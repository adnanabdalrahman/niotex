<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class SapApiClient
{
    protected $baseUrl;
    protected $client_id;
    protected $client_secret;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->client_id = config('sap.client_id');
        $this->client_secret = config('sap.client_secret');
    }

    /**
     * Fetch CSRF token and cookies from SAP
     */
    protected function fetchToken($tokenEndpoint): array
    {
        $response = Http::withHeaders([
            'x-csrf-token' => 'Fetch',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
        ])->get("{$this->baseUrl}{$tokenEndpoint}");


        if ($response->header('x-csrf-token') == "") {
            throw new \Exception("Token request failed: " . $response->body());
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
    }

    /**
     * General method to send POST request with CSRF token
     */
    public function post(string $endpoint, array $data): array
    {
        $tokenEndpoint = $endpoint;
        $auth = $this->fetchToken($tokenEndpoint);
        $response = Http::withHeaders([
            'x-csrf-token' => $auth['token'],
            'Accept' => 'application/json',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
        ])->withCookies($auth['cookies'], parse_url($this->baseUrl, PHP_URL_HOST))
            ->post("{$this->baseUrl}{$endpoint}", $data);



        if (!$response->successful()) {
            throw new \Exception("SAP POST to '{$endpoint}' failed: " . $response->body());
        }

        return $response->json();
    }
}
