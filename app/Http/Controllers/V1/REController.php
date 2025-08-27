<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\RE_0101_LiegenschaftenRequest;
use App\Services\REServices;
use Illuminate\Support\Facades\Log;


class REController extends Controller
{
    protected REServices\RE_01_01_Services $re0101Services;
    protected REServices\MasterServices $masterServices;

    public function __construct(
        REServices\RE_01_01_Services $re0101Services,
        REServices\MasterServices    $masterServices)
    {
        $this->re0101Services = $re0101Services;
        $this->masterServices = $masterServices;
    }


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
            'message' => 're_01_01_Liegenschaften fehlgeschlagen',
        ], 400);
    }


    // Take Liegenschaften Timeline and build Master

    public function buildMasterForLiegenschaft($liegenschaftsId)
    {
        $response = $this->masterServices->buildMasterForLiegenschaft($liegenschaftsId);
        if ($response !== null) {
            $message = "buildMaster erfolgreich erstellt";
            Log::info($message);
            return response()->json([
                'status' => 'success',
                'message' => $message,
            ], 202);
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'buildMaster fehlgeschlagen',
        ], 400);
    }

    public function buildAllMaster($liegenschaft)
    {

        $response = $this->masterServices->buildAllMaster();
        if ($response !== null) {
            $message = "buildMaster erfolgreich erstellt";
            Log::info($message);
            return response()->json([
                'status' => 'success',
                'message' => $message,
            ], 202);
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'buildMaster fehlgeschlagen',
        ], 400);
    }


}
