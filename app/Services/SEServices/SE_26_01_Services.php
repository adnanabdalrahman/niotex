<?php

namespace App\Services\SEServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SE_26_01_Services
{
    protected string $baseUrl;
    protected string $se2601_path;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->se2601_path = config('sap.se2601_path');
    }

    /**
     * SE-26-01 Reparaturauftrag
     */

    public function se_26_01_Reparaturauftrag($request)
    {
        try {
            $data = [];
            $vorgang = Vorgang::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();

            if ($vorgang === null) {
                Log::error(
                    "se_26_01_Reparaturauftrag Kein Vorgang gefunden",
                    ['InterneVorgangsnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
            if ($adresse !== null) {
                $data['Kunnr'] = $adresse->AdressNummer;
            } else {
                Log::error(
                    "Kein Adresse für Vorgang gefunden",
                    ['Vorgangnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $data['Auart'] = (string)$vorgang->VorIndividualC2;
            $data['Zzlgsnr'] = (string)$vorgang->VorIndividualC3 ?? '';
            $data['Vorgn'] = (string)$vorgang->VorNummer;
            $data['VorgnInt'] = (string)$vorgang->InterneVorgangsnummer;

            //---------------------------------------------------------------------------------------------
            $positions = DB::connection('sqlsrv2')->table('cis.Position')
                ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->get();
            $positionArray = [];
            foreach ($positions as $position) {

                $artikel = Artikel::where('InterneArtikelnummer', $position->InterneArtikelnummer)->first();
                if (is_null($artikel)) {
                    Log::error(
                        "Artikel für Position nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InterneArtikelnummer' => $position->InterneArtikelnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $position3Menge = DB::connection('sqlsrv2')->table('cis.Position3Menge')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
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
                $position2Text = DB::connection('sqlsrv2')->table('cis.Position2Text')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position2Text)) {
                    Log::error(
                        "position2Text nicht gefunden",
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

                $positionArray[] = [
                    'Matnr' => $artikel->Artikelnummer,
                    'TxtZ009' => (string)$position2Text->PosZusatztext,
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
            if ($result === null ||
                !isset($result['d']['Status']) ||
                $result['d']['Status'] === "error") {
                Log::error('se-26-01 Error received');
                return null;
            }
            //Storno
            if ($result['d']['Vbeln'] == $result['d']['Zuonr']) {
                $vorgang->VorStatus = 100430;
                $vorgang->save();
            }


        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }
        return $result;
    }
}
