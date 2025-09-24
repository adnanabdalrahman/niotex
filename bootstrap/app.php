<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $ex) {
        // General Report
        $ex->renderable(function (Throwable $e) {
            // If it’s already an ApiException, let it render itself
            if ($e instanceof \App\Exceptions\ApiException) {
                return $e->render();
            }

            // Fallback for any other unhandled exceptions
            return response()->json([
                "status" => "error",
                "status_code" => 500,
                "code" => "INTERNAL_SERVER_ERROR",
                "message" => $e->getMessage() ?: "An unexpected error occurred.",
                "errors" => [],
                "meta" => [
                    "path" => request()->path(),
                    "timestamp" => now()->toIso8601String(),
                    "trace_id" => uniqid('', true),
                ]
            ], 500);
        });


        $ex->reportable(function (Throwable $e) {
            Log::error($e->getMessage(), [
                'exception' => Str::limit((string)$e, 600) . '....'
            ]);
        })->stop();
    })
    ->create();
