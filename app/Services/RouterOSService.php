<?php

namespace App\Services;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Query;
use Throwable;

class RouterOSService
{
    /**
     * Connects to the RouterOS device.
     *
     * @param  Device  $device
     * @return Client
     * @throws ConnectException
     */
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

    /**
     * Executes a RouterOS request and handles exceptions.
     *
     * @param  Device  $device
     * @param  callable  $callback  The callback function to execute. Receives a RouterOS\Client instance as an argument.
     * @return array  The result of the callback or an error message.
     * @throws Throwable
     */
    private function executeRouterOSRequest(Device $device, callable $callback): array
    {
        try {
            $client = $this->connectToRouterOS($device);
            $result = $callback($client);
            if (!is_array($result)) {
                Log::error("RouterOS request did not return an array for device {$device->id}.");
                return ['error' => 'Unexpected response from RouterOS.'];
            }
            return $result;
        } catch (ConnectException $e) {
            Log::error("RouterOS connection failed for device {$device->id}: {$e->getMessage()}");
            return ['error' => 'Connection to RouterOS failed.'];
        } catch (Throwable $e) {
            Log::error("RouterOS request failed for device {$device->id}: {$e->getMessage()}");
            throw $e;
        }
    }

    /**
     * Retrieves system resource information.
     *
     * @param  Device  $device
     * @return array
     * @throws Throwable
     */
    public function show(Device $device): array
    {
        return $this->executeRouterOSRequest($device, fn (Client $client) => $client->query('/system/resource/print')->read());
    }

    /**
     * Creates a new PPP user.
     *
     * @param  Request  $request
     * @param  Device  $device
     * @return array
     * @throws Throwable
     */
    public function createPppUser(Request $request, Device $device): array
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required'],
            'password' => ['required'],
            'profile' => ['required'],
        ])->validate();

        return $this->executeRouterOSRequest($device, function (Client $client) use ($validated): array {
            $query = new Query('/ppp/secret/add');
            $query->equal('name', $validated['name']);
            $query->equal('password', $validated['password']);
            $query->equal('profile', $validated['profile']);
            $client->query($query)->read();
            return ['message' => 'PPP user created successfully.'];
        });
    }

    /**
     * Creates a new PPP profile.
     *
     * @param  Request  $request
     * @param  Device  $device
     * @return array
     * @throws Throwable
     */
    public function createPppProfile(Request $request, Device $device): array
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required'],
            'rate-limit' => ['required'],
        ])->validate();

        return $this->executeRouterOSRequest($device, function (Client $client) use ($validated): array {
            $query = new Query('/ppp/profile/add');
            $query->equal('name', $validated['name']);
            $query->equal('rate-limit', $validated['rate-limit']);
            $client->query($query)->read();
            return ['message' => 'PPP profile created successfully.'];
        });
    }

    /**
     * Lists all PPP users.
     *
     * @param  Device  $device
     * @return array
     * @throws Throwable
     */
    public function listPppUsers(Device $device): array
    {
        return $this->executeRouterOSRequest($device, fn (Client $client) => $client->query('/ppp/secret/print')->read());
    }

    /**
     * Lists all PPP profiles.
     *
     * @param  Device  $device
     * @return array
     * @throws Throwable
     */
    public function listPppProfiles(Device $device): array
    {
        return $this->executeRouterOSRequest($device, fn (Client $client) => $client->query('/ppp/profile/print')->read());
    }

    /**
     * Deletes a PPP user.
     *
     * @param  Request  $request
     * @param  Device  $device
     * @return array
     * @throws Throwable
     */
    public function deletePppUser(Request $request, Device $device): array
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();

        return $this->executeRouterOSRequest($device, function (Client $client) use ($validated): array {
            $client->query('/ppp/secret/remove', ['name' => $validated['name']])->read();
            return ['message' => 'PPP user deleted successfully.'];
        });
    }

    /**
     * Deletes a PPP profile.
     *
     * @param  Request  $request
     * @param  Device  $device
     * @return array
     * @throws Throwable
     */
    public function deletePppProfile(Request $request, Device $device): array
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();

        return $this->executeRouterOSRequest($device, function (Client $client) use ($validated): array {
            $client->query('/ppp/profile/remove', ['name' => $validated['name']])->read();
            return ['message' => 'PPP profile deleted successfully.'];
        });
    }
}