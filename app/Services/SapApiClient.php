<?php

namespace App\Services;

use App\Services\Logging\OutgoingLogger;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

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
     * @throws Throwable
     */
    public function post(string $endpoint, array $data)
    {
        $headers = [
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/json',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
        ];

        // Store outgoing request
        $outgoingRequest = OutgoingLogger::storeRequest(
            targetSystem: 'sap',
            endpoint: $endpoint,
            method: 'POST',
            headers: $headers,
            payload: $data
        );

        $startedAt = microtime(true);

        $response = Http::withHeaders($headers)->post($this->baseUrl . $endpoint, $data);
        // Store outgoing response
        OutgoingLogger::storeResponse(
            $outgoingRequest,
            $response,
            (int)round((microtime(true) - $startedAt) * 1000)
        );

        if (!$response->successful()) {
            throw new Exception("SAP POST to '{$endpoint}' failed: " . $response->body());
        }

        return $response->json();
    }


    /**
     * @throws ConnectionException
     * @throws Exception
     * @throws Throwable
     */
    public function get(string $endpoint, string $data)
    {
        $headers = [
            'Accept' => 'application/json',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
        ];

        // Store outgoing request
        $outgoingRequest = OutgoingLogger::storeRequest(
            targetSystem: 'sap',
            endpoint: $endpoint,
            method: 'GET',
            headers: $headers,
            payload: [
                'query' => $data,
            ]
        );

        $startedAt = microtime(true);

        $response = Http::withHeaders($headers)
            ->get($this->baseUrl . $endpoint . $data);

        // Store outgoing response
        OutgoingLogger::storeResponse(
            $outgoingRequest,
            $response,
            (int)round((microtime(true) - $startedAt) * 1000)
        );

        if (!$response->successful()) {
            throw new Exception(
                "SAP GET to '{$endpoint}' failed: " . $response->body()
            );
        }

        return $response->json();
    }

}
