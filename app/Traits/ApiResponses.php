<?php

namespace App\Traits;

use App\Services\Logging\ResponseLogger;
use Illuminate\Http\JsonResponse;
use Throwable;

trait ApiResponses
{
    /**
     * Return a standardized success JSON response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @param string $code
     * @return JsonResponse
     * @throws Throwable
     */
    public function multiStatusResponse(
        string $message = "Einige Daten wurden nicht importiert",
        mixed  $data = null,
        int    $statusCode = 207,
        string $code = "PARTIAL"
    ): JsonResponse
    {
        $response = [
            "status" => "partial",
            "status_code" => $statusCode,
            "code" => $code,
            "message" => $message,
            "data" => $data,
            "meta" => [
                "path" => request()->path(),
                "timestamp" => now()->toIso8601String(),
                "trace_id" => request()->attributes->get('trace_id'),
            ]
        ];
        ResponseLogger::log('warning', $response);
        return response()->json($response, $statusCode);
    }

    /**
     * Quick shortcut for a 200-OK message with optional data.
     *
     * @param string $message
     * @param mixed|null $data
     * @return JsonResponse
     * @throws Throwable
     */
    protected function ok(string $message, mixed $data = null): JsonResponse
    {
        return $this->successResponse($message, $data, 200, "OK");
    }

    /**
     * Return a standardized success JSON response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @param string $code
     * @return JsonResponse
     * @throws Throwable
     */
    public function successResponse(
        string $message = "Success",
        mixed  $data = null,
        int    $statusCode = 200,
        string $code = "OK"): JsonResponse
    {
        $response = [
            "status" => "success",
            "status_code" => $statusCode,
            "code" => $code,
            "message" => $message,
            "data" => $data,
            "meta" => [
                "path" => request()->path(),
                "timestamp" => now()->toIso8601String(),
                "trace_id" => request()->attributes->get('trace_id'),
            ]
        ];
        ResponseLogger::log('info', $response);
        return response()->json($response, $statusCode);
    }

    /**
     * Quick shortcut for a 400/422 error with a message.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     * @throws Throwable
     */
    protected function fail(string $message, int $statusCode = 422): JsonResponse
    {
        return $this->errorResponse($message, [], "ERROR", $statusCode);
    }

    /**
     * Return a standardized error JSON response.
     *
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @param string $code
     * @return JsonResponse
     * @throws Throwable
     */
    public function errorResponse(string $message, array $data = [], int $statusCode = 422, string $code = "ERROR"): JsonResponse
    {
        $response = [
            "status" => "error",
            "status_code" => $statusCode,
            "code" => $code,
            "message" => $message,
            "data" => $data,
            "meta" => [
                "path" => request()->path(),
                "timestamp" => now()->toIso8601String(),
                "trace_id" => request()->attributes->get('trace_id'),
            ]
        ];
        ResponseLogger::log('error', $response);
        return response()->json($response, $statusCode);
    }

}
