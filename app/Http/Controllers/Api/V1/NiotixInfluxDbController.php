<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfluxDb\QueryRequest;
use App\Services\Niotix\InfluxDbService;
use App\Traits\ApiResponses;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Throwable;

class NiotixInfluxDbController extends Controller
{
    use ApiResponses;

    protected InfluxDbService $influxDbService;

    public function __construct(InfluxDbService $influxDbService)
    {
        $this->influxDbService = $influxDbService;
    }

    /**
     * POST /influxdb/query
     *
     * @throws ConnectionException|Throwable
     */
    public function syncStateHistory(QueryRequest $request): JsonResponse
    {
        $this->influxDbService->syncStateHistory($request->validated());
        return $this->successResponse('Query executed successfully', []);
    }

    /**
     * @throws ConnectionException
     */
    public function getStateHistory(QueryRequest $request): JsonResponse
    {
        $result = $this->influxDbService->getStateHistory($request->validated());
        return $this->successResponse('Query executed successfully', $result);
    }

}
