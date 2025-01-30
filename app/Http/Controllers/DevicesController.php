<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Product;
use App\Models\User;
use App\Services\RouterOSService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Normalizer;
use Throwable;

class DevicesController extends Controller
{
    private RouterOSService $routerOSService;

    public function __construct(RouterOSService $routerOSService)
    {
        $this->routerOSService = $routerOSService;
    }

    public function index(): JsonResponse
    {
        $teamId = Auth::user()->current_team_id;
        $devices = Device::where('team_id', $teamId)->get();
        return response()->json(['data' => $devices]);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required'],
            'ip' => ['required', 'ip'],
            'user' => ['required'],
            'password' => ['required'],
            'ikev2' => ['nullable'],
            'team_id' => ['required', Rule::exists('teams', 'id')->where(fn($query) => $query->where('user_id', Auth::id()))],
        ])->validate();

        $device = Device::create($validatedData);

        if (!$this->createDeviceConfigFile($device, $validatedData['ip'], $validatedData['ikev2'] ?? false)) {
            return response()->json(['message' => 'Device Created, but config file creation failed.', 'data' => $device], 500);
        }

        return response()->json(['message' => 'Device Created Successfully.', 'data' => $device], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $device = Device::findOrFail($id);

        $validatedData = Validator::make($request->all(), [
            'name' => ['required'],
            'ip' => ['required', 'ip'],
            'user' => ['required'],
            'password' => ['required'],
            'ikev2' => ['nullable'],
            'team_id' => ['required', Rule::exists('teams', 'id')->where(fn($query) => $query->where('user_id', Auth::id()))],
        ])->validate();

        $device->update($validatedData);

        if (!$this->updateDeviceConfigFile($device, $validatedData['ip'], $validatedData['ikev2'] ?? false)) {
            return response()->json(['message' => 'Device Updated, but config file update failed.', 'data' => $device], 500);
        }

        return response()->json(['message' => 'Device Updated Successfully.', 'data' => $device]);
    }

    public function destroy(int $id): JsonResponse
    {
        $device = Device::findOrFail($id);

        if (!$this->deleteDeviceConfigFile($device)) {
            Log::error('Failed to delete config file for device ' . $device->name);
            // Log the error but don't prevent device deletion
        }

        $device->delete();
        return response()->json(['message' => 'Device Deleted Successfully.']);
    }

    /**
     * Display the specified device.
     * Retrieves device data and syncs PPP users and profiles.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $device = $this->getDeviceById($id);

        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        try {
            $syncResult = $this->syncDeviceData($device);
        } catch (Throwable $e) {
            Log::error('Error syncing device data', ['device_id' => $device->id, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to sync device data'], 500);
        }

        return response()->json([
            'message' => 'Device data retrieved successfully.',
            'device' => $syncResult['device'],
            'pppUsers' => $syncResult['pppUsers'],
            'pppProfiles' => $syncResult['pppProfiles'],
        ]);
    }


    /**
     * Sync device users and profiles with the RouterOS device.
     *
     * @param  Device  $device
     * @return array
     */
    private function syncDeviceData(Device $device): array
    {
        $teamId = $device->team_id;
        $users = User::where('current_team_id', $teamId)->get();
        $products = Product::where('team_id', $teamId)->get();

        // Retrieve PPP users and profiles directly from the RouterOS device
        $pppUsersOnDeviceList = $this->routerOSService->listPppUsers($device);
        $pppProfilesOnDeviceList = $this->routerOSService->listPppProfiles($device);

        // Extract names for easier comparison
        $pppUsersOnDevice = collect($pppUsersOnDeviceList)->pluck('name')->toArray();
        $pppProfilesOnDevice = collect($pppProfilesOnDeviceList)->pluck('name')->toArray();

        // Sync PPP profiles based on products
        $this->syncPppProfiles($device, $products, $pppProfilesOnDevice);
        // Sync PPP users based on users
        $this->syncPppUsers($device, $users, $pppUsersOnDevice);

        // Retrieve device information again to ensure latest data
        $deviceInfo = $this->routerOSService->show($device);

        return [
            'pppUsers' => $pppUsersOnDeviceList,
            'device' => $deviceInfo,
            'pppProfiles' => $pppProfilesOnDeviceList,
        ];
    }

    /**
     * Sync PPP profiles to the RouterOS device based on products.
     * Creates profiles if they don't exist.
     *
     * @param  Device  $device
     * @param  \Illuminate\Database\Eloquent\Collection  $products
     * @param  array  $pppProfilesOnDevice
     * @return void
     */
    private function syncPppProfiles(Device $device, $products, array $pppProfilesOnDevice): void
    {
        foreach ($products as $product) {
            $profileName = $this->sanitizeName($product->name);
            if (!in_array($profileName, $pppProfilesOnDevice)) {
                $profileData = [
                    'name' => $profileName,
                    'rate-limit' => $product->rate,
                ];
                try {
                    $request = new Request();
                    $request->replace($profileData);
                    $this->routerOSService->createPppProfile($request, $device);
                } catch (Throwable $e) {
                    Log::error('Error creating PPP profile', [
                        'product_id' => $product->id,
                        'profile_name' => $product->name,
                        'device_id' => $device->id,
                        'error' => $e->getMessage(),
                        'rate_limit' => $profileData['rate-limit'],
                    ]);
                }
            }
        }
    }

    /**
     * Sync PPP users to the RouterOS device based on users.
     * Creates users if they don't exist.
     *
     * @param  Device  $device
     * @param  \Illuminate\Database\Eloquent\Collection  $users
     * @param  array  $pppUsersOnDevice
     * @return void
     */
    private function syncPppUsers(Device $device, $users, array $pppUsersOnDevice): void
    {
        $defaultProfileName = 'default'; // Define default profile name - make configurable if needed

        foreach ($users as $user) {
            $username = $this->sanitizeName($user->name);
            if (!in_array($username, $pppUsersOnDevice)) {
                $userData = [
                    'name' => $username,
                    'password' => Str::random(16),
                    'profile' => $defaultProfileName,
                ];
                try {
                    $request = new Request();
                    $request->replace($userData);
                    $this->routerOSService->createPppUser($request, $device);
                } catch (Throwable $e) {
                    Log::error('Error creating PPP user', [
                        'user_id' => $user->id,
                        'username' => $user->name,
                        'device_id' => $device->id,
                        'error' => $e->getMessage(),
                        'profile' => $defaultProfileName, // Log the profile name as well
                    ]);
                }
            }
        }
    }


    private function getDeviceById(int $id): ?Device
    {
        return Device::find($id);
    }

    /**
     * Sanitize a name to be used as a PPP profile or user name.
     * Removes accents and special characters, replaces spaces with underscores.
     *
     * @param  string  $name
     * @return string
     */
    private function sanitizeName(string $name): string
    {
        $normalizedName = Normalizer::normalize($name, Normalizer::FORM_D);
        $sanitizedName = preg_replace('/\p{M}/u', '', $normalizedName);
        return preg_replace('/[^a-zA-Z0-9_-]/', '_', $sanitizedName);
    }

    private function createDeviceConfigFile(Device $device, string $ip, bool $ikev2): bool
    {
        $deviceNameSlug = Str::slug($device->name) . '_' . $device->id;
        return $this->createOrUpdateConfigFile($deviceNameSlug, $ip, $ikev2);
    }

    private function updateDeviceConfigFile(Device $device, string $ip, bool $ikev2): bool
    {
        $deviceNameSlug = Str::slug($device->name) . '_' . $device->id;
        return $this->createOrUpdateConfigFile($deviceNameSlug, $ip, $ikev2);
    }

    private function deleteDeviceConfigFile(Device $device): bool
    {
        $deviceNameSlug = Str::slug($device->name) . '_' . $device->id;
        try {
            Storage::delete('ipsec.d/' . $deviceNameSlug . '.conf');
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to delete config file for device ' . $device->name . ': ' . $e->getMessage());
            return false;
        }
    }


    private function createOrUpdateConfigFile(string $deviceNameSlug, string $ip, bool $ikev2): bool
    {
        $configContent = $this->generateConfigFileContent($deviceNameSlug,$ip, $ikev2);
        try {
            Storage::disk('local')->put('ipsec.d/' . $deviceNameSlug . '.conf', $configContent);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to create/update config file for device ' . $deviceNameSlug . ': ' . $e->getMessage());
            return false;
        }
    }

    private function generateConfigFileContent(string $deviceNameSlug, string $ip, bool $ikev2): string
    {
        $deviceName = str_replace('.', '-', $deviceNameSlug);
        $ikev2Config = $ikev2 ? 'also=ikev2-cp' : '';
        return <<<CONF
conn {$deviceName}
  rightid=@{$deviceName}
  rightaddresspool={$ip}-{$ip}
  {$ikev2Config}
CONF;
    }
}
