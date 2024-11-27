<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RouterOS\Client;
use Illuminate\Support\Facades\Log;
use RouterOS\Query\Query;
use RouterOS\Config;


class DevicesController extends Controller
{
    /**
     * Display a listing of the devices.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $teamId = Auth::user()->current_team_id;
        $perPage = $request->input('per_page', 4); // Default to 4 per page
        $page = $request->input('page', 1); // Default to page 1

        $devices = Device::where('team_id', $teamId)
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $devices->items(),
            'meta' => [
                'current_page' => $devices->currentPage(),
                'last_page' => $devices->lastPage(),
                'per_page' => $devices->perPage(),
                'total' => $devices->total(),
            ],
            'links' => [
                'previous' => $devices->previousPageUrl(),
                'next' => $devices->nextPageUrl(),
            ],
        ]);
    }

    /**
     * Show the selected device's information using the connection to RouterOS.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $device = Device::where('team_id', Auth::user()->current_team_id)->find($id);

        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        try {
            $client = $this->connectToRouterOS($device);

            $identityResponse = $client->query('/system/identity/print')->read();
            $pppClientsResponse = $client->query('/ppp/active/print')->read();
            $pppSecretResponse = $client->query('/ppp/secret/print')->read();
            $connectionProfilesResponse = $client->query('/interface/ppp-client/print')->read();

            return response()->json([
                'device' => $device,
                'identity' => $identityResponse,
                'ppp_clients' => $pppClientsResponse,
                'ppp_secrets' => $pppSecretResponse,
                'connection_profiles' => $connectionProfilesResponse,
            ]);
        } catch (\Exception $e) {
            Log::error('Error connecting to RouterOS: ' . $e->getMessage());
            return response()->json(['device' => $device, 'error' => 'Error connecting to RouterOS'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required'],
            'ip' => ['required', 'ip'],
            'user' => ['required'],
            'password' => ['required'],
            'port' => ['nullable', 'integer'],
        ])->validate();

        $validatedData['team_id'] = Auth::user()->current_team_id;

        Device::create($validatedData);

        return redirect()->back()->with('message', 'Device Created Successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required'],
            'ip' => ['required', 'ip'],
            'user' => ['required'],
            'password' => ['required'],
            'port' => ['nullable', 'integer'],
        ])->validate();

        Device::find($id)->update($validatedData);

        return redirect()->back()->with('message', 'Device Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        Device::find($id)->delete();
        return redirect()->back();
    }

    /**
     * Creates a new PPP user on the Routerboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPppUser(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $device = Device::where('team_id', Auth::user()->current_team_id)->find($id);

        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'name' => ['required'],
            'password' => ['required'],
            'profile' => ['required'],
        ])->validate();

        try {
            $client = $this->connectToRouterOS($device);
            $client->command('/ppp/secret/add', [
                'name' => $validatedData['name'],
                'password' => $validatedData['password'],
                'profile' => $validatedData['profile'],
                'service' => 'any',
            ]);

            return response()->json(['message' => 'Usuário PPP criado com sucesso.']);
        } catch (\Exception $e) {
            Log::error('Error creating PPP user: ' . $e->getMessage());
            return response()->json(['error' => 'Error creating PPP user'], 500);
        }
    }

    /**
     * Creates a new PPP user profile on the Routerboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPppProfile(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $device = Device::where('team_id', Auth::user()->current_team_id)->find($id);

        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'name' => ['required'],
            'remote-address' => ['required'],
        ])->validate();

        try {
            $client = $this->connectToRouterOS($device);
            $client->command('/interface/ppp-client/add', $validatedData);

            return response()->json(['message' => 'Perfil PPP criado com sucesso.']);
        } catch (\Exception $e) {
            Log::error('Error creating PPP profile: ' . $e->getMessage());
            return response()->json(['error' => 'Error creating PPP profile'], 500);
        }
    }

    private function connectToRouterOS(Device $device): Client
    {
        $config = new Config([
            'host' => $device->ip,
            'user' => $device->user,
            'pass' => $device->password,
            'port' => $device->port ?? 8728,
            'ssh_timeout' => 60,
        ]);
        $client = new Client($config);
        $client->connect();
        return $client;
    }
}
