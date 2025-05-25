<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\SD_0101_beauftragungRequest;
use App\Http\Requests\SD_0201_mietvertragsrechnungenRequest;
use App\Http\Requests\SD_0301_dienstleistungsabrechnungRequest;
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
     * Receive order data from SAP.
     *
     * @param SD_0101_beauftragungRequest $request
     * @return JsonResponse
     */
    public function beauftragung(SD_0101_beauftragungRequest $request)
    {
        try {
            $validated = $request->validated();

            $vorgangDataArray = $this->sdServices->sd_0101_beauftragung_vorgang($validated['header']);
            if ($vorgangDataArray !== null) {
                $positionsNrArray = $this->sdServices->sd_0101_beauftragung_positions($validated['positions'], $vorgangDataArray);
                Log::info('Received Vorgang: ', $vorgangDataArray);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Beauftragung erfolgreich empfangen',
                    'data' => $positionsNrArray
                ], 202);
            }
            return response()->json([
                'status' => 'Error',
                'message' => 'Beauftragung fehlgeschlagen',
            ], 400);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);

        }
    }


    // SD-01-02: CEOS-->SAP, beauftragung Rueckmeldung
    public function beauftragungRueckmeldung(Request $request)
    {
        try {
            $vorgangDataArray = $this->sdServices->sd_0101_beauftragung_rueckmeldung($request);
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

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);

        }
    }





    // SD-02-01: SAP-->CEOS, Übergabe Werte aus Mietvertragsrechnungen an die CEOS

    /**
     * SD-02-01 Mietvertragsrechnungen
     * Receive rental contract invoice data from SAP.
     *
     * @param SD_0201_mietvertragsrechnungenRequest $request
     * @return JsonResponse
     */
    public function mietvertragsrechnungen(SD_0201_mietvertragsrechnungenRequest $request)
    {
        try {
            $validated = $request->validated();

            $data = $this->sdServices->sd_0201_mietvertragsrechnungen();

            return response()->json([
                'status' => 'success',
                'message' => 'Faktura erfolgreich übernommen',
                'vorNummer' => $data['vorNummer'],
            ], 202);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);

            // message is max 255 characters
        }
    }

    /*
     *  SD-03-01 SAP -> CEOS
     * Fakturierte Dienstleistungsabrechnung
     *
     *
     */
    public function dienstleistungsabrechnung(SD_0301_dienstleistungsabrechnungRequest $request)
    {
        try {
            $validated = $request->validated();

            $data = $this->sdServices->sd_0301_dienstleistungsabrechnung();

            return response()->json([
                'status' => 'success',
                'message' => 'Fakturierte Dienstleistungsabrechnung erfolgreich übernommen',
                'vorNummer' => $data['vorNummer'],
            ], 202);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);

            // message is max 255 characters
        }
    }
}
