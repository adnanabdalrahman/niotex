<?php

namespace App\Services\SDServices;

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
     * SD-01-02: CEOS-->SAP, beauftragung Rückmeldung
     */
    public function sd_0102_beauftragung_rueckmeldung($request)
    {
        try {
            $data = [];
            $vorgang = Vorgang::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();
            if ($vorgang === null) {
                Log::error(
                    "sd_0102_beauftragung_rueckmeldung Kein Vorgang gefunden",
                    ['Vorgangnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
            if ($adresse === null) {
                Log::error(
                    "Kein Adresse für Vorgang gefunden",
                    ['Vorgangnummer' => $request->InterneVorgangsnummer]
                );
                return null;
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

            $vorgang2Text = Vorgang2Text::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();

            $vorNotiz = (string)$vorgang2Text?->VorNotiz;
            $data['TxtZ012'] = $vorNotiz;

            //---------------------------------------------------------------------------------------------
            $positions = Position::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->get();
            foreach ($positions as $position) {
                //ignore unterpositionen
                if (intval($position->PosNummernText) != $position->PosNummernText) {
                    continue;
                }
                $artikel = Artikel::where('InterneArtikelnummer', $position->InterneArtikelnummer)->first();
                if (is_null($artikel)) {
                    Log::error(
                        "sd_0102_beauftragung_rueckmeldung Artikel für Position nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InterneArtikelnummer' => $position->InterneArtikelnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $position5Individual = Position5Individual::where
                ('InternePositionsnummer', $position->InternePositionsnummer)->first();
                if (is_null($position5Individual)) {
                    Log::error(
                        "Position5Individual nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $position3Menge = Position3Menge::where
                ('InternePositionsnummer', $position->InternePositionsnummer)->first();
                if (is_null($position3Menge)) {
                    Log::error(
                        "Position3Menge nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $position1wert = Position1Wert::where
                ('InternePositionsnummer', $position->InternePositionsnummer)->first();
                if (is_null($position1wert)) {
                    Log::error(
                        "Position1wert nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $position2Text = Position2Text::where
                ('InternePositionsnummer', $position->InternePositionsnummer)->first();
                if (is_null($position2Text)) {
                    Log::error(
                        "Position2Text nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
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
                    'TxtZ002' => (string)$position2Text->PosZusatztextLieferschein,
                    'TxtZ009' => (string)$position2Text->PosZusatztext,
                    'TxtZ010' => (string)$position2Text->PosNotiz,
                    'PosAtt' => (string)$position5Individual->PosIndividualC4,
                    'Montagedatum' => Carbon::parse($position5Individual->PosIndividualT3)->format('Ymd')
                ];
            }
            Log::info('sd-01-02 Sent data', $data);
            $result = app(SapApiClient::class)->post($this->sd0102_path, $data);
            if ($result === null ||
                !isset($result['d']['Status']) ||
                $result['d']['Status'] === "error") {
                Log::error('sd-01-02 Error received');
                return null;
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }
        return $result;
    }
}
