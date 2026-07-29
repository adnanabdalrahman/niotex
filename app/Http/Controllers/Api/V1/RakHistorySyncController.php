<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Jobs\RakLiegenschaftHistorySyncJob;
use App\Services\RakLiegenschaftHistorySyncService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class RakHistorySyncController extends Controller
{
    public function __construct(
        protected RakLiegenschaftHistorySyncService $service
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function syncForLiegenschaft(Request $request): JsonResponse
    {
        $request->validate([
            'lsnummer' => ['required', 'string'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
        ]);

        $result = RakLiegenschaftHistorySyncJob::dispatch(
            $request->lsnummer,
            $request->from,
            $request->to,
        );

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }
}
