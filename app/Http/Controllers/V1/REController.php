<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\RE_0101_LiegenschaftenRequest;
use App\Services\REServices;


class REController extends Controller
{
    protected REServices\RE_01_01_Services $re0101Services;

    public function __construct(REServices\RE_01_01_Services $re0101Services)
    {
        $this->re0101Services = $re0101Services;
    }


    public function re_01_01_Liegenschaften(RE_0101_LiegenschaftenRequest $request)
    {
        $validated = $request->validated();

        // Service now returns a report instead of just true/null
        $report = $this->re0101Services->re_01_01_Liegenschaften($validated);

        if (empty($report['success']) && !empty($report['failed'])) {
            // everything failed
            return response()->json([
                'status' => 'error',
                'message' => 'Alle Liegenschaften fehlgeschlagen',
                'report' => $report,
            ], 400);
        }

        if (!empty($report['failed'])) {
            // partial success
            return response()->json([
                'status' => 'partial',
                'message' => 'Einige Liegenschaften wurden nicht importiert',
                'report' => $report,
            ], 207); // 207 Multi-Status is good for mixed results
        }

        // all success
        return response()->json([
            'status' => 'success',
            'message' => 'Alle Liegenschaften erfolgreich importiert',
            'report' => $report,
        ], 202);
    }


}
