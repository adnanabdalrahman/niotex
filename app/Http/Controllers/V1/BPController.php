<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\DBSaveException;
use App\Exceptions\ResourceNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BP_0101_geschaeftspartnerRequest;
use App\Http\Requests\BP_0103_verwalterRequest;
use App\Models\Adresse;
use App\Models\Ansprechpartner;
use App\Services\BPServices;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
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
        $validated = $request->validated();
        $adressnummer = ltrim($validated['DebitorenKreditorennummer'], '0');
        try {
            $currentAdresse = Adresse::where('AdressNummer', $adressnummer)->first();
        } catch (Throwable $exception) {
            throw new DBSaveException('Fehler beim Abrufen des Geschäftspartners', [
                'database' => $exception->getMessage(),
            ]);
        }
        $status = match (true) {
            !empty($validated['Loeschvormerkung']) => 'gelöscht',
            !empty($validated['Sperrkennzeichen']) => 'gesperrt',
            $currentAdresse !== null => 'aktualisiert',
            default => 'gespeichert',
        };

        $data = $this->bp0101Services->bp_0101_geschaeftspartner($validated);
        return $this->successResponse("Geschäftspartner erfolgreich " . $status,
            $data, 202);
    }

    /*
     * BP_0103 Geschaeftspartner Verwalter
     * SAP → CEOS
     */
    /**
     * @throws ResourceNotFoundException|DBSaveException
     */
    public function bp_01_03_Verwalter(BP_0103_verwalterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $adressnummer = ltrim($validated['Adressnummer'], '0');

        $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
        if ($adresse === null) {
            throw new ResourceNotFoundException('Die angeforderte Adresse wurde nicht gefunden.', [
                'AdressNummer' => $adressnummer,
            ]);
        }

        $currentAnsprechpartner = Ansprechpartner::
        where('InterneAdressnummer', $adresse->InterneAdressnummer)
            ->where('AnsIndividualC1', $validated['Geschaeftspartnernummer'])
            ->first();

        $status = match (true) {
            $request['LVorm'] !== null => 'gelöscht',
            $currentAnsprechpartner !== null => 'aktualisiert',
            default => 'gespeichert',
        };

        $data = $this->bp0103Services->bp_0103_verwalter($validated, $adresse->InterneAdressnummer);
        return $this->successResponse("Verwalter erfolgreich " . $status,
            $data, 202);
    }
}
