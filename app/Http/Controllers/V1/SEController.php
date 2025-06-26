<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Services\SEServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SEController extends Controller
{

    protected SEServices $seServices;

    public function __construct(SEServices $seServices)
    {
        $this->seServices = $seServices;
    }

    // SE-26-01: CEOS-->SAP, Reparaturauftrag
    public function se_26_01_Reparaturauftrag(Request $request)
    {
        $response = $this->seServices->se_26_01_Reparaturauftrag($request);
        if ($response !== null) {
            Log::info('se_26_01_Reparaturauftrag Received Data: ', $response);
            return response()->json($response, 202);
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'se_26_01_Reparaturauftrag fehlgeschlagen',
        ], 400);
    }

}
