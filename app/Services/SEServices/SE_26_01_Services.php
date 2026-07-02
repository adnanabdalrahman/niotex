<?php

namespace App\Services\SEServices;

use App\Exceptions\InvalidSapResponseException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\SapBusinessException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position2Text;
use App\Models\Position3Menge;
use App\Models\Vorgang;
use App\Models\Vorgang7Abrechnung;
use App\Services\SapApiClient;
use Illuminate\Support\Facades\Log;
use Throwable;

class SE_26_01_Services
{
    protected string $se2601_path;

    public function __construct()
    {
        $this->se2601_path = config('sap.se2601_path');
    }

    /**
     * SE-26-01 Reparaturauftrag
     *
     * @param array $requestData
     * @return array
     * @throws ResourceNotFoundException
     * @throws InvalidSapResponseException
     * @throws SapBusinessException
     * @throws Throwable
     */

    public function se_26_01_Reparaturauftrag(array $requestData): array
    {
        $data = [];
        $interneVorgangsnummer = $requestData['InterneVorgangsnummer'];

        $vorgang = Vorgang::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();

        if ($vorgang === null) {
            throw new ResourceNotFoundException('Kein Vorgang gefunden.',
                ['InterneVorgangsnummer' => $interneVorgangsnummer,]
            );
        }
        $vorgang7Abrechnung = Vorgang7Abrechnung::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
        if ($vorgang7Abrechnung === null) {
            throw new ResourceNotFoundException('Keine Vorgang7Abrechnung für den Vorgang gefunden.',
                ['InterneVorgangsnummer' => $interneVorgangsnummer,]
            );
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            throw new ResourceNotFoundException('Keine Adresse für den Vorgang gefunden.',
                [
                    'InterneAdressnummer' => $vorgang->VorAuftraggeber,
                ]
            );
        }

        $data['Kunnr'] = $adresse->AdressNummer;
        $data['Auart'] = (string)$vorgang->VorIndividualC2;
        $data['Zzlgsnr'] = (string)$vorgang->VorIndividualC3;
        $data['Bstkd'] = (string)$vorgang7Abrechnung->NutzerMontage_Bestellnummer;
        $data['Vorgn'] = (string)$vorgang->VorNummer;
        $data['VorgnInt'] = (string)$vorgang->InterneVorgangsnummer;

        //---------------------------------------------------------------------------------------------
        $positions = Position::where('InterneVorgangsnummer', $interneVorgangsnummer)->get();
        if ($positions->isEmpty()) {
            throw new ResourceNotFoundException('Keine Positionen für den Vorgang gefunden.',
                ['InterneVorgangsnummer' => $interneVorgangsnummer,]
            );
        }
        $positionArray = [];

        /** @var Position $position */
        foreach ($positions as $position) {
            $artikel = Artikel::where('InterneArtikelnummer', $position->InterneArtikelnummer)->first();
            if ($artikel === null) {
                throw new ResourceNotFoundException('Kein Artikel für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $interneVorgangsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer,
                        'InternePositionsnummer' => $position->InternePositionsnummer,
                    ]
                );
            }
            $position3Menge = Position3Menge::where('InterneVorgangsnummer', $interneVorgangsnummer)
                ->where('InternePositionsnummer', $position->InternePositionsnummer)
                ->first();
            if ($position3Menge === null) {
                throw new ResourceNotFoundException('Keine Mengenangabe für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $interneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }

            $position2Text = Position2Text::where('InterneVorgangsnummer', $interneVorgangsnummer)
                ->where('InternePositionsnummer', $position->InternePositionsnummer)
                ->first();
            if ($position2Text === null) {
                throw new ResourceNotFoundException('Keine Position2Text-Daten für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $interneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }
            if ($position3Menge->PosKZMengeneinheit1 == "Stck") {
                $vrkme = "ST";
            } else {
                $vrkme = $position3Menge->PosKZMengeneinheit1;
            }

            $positionArray[] = [
                'Matnr' => $artikel->Artikelnummer,
                'TxtZ010' => (string)$position2Text->PosNotiz,
                'Kwmeng' => (string)$position3Menge->PosMenge1,
                'Vrkme' => (string)$vrkme,
                'Vorgn' => (string)$vorgang->VorNummer,
                'VorgnInt' => (string)$vorgang->InterneVorgangsnummer,
                'Abgru' => '',
            ];
        }
        $data['to_Items'] = $positionArray;
        Log::info('se-26-01 Sent data', $data);
        $result = app(SapApiClient::class)->post($this->se2601_path, $data);
        Log::info('se-26-01 Received data', $result);


        if (
            !isset($result['d']) ||
            !isset($result['d']['Status'])
        ) {
            throw new InvalidSapResponseException('Ungültige SAP-Antwort.');
        }
        if ($result['d']['Status'] === 'error') {
            throw new SapBusinessException(
                $result['d']['Message'] ?? 'SAP hat die Anfrage abgelehnt.',
                $result['d']
            );
        }
        return $result;
    }
}
