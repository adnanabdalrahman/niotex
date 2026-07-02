<?php

namespace App\Services\COServices;

use App\Exceptions\DBSaveException;
use App\Exceptions\InvalidSapResponseException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\SapBusinessException;
use App\Models\Position;
use App\Models\Position1Wert;
use App\Models\Position3Menge;
use App\Models\Position5Individual;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
     * @throws ResourceNotFoundException
     * @throws Throwable
     */
    public function co_01_01_Zeiteinheiten(array $requestData): array
    {
        $data = [];
        $vorgang = Vorgang::where('InterneVorgangsnummer', $requestData['InterneVorgangsnummer'])->first();
        if ($vorgang === null) {
            throw new ResourceNotFoundException('Kein Vorgang gefunden.', [
                    'InterneVorgangsnummer' => $requestData['InterneVorgangsnummer'],
                ]
            );
        }

        $belegDatum = Carbon::parse($vorgang->VorAnlageAm)->format('Y-m-d');
        //---------------------------------------------------------------------------------------------
        $positions = Position::where('InterneVorgangsnummer', $requestData['InterneVorgangsnummer'])->get();
        if ($positions->isEmpty()) {
            throw new ResourceNotFoundException('Keine Positionen für den Vorgang gefunden.',
                ['InterneVorgangsnummer' => $requestData['InterneVorgangsnummer'],]
            );
        }
        $successPositions = [];

        $position3Mengen = Position3Menge::where(
            'InterneVorgangsnummer',
            $requestData['InterneVorgangsnummer']
        )->get()->keyBy('InternePositionsnummer');

        $position5Individuals = Position5Individual::whereIn(
            'InternePositionsnummer',
            $positions->pluck('InternePositionsnummer')
        )->get()->keyBy('InternePositionsnummer');

        /** @var Position $position */
        foreach ($positions as $position) {
            $position3Menge = $position3Mengen[$position->InternePositionsnummer] ?? null;
            if ($position3Menge === null) {
                throw new ResourceNotFoundException('Keine Mengenangabe für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $requestData['InterneVorgangsnummer'],
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }

            $richtzeiteinheiten = $position3Menge->PosMenge1 * $position3Menge->PosMenge2;

            $position5Individual = $position5Individuals[$position->InternePositionsnummer] ?? null;
            if ($position5Individual === null) {
                throw new ResourceNotFoundException('Keine Position5Individual-Daten für die Position gefunden.',
                    ['Position' => $position->InternePositionsnummer,]
                );
            }

            if (blank($position5Individual->PosIndividualC2)) {
                //todo optimieren
                Log::warning('co_01_01_Zeiteinheiten Kein CeosAuftragsart gefunden',
                    ['InternePositionsnummer' => $position->InternePositionsnummer,]);
                continue;
            }

            if (filled($position5Individual->PosIndividualT4)) {
                //todo optimieren
                Log::warning('co_01_01_Zeiteinheiten Position wurde bereits gesendet.',
                    ['InternePositionsnummer' => $position->InternePositionsnummer]
                );
                continue;
            }

            $successPositions[] = $position->InternePositionsnummer;
            $posNr = $position5Individual->PosIndividualC1;
            $data['to_TimeUnits'][] = [
                'Richtzeiteinheiten' => (string)$richtzeiteinheiten,
                'SapKundenauftragspos' => (string)$posNr,
                'Belegdatum' => $belegDatum,
                'Buchungsdatum' => Carbon::today()->format('Y-m-d'),
                'SapKundenauftrag' => '',
                'Mengeneinheit' => 'MIN',
                'SapLiegenschaft' => (string)$vorgang->VorIndividualC3,
                'CeosAuftragsart' => (string)$position5Individual->PosIndividualC2,
                'CeosUnterauftragsart' => $vorgang->VorGruppe . ' ' . $vorgang->VorNummer,
            ];
        }
        $grouped = [];
        if (empty($data['to_TimeUnits'])) {
            throw new ResourceNotFoundException('Keine sendbaren Positionen gefunden.',
                ['InterneVorgangsnummer' => $requestData['InterneVorgangsnummer'],]
            );
        }
        foreach ($data['to_TimeUnits'] as $item) {
            $key = $item['CeosAuftragsart'];
            if (!isset($grouped[$key])) {
                $grouped[$key] = $item;
            } else {
                $grouped[$key]['Richtzeiteinheiten'] = (string)(
                    (int)$grouped[$key]['Richtzeiteinheiten'] + (int)$item['Richtzeiteinheiten']
                );
            }
        }

        $data['to_TimeUnits'] = array_values($grouped);
        Log::info('co_01_01_Zeiteinheiten Sent data', $data);
        $result = app(SapApiClient::class)->post($this->co0101_path, $data);
        Log::info('co_01_01_Zeiteinheiten received data', $result);

        if (!isset($result['d']) || !isset($result['d']['Status'])) {
            throw new InvalidSapResponseException('Ungültige SAP-Antwort.');
        }
        if ($result['d']['Status'] === 'error') {
            throw new SapBusinessException('SAP hat die Anfrage abgelehnt.', $result['d']);
        }


        $positionUpdates = [];

        $position1Werte = Position1Wert::whereIn(
            'InternePositionsnummer',
            $successPositions
        )->get()->keyBy('InternePositionsnummer');

        foreach ($successPositions as $internePositionsnummer) {
            $position1wert = $position1Werte[$internePositionsnummer] ?? null;
            if ($position1wert === null) {
                throw new ResourceNotFoundException('Keine Position1Wert-Daten für die Position gefunden.',
                    ['Position' => $internePositionsnummer]
                );
            }

            $position5Individual = $position5Individuals[$internePositionsnummer] ?? null;
            if ($position5Individual === null) {
                throw new ResourceNotFoundException('Keine Position5Individual-Daten für die Position gefunden.',
                    ['Position' => $internePositionsnummer]
                );
            }

            $positionUpdates[] = [
                'position1wert' => $position1wert,
                'position5Individual' => $position5Individual,
            ];
        }


        try {
            DB::transaction(function () use ($vorgang, $positionUpdates) {
                $vorgang->VorStatus = 100425;
                $vorgang->save();

                foreach ($positionUpdates as $item) {
                    $item['position1wert']->PosPreisProME2 = 1;
                    $item['position5Individual']->PosIndividualT4 = Carbon::today()->format('Ymd');
                    $item['position1wert']->save();
                    $item['position5Individual']->save();
                }
            });
        } catch (Throwable $e) {
            throw new DBSaveException('Fehler beim Aktualisieren des Vorgangs oder der Positionen: ' .
                $e->getMessage()
            );
        }
        return $result;
    }
}
