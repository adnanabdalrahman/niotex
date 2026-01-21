<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

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
     */
    public function multiStatusResponse(
        string $message = "Einige Daten wurden nicht importiert",
        mixed  $data = null,
        int    $statusCode = 207,
        string $code = "PARTIAL"
    ): JsonResponse
    {
        Log::warning(request()->path() . ": " . $message, $data);
        return response()->json([
            "status" => "partial",
            "status_code" => $statusCode,
            "code" => $code,
            "message" => $message,
            "data" => $data,
            "meta" => [
                "path" => request()->path(),
                "timestamp" => now()->toIso8601String(),
                "trace_id" => uniqid('', true)
            ]
        ], $statusCode);
    }

    /**
     * Quick shortcut for a 200-OK message with optional data.
     *
     * @param string $message
     * @param mixed|null $data
     * @return JsonResponse
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
     */
    public function successResponse(
        string $message = "Success",
        mixed  $data = null,
        int    $statusCode = 200,
        string $code = "OK"
    ): JsonResponse
    {
        Log::info(request()->path() . ": " . $message, [
            "status" => "success",
            "status_code" => $statusCode,
            "code" => $code,
            "message" => $message,
            "data" => $data,
            "meta" => [
                "path" => request()->path(),
                "timestamp" => now()->toIso8601String(),
                "trace_id" => uniqid('', true)
            ]
        ]);
        return response()->json([
            "status" => "success",
            "status_code" => $statusCode,
            "code" => $code,
            "message" => $message,
            "data" => $data,
            "meta" => [
                "path" => request()->path(),
                "timestamp" => now()->toIso8601String(),
                "trace_id" => uniqid('', true)
            ]
        ], $statusCode);
    }

    /**
     * Quick shortcut for a 400/422 error with a message.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function fail(string $message, int $statusCode = 422): JsonResponse
    {
        return $this->errorResponse($message, [], "ERROR", $statusCode);
    }

    /**
     * Return a standardized error JSON response.
     *
     * @param string $message
     * @param array $errors
     * @param string $code
     * @param int $statusCode
     * @return JsonResponse
     */
    public function errorResponse(
        string $message,
        array  $errors = [],
        int    $statusCode = 422,
        string $code = "ERROR"
    ): JsonResponse
    {
        Log::error(request()->path() . ": " . $message, $errors);
        return response()->json([
            "status" => "error",
            "status_code" => $statusCode,
            "code" => $code,
            "message" => $message,
            "errors" => $errors,
            "meta" => [
                "path" => request()->path(),
                "timestamp" => now()->toIso8601String(),
                "trace_id" => uniqid('', true)
            ]
        ], $statusCode);
    }


}
