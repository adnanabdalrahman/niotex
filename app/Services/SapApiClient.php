<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class SapApiClient
{
    protected mixed $baseUrl;
    protected mixed $client_id;
    protected mixed $client_secret;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->client_id = config('sap.client_id');
        $this->client_secret = config('sap.client_secret');
    }

    /**
     * Fetch CSRF token and cookies from SAP
     * @throws ConnectionException
     * @throws Exception
     */
    /*protected function fetchToken($tokenEndpoint): array
    {
        $response = Http::withHeaders([
            'x-csrf-token' => 'Fetch',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
        ])->get($this->baseUrl.$tokenEndpoint);


        if ($response->header('x-csrf-token') == "") {
            throw new Exception("Token request failed: " . $response->body());
        }
        // Convert cookies into associative array
        $cookies = [];
        foreach ($response->cookies() as $cookie) {
            $cookies[$cookie->getName()] = $cookie->getValue();
        }

        return [
            'token' => $response->header('x-csrf-token'),
            'cookies' => $cookies,
        ];
    }*/

    /**
     * General method to send POST request with CSRF token
     * @throws Exception
     */
    public function post(string $endpoint, array $data)
    {
//        $tokenEndpoint = $endpoint;
//        $auth = $this->fetchToken($tokenEndpoint);
        $response = Http::withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/json',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
        ])->post($this->baseUrl . $endpoint, $data);

        if (!$response->successful()) {
            \Log::error("SAP POST to '{$endpoint}' failed: " . $response->body());
            return null;
        }
        return $response->json();
    }


    /**
     * @throws ConnectionException
     * @throws Exception
     */
    public function get(string $endpoint, string $data)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
        ])->get($this->baseUrl . $endpoint . $data);
        if (!$response->successful()) {
            throw new Exception("SAP GET to '{$endpoint}' failed: " . $response->body());
        }
        return $response->json();
    }

}
