<?php

namespace App\Exceptions;

use App\Notifications\ErrorNotifiable;
use App\Notifications\ErrorReportNotification;
use Exception;
use Illuminate\Http\JsonResponse;

abstract class ApiException extends Exception
{
    public array $errors;

    public function __construct(
        string $message = "An error occurred",
        array  $errors = [],
        int    $statusCode = 400,
    )
    {
        parent::__construct($message, $statusCode);
        $this->errors = $errors;
    }

    /**
     * Render the exception as JSON exactly like errorResponse()
     */
    public function render(): JsonResponse
    {
        $report = [
            "status" => "error",
            "status_code" => $this->getCode() ?: 422,
            "code" => $this->getErrorCode(),
            "message" => $this->getMessage(),
            "errors" => $this->errors,
            "meta" => [
                "path" => request()->path(),
                "timestamp" => now()->toIso8601String(),
                "trace_id" => uniqid('', true)
            ]
        ];

        $notifiable = new ErrorNotifiable();
        $notifiable->notify(new ErrorReportNotification($report));

        return response()->json($report, $this->getCode() ?: 422);
    }

    /**
     * Each exception must define its own specific error code
     */
    abstract public function getErrorCode(): string;
}
