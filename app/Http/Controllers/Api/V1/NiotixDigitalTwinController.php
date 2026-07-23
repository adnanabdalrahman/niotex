<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Niotix\NiotixDigitalTwinsService;
use App\Traits\ApiResponses;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NiotixDigitalTwinController extends Controller
{
    use ApiResponses;

    protected NiotixDigitalTwinsService $digitalTwinService;

    public function __construct(
        NiotixDigitalTwinsService $digitalTwinService
    )
    {
        $this->digitalTwinService = $digitalTwinService;
    }

    /**
     * GET /digital-twins
     * @throws ConnectionException
     */
    public function index()
    {
        $digitalTwins = $this->digitalTwinService->getAllFromNiotix();
        return $this->successResponse('Digital twins retrieved successfully',
            $digitalTwins['data']
        );
    }

    /**
     * POST /digital-twins
     */
    public function store(Request $request): JsonResponse
    {
        return $this->successResponse(
            'Not implemented yet'
        );
    }

    /**
     * GET /digital-twins/{id}
     * @throws ConnectionException
     */
    public function show(int $id): JsonResponse
    {

        $digitalTwin = $this->digitalTwinService
            ->getByIdFromNiotix($id);

        return $this->successResponse(
            'Digital twin retrieved successfully',
            $digitalTwin
        );
    }

    /**
     * PUT /digital-twins/{id}
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->successResponse(
            'Not implemented yet'
        );
    }

    /**
     * DELETE /digital-twins/{id}
     */
    public function destroy(
        int $id
    ): JsonResponse
    {
        return $this->successResponse(
            'Not implemented yet'
        );
    }
}
