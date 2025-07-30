<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\RE_0101_LiegenschaftenRequest;
use App\Services\REServices;
use Illuminate\Support\Facades\Log;


class REController extends Controller
{
    protected REServices\RE_01_01_Services $re0101Services;

    public function __construct(REServices\RE_01_01_Services $re0101Services)
    {
        $this->re0101Services = $re0101Services;
    }

    // RE-01-01: SAP-->CEOS, Liegenschaften
    public function re_01_01_Liegenschaften(RE_0101_LiegenschaftenRequest $request)
    {
        $validated = $request->validated();
        $response = $this->re0101Services->re_01_01_Liegenschaften($validated);
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
