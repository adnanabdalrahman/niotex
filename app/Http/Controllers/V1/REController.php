<?php

namespace App\Http\Controllers\V1;


use App\Helpers\RE_01_01_Validation;
use App\Http\Controllers\Controller;
use App\Services\REServices;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;


class REController extends Controller
{
    use ApiResponses;

    protected REServices\RE_01_01_Services $re0101Services;

    public function __construct(REServices\RE_01_01_Services $re0101Services)
    {
        $this->re0101Services = $re0101Services;
    }


    /**
     * @throws Throwable
     */
    public function re_01_01_Liegenschaften(Request $request): JsonResponse
    {

        $receivedLiegenschaften = $request->all();
        $report = ['success' => [], 'failed' => []];

        foreach ($receivedLiegenschaften as $wrapper) {
            $data = $wrapper['liegenschaft'];
            $slgnr = $data['slgnr'];

            $validator = Validator::make(
                $data,
                RE_01_01_Validation::rules(),
                RE_01_01_Validation::messages()
            );

            if ($validator->fails()) {
                $report['failed'][] = [
                    'slgnr' => $slgnr,
                    'message' => implode(';', $validator->errors()->all())
                ];
                continue;
            }

            try {
                $response = $this->re0101Services->re_01_01_Liegenschaften($data);
                if ($response) {
                    $report['success'][] = $response;
                } else {
                    $report['failed'][] = [
                        'slgnr' => $slgnr,
                        'message' => "Liegenschaft konnte nicht gespeichert werden"
                    ];
                }
            } catch (Throwable $e) {
                $report['failed'][] = [
                    'slgnr' => $slgnr,
                    'message' => $e->getMessage()
                ];
            }
        }
        // Return response based on success/failure
        return match (true) {
            empty($report['failed']) => $this->successResponse("Alle Liegenschaften erfolgreich importiert", $report, 202),
            empty($report['success']) => $this->errorResponse("Kein Liegenschaften konnte importiert werden", $report, 400),
            default => $this->multiStatusResponse("Einige Liegenschaften wurden nicht importiert", $report),
        };
    }


}
