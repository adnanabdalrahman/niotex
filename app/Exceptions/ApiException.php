<?php

namespace App\Exceptions;

use App\Services\Logging\ResponseLogger;
use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

abstract class ApiException extends Exception
{
    public array $data;

    public function __construct(
        string $message = "Es ist ein Fehler aufgetreten",
        array  $data = [],
        int    $statusCode = 400,
    )
    {
        parent::__construct($message, $statusCode);
        $this->data = $data;
    }

    /**
     * @throws Throwable
     */
    public function render(): JsonResponse
    {
        $response = [
            "status" => "error",
            "status_code" => $this->getCode() ?: 422,
            "code" => $this->getErrorCode(),
            "message" => $this->getMessage(),
            "data" => $this->data,
            "meta" => [
                "path" => request()->path(),
                "timestamp" => now()->toIso8601String(),
                "trace_id" => request()->attributes->get('trace_id'),
            ]
        ];

        ResponseLogger::log('error', $response);
        return response()->json(
            $response,
            $this->getCode() ?: 422
        );
    }

    abstract public function getErrorCode(): string;

    public function getData(): array
    {
        return $this->data;
    }
}
