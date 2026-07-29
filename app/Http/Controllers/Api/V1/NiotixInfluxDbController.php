<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfluxDb\QueryRequest;
use App\Jobs\RakLiegenschaftHistorySyncJob;
use App\Services\Niotix\InfluxDbService;
use App\Services\RakLiegenschaftHistorySyncService;
use App\Traits\ApiResponses;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class NiotixInfluxDbController extends Controller
{
    use ApiResponses;

    protected InfluxDbService $influxDbService;

    public function __construct(
        InfluxDbService                             $influxDbService,
        protected RakLiegenschaftHistorySyncService $service
    )
    {

        $this->influxDbService = $influxDbService;
    }

    /**
     * POST /influxdb/query
     *
     * @throws ConnectionException|Throwable
     */
    public function syncDeviceStateHistory(QueryRequest $request): JsonResponse
    {
        $this->influxDbService->syncStateHistory($request->validated());
        return $this->successResponse('Query executed successfully', []);
    }

    /**
     */
    public function syncDevicesStateHistoryForLiegenschaft(Request $request): JsonResponse
    {
        $request->validate([
            'lsnummer' => ['required', 'string'],
            'device_type' => ['nullable', 'string'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
        ]);
        $result = RakLiegenschaftHistorySyncJob::dispatch(
            $request->lsnummer,
            $request->device_type,
            $request->from,
            $request->to,
        );

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    /**
     * @throws ConnectionException
     */
    public function getDeviceStateHistory(QueryRequest $request): JsonResponse
    {
        $result = $this->influxDbService->getStateHistory($request->validated());
        return $this->successResponse('Query executed successfully', $result);
    }

}
