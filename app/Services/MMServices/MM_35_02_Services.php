<?php

namespace App\Services\MMServices;

use App\Exceptions\InvalidSapResponseException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Position5Individual;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;


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
     * @param $requestData
     * @return array
     * @throws InvalidSapResponseException
     * @throws ResourceNotFoundException
     * @throws Throwable
     */
    public function mm_35_02_materialverbrauch($requestData): array
    {
        $vorgang = Vorgang::where('VorNummer', $requestData['Vorgangnummer'])
            ->where('VorGruppe', $requestData['VorGruppe'])//'M_LG'
            ->first();

        if ($vorgang === null) {
            throw new ResourceNotFoundException(
                'Kein Vorgang gefunden.',
                ['Vorgangnummer' => $requestData['Vorgangnummer']]
            );
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorLieferanschrift)->first();

        if ($adresse === null) {
            throw new ResourceNotFoundException(
                'Keine Adresse für den Vorgang gefunden.',
                ['InterneAdressnummer' => $vorgang->VorLieferanschrift]
            );
        }

        $milliseconds = Carbon::parse($requestData['tourDate'])->timestamp * 1000;
        $tourDate = "/Date({$milliseconds})/";

        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();
        if ($positions->isEmpty()) {
            throw new ResourceNotFoundException(
                'Keine Positionen für den Vorgang gefunden.',
                ['InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer]
            );
        }
        $to_Items = [];
        /** @var Position $position */
        foreach ($positions as $position) {
            $artikel = Artikel::find($position->InterneArtikelnummer);

            if ($artikel === null) {
                throw new ResourceNotFoundException(
                    'Kein Artikel für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer,
                    ]
                );
            }
            $position3Menge = Position3Menge::where('InternePositionsnummer', $position->InternePositionsnummer)
                ->where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                ->first();

            if ($position3Menge === null) {
                throw new ResourceNotFoundException(
                    'Keine Mengenangabe für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }

            $position5Individual = Position5Individual::where('InternePositionsnummer', $position->InternePositionsnummer)
                ->where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                ->first();
            if ($position5Individual === null) {
                throw new ResourceNotFoundException(
                    'Keine Position5Individual-Daten für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                    ]
                );
            }

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
        $response = app(SapApiClient::class)->post($this->mm352_path, $requestData);
        Log::info("mm_35_02_materialverbrauch received Data", $response);
        if (!isset($response['d'])) {
            throw new InvalidSapResponseException(
                'Ungültige SAP-Antwort.'
            );
        }
        return $response;
    }
}
