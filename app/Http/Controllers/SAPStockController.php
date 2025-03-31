<?php

namespace App\Http\Controllers;

use App\Http\Requests\SAPStockRequest;
use App\Services\SAPService;
use Illuminate\Http\JsonResponse;

class SAPStockController extends Controller
{
    protected SAPService $sapService;

    public function __construct(SAPService $sapService)
    {
        $this->sapService = $sapService;
    }

    public function getStock(SAPStockRequest $request): JsonResponse
    {
        $data = $this->sapService->getStockData(
            $request->input('materials'),
            $request->input('plant'),
            $request->input('storage_location')
        );

        return response()->json($data);
    }
}
