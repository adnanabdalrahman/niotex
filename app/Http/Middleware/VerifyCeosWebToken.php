<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCeosWebToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Ceos-Web-Token');
        if (!$token || $token !== config('ceosweb.api_token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
