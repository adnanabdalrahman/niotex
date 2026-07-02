<?php

namespace App\Http\Middleware;

use App\Notifications\ErrorNotifiable;
use App\Notifications\ErrorReportNotification;
use App\Services\Logging\IncomingLogger;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class VerifyCeosWebToken
{
    /**
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Generate one Trace ID for the whole request lifecycle
        $traceId = (string)Str::uuid();

        $request->attributes->set('request_started_at', microtime(true));
        $request->attributes->set('trace_id', $traceId);

        $this->logIncomingRequest($request, $traceId);

        // Store request in database (before authentication)
        $incomingRequest = IncomingLogger::storeRequest($request);

        $request->attributes->set('incoming_request', $incomingRequest);

        // Validate CEOS-Web Token
        $token = $request->header('Ceos-Web-Token');

        if (!$token || $token !== config('ceosweb.api_token')) {
            $response = [
                "status" => "error",
                "status_code" => 401,
                "code" => "UNAUTHORIZED",
                "message" => "Unauthorized Request",
                "data" => [],
                "meta" => [
                    "path" => $request->path(),
                    "timestamp" => now()->toIso8601String(),
                    "trace_id" => $traceId,
                ]
            ];

            Log::channel('incoming_requests')->warning(
                'Unauthorized CEOS-Web Request',
                $response
            );

            IncomingLogger::storeResponse($incomingRequest, $response, (int)round(
                (microtime(true) - $request->attributes->get('request_started_at')) * 1000
            ));

            (new ErrorNotifiable())->notify(new ErrorReportNotification($response));
            return response()->json($response, 401);
        }

        return $next($request);
    }

    /**
     * Write incoming request to log file.
     */
    private function logIncomingRequest(Request $request, string $traceId): void
    {
        Log::channel('incoming_requests')->info(
            'Incoming CEOS-Web Request',
            [
                'trace_id' => $traceId,
                'method' => $request->method(),
                'ip' => $request->ip(),
                'user_id' => optional($request->user())->id,
                'body' => $request->all(),
                'headers' => $request->headers->all(),
                'url' => $request->fullUrl(),
            ]
        );
    }
}
