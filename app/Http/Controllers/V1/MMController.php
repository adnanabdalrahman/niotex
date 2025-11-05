<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\ResourceNotFoundException;
use App\Helpers\MM_31_01_01_Validation;
use App\Http\Controllers\Controller;
use App\Http\Requests\MM_2201_SAPStockRequest;
use App\Http\Requests\MM_3402_StatusUmlagerungReservierungRequest;
use App\Http\Requests\MM_3701_nuLeistungspositionenRequest;
use App\Models\Artikel;
use App\Services\MMServices;
use App\Traits\ApiResponses;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;


class MMController extends Controller
{
    use ApiResponses;

    protected MMServices\MM_33_01_b_Services $mm331bServices;
    protected MMServices\MM_31_01_Services $mm311Services;
    protected MMServices\MM_34_01_Services $mm341Services;
    protected MMServices\MM_34_02_Services $mm342Services;
    protected MMServices\MM_22_01_Services $mm221Services;
    protected MMServices\MM_35_02_Services $mm352Services;
    protected MMServices\MM_33_01_a_Services $mm331aServices;
    protected MMServices\MM_37_1_Services $mm371aServices;

    public function __construct(
        MMServices\MM_33_01_b_Services $mm331bServices,
        MMServices\MM_31_01_Services   $mm311Services,
        MMServices\MM_34_01_Services   $mm341Services,
        MMServices\MM_22_01_Services   $mm221Services,
        MMServices\MM_35_02_Services   $mm352Services,
        MMServices\MM_33_01_a_Services $mm331aServices,
        MMServices\MM_37_1_Services    $mm371aServices,
        MMServices\MM_34_02_Services   $mm342Services,

    )
    {
        $this->mm331bServices = $mm331bServices;
        $this->mm331aServices = $mm331aServices;
        $this->mm311Services = $mm311Services;
        $this->mm341Services = $mm341Services;
        $this->mm221Services = $mm221Services;
        $this->mm352Services = $mm352Services;
        $this->mm371aServices = $mm371aServices;
        $this->mm342Services = $mm342Services;
    }

    /**
     * MM-31-1 Materialstammdaten
     * Receive material data from SAP.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function mm_31_1_Materialstammdaten(Request $request): JsonResponse
    {
        $materials = $request->all();
        $report = ['success' => [], 'failed' => []];

        foreach ($materials as $materialData) {
            $validator = Validator::make(
                $materialData,
                MM_31_01_01_Validation::rules(),
                MM_31_01_01_Validation::messages()
            );

            if ($validator->fails()) {
                $report['failed'][] = [
                    'Material' => $materialData['Material'] ?? 'unknown',
                    'message' => $validator->errors()->all()
                ];
                continue;
            }

            // Process material
            $artikelNummer = ltrim($materialData['Material'], '0');
            $currentArtikel = Artikel::where('Artikelnummer', $artikelNummer)->first();
            $status = !empty($materialData['LVorm']) ? 'gelöscht' : ($currentArtikel ? 'aktualisiert' : 'gespeichert');

            try {
                $data = $this->mm311Services->mm_31_01_materialstammdaten($materialData);

                if ($data) {
                    $report['success'][] = [
                        'Material' => $data['Material'],
                        'message' => "Material {$data['Material']} erfolgreich {$status}"
                    ];
                } else {
                    $report['failed'][] = [
                        'Material' => $artikelNummer,
                        'message' => "Material {$artikelNummer} konnte nicht gespeichert werden"
                    ];
                }
            } catch (Throwable $e) {
                $report['failed'][] = [
                    'Material' => $materialData['Material'],
                    'message' => $e->getMessage()
                ];
            }
        }

        // Return response based on success/failure
        return match (true) {
            empty($report['failed']) => $this->successResponse("Alle Materialien erfolgreich importiert", $report, 202),
            empty($report['success']) => $this->errorResponse("Kein Material konnte importiert werden", $report, 400),
            default => $this->multiStatusResponse("Einige Materialien wurden nicht importiert", $report),
        };
    }


    /**
     * @throws ResourceNotFoundException
     * @throws Throwable
     */
    public function mm_34_02_Statusumlagerungsreservierung(MM_3402_StatusUmlagerungReservierungRequest $request): JsonResponse
    {
        $data = $request->validated();
        $response = $this->mm342Services->mm_34_02_Statusumlagerungsreservierung($data);

        return $response['checkstatus'] ?
            $this->successResponse("Status umlagerungsreservierung erfolgreich geprüft",
                $response['response']) :
            $this->successResponse("Status umlagerungsreservierung erfolgreich gespeichert",
                $response['response'], 202);
    }




