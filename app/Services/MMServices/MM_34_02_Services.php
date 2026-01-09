<?php

namespace App\Services\MMServices;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position5Individual;
use App\Models\Rak_Mad_Material_Tour;
use App\Models\Vorgang;
use Illuminate\Support\Facades\DB;

class MM_34_02_Services
{
    /**
     * @throws ResourceNotFoundException|\Throwable
     */
    public function mm_34_02_Statusumlagerungsreservierung($reservations): ?array
    {
        return DB::transaction(function () use ($reservations) {
            $response = [];
            $response['checkstatus'] = true;

            foreach ($reservations as $reservation) {
                $tourId = $reservation['header']['tourId'];
                $checkStatus = $reservation['header']['checkstatus'];
                $response['response']['TourId'] = $tourId;
                $materialTour = Rak_Mad_Material_Tour::where('TourID', $tourId)->first();
                if ($materialTour === null) {
                    throw new ResourceNotFoundException('Der Vorgang für diese Tour wurde nicht gefunden.', [
                        'TourId' => $tourId,
                    ]);
                }

                $vorgang = Vorgang::where('InterneVorgangsnummer', $materialTour->InterneVorgangsnummer)->first();
                if ($vorgang === null) {
                    throw new ResourceNotFoundException('Die angeforderte Vorgang wurde nicht gefunden.', [
                        'TourId' => $tourId,
                    ]);
                }
                foreach ($reservation['materials'] as $materialData) {
                    $artikelNummer = ltrim($materialData['material'], '0');
                    $interneArtikel = Artikel::where('Artikelnummer', $artikelNummer)->first();
                    if ($interneArtikel === null) {
                        throw new ResourceNotFoundException('Die Interne CEOS Material wurde nicht gefunden.', [
                            'TourId' => $tourId,
                            'materials' => [$artikelNummer],
                        ]);
                    }

                    $position = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                        ->where('InterneArtikelnummer', $interneArtikel->InterneArtikelnummer)
                        ->first();

                    if ($position === null) {
                        throw new ResourceNotFoundException('Die Position wurde nicht gefunden.', [
                            'TourId' => $tourId,
                            'materials' => [$artikelNummer],
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

                    $position5Individual->PosIndividualC6 =
                        (($position5Individual->PosIndividualC6 ?? 0) + $materialData['entryQnt']);
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
