<?php

namespace App\Services\Logging;

use App\Models\OutgoingRequest;
use App\Models\OutgoingRequestPayload;
use App\Models\OutgoingResponse;
use App\Models\OutgoingResponsePayload;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

class OutgoingLogger
{
    /**
     * @throws Throwable
     */
    public static function storeRequest(
        string $targetSystem,
        string $endpoint,
        string $method,
        array  $headers,
        array  $payload = []
    ): OutgoingRequest
    {
        return DB::transaction(function () use (
            $targetSystem,
            $endpoint,
            $method,
            $headers,
            $payload
        ) {
            $route = self::parseEndpoint($endpoint);
            $outgoingRequest = OutgoingRequest::create([
                'trace_id' => request()->attributes->get('trace_id'),
                'target_system' => $targetSystem,
                'module' => $route['module'],
                'interface_no' => $route['interface_no'],
                'endpoint_name' => $route['endpoint_name'],
                'endpoint' => $endpoint,
                'method' => $method,
            ]);

            OutgoingRequestPayload::create([
                'outgoing_request_id' => $outgoingRequest->id,
                'headers' => $headers,
                'payload' => $payload,
            ]);

            return $outgoingRequest;
        });
    }

    private static function parseEndpoint(string $endpoint): array
    {
        $endpoint = trim($endpoint, '/');
        $segments = explode('/', $endpoint);
        return [
            'module' => $segments[2] ?? '',
            'interface_no' => $segments[3] ?? '',
            'endpoint_name' => $segments[4] ?? '',
        ];
    }

    /**
     * @throws Throwable
     */
    public static function storeResponse(
        OutgoingRequest $outgoingRequest,
        Response        $response,
        ?int            $processingTimeMs = null
    ): OutgoingResponse
    {
        return DB::transaction(function () use (
            $outgoingRequest,
            $response,
            $processingTimeMs
        ) {

            $body = $response->json();
            $outgoingResponse = OutgoingResponse::create([
                'outgoing_request_id' => $outgoingRequest->id,
                'status' => $response->successful() ? 'success' : 'error',
                'status_code' => $response->status(),
                'response_code' => $body['code'] ?? null,
                'message' => $body['message'] ?? null,
                'trace_id' => request()->attributes->get('trace_id'),
                'processing_time_ms' => $processingTimeMs,
            ]);

            OutgoingResponsePayload::create([
                'outgoing_response_id' => $outgoingResponse->id,
                'payload' => $body,
            ]);

            return $outgoingResponse;
        });
    }
}
