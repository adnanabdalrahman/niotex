<?php

namespace App\Services\Niotix;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class NiotixApiClient
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('niotix.base_url'), '/');
        $this->apiKey = config('niotix.api_key');
    }

    /**
     * Send POST request to Niotix API.
     *
     * @throws ConnectionException
     * @throws Exception
     */
    public function post(string $endpoint, array $query = [], array $body = []): array
    {
        $response = $this->client()
            ->withQueryParameters($query)
            ->post($this->baseUrl . '/' . ltrim($endpoint, '/'), $body);

        if (!$response->successful()) {
            throw new RuntimeException(
                'Niotix POST request failed: ' . $response->body()
            );
        }

        return $response->json();
    }

    /**
     * Create HTTP client.
     */
    private function client(): PendingRequest
    {
        return Http::retry(3, 1000)
            ->timeout(30)
            ->acceptJson()
            ->withHeaders([
                'x-api-key' => $this->apiKey,
            ]);
    }

    public function getByUrl(string $url): array
    {
        $response = $this->client()->get($url);

        if (!$response->successful()) {
            throw new RuntimeException(
                'Niotix GET request failed: ' . $response->body()
            );
        }

        return $response->json();
    }

    /**
     * Send GET request to Niotix API.
     *
     * @throws ConnectionException
     * @throws Exception
     */
    public function get(string $endpoint, array $query = []): array
    {
        $response = $this->client()
            ->withQueryParameters($query)
            ->get($this->baseUrl . '/' . ltrim($endpoint, '/'));

        if (!$response->successful()) {
            throw new RuntimeException(
                'Niotix GET request failed: ' . $response->body()
            );
        }

        return $response->json();
    }

}
