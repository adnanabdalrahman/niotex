<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\DBSaveException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BP_0101_geschaeftspartnerRequest;
use App\Http\Requests\BP_0103_verwalterRequest;
use App\Models\Adresse;
use App\Models\Ansprechpartner;
use App\Services\BPServices;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class BPController extends Controller
{
    use ApiResponses;

    protected BPServices\BP_01_01_Services $bp0101Services;
    protected BPServices\BP_01_03_Services $bp0103Services;

    public function __construct(
        BPServices\BP_01_01_Services $bp0101Services,
        BPServices\BP_01_03_Services $bp0103Services
    )
    {
        $this->bp0101Services = $bp0101Services;
        $this->bp0103Services = $bp0103Services;
    }

    /*
     * BP_01_01 Geschaeftspartner
     * SAP → CEOS
     */
    /**
     * @throws DBSaveException
     */
    public function bp_01_01_Geschaeftspartner(BP_0101_geschaeftspartnerRequest $request): JsonResponse
    {
        /*        throw new DBSaveException('SaveWorkerRequest', [
                    'database' => 'Failed to insert worker'
                ]);*/


        //return $this->successResponse("Worker created successfully",['data1' => 2233], 201);
        /*return $this->errorResponse(
            "Failed to save worker",
            ['database' => 'Insert failed'],
            "RESOURCE_NOT_SAVED",
            422);*/


        $validated = $request->validated();
        $adressnummer = ltrim($validated['DebitorenKreditorennummer'], '0');
        try {
            $currentAdresse = Adresse::where('AdressNummer', $adressnummer)->first();
        } catch (Throwable $exception) {
            /*  throw new DBSaveException('bp_0101_geschaeftspartner', ['error' => $exception->getMessage()]);*/
            throw new DBSaveException('bp_0101_geschaeftspartner', [
                'database' => 'Failed to insert worker record'
            ]);
        }
        $status = $currentAdresse !== null ? 'aktualisiert' : 'gespeichert';
        if ($validated['Loeschvormerkung'] !== null) {
            $status = 'gelöscht';
        }
        if ($request['Sperrkennzeichen'] !== null) {
            $status = 'gesperrt';
        }

        $data = $this->bp0101Services->bp_0101_geschaeftspartner($validated);
        $message = "Geschäftspartner {$data['Adresse']} erfolgreich " . $status;
        Log::info($message);
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 202);
    }

    /*
     * BP_0103 Geschaeftspartner Verwalter
     * SAP → CEOS
     * */
    public function bp_01_03_Verwalter(BP_0103_verwalterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $adressnummer = ltrim($validated['Adressnummer'], '0');
        $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
        if ($adresse === null) {
            Log::error(
                'bp_0103_verwalter Kein Adresse für Verwalter gefunden',
                ['AdressNummer' => $adressnummer]
            );
            return response()->json([
                'status' => 'Error',
                'message' => 'Ansprechpartner speichern fehlgeschlagen',
            ], 400);
        }

        $currentAnsprechpartner = Ansprechpartner::
        where('InterneAdressnummer', $adresse->InterneAdressnummer)
            ->where('AnsIndividualC1', $validated['Geschaeftspartnernummer'])
            ->first();

        $status = $currentAnsprechpartner !== null ? 'aktualisiert' : 'gespeichert';
        if ($request['LVorm'] !== null) {
            $status = 'gelöscht';
        }

        $data = $this->bp0103Services->bp_0103_verwalter($validated, $adresse->InterneAdressnummer);
        if ($data !== null) {
            $message = "Ansprechpartner {$validated['Geschaeftspartnernummer']} erfolgreich " . $status;
            Log::info($message);
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data
            ], 202);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Ansprechpartner speichern fehlgeschlagen',
            ], 400);
        }
    }
}
