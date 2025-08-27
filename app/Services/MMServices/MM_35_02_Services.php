<?php

namespace App\Services\MMServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Position5Individual;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;


class MM_35_02_Services
{

    protected string $mm352_path;

    public function __construct()
    {
        $this->mm352_path = config('sap.mm352_path');
    }


    /**
     * MM_35_02 materialverbrauch
     * CEOSWEB-->CEOS-->SAP
     * @throws Exception
     */
    public function mm_35_02_materialverbrauch($requestData)
    {
        $vorgang = Vorgang::where('VorNummer', $requestData['Vorgangnummer'])
            ->where('VorGruppe', $requestData['VorGruppe'])//'M_LG'
            ->first();

        if ($vorgang === null) {
            Log::error(
                'mm_35_02_materialverbrauch Kein Vorgang vorhanden',
                ['Vorgangnummer' => $requestData['Vorgangnummer']]
            );
            return null;
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorLieferanschrift)->first();
        if ($adresse === null) {
            Log::error("mm_35_02_materialverbrauch Kein Adresse für Vorgang gefunden");
            return null;
        }

        $milliseconds = Carbon::parse($requestData['tourDate'])->timestamp * 1000;
        $tourDate = "/Date({$milliseconds})/";

        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();
        if ($positions->isEmpty()) {
            Log::error('Keine Positionen vorhanden');
            return null;
        }
        $to_Items = [];
        foreach ($positions as $position) {
            $artikel = Artikel::find($position->InterneArtikelnummer);

            if ($artikel === null) {
                Log::error(
                    'mm_35_02_materialverbrauch Kein Artikel für Position gefunden',
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
            $position5Individual = Position5Individual::where('InternePositionsnummer', $position->InternePositionsnummer)
                ->where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                ->first();
            $to_Items[] = [
                'Material' => (string)(int)$artikel->Artikelnummer,
                "MoveType" => "261",
                "Storage" => '',
                "DynamicStorage" => $adresse->AdressNummer,
                "EntryQnt" => (string)(int)$position3Menge->PosMenge1,
                "EntryUom" => "ST",
                'Vbeln' => '',
                'Posnr' => '',
                'Slgnr' => $vorgang->VorIndividualC3,
                'Vgart' => $position5Individual->PosIndividualC2,
                "TourId" => (string)$requestData['tourId'],
            ];
        }

        $requestData = [
            "TourId" => (string)(int)$requestData['tourId'],
            "MoveDate" => $tourDate,
            "to_Items" => $to_Items
        ];
        Log::info("mm_35_02_materialverbrauch sent Data", $requestData);
        return app(SapApiClient::class)->post($this->mm352_path, $requestData);
    }
}
