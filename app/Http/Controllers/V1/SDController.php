<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\SD_0101_beauftragungRequest;
use App\Http\Requests\SD_0201_mietvertragsrechnungenRequest;
use App\Http\Requests\SD_0302_fakturiertedienstleistungsrechnungRequest;
use App\Services\SDServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SDController extends Controller
{

    protected SDServices $sdServices;

    public function __construct(SDServices $sdServices)
    {
        $this->sdServices = $sdServices;
    }

    // SD-01-01: SAP-->CEOS, in SAP wird ein Kundenauftrag angelegt -
    // dieser wird auf Unvollständigkeit geprüft und danach wird CEOS mit den Daten positionsgenau beauftragt

    /**
     * SD-01-01 Beauftragung
     * Sap --> CEOS.
     *
     * @param SD_0101_beauftragungRequest $request
     * @return JsonResponse
     */
    public function sd_0101_beauftragung(SD_0101_beauftragungRequest $request)
    {
        Log::info('Received Payload for sd_0101_beauftragung:', $request->all());
        $validated = $request->validated();
        $vorgangDataArray = $this->sdServices->sd_0101_beauftragung_vorgang($validated['header']);
        if ($vorgangDataArray !== null) {
            $positionsNrArray = $this->sdServices->sd_0101_beauftragung_positions($validated['positions'], $vorgangDataArray);
            if ($positionsNrArray !== null) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Beauftragung erfolgreich empfangen',
                    'data' => [
                        'header' => $vorgangDataArray,
                        'positions' => $positionsNrArray
                    ],
                ], 202);
            }
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'Beauftragung fehlgeschlagen',
        ], 400);
    }


    // SD-01-02: CEOS-->SAP, beauftragung Rückmeldung
    public function sd_01_02_beauftragungRueckmeldung(Request $request)
    {
        Log::info('Received Payload for sd_01_02_beauftragungRueckmeldung:', $request->all());
        $vorgangDataArray = $this->sdServices->sd_0102_beauftragung_rueckmeldung($request);
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
        Log::info('Received Payload for sd_02_01_mietvertragsrechnungen:', $request->all());
        $validated = $request->validated();
        $resultDataArray = $this->sdServices->sd_0201_mietvertragsrechnungen($validated);

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
        $vorgangDataArray = $this->sdServices->sd_0301_dienstleistungsrechnung($request);
        if ($vorgangDataArray !== null) {
            Log::info('Sent Vorgang: ', $vorgangDataArray);
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
        Log::info('Received Payload for sd_03_02_fakturiertedienstleistungsrechnung:', $request->all());
        $validated = $request->validated();
        $resultDataArray = $this->sdServices->sd_03_02_fakturiertedienstleistungsrechnung($validated);

        if ($resultDataArray !== null) {
            Log::info('Sent Vorgang: ', $resultDataArray);
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




