<?php

namespace App\Services\Niotix;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use RuntimeException;

class NiotixApiClient
{
    private const RATE_LIMITER_KEY = 'niotix-api';

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
        $response = $this->send(fn() => $this->client()
            ->withQueryParameters($query)
            ->post($this->baseUrl . '/' . ltrim($endpoint, '/'), $body));

        if (!$response->successful()) {
            throw new RuntimeException(
                'Niotix POST request failed: ' . $response->body()
            );
        }

        return $response->json();
    }

    /**
     * Create HTTP client.
     * Retries only connection errors and 5xx responses; 4xx (incl. the rate limit) are handled in send().
     */
    private function client(): PendingRequest
    {
        return Http::retry(3, 1000, function (Exception $e) {
            return $e instanceof ConnectionException
                || ($e instanceof RequestException && $e->response->serverError());
        }, throw: false)
            ->timeout(30)
            ->acceptJson()
            ->withHeaders([
                'x-api-key' => $this->apiKey,
            ]);
    }

    /**
     * Run a request while respecting the niotix rate limit (calls per minute per API key).
     * The limiter lives in the cache store, so it is shared by web requests and queue workers.
     */
    private function send(callable $request): Response
    {
        $maxWaits = config('niotix.rate_limit_max_waits', 5);

        for ($wait = 0; ; $wait++) {
            $this->throttle();
            $response = $request();

            if (!$this->isRateLimited($response) || $wait >= $maxWaits) {
                $this->pauseIfQuotaExhausted($response);
                return $response;
            }

            $seconds = $this->secondsUntilReset($response);
            logger()->warning("Niotix API limit reached, waiting {$seconds}s before retrying", [
                'attempt' => $wait + 1,
                'max_waits' => $maxWaits,
            ]);
            sleep($seconds);
        }
    }

    /**
     * Block until our own per-minute budget allows another call.
     */
    private function throttle(): void
    {
        $perMinute = config('niotix.rate_limit_per_minute', 60);

        while (RateLimiter::tooManyAttempts(self::RATE_LIMITER_KEY, $perMinute)) {
            sleep(max(1, RateLimiter::availableIn(self::RATE_LIMITER_KEY)));
        }

        RateLimiter::hit(self::RATE_LIMITER_KEY, 60);
    }

    private function isRateLimited(Response $response): bool
    {
        return $response->status() === 429
            || data_get($response->json(), 'type') === 'API_LIMIT_REACHED';
    }

    /**
     * niotix reports the remaining calls in X-RateLimit-Remaining; when it hits 0, wait for the reset
     * so the next call does not fail (covers other clients using the same API key).
     */
    private function pauseIfQuotaExhausted(Response $response): void
    {
        $remaining = $response->header('X-RateLimit-Remaining');

        if ($remaining !== '' && (int)$remaining <= 0) {
            sleep($this->secondsUntilReset($response));
        }
    }

    /**
     * X-RateLimit-Reset is a Unix timestamp (seconds); fall back to a full minute.
     */
    private function secondsUntilReset(Response $response): int
    {
        $reset = (int)$response->header('X-RateLimit-Reset');
        $seconds = $reset > 0 ? $reset - time() + 1 : 60;

        return min(max($seconds, 1), 65);
    }

    public function getByUrl(string $url): array
    {
        $response = $this->send(fn() => $this->client()->get($url));

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
        $response = $this->send(fn() => $this->client()
            ->withQueryParameters($query)
            ->get($this->baseUrl . '/' . ltrim($endpoint, '/')));

        if (!$response->successful()) {
            throw new RuntimeException(
                'Niotix GET request failed: ' . $response->body()
            );
        }

        return $response->json();
    }

}
