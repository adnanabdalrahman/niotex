<?php

use App\Exceptions\ApiException;
use App\Helpers\RequestSource;
use App\Notifications\ErrorNotifiable;
use App\Notifications\ErrorReportNotification;
use App\Services\Logging\ResponseLogger;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
            $response = [
                "status" => "error",
                "status_code" => 500,
                "code" => "INTERNAL_SERVER_ERROR",
                "message" => $e->getMessage() ?: "An unexpected error occurred.",
                "data" => [],
                "meta" => [
                    "path" => request()->path(),
                    "timestamp" => now()->toIso8601String(),
                    "trace_id" => request()->attributes->get('trace_id'),
                ]
            ];
            ResponseLogger::log('critical', $response);
            // Fallback for any other unhandled exceptions
            return response()->json($response, 500);
        });

        $ex->reportable(function (Throwable $e) {
            $data = [];
            $errorCode = '';
            if ($e instanceof ApiException) {
                $data = $e->getData();
                $errorCode = $e->getErrorCode();
            }
            $channel = RequestSource::getChannel();
            $statusCode = $e instanceof ApiException ? ($e->getCode() ?: 422) : 500;
            $report = [
                "status" => "error",
                "status_code" => $statusCode,
                "code" => $errorCode,
                "message" => $e->getMessage(),
                "data" => $data,
                "channel" => $channel,
                "meta" => [
                    "path" => request()->path(),
                    "timestamp" => now()->toIso8601String(),
                    "trace_id" => request()->attributes->get('trace_id'),
                ]
            ];

            $notifiable = new ErrorNotifiable();
            $notifiable->notify(new ErrorReportNotification($report));

        })->stop();
    })
    ->create();
