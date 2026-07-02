<?php namespace App\Services\Logging;

use App\Helpers\RequestSource;
use App\Models\IncomingRequest;
use App\Models\IncomingRequestPayload;
use App\Models\IncomingResponse;
use App\Models\IncomingResponsePayload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class IncomingLogger
{
    /** * Store incoming request metadata and payload. * * @throws Throwable */
    public static function storeRequest(Request $request): IncomingRequest
    {
        return DB::transaction(function () use ($request) {
            $route = self::parseEndpoint($request);
            $incomingRequest = IncomingRequest::create(['trace_id' =>
                $request->attributes->get('trace_id'),
                'source_system' => RequestSource::getChannel(),
                'module' => $route['module'],
                'interface_no' => $route['interface_no'],
                'endpoint_name' => $route['endpoint_name'],
                'endpoint' => $route['endpoint'],
                'method' => $request->method(),
                'client_ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'content_type' => $request->header('Content-Type'),
            ]);
            IncomingRequestPayload::create(['incoming_request_id' => $incomingRequest->id,
                'headers' => $request->headers->all(),
                'payload' => $request->all(),]);
            return $incomingRequest;
        });
    }

    /** * Parse endpoint information. */
    private static function parseEndpoint(Request $request): array
    {
        $endpoint = trim($request->path(), '/');
        $segments = explode('/', $endpoint);
        return ['endpoint' => $endpoint,
            'module' => $segments[2] ?? '',
            'interface_no' => $segments[3] ?? '',
            'endpoint_name' => $segments[4] ?? '',
        ];
    }

    /** * Store response metadata and payload. * * @throws Throwable */
    public static function storeResponse(IncomingRequest $incomingRequest, array $response, ?int $processingTimeMs = null): IncomingResponse
    {
        return DB::transaction(function () use ($incomingRequest, $response, $processingTimeMs) {
            $incomingResponse = IncomingResponse::create(['incoming_request_id' => $incomingRequest->id,
                'status' => $response['status'] ?? 'error',
                'status_code' => $response['status_code'] ?? 500,
                'response_code' => $response['code'] ?? null,
                'message' => $response['message'] ?? null,
                'trace_id' => $response['meta']['trace_id'] ?? null,
                'path' => $response['meta']['path'] ?? null,
                'processing_time_ms' => $processingTimeMs,
            ]);
            $payload = null;
            if (array_key_exists('data', $response)) {
                $payload = $response['data'];
            } elseif (array_key_exists('errors', $response)) {
                $payload = $response['errors'];
            }
            IncomingResponsePayload::create(['incoming_response_id' => $incomingResponse->id, 'payload' => $payload,]);
            return $incomingResponse;
        });
    }

}
