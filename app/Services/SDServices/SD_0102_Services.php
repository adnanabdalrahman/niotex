<?php

namespace App\Services\SDServices;

use App\Exceptions\InvalidSapResponseException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position1Wert;
use App\Models\Position2Text;
use App\Models\Position3Menge;
use App\Models\Position5Individual;
use App\Models\Vorgang;
use App\Models\Vorgang2Text;
use App\Services\SapApiClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class SD_0102_Services
{
    protected string $sd0102_path;
    protected array $vorgruppeMapping;

    public function __construct()
    {
        $this->sd0102_path = config('sap.sd0102_path');
        $this->vorgruppeMapping = config('vorgruppeMapping');
    }

    /**
     * SD-01-02: CEOS-->SAP, Beauftragung Rückmeldung
     *
     * @param array $requestData
     * @return array
     * @throws InvalidSapResponseException
     * @throws ResourceNotFoundException
     * @throws Throwable
     */
    public function sd_0102_beauftragung_rueckmeldung(array $requestData): array
    {
        $data = [];
        $interneVorgangsnummer = $requestData['InterneVorgangsnummer'];
        $vorgang = Vorgang::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
        if ($vorgang === null) {
            throw new ResourceNotFoundException(
                'Kein Vorgang gefunden.',
                ['InterneVorgangsnummer' => $interneVorgangsnummer]
            );
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            throw new ResourceNotFoundException(
                'Keine Adresse für den Vorgang gefunden.',
                ['InterneAdressnummer' => $vorgang->VorAuftraggeber]
            );
        }
        $data['Kunnr'] = $adresse->AdressNummer;

        $data['Vbeln'] = (string)$vorgang->VorIndividualC1;
        $data['Auart'] = (string)$vorgang->VorIndividualC2;
        $data['Vdatu'] = Carbon::parse($vorgang->VorLieferungWunschDatum)->format('Y-m-d');
        $data['Zzlgsnr'] = (string)$vorgang->VorIndividualC3;
        $data['GenrCeos'] = (string)(int)$vorgang->VorIndividualD4;
        $data['TxtZ013'] = (string)$vorgang->VorStichwort;


        $vorGruppeKey = array_search($vorgang->VorGruppe, $this->vorgruppeMapping);
        $data['Augru'] = substr($vorGruppeKey, 0, 3);

        $vorgang2Text = Vorgang2Text::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();

        $vorNotiz = (string)$vorgang2Text?->VorNotiz;
        $data['TxtZ012'] = $vorNotiz;

        //---------------------------------------------------------------------------------------------
        $positions = Position::where('InterneVorgangsnummer', $interneVorgangsnummer)->get();
        if ($positions->isEmpty()) {
            throw new ResourceNotFoundException(
                'Keine Positionen für den Vorgang gefunden.',
                [
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                ]
            );
        }
        /** @var Position $position */
        foreach ($positions as $position) {
            //ignore unterpositionen
            if (intval($position->PosNummernText) != $position->PosNummernText) {
                continue;
            }
            $artikel = Artikel::where('InterneArtikelnummer', $position->InterneArtikelnummer)->first();
            if ($artikel === null) {
                throw new ResourceNotFoundException(
                    'Kein Artikel für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $interneVorgangsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer,
                        'InternePositionsnummer' => $position->InternePositionsnummer,
                    ]
                );
            }

            $position5Individual = Position5Individual::where
            ('InternePositionsnummer', $position->InternePositionsnummer)->first();
            if ($position5Individual === null) {
                throw new ResourceNotFoundException(
                    'Keine Position5Individual-Daten für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $interneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }
            $position3Menge = Position3Menge::where
            ('InternePositionsnummer', $position->InternePositionsnummer)->first();
            if ($position3Menge === null) {
                throw new ResourceNotFoundException(
                    'Keine Mengenangabe für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $interneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }

            $position1wert = Position1Wert::where
            ('InternePositionsnummer', $position->InternePositionsnummer)->first();
            if ($position1wert === null) {
                throw new ResourceNotFoundException(
                    'Keine Position1Wert-Daten für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $interneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }

            $position2Text = Position2Text::where
            ('InternePositionsnummer', $position->InternePositionsnummer)->first();
            if ($position2Text === null) {
                throw new ResourceNotFoundException(
                    'Keine Position2Text-Daten für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $interneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }

            $posErl = $position1wert->PosPreisProME2 ? 1 : 2;

            if ($position3Menge->PosKZMengeneinheit1 == "Stck") {
                $vrkme = "ST";
            } else {
                $vrkme = $position3Menge->PosKZMengeneinheit1;
            }
            $data['to_Items'][] = [
                'Matnr' => $artikel->Artikelnummer,
                'PosErl' => (string)$posErl,
                'KwmengO' => (string)$position3Menge->PosMenge2,
                'Vorgn' => (string)$vorgang->VorNummer,
                'Vbeln' => (string)$vorgang->VorIndividualC1,
                'VorgnInt' => (string)$vorgang->InterneVorgangsnummer,
                'Posnr' => (string)(int)$position5Individual->PosIndividualC1,
                'Kwmeng' => (string)$position3Menge->PosMenge1,
                'Vrkme' => (string)$vrkme,
                // neue Anforderungen von Susanne
                //'TxtZ002' => (string)$position2Text->PosZusatztextLieferschein,
                //'TxtZ009' => (string)$position2Text->PosZusatztext,
                'TxtZ010' => (string)$position2Text->PosNotiz,
                'PosAtt' => (string)$position5Individual->PosIndividualC4,
                'Montagedatum' => Carbon::parse($position5Individual->PosIndividualT3)->format('Ymd')
            ];
        }
        Log::info('sd-01-02 Sent data', $data);
        $result = app(SapApiClient::class)->post($this->sd0102_path, $data);
        Log::info('sd-01-02 received data', $result);

        if (
            !isset($result['d']) ||
            !isset($result['d']['Status']) ||
            $result['d']['Status'] === 'error'
        ) {
            throw new InvalidSapResponseException('Ungültige SAP-Antwort.');
        }
        return $result;
    }
}
