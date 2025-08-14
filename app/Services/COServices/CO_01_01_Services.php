<?php

namespace App\Services\COServices;

use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Position5Individual;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class CO_01_01_Services
{
    protected string $co0101_path;
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->co0101_path = config('sap.co0101_path');

    }


    /**
     * CEOSWeb -> CEOS --> SAP
     * CO-01-01 Dienstleistungsrechnung
     */
    public function co_01_01_Zeiteinheiten($request): ?array
    {
        /*
         "CeosAuftragsart":"123", ??
         "CeosUnterauftragsart":"456" ??
         */
        try {
            $data = [];
            $vorgang = Vorgang::where('InterneVorgangsnummer', $request['InterneVorgangsnummer'])->first();
            if ($vorgang === null) {
                Log::error(
                    "co_01_01_Zeiteinheiten Kein Vorgang gefunden",
                    ['InterneVorgangsnummer' => $request['InterneVorgangsnummer']]
                );
                return null;
            }

            $belegDatum = Carbon::parse($vorgang->VorAnlageAm)->format('Y-m-d');

            //---------------------------------------------------------------------------------------------
            $positions = Position::where('InterneVorgangsnummer', $request['InterneVorgangsnummer'])->get();

            foreach ($positions as $position) {

                $position3Menge = Position3Menge::where
                ('InternePositionsnummer', $position->InternePositionsnummer)->first();
                if (is_null($position3Menge)) {
                    Log::error(
                        "co_01_01_Zeiteinheiten Position3Menge nicht gefunden",
                        [
                            'Vorgangnummer' => $request['InterneVorgangsnummer'],
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $richtzeiteinheiten = $position3Menge->PosMenge1 * $position3Menge->PosMenge2;

                $position5Individual = Position5Individual::where
                ('InternePositionsnummer', $position->InternePositionsnummer)->first();

                $sapKundenauftragspos = $position5Individual->PosIndividualD1;

                $data['to_TimeUnits'][] = [
                    'Richtzeiteinheiten' => (string)$richtzeiteinheiten,
                    'SapKundenauftragspos' => (string)$sapKundenauftragspos,
                    'Belegdatum' => $belegDatum,
                    'Buchungsdatum' => date('Y-m-d'),
                    'SapKundenauftrag' => (string)$vorgang->VorIndividualC6,
                    'Mengeneinheit' => 'MIN',
                    'SapLiegenschaft' => (string)$vorgang->VorIndividualC3,
                    'CeosAuftragsart' => (string)$vorgang->VorGruppe, //todo clarify
                    'CeosUnterauftragsart' => "456",//todo clarify
                ];
            }
            Log::info('co_01_01_Zeiteinheiten Sent data', $data);
            $result = app(SapApiClient::class)->post($this->co0101_path, $data);
            if ($result !== null) {
                Log::info('co_01_01_Zeiteinheiten received data: ', $result);
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }

        //todo change status also Preis pro ME2 to all Positions
        return $result;
    }

}





