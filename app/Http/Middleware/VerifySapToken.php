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
        Log::channel('sap_requests')->DEBUG('Incoming SAP API request : ' . $request->fullUrl(), [
            'request_id' => $requestId,
            'method' => $request->method(),
            'ip' => $request->ip(),
            'user_id' => optional($request->user())->id,
            'body' => $request->all(),
            //'headers' => $request->headers->all(),
            //'url' => $request->fullUrl(),
            //'raw_body' => $request->all(),
        ]);

        if (!$token || $token !== config('sap.api_token')) {
            Log::channel('sap_requests')->error('Unauthorized Request: ', [
                'request_id' => $requestId,
                'method' => $request->method(),
                'ip' => $request->ip(),
                'headers' => $request->headers->all(),
                'url' => $request->fullUrl(),
                'raw_body' => $request->all(),
                'user_id' => optional($request->user())->id,
                'body' => $request->all(),
            ]);
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
