<?php

namespace App\Services\MMServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\ArtikelKunde;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class MM_37_1_Services
{
    public function __construct()
    {

    }

    public function mm_37_1_NuLeistungspositionen($data): ?array
    {
        try {
            $adressnummer = $data['header']['kreditor'];
            $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
            if ($adresse === null) {
                Log::error('mm_37_1_NuLeistungspositionen Adresse nicht gefunden: ' . $adressnummer);
                return null;
            }

            $gueltigVon = Carbon::parse($data['header']['gueltigVon'])->format('Y-m-d');
            $gueltigBis = Carbon::parse($data['header']['gueltigBis'])->format('Y-m-d');
            $artikelKundeIds = [];
            foreach ($data['positions'] as $position) {
                //getInterneArtikelnummer
                $artikelNummer = ltrim($position['materialnummer'], '0');
                $artikel = Artikel::where('ArtikelNummer', $artikelNummer)->first();
                if ($artikel === null) {
                    Log::error('mm_37_1_NuLeistungspositionen Artikel nicht gefunden: ' . $artikelNummer);
                    return null;
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
                    'AkuArtikelBezeichnung1' => $position['materialkurztext'],
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
                        $artikelKunde->save();
                    } else {
                        // if not, check if AkuVKNeuDatum,AkuVKNeu Empty or not
                        if ($artikelKunde->AkuVKNeu === null) {
                            // if Empty => add Gültigab in AkuVKNeuDatum and New Preis(Preis) in AkuVKNeu
                            $artikelKunde->AkuVKNeu = (float)$position['preis'];
                            $artikelKunde->AkuVKNeuDatum = $gueltigVon;
                            $artikelKunde->save();
                        } else {
                            // if not Empty => Move current AkuVKNeu To AkuLetzterVK and save new one in AkuVKNeu the update Gültig ab
                            $artikelKunde->AkuLetzterVK = (float)$artikelKunde->AkuVKNeu;
                            $artikelKunde->AkuIndividualT1 = $artikelKunde->AkuVKNeuDatum;
                            $artikelKunde->AkuVKNeu = (float)$position['preis'];
                            $artikelKunde->AkuVKNeuDatum = $gueltigVon;
                            $artikelKunde->save();
                        }

                    }
                }
                $artikelKundeIds[] = $artikelKunde->ArtikelKundeID;
            }
        } catch (\Throwable $e) {
            Log::error(
                'mm_37_1_NuLeistungspositionen Save  Error' . $e->getMessage(),
            );
            return null;
        }
        return [
            'artikelKundeIds' => $artikelKundeIds,
        ];
    }
}
