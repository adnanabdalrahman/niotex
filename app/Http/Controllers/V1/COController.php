<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CO_0101_ZeiteinheitenRequest;
use App\Services\COServices;
use Illuminate\Support\Facades\Log;

class COController extends Controller
{
    protected COServices\CO_01_01_Services $co0101Services;

    public function __construct(COServices\CO_01_01_Services $co0101Services)
    {
        $this->co0101Services = $co0101Services;
    }

    // CO-01-01: CEOS --> SAP, Zeiteinheiten
    public function co_01_01_Zeiteinheiten(CO_0101_ZeiteinheitenRequest $request)
    {
        $validated = $request->validated();

        $response = $this->co0101Services->co_01_01_Zeiteinheiten($validated);
        if ($response !== null) {
            Log::info('co_01_01_Zeiteinheiten Received Data: ', $response);
            return response()->json($response, 202);
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'co_01_01_Zeiteinheiten fehlgeschlagen',
        ], 400);
    }
}
