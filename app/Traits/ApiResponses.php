<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses
{
    /**
     * Return a success JSON response.
     *
     * @param string $message
     * @param mixed|null $data
     * @param int $status
     * @return JsonResponse
     */

    protected function ok(string $message): JsonResponse
    {
        return $this->successResponse($message);
    }


    public function successResponse(string $message, mixed $data = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function errorResponse(string $message, int $status): JsonResponse
    {
        return response()->json(['message' => $message], $status);
    }
}
