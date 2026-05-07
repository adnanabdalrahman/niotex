<?php

namespace App\Services\MMServices;

use App\Exceptions\DBSaveException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\ArtikelKunde;
use Carbon\Carbon;
use Throwable;


class MM_37_1_Services
{
    /**
     * SAP → CEOS
     * @throws DBSaveException
     * @throws ResourceNotFoundException
     */
    public function mm_37_1_NuLeistungspositionen($data): ?array
    {
        $adressnummer = $data['header']['kreditor'];
        $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
        if ($adresse === null) {
            throw new ResourceNotFoundException('Kein Adresse für kreditor ' . $adressnummer . ' gefunden: ',
                ["Adresse" => $adressnummer]
            );
        }

        $gueltigVon = Carbon::parse($data['header']['gueltigVon'])->format('Ymd');
        $gueltigBis = Carbon::parse($data['header']['gueltigBis'])->format('Ymd');
        $artikelKundeIds = [];
        foreach ($data['positions'] as $position) {
            //getInterneArtikelnummer
            $artikelNummer = ltrim($position['materialnummer'], '0');
            $artikel = Artikel::where('ArtikelNummer', $artikelNummer)->first();
            if ($artikel === null) {
                throw new ResourceNotFoundException('Artikel ' . $artikelNummer . ' nicht gefunden: ',
                    ["Artikel" => $artikelNummer]
                );
            }

            //set artikel as Inactive
            if ($position['loeschkennzeichen'] !== null) {
                $artikel->ArtAltJN = 1;
                $artikel->save();
            }
            $dataArtikel = [
                'AkuBestellnummer' => $position['kontraktnummer'],
                'AkuArtikelBezeichnung2' => $position['kontraktposition'],
                'InterneArtikelnummer' => $artikel->InterneArtikelnummer,
                'InterneAdressnummer' => $adresse->InterneAdressnummer,
                'AkuArtikelBezeichnung1' => mb_substr($position['materialkurztext'], 0, 39),
                'NRPreisbasis' => $position['preismengeneinheit'],
                'AkuLetzterVK' => (float)$position['preis'],
                'AkuIndividualT1' => $gueltigVon,
                'AkuIndividualT2' => $gueltigBis,

                //-----------------------------------------------------
                'AkuLetzterRabattWert1' => 0,
                'AkuLetzterRabattWert2' => 0,
                'AkuLetzteMenge1' => 0,
                'AkuLetzteMenge2' => 0,
                'AkuLetzterRabatt1' => 0,
                'AkuLetzterRabatt2' => 0,
                'AkuLetzterRabatt3' => 0,
            ];

            try {
                $artikelKunde = ArtikelKunde::where('InterneArtikelnummer', $artikel->InterneArtikelnummer)
                    ->where('InterneAdressnummer', $adresse->InterneAdressnummer)
                    ->first();

                //check if exist before or not :
                if ($artikelKunde === null) {
                    //No => create new one.
                    $artikelKunde = ArtikelKunde::create($dataArtikel);
                } else {
                    //yes =>  check if Gültigab(AkuIndividualT1) tha same or not
                    $akuIndividualT1 = Carbon::parse($artikelKunde->AkuIndividualT1)->format('Ymd');
                    if ($gueltigVon == $akuIndividualT1) {
                        // if same we should change only the Preis
                        $artikelKunde->AkuLetzterVK = (float)$position['preis'];
                    } else {
                        // if not, check if AkuVKNeuDatum,AkuVKNeu Empty or not
                        if ($artikelKunde->AkuVKNeu !== null) {
                            // if not Empty => Move current AkuVKNeu To AkuLetzterVK and save new one in AkuVKNeu the update Gültig ab
                            $artikelKunde->AkuLetzterVK = (float)$artikelKunde->AkuVKNeu;
                            $akuVKNeuDatum = Carbon::parse($artikelKunde->AkuVKNeuDatum)->format('Ymd');
                            $artikelKunde->AkuIndividualT1 = $akuVKNeuDatum;
                        }
                        $artikelKunde->AkuVKNeu = (float)$position['preis'];
                        $artikelKunde->AkuVKNeuDatum = $gueltigVon;
                    }
                    $artikelKunde->save();
                }
            } catch (Throwable $exception) {
                throw new DBSaveException('Fehler beim Speichern oder Aktualisieren die ArtikelKunde', [
                    'database' => $exception->getMessage(),
                ]);
            }
            $artikelKundeIds[] = $artikelKunde->ArtikelKundeID;
        }
        return [
            'artikelKundeIds' => $artikelKundeIds,
        ];
    }
}
