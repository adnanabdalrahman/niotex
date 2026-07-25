<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\RakLiegenschaftHistorySyncService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RakHistorySyncController extends Controller
{
    public function __construct(
        protected RakLiegenschaftHistorySyncService $service
    )
    {
    }

    /**
     * @throws \Throwable
     * @throws ConnectionException
     */
    public function sync(Request $request): JsonResponse
    {
        $request->validate([
            'LS_Nummer' => ['required', 'string'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
        ]);

        $result = $this->service->sync(
            $request->LS_Nummer,
            $request->from,
            $request->to,
        );

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }
}
