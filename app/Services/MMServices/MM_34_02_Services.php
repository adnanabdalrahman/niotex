<?php

namespace App\Services\MMServices;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position5Individual;
use App\Models\Vorgang;


class MM_34_02_Services
{

    /**
     * @throws ResourceNotFoundException
     */
    public function mm_34_02_Statusumlagerungsreservierung($reservations): ?array
    {

        foreach ($reservations as $reservation) {

            //get Vorgang for this tourId,
            $tourId = $reservation['header']['TourId'];
            $reservNo = ltrim($reservation['header']['ReservNo'], '0');

            $vorgang = Vorgang::where('VorIndividualC4', $reservNo)->first();// todo find TourId
            if ($vorgang === null) {
                throw new ResourceNotFoundException('Die angeforderte Vorgang wurde nicht gefunden.', [
                    'TourId' => $tourId,
                    'ReservNo' => $reservNo,
                ]);
            }

            $artikels = [];
            foreach ($reservation['materials'] as $materialData) {
                $artikelNummer = ltrim($materialData['Material'], '0');
                $interneArtikelNummer = Artikel::where('Artikelnummer', $artikelNummer)->first()->InterneArtikelnummer;
                if ($interneArtikelNummer === null) {
                    throw new ResourceNotFoundException('Die Material  wurde nicht gefunden.', [
                        'ArtikelNummer' => $artikelNummer,
                        'ReservNo' => $reservNo,
                    ]);
                }
                $artikels[$interneArtikelNummer] = [
                    "EntryQnt" => $materialData['EntryQnt'],
                    "EntryUom" => $materialData['EntryUom']
                ];
            }
            $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();

            foreach ($positions as $position) {
                if (array_key_exists($position->InterneArtikelnummer, $artikels)) {
                    $newMenge = $artikels[$position->InterneArtikelnummer];
                    $position5Individual = Position5Individual::
                    where('InternePositionsnummer', $position->InternePositionsnummer)->first();

                    if ($position5Individual->PosIndividualC3 == "") {
                        $position5Individual->PosIndividualC3 = $newMenge;
                    } else {
                        $position5Individual->PosIndividualC3 = $position5Individual->PosIndividualC3 + $newMenge;
                    }
                    $position5Individual->save();

                } else {
                    throw new ResourceNotFoundException('Die Position wurde nicht gefunden.', [
                        'Position' => $position,
                        'ReservNo' => $reservNo,
                    ]);
                }

            }
        }
        return ['success' => true];

    }

}
