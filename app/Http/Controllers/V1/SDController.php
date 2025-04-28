<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\SD_0101_beauftragungRequest;

use App\Services\SDServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SDController extends Controller
{

    protected SDServices $sdServices;
    public function __construct(SDServices $sdServices)
    {
        $this->sdServices = $sdServices;
    }

    public function beauftragung(SD_0101_beauftragungRequest $request)
    {
        try {
            $validated = $request->validated();

            $data = $this->sdServices->sd_0101_beauftragung($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Beauftragung erfolgreich empfangen',
                'vbeln' => $data['vbeln'],
                'vorNummer' => $data['vorNummer'],
            ], 202);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);
        }
    }
}
