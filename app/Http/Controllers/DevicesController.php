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
        return response()->json(['data' => Device::where('team_id', $teamId)->get()]);
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

        return response()->json(['message' => 'Device Created Successfully.', 'data' => $device]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $device = Device::find($id);
        if (!$device) {
            return response()->json(['message' => 'Device not found.'], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'name' => ['required'],
            'ip' => ['required', 'ip'],
            'user' => ['required'],
            'password' => ['required'],
            'ikev2' => ['nullable'],
            'team_id' => ['required', Rule::exists('teams', 'id')->where(fn($query) => $query->where('user_id', Auth::id()))],
        ])->validate();

        $device->update($validatedData);

        return response()->json(['message' => 'Device Updated Successfully.', 'data' => $device]);
    }

    public function destroy(int $id): JsonResponse
    {
        $device = Device::findOrFail($id);
        $device->delete();
        return response()->json(['message' => 'Device Deleted Successfully.']);
    }

    /**
     * Display the specified resource and sync device users and profiles.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $device = $this->getDevice($id);

        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        try {
            $teamId = $device->team_id;
            $users = User::where('current_team_id', $teamId)->get();
            $products = Product::where('team_id', $teamId)->get();

            $pppUsersOnDevice = collect($this->routerOSService->listPppUsers($device))->pluck('name')->toArray();
            $pppProfilesOnDevice = collect($this->routerOSService->listPppProfiles($device))->pluck('name')->toArray();

            foreach ($products as $product) {
                $profileName = $this->sanitizeName($product->name);
                if (!in_array($profileName, $pppProfilesOnDevice)) {
                    $requestData = [
                        'name' => $profileName,
                        'rate-limit' => $product->rate
                    ];
                    $request = new Request($requestData);
                    try {
                        $this->routerOSService->createPppProfile($request, $device);
                    } catch (Throwable $e) {
                        Log::error('Error creating PPP profile', [
                            'product_id' => $product->id,
                            'profile_name' => $product->name,
                            'device_id' => $device->id,
                            'error' => $e->getMessage(),
                            'rate_limit' => $requestData['rate-limit'],
                        ]);
                    }
                }
            }

            foreach ($users as $user) {
                $username = $this->sanitizeName($user->name);
                if (!in_array($username, $pppUsersOnDevice)) {
                    $requestData = [
                        'name' => $username,
                        'password' => Str::random(16),
                        'profile' => 'default', // TODO: Ensure 'default' profile exists on RouterOS or make it configurable
                    ];
                    $request = new Request($requestData);
                    try {
                        $this->routerOSService->createPppUser($request, $device);
                    } catch (Throwable $e) {
                        Log::error('Error creating PPP user', [
                            'user_id' => $user->id,
                            'username' => $user->name,
                            'device_id' => $device->id,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            }

            $pppUsers = $this->routerOSService->listPppUsers($device);
            $pppProfiles = $this->routerOSService->listPppProfiles($device);
            $deviceInfo = $this->routerOSService->show($device);

            return response()->json([
                'message' => 'Device users and profiles synced and data retrieved successfully.',
                'pppUsers' => $pppUsers,
                'device' => $deviceInfo,
                'pppProfiles' => $pppProfiles,
            ]);
        } catch (Throwable $e) {
            Log::error('Error fetching or syncing device resource', ['device_id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Error fetching or syncing device resource: ' . $e->getMessage()], 500);
        }
    }

    private function getDevice(int $id): ?Device
    {
        return Device::find($id);
    }

    private function sanitizeName(string $name): string
    {
        $normalizedName = Normalizer::normalize($name, Normalizer::FORM_D);
        $sanitizedName = preg_replace('/\p{M}/u', '', $normalizedName);
        return preg_replace('/[^a-zA-Z0-9_-]/', '_', $sanitizedName);
    }
}
