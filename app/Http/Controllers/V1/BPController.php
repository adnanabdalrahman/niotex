<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BP_0101_geschaeftspartnerRequest;
use App\Http\Requests\BP_0103_verwalterRequest;
use App\Models\Adresse;
use App\Models\Ansprechpartner;
use App\Services\BPServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BPController extends Controller
{

    protected BPServices $bpServices;

    public function __construct(BPServices $bpServices)
    {
        $this->bpServices = $bpServices;
    }

    /*
     * BP_01_01 Geschaeftspartner
     * SAP → CEOS
     */
    public function bp_01_01_Geschaeftspartner(BP_0101_geschaeftspartnerRequest $request): JsonResponse
    {
        Log::info('Received Payload for bp_01_01_Geschaeftspartner:', $request->all());

        $validated = $request->validated();
        $adressnummer = ltrim($validated['DebitorenKreditorennummer'], '0');

        $currentAdresse = Adresse::where('AdressNummer', $adressnummer)->first();

        $status = $currentAdresse !== null ? 'aktualisiert' : 'gespeichert';
        if ($request['LVorm'] !== null) {
            $status = 'gelöscht';
        }

        $data = $this->bpServices->bp_0101_geschaeftspartner($validated);
        if ($data !== null) {
            $message = "Geschäftspartner {$data['Adresse']} erfolgreich " . $status;
            Log::info($message);
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data
            ], 202);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Geschäftspartner speichern fehlgeschlagen',
            ], 400);
        }
    }

    /*
     * BP_0103 Geschaeftspartner Verwalter
     * SAP → CEOS
     * */
    public function bp_01_03_Verwalter(BP_0103_verwalterRequest $request): JsonResponse
    {
        Log::info('Received Payload for bp_01_03_Verwalter:', $request->all());
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

        $currentAnsprechpartner = Ansprechpartner::where('InterneAdressnummer', $adresse->InterneAdressnummer)->first();

        $status = $currentAnsprechpartner !== null ? 'aktualisiert' : 'gespeichert';
        if ($request['LVorm'] !== null) {
            $status = 'gelöscht';
        }

        $data = $this->bpServices->bp_0103_verwalter($validated, $adresse->InterneAdressnummer);
        if ($data !== null) {
            $message = "Ansprechpartner {$data['Adresse']} erfolgreich " . $status;
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
