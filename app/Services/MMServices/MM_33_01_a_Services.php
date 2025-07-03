<?php

namespace App\Services\MMServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Exception;
use Illuminate\Support\Facades\Log;


class MM_33_01_a_Services
{
    protected string $mm331_path;

    public function __construct()
    {
        $this->mm331_path = config('sap.mm331_path');
    }


    /**
     * @throws Exception
     */
    public function mm_33_01_a_Leistungsbestaetigung($data)
    {
        $vorgang = Vorgang::where('VorNummer', $data['Vorgangnummer'])
            ->where('VorGruppe', 'NU')
            ->first();

        if ($vorgang === null) {
            Log::error(
                'mm_33_01_a_Leistungsbestaetigung Kein Vorgang vorhanden',
                ['Vorgangnummer' => $data['Vorgangnummer']]
            );
            return null;
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            Log::error("mm_33_01_a_Leistungsbestaetigung Kein Adresse für Vorgang gefunden");
            return null;
        }

        $tourId = '3025';

        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();
        if ($positions->isEmpty()) {
            Log::error('Keine Positionen vorhanden');
            return null;
        }
        $to_Items = [];
        foreach ($positions as $position) {
            if ($position->PosTyp == 2) {
                continue;
            }

            $artikel = Artikel::find($position->InterneArtikelnummer);
            if ($artikel === null) {
                Log::error(
                    'mm_33_01_a_Leistungsbestaetigung Kein Artikel für Position gefunden',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer
                    ]
                );
                return null;
            }
            $position3Menge = Position3Menge::where('InternePositionsnummer', $position->InternePositionsnummer)
                ->where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                ->first();
            $to_Items[] = [
                'TourId' => (string)(int)$tourId,
                'Lifnr' => $adresse->AdressNummer,
                'Slgnr' => $vorgang->VorIndividualC3,
                'Vgart' => 'M_RM', // 'M',//todo clarify with VIVAWEST $vorgang->VorGruppe,
                'Vbeln' => '',
                'Posnr' => '',
                'Material' => (string)(int)$artikel->Artikelnummer,
                'ShortText' => $artikel->ArtBezeichnung1 ?? "",
                "Quantity" => (string)(int)$position3Menge->PosMenge1,
                //"Netpr" => $artikelKunde->AkuLetzterVK,
                "Peinh" => '1',//always 1 //todo clarify from pante
                "CeosData" => "X",
                "Goodsmovement" => "",
                "GoodsmvmtLine" => "",
                "PoUnit" => "",
                "PoNumber" => $vorgang->VorIndividualC6 ?? "",
                "PoItem" => $vorgang->VorIndividualC5 ?? "",
            ];
        }

        $data = [
            "TourId" => (string)(int)$tourId,
            "Interface" => 'A',
            "Lifnr" => $adresse->AdressNummer,
            "PoNumber" => $vorgang->VorIndividualC6 ?? "",
            "to_items" => $to_Items
        ];
        Log::info("mm_33_01_a_Leistungsbestaetigung sent Data", $data);
        return app(SapApiClient::class)->post($this->mm331_path, $data);
    }
}
