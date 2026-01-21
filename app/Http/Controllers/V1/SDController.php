<?php

namespace App\Http\Controllers\V1;

use App\Helpers\SD_01_01_Validation;
use App\Http\Controllers\Controller;
use App\Http\Requests\SD_0101_beauftragungRequest;
use App\Http\Requests\SD_0201_mietvertragsrechnungenRequest;
use App\Http\Requests\SD_0302_fakturiertedienstleistungsrechnungRequest;
use App\Services\SDServices;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;


class SDController extends Controller
{

    use ApiResponses;

    protected SDServices\SD_0101_Services $sd0101Services;
    protected SDServices\SD_0102_Services $sd0102Services;
    protected SDServices\SD_0201_Services $sd0201Services;
    protected SDServices\SD_03_01_Services $sd0301Services;
    protected SDServices\SD_03_02_Services $sd0302Services;

    public function __construct(
        SDServices\SD_0101_Services  $sd0101Services,
        SDServices\SD_0102_Services  $sd0102Services,
        SDServices\SD_0201_Services  $sd0201Services,
        SDServices\SD_03_01_Services $sd0301Services,
        SDServices\SD_03_02_Services $sd0302Services,

    )
    {
        $this->sd0101Services = $sd0101Services;
        $this->sd0102Services = $sd0102Services;
        $this->sd0201Services = $sd0201Services;
        $this->sd0301Services = $sd0301Services;
        $this->sd0302Services = $sd0302Services;
    }

    // SD-01-01: SAP-->CEOS, in SAP wird ein Kundenauftrag angelegt -
    // dieser wird auf Unvollständigkeit geprüft und danach wird CEOS mit den Daten positionsgenau beauftragt

    /**
     * SD-01-01 Beauftragung
     * Sap --> CEOS.
     *
     * @param SD_0101_beauftragungRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function sd_0101_beauftragung(Request $request): JsonResponse
    {
        $auftraege = $request->all();

        $report = ['success' => [], 'failed' => []];

        foreach ($auftraege as $auftrag) {
            $validator = Validator::make(
                $auftrag,
                SD_01_01_Validation::rules(),
                SD_01_01_Validation::messages()
            );
            $vbeln = $auftrag['header']['vbeln'] ?? 'unknown';

            if ($validator->fails()) {
                $report['failed'][] = [
                    'vbeln' => $vbeln,
                    'message' => $validator->errors()->all()
                ];
                continue;
            }
            try {
                $result = $this->sd0101Services->sd_0101_beauftragung($auftrag);

                if ($result) {
                    $report['success'][] = [
                        'vbeln' => $vbeln,
                        'data' => $result,
                        'message' => "Beauftragung $vbeln erfolgreich verarbeitet",
                    ];
                } else {
                    $report['failed'][] = [
                        'vbeln' => $vbeln,
                        'message' => "Beauftragung $vbeln konnte nicht verarbeitet werden",
                    ];
                }

            } catch (Throwable $e) {
                $report['failed'][] = [
                    'vbeln' => $vbeln,
                    'message' => $e->getMessage(),
                ];
            }
        }
        return match (true) {
            empty($report['failed']) =>
            $this->successResponse('Alle Beauftragungen erfolgreich verarbeitet', $report, 202),

            empty($report['success']) =>
            $this->errorResponse('Keine Beauftragung konnte verarbeitet werden', $report, 400),

            default =>
            $this->multiStatusResponse('Einige Beauftragungen wurden nicht verarbeitet', $report),
        };
    }


    // SD-01-02: CEOS-->SAP, beauftragung Rückmeldung
    public function sd_01_02_beauftragungRueckmeldung(Request $request)
    {
        $vorgangDataArray = $this->sd0102Services->sd_0102_beauftragung_rueckmeldung($request);
        if ($vorgangDataArray !== null) {
            Log::info('Sent Vorgang: ', $vorgangDataArray);
            return response()->json([
                'status' => 'success',
                'message' => 'Auftrag Status erfolgreich geändert',
                'data' => $vorgangDataArray
            ], 202);
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'Beauftragung fehlgeschlagen',
        ], 400);
    }


    // SD-02-01: SAP-->CEOS, Übergabe Werte aus Mietvertragsrechnungen an die CEOS

    /**
     * SD-02-01 Mietvertragsrechnungen
     * Receive rental contract invoice data from SAP.
     *
     * @param SD_0201_mietvertragsrechnungenRequest $request
     * @return JsonResponse
     */
    public function sd_02_01_mietvertragsrechnungen(SD_0201_mietvertragsrechnungenRequest $request)
    {
        $validated = $request->validated();
        $resultDataArray = $this->sd0201Services->sd_0201_mietvertragsrechnungen($validated);

        if ($resultDataArray !== null) {
            Log::info('Auftrag erfolgreich gespeichert: ', $resultDataArray);
            return response()->json([
                'status' => 'success',
                'message' => 'Auftrag erfolgreich gespeichert',
                'data' => $resultDataArray
            ], 202);
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'sd_02_01_mietvertragsrechnungen Beauftragung fehlgeschlagen',
        ], 400);
    }
    // SD-02-01: SAP-->CEOS, Übergabe Werte aus Mietvertragsrechnungen an die CEOS


    /*
     *  SD-03-01 CEOS --> SAP
     *  Dienstleistungsrechnung
     */
    public function sd_03_01_dienstleistungsrechnung(Request $request)
    {
        $vorgangDataArray = $this->sd0301Services->sd_0301_dienstleistungsrechnung($request);
        if ($vorgangDataArray !== null) {
            return response()->json([
                'status' => 'success',
                'message' => 'Dienstleistungsrechnung erfolgreich übernommen',
                'data' => $vorgangDataArray
            ], 202);
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'Beauftragung fehlgeschlagen',
        ], 400);
    }

    /**
     * SD-03-02 Fakturierte Dienstleistungsrechnung
     * SAP --> CEOS
     *
     * @param SD_0302_fakturiertedienstleistungsrechnungRequest $request
     * @return JsonResponse
     */
    public function sd_03_02_fakturiertedienstleistungsrechnung(SD_0302_fakturiertedienstleistungsrechnungRequest $request)
    {
        $validated = $request->validated();
        $resultDataArray = $this->sd0302Services->sd_03_02_fakturiertedienstleistungsrechnung($validated);

        if ($resultDataArray !== null) {
            Log::info('sd_03_02_fakturiertedienstleistungsrechnung Updated Vorgang: ', $resultDataArray);
            return response()->json([
                'status' => 'success',
                'message' => 'Auftrag erfolgreich gespeichert',
                'data' => $resultDataArray
            ], 202);
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'sd_02_01_mietvertragsrechnungen Beauftragung fehlgeschlagen',
        ], 400);
    }
}