    //------------------------------------------------------------------------------------------------------------------
    /*
    SAP → CEOS
    Übertragung für den NU zugelassene Leistungspositionen von SAP an CEOS
    */
    public function mm_37_1_NuLeistungspositionen(MM_3701_nuLeistungspositionenRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data = $this->mm371aServices->mm_37_1_NuLeistungspositionen($validated);

        if ($data !== null) {
            $message = "Leistungspositionen erfolgreich gespeichert";
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
    }
    //------------------------------------------------------------------------------------------------------------------

    /**
     * MM_34_01 Umlagerungsreservierung
     * CEOSWEB-->CEOS-->SAP
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */

    public function mm_34_01_umlagerungsreservierung(Request $request): JsonResponse
    {
        $data = $request->validate([
            'Vorgangnummer' => 'required',
            'VorGruppe' => 'required',
            'tourId' => 'required',
            'tourDate' => 'required|date',
        ]);

        $response = $this->mm341Services->mm_34_01_umlagerungsreservierung($data);
        if ($response !== null) {
            $message = "mm_34_01_umlagerungsreservierung erfolgreich gesendet";
            Log::info($message);
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $response
            ]);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'mm_34_01_umlagerungsreservierung fehlgeschlagen',
            ], 400);
        }

    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * MM_35_02 materialverbrauch
     * CEOSWEB-->CEOS-->SAP
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */

    public function mm_35_02_materialverbrauch(Request $request): JsonResponse
    {
        $data = $request->validate([
            'Vorgangnummer' => 'required',
            'VorGruppe' => 'required',
            'tourId' => 'required',
            'tourDate' => 'required|date',
        ]);

        $response = $this->mm352Services->mm_35_02_materialverbrauch($data);
        if ($response !== null) {
            Log::info('mm_35_02_materialverbrauch erfolgreich gesendet');
            return response()->json(
                [
                    'message' => 'mm_35_02_materialverbrauch erfolgreich gesendet',
                    'data' => $response
                ]);
        }
        return response()->json(['message' => 'mm_35_02_materialverbrauch fehlgeschlagen'], 400);
    }

    /**
     * MM_33_01a Leistungsbestaetigung
     * CEOSWEB-->CEOS-->SAP
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */

    public function mm_33_01_a_NuLeistungsbestaetigung(Request $request): JsonResponse
    {
        $data = $request->validate([
            'Vorgangnummer' => 'required',
            'VorGruppe' => 'required',
            'tourId' => 'required',
        ]);
        $response = $this->mm331aServices->mm_33_01_a_NuLeistungsbestaetigung($data);
        if ($response !== null) {
            Log::info('mm_33_01_a_NuLeistungsbestaetigung erfolgreich gesendet');
            return response()->json([
                'message' => 'mm_33_01_a_NuLeistungsbestaetigung erfolgreich gesendet',
                'data' => $response
            ]);
        }
        return response()->json(['message' => 'mm_33_01_a_NuLeistungsbestaetigung fehlgeschlagen'], 400);
    }

    /**
     * MM_33_01b NU-Auftragspaket
     * CEOSWEB-->CEOS-->SAP
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */

    public function mm_33_01_b_NuAuftragspaket(Request $request): JsonResponse
    {
        $data = $request->validate([
            'Vorgangnummer' => 'required',
            'VorGruppe' => 'required',
            'tourId' => 'required',
        ]);
        $response = $this->mm331bServices->mm_33_01_b_NuAuftragspaket($data);

        if ($response !== null) {
            Log::info('mm_33_01_b_NuAuftragspaket erfolgreich gesendet');
            return response()->json([
                'message' => 'mm_33_01_b_NuAuftragspaket erfolgreich gesendet',
                'data' => $response
            ]);
        }
        return response()->json(['message' => 'mm_33_01_b_NuAuftragspaket fehlgeschlagen'], 400);
    }


    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     *
     * @param MM_2201_SAPStockRequest $request
     * @return JsonResponse
     */
    public function mm_22_1_lagerbestaende(MM_2201_SAPStockRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $response = $this->mm221Services->mm_22_01_lagerbestaende(
            $validated['artikelnummer'],
            $validated['lager']
        );
        if ($response !== null) {
            Log::info('mm_22_1_lagerbestaende erfolgreich gesendet');
            return response()->json([
                'status' => 'success',
                'message' => 'Menge erfolgreich gespeichert',
                'data' => $response
            ]);
        }
        return response()->json(['message' => 'Menge speichern fehlgeschlagen'], 400);
    }

}
