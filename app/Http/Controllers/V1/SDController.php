<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\SD_0101_beauftragungRequest;
use App\Http\Requests\SD_0201_mietvertragsrechnungenRequest;
use App\Http\Requests\SD_0301_dienstleistungsabrechnungRequest;
use App\Services\SDServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

class SDController extends Controller
{

    protected SDServices $sdServices;

    public function __construct(SDServices $sdServices)
    {
        $this->sdServices = $sdServices;
    }

    // SD-01-01: SAP-->CEOS, in SAP wird ein Kundenauftrag angelegt -
    // dieser wird auf Unvollständigkeit geprüft und danach wird CEOS mit den Daten positionsgenau beauftragt

    #[OpenApi\Operation(tags: ['SD'], method: 'POST')]
    #[OpenApi\RequestBody(factory: SD_0101_beauftragungRequest::class)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\Success202::class)]
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

            $data = $this->sdServices->sd_0101_beauftragung($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Beauftragung erfolgreich empfangen',
                'vbeln' => $data['vbeln'],
                'vorNummer' => $data['vorNummer'],
            ], 202);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);

            // message is max 255 characters
        }
    }


    // SD-02-01: SAP-->CEOS, Übergabe Werte aus Mietvertragsrechnungen an die CEOS
    #[OpenApi\Operation(tags: ['SD'], method: 'POST')]
    #[OpenApi\RequestBody(factory: SD_0201_mietvertragsrechnungenRequest::class)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\Success202::class)]
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

            $data = $this->sdServices->sd_0201_mietvertragsrechnungen($validated);

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

            $data = $this->sdServices->sd_0301_dienstleistungsabrechnung($validated);

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
