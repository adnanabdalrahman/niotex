<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Services\REServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class REController extends Controller
{
    protected REServices\RE_01_01_Services $re0101Services;

    public function __construct(REServices\RE_01_01_Services $re0101Services)
    {
        $this->re0101Services = $re0101Services;
    }

    // RE-01-01: SAP-->CEOS, Liegenschaften
    public function re_01_01_Liegenschaften(Request $request)
    {
        //todo build Request validation
        $response = $this->re0101Services->re_01_01_Liegenschaften($request);
        if ($response !== null) {
            Log::info('re_01_01_Liegenschaften Received Data: ', $response);
            $message = "Liegenschaften erfolgreich empfangen";
            Log::info($message);
            return response()->json([
                'status' => 'success',
                'message' => $message,
            ], 202);
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'se_26_01_Reparaturauftrag fehlgeschlagen',
        ], 400);
    }

}
