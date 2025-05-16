<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BP_0101_geschaeftspartnerRequest;
use App\Http\Requests\BP_0103_verwalterRequest;
use Illuminate\Support\Facades\Log;
use App\Services\BPServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
class BPController extends Controller
{

    protected BPServices $bpServices;
    public function __construct(BPServices $bpServices)
    {
        $this->bpServices = $bpServices;
    }

    /*
     * BP_01_01 Geschaeftspartner
     * SAP -> CEOS
     */
    public function geschaeftspartner(BP_0101_geschaeftspartnerRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            Log::info('Received SAP Geschäftspartner Data:', $validated);

            $data = $this->bpServices->bp_0101_geschaeftspartner($validated);
            return response()->json(['message' => 'Geschäftspartner erfolgreich gespeichert.', 'data' => $data], 202);
        } catch (ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);
        }
    }

    /*
     * BP_0103 Geschaeftspartner Verwalter
     * SAP -> CEOS
     * */
    public function verwalter(BP_0103_verwalterRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            Log::info('Received SAP Material Data:', $validated);
            $data = $this->bpServices->bp_0103_verwalter($validated);
            return response()->json(['message' => 'Verwalter erfolgreich gespeichert.', 'data' => $data], 202);
        } catch (ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);
        }
    }



}
