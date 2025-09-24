<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class VerifySapToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $requestId = (string)Str::uuid();

        $token = $request->header('X-SAP-Token');

        // Log the incoming request
        Log::channel('sap_requests')->DEBUG('Incoming SAP API request', [
            'request_id' => $requestId,
            //'headers' => $request->headers->all(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'url' => $request->fullUrl(),
            'user_id' => optional($request->user())->id,
            'body' => $request->all(),
            //'raw_body' => $request->all(),
        ]);

        if (!$token || $token !== config('sap.api_token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
