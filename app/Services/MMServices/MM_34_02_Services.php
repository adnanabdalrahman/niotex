<?php

namespace App\Services\MMServices;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position5Individual;
use App\Models\Rak_Mad_Material_Tour;
use App\Models\Vorgang;
use Illuminate\Support\Facades\DB;
use Throwable;

class MM_34_02_Services
{
    /**
     * SAP -> CEOS
     * @throws ResourceNotFoundException|Throwable
     */
    public function mm_34_02_Statusumlagerungsreservierung($reservations): ?array
    {
        return DB::transaction(function () use ($reservations) {
            $response = [];
            $response['checkstatus'] = true;

            foreach ($reservations as $reservation) {
                $tourId = $reservation['header']['tourId'];
                $checkStatus = $reservation['header']['checkstatus'];
                $reservNo = $reservation['header']['reservNo'];
                $response['response']['TourId'] = $tourId;
                $interneVorgangsnummerArray = Rak_Mad_Material_Tour::where('TourID', $tourId)->get()
                    ->pluck('InterneVorgangsnummer')
                    ->toArray();

                if (empty($interneVorgangsnummerArray)) {
                    throw new ResourceNotFoundException('Kein Vorgänge für diese Tour gefunden.', [
                        'TourId' => $tourId,
                    ]);
                }

                $resultArray = [];
                foreach ($interneVorgangsnummerArray as $interneVorgangsnummer) {
                    $vorgang = Vorgang::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
                    if ($vorgang === null) {
                        throw new ResourceNotFoundException('Die angeforderte Vorgang wurde nicht gefunden.', [
                            'TourId' => $tourId,
                        ]);
                    }

                    $resultArray[$interneVorgangsnummer] = $vorgang->VorIndividualC4;
                }


                $resultInterneVorgangsnummer = array_search($reservNo, $resultArray);

                foreach ($reservation['materials'] as $materialData) {
                    $artikelNummer = ltrim($materialData['material'], '0');
                    $interneArtikel = Artikel::where('Artikelnummer', $artikelNummer)->first();
                    if ($interneArtikel === null) {
                        throw new ResourceNotFoundException('Die Interne CEOS Material wurde nicht gefunden.', [
                            'TourId' => $tourId,
                            'materials' => [$artikelNummer],
                        ]);
                    }

                    $position = Position::where('InterneVorgangsnummer', $resultInterneVorgangsnummer)
                        ->where('InterneArtikelnummer', $interneArtikel->InterneArtikelnummer)
                        ->first();

                    if ($position === null) {
                        throw new ResourceNotFoundException('Die Position wurde nicht gefunden.', [
                            'TourId' => $tourId,
                            'materials' => [$artikelNummer],
                            'InterneVorgangsnummer' => $resultInterneVorgangsnummer,
                            'InterneArtikelnummer' => $interneArtikel->InterneArtikelnummer,
                        ]);
                    }
                    $position5Individual = Position5Individual::where('InternePositionsnummer',
                        $position->InternePositionsnummer
                    )->first();

                    if ($position5Individual === null) {
                        throw new ResourceNotFoundException('Position5Individual wurde nicht gefunden.', [
                            'TourId' => $tourId,
                            'materials' => [$artikelNummer],
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                            'InterneArtikelnummer' => $interneArtikel->InterneArtikelnummer,
                        ]);
                    }

                    $position5Individual->PosIndividualD6 =
                        (($position5Individual->PosIndividualD6 ?? 0) + $materialData['entryQnt']);
                    if ($checkStatus !== "X") {
                        $response['checkstatus'] = false;
                        $position5Individual->save();
                    }
                    $response['response']['materials'][] = $artikelNummer;
                }
            }
            return $response;
        });
    }
}
