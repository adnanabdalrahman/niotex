<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Services\SEServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SEController extends Controller
{
    protected SEServices\SE_26_01_Services $se2601Services;

    public function __construct(SEServices\SE_26_01_Services $se2601Services)
    {
        $this->se2601Services = $se2601Services;
    }

    // SE-26-01: CEOS-->SAP, Reparaturauftrag
    public function se_26_01_Reparaturauftrag(Request $request)
    {
        $response = $this->se2601Services->se_26_01_Reparaturauftrag($request);
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
