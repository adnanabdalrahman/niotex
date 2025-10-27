<?php

namespace App\Exceptions;

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
        return response()->json($report, $this->getCode() ?: 422);
    }

    abstract public function getErrorCode(): string;
}
