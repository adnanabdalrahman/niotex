<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses
{
    /**
     * Quick shortcut for a 200 OK message with optional data.
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
        mixed  $data = null,
        string $message = "Success",
        int    $statusCode = 200,
        string $code = "OK"
    ): JsonResponse
    {
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
        string $code = "ERROR",
        int    $statusCode = 422
    ): JsonResponse
    {
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
