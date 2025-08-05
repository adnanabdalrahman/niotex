<?php

namespace App\Services\SDServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Position2Text;
use App\Models\Position3Menge;
use App\Models\Position5Individual;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SD_03_01_Services
{
    protected string $sd0301_path;
    protected string $baseUrl;
    protected array $vorGruppe;
    protected array $mwstSatzProzentArray;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');

        $this->sd0301_path = config('sap.sd0301_path');
        $this->vorGruppe = config('vorgruppe');
        $this->mwstSatzProzentArray = [
            7 => 2,
            19 => 3,
            0 => 4,
        ];
    }


    /**
     * CEOSWeb -> CEOS --> SAP
     * SD-03-01 Dienstleistungsrechnung
     */
    public function sd_0301_dienstleistungsrechnung($request): ?array
    {
        try {
            $data = [];
            $vorgang = Vorgang::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();
            if ($vorgang === null) {
                Log::error(
                    "sd_0301_dienstleistungsrechnung Kein Vorgang gefunden",
                    ['InterneVorgangsnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
            if ($adresse === null) {
                Log::error(
                    "Kein Adresse für Vorgang gefunden",
                    ['InterneVorgangsnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $data['Kunnr'] = $adresse->AdressNummer;
            $data['Auart'] = (string)$vorgang->VorIndividualC2;
            $data['Zzlgsnr'] = (string)$vorgang->VorIndividualC3;
            $data['Vorgn'] = (string)$vorgang->VorNummer;
            $data['VorgnInt'] = (string)$vorgang->InterneVorgangsnummer;
            $carbonAbrVon = Carbon::parse((string)$vorgang->VorIndividualT1);
            $data['AbrVon'] = $carbonAbrVon->format('Ymd');
            $carbonAbrBis = Carbon::parse((string)$vorgang->VorIndividualT2);
            $data['AbrBis'] = $carbonAbrBis->format('Ymd');
            //---------------------------------------------------------------------------------------------
            $positions = DB::connection('sqlsrv2')->table('cis.Position')
                ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->get();

            foreach ($positions as $position) {
                $artikel = Artikel::where('InterneArtikelnummer', $position->InterneArtikelnummer)->first();
                if (is_null($artikel)) {
                    Log::error(
                        "sd_0301_dienstleistungsrechnung Artikel für Position nicht gefunden",
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
                if ($position3Menge->PosKZMengeneinheit1 == "Stck") {
                    $vrkme = "ST";
                } else {
                    $vrkme = $position3Menge->PosKZMengeneinheit1;
                }
                $data['to_ServItems'][] = [
                    'Matnr' => $artikel->Artikelnummer,
                    'Kwmeng' => (string)$position3Menge->PosMenge1,
                    'Vrkme' => (string)$vrkme,
                    'Vorgn' => (string)$vorgang->VorNummer,
                    'VorgnInt' => (string)$vorgang->InterneVorgangsnummer,
                ];
            }
            Log::info('sd-03-01 Sent data', $data);
            $result = app(SapApiClient::class)->post($this->sd0301_path, $data);
            if ($result === null ||
                !isset($result['d']['Status']) ||
                $result['d']['Status'] === "error") {
                Log::error('sd-03-01 Error received', $result);
                return null;
            }

        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }
        Log::info('sd-03-01 received data: ', $result);

        return $result;
    }

}





