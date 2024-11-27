<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Device;
use Illuminate\Support\Facades\Validator;
use RouterOS\Client;
use RouterOS\Config; // Added import for Config class
use Illuminate\Support\Facades\Auth; // Added to access Auth facade

class DevicesController extends Controller
{
    /**
     * Display a listing of the devices.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $teamId = Auth::user()->current_team_id;
        $devices = Device::where('team_id', $teamId)->get();
        return response()->json($devices);
    }

    /**
     * Show the selected device's information using the connection to RouterOS.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $teamId = Auth::user()->current_team_id;

        $device = Device::where('team_id', $teamId)->find($id);
        if ($device) {
            // Test connection to the device using the RouterOS facade
            $client = \RouterOS::client([
                'host'        => $device->ip,
                'user'        => $device->user,
                'pass'        => $device->password,
                'port'        => $device->port ?? 8728,
                'ssh_timeout' => 60,
            ]);

            try {
                $identityResponse = $client->query('/system/identity/print')->read(); // Get device identity
                $pppClientsResponse = $client->query('/ppp/active/print')->read(); // Get connected PPP clients list
                $pppSecretResponse = $client->query('/ppp/secret/print')->read(); // Get PPP secret list
                $connectionProfilesResponse = $client->query('/interface/ppp-client/print')->read(); // Get connection profiles list

                return response()->json([
                    'device' => $device, 
                    'identity' => $identityResponse, 
                    'ppp_clients' => $pppClientsResponse,
                    'ppp_secrets' => $pppSecretResponse,
                    'connection_profiles' => $connectionProfilesResponse // Added connection profiles
                ]);
            } catch (\Exception $e) {
                return response()->json(['device' => $device, 'error' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'Device not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $teamId = Auth::user()->current_team_id; // Get team ID only once using Auth facade

        $validatedData = Validator::make($request->all(), [
            'name' => ['required'],
            'ip' => ['required', 'ip'], // Added IP validation
            'user' => ['required'], // Added user validation
            'password' => ['required'], // Added password validation
            'port' => ['nullable', 'integer'], // Added port validation
        ])->validate();

        $validatedData['team_id'] = $teamId;

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
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required'],
            'ip' => ['required', 'ip'], // Added IP validation
            'user' => ['required'], // Added user validation
            'password' => ['required'], // Added password validation
            'port' => ['nullable', 'integer'], // Added port validation
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
    public function destroy(Request $request, $id)
    {
        Device::find($id)->delete();
        return redirect()->back();
    }
}
