<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MM_2201_SAPStockRequest;
use App\Http\Requests\MM_3101_materialStammdatenRequest;
use App\Models\Artikel;
use App\Services\MMServices;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

;

#[OpenApi\PathItem]
class MMController extends Controller
{
    protected MMServices $mmServices;

    public function __construct(MMServices $mmServices)
    {
        $this->mmServices = $mmServices;
    }

    /**
     * MM-31-1 Materialstammdaten
     * Receive material data from SAP.
     *
     * @param MM_3101_materialStammdatenRequest $request
     * @return JsonResponse
     */

    public function materialstammdaten(MM_3101_materialStammdatenRequest $request): JsonResponse
    {
        try {

            Log::info('Received SAP Material Data:', $request);

            $validated = $request->validated();
            $artikelNummer = ltrim($validated['Material'], '0');
            $currentArtikel = Artikel::where('Artikelnummer', $artikelNummer)->first();
            $status = $currentArtikel !== null ? 'aktualisiert' : 'gespeichert';
            if ($request['LVorm'] !== "") {
                $status = 'gelöscht';
            }

            Log::info('Received SAP Material Data:', $validated);
            $data = $this->mmServices->mm_31_01_materialstammdaten($validated);

            if ($data !== null) {
                $message = "Material {$data['Material']} erfolgreich " . $status;
                Log::info($message);
                return response()->json([
                    'status' => 'success',
                    'message' => $message,
                    'data' => $data
                ], 202);
            } else {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Material speichern fehlgeschlagen',
                ], 400);
            }
        } catch (ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 400);
        }
    }

    /**
     * MM_34_01 Umlagerungsreservierung
     * CEOSWEB-->CEOS-->SAP
     *
     * @return JsonResponse
     */

    public function umlagerungsreservierung(Request $request): JsonResponse
    {
        $data = $request->validate([
            'Vorgangnummer' => 'required',
        ]);


        try {
            $response = $this->mmServices->mm_34_01_umlagerungsreservierung($request);
            
            $data = json_decode($response, true); // decode JSON to array
            $tourId = $data['d']['TourId'] ?? null;
            if ($tourId !== null) {
                Log::info('Received SAP Material Data:', $request);
            }
            return response()->json(['data' => $data], 202);
        } catch (\Exception $e) {
            Log::error('Internal error:', ['errors' => $e->getMessage()]);
            return response()->json(['message' => 'Internal error', 'errors' => $e->getMessage()], 500);
        }

    }


    public function materialverbrauch(): JsonResponse
    {
        try {
            return $this->mmServices->mm_35_02_materialverbrauch();
        } catch (\Exception $e) {
            Log::error('Internal error:', ['errors' => $e->getMessage()]);
            return response()->json(['message' => 'Internal error', 'errors' => $e->getMessage()], 500);
        }
    }


    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     *
     * @param MM_2201_SAPStockRequest $request
     * @return JsonResponse
     * @throws ConnectionException
     */
    public function lagerbestaende(MM_2201_SAPStockRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $data = $this->mmServices->mm_22_01_lagerbestaende(
            $validated['materials'],
            $validated['storage']
        );

        return response()->json($data);
    }
}
