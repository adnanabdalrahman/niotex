<?php

use App\Exceptions\ApiException;
use App\Notifications\ErrorNotifiable;
use App\Notifications\ErrorReportNotification;
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

        //Controls how an exception is converted into an HTTP response (JSON, HTML, etc.) sent back
        $ex->renderable(function (Throwable $e) {

            if ($e instanceof ApiException) {
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
            $context[] = [];
            $context['errors'] = [];
            $context['errorCode'] = '';
            if ($e instanceof ApiException) {
                $context['errors'] = $e->errors ?? [];
                $context['errorCode'] = $e->getErrorCode();
            }

            $report = [
                "status" => "error",
                "status_code" => $e->getCode() ?: 422,
                "code" => $context['errorCode'],
                "message" => $e->getMessage(),
                "errors" => $context['errors'],
                "meta" => [
                    "path" => request()->path(),
                    "timestamp" => now()->toIso8601String(),
                    "trace_id" => uniqid('', true)
                ]
            ];

            $notifiable = new ErrorNotifiable();
            $notifiable->notify(new ErrorReportNotification($report));

            Log::error(request()->path() . " " . $e->getMessage(), $context);
        })->stop();
    })
    ->create();
