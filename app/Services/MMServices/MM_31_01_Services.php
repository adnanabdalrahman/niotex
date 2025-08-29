<?php

namespace App\Services\MMServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Artikelgruppe;
use App\Models\ArtikelLieferant;
use App\Models\ArtikelUntergruppe;
use App\Models\Basisempfindlichkeit;
use App\Models\Ceos_HIBE2HAWA;
use App\Models\Warengruppe;
use Exception;
use Illuminate\Support\Facades\Log;


class MM_31_01_Services
{
    /**
     * MM-31-1 Materialstammdaten
     * SAP -> CEOS
     */
    public function mm_31_01_materialstammdaten($data): ?array
    {
        //validate HibeZuHawa
        $hawaInternArtikelNummerArray = $this->validateHibeZuHawa($data);
        if ($hawaInternArtikelNummerArray === null) {
            return null;
        }
        //trim Artikelnummer
        $data['Material'] = ltrim($data['Material'], '0');

        //Validate Warengruppe
        $validateWarengruppe = Warengruppe::where('KZWarengruppe', $data['CEOSWarengruppe'])->first();
        if ($validateWarengruppe === null) {
            Log::error('mm_31_01_materialstammdaten Kein Warengruppe für diese Material ', $data);
            return null;
        }

        //Validate KZWarengruppe+KZArtikelgruppe
        $validateArtikelGruppe = Artikelgruppe::where('KZArtikelgruppe', $data['CEOSArtikelgruppe'])
            ->where('KZWarengruppe', $data['CEOSWarengruppe'])
            ->first();
        if ($validateArtikelGruppe === null) {
            Log::error('mm_31_01_materialstammdaten Kein Artikelgruppe für diese Material ', $data);
            return null;
        }

        $artikelUntergruppe = ArtikelUntergruppe::where('KZUnterArtikelgruppe', $data['CEOSArtikeluntergruppe'])
            ->where('KZWarengruppe', $data['CEOSWarengruppe'])
            ->where('KZArtikelgruppe', $data['CEOSArtikelgruppe'])
            ->first();

        $data['ArtikelUntergruppeID'] = null;
        if ($artikelUntergruppe !== null) {
            $data['ArtikelUntergruppeID'] = $artikelUntergruppe->ArtikelUntergruppeID;
        }
        //EAN Splitt
        $artEAN1 = substr($data['EANNummerSAP'], 0, 8); // first 8 characters
        $artEAN2 = substr($data['EANNummerSAP'], 8, 8);

        $data['NRPreisbasis'] = 1;
        $data['MwstNummer'] = 3;
        $data['ArtVerkaufspreis1'] = 0;
        $data['ArtMaterialkosten'] = 0;
        $data['ArtSondereinzelkosten'] = 0;
        $data['ArtStkAuftragLagerbuchung'] = 0;
        $data['ArtFremdFertigungskosten'] = 0;
        $data['ArtFertigungskosten'] = 0;
        //    ------------------------------------
        $data['ArtRabattfaehigJN'] = 0;
        $data['ArtSeriennummernfaehigJN'] = 0;
        $data['ArtStuecklisteJN'] = 0;
        $data['ArtProvisionsfaehigJN'] = 0;
        $data['ArtLieferantenfaehigJN'] = 1;
        $data['ArtVerkaufsfaehigJN'] = 1;
        $data['ArtSkontofaehigJN'] = 0;

        if ($data['LVorm'] === null) {
            $data['LVorm'] = 0;
        } else {
            $data['LVorm'] = 1;
        }

        try {
            $artikel = Artikel::updateOrCreate(
                ['Artikelnummer' => $data['Material']],
                [
                    'Artikelnummer' => $data['Material'],
                    'ArtMatchcode' => mb_substr($data['Materialkurztext'], 0, 20),
                    'ArtBezeichnung1' => $data['Materialkurztext'], // ArtMatchcode
                    'ArtBezeichnung2' => $data['Bezeichnung1'] . "|" . $data['Bezeichnung2'],
                    'KZArtMengeneinheit1' => $data['Basismengeneinheit'],
                    'ArtAltJN' => $data['LVorm'],
                    'ArtIndividualC5' => $data['BKSchluessel'],
                    'KZWarengruppe' => $data['CEOSWarengruppe'],
                    'KZArtikelgruppe' => $data['CEOSArtikelgruppe'],
                    'ArtikelUntergruppeID' => $data['ArtikelUntergruppeID'],
                    'KZProduktgruppe' => $data['Produktgruppe'],
                    'ArtEAN1' => $artEAN1,
                    'ArtEAN2' => $artEAN2,
                    // default values for CEOS
                    'NRPreisbasis' => $data['NRPreisbasis'],
                    'MwstNummer' => $data['MwstNummer'],
                    'ArtVerkaufspreis1' => $data['ArtVerkaufspreis1'],
                    'ArtMaterialkosten' => $data['ArtMaterialkosten'],
                    'ArtSondereinzelkosten' => $data['ArtSondereinzelkosten'],
                    'ArtStkAuftragLagerbuchung' => $data['ArtStkAuftragLagerbuchung'],
                    'ArtFremdFertigungskosten' => $data['ArtFremdFertigungskosten'],
                    'ArtFertigungskosten' => $data['ArtFertigungskosten'],
                    'ArtRabattfaehigJN' => $data['ArtRabattfaehigJN'],
                    'ArtSeriennummernfaehigJN' => $data['ArtSeriennummernfaehigJN'],
                    'ArtStuecklisteJN' => $data['ArtStuecklisteJN'],
                    'ArtProvisionsfaehigJN' => $data['ArtProvisionsfaehigJN'],
                    'ArtLieferantenfaehigJN' => $data['ArtLieferantenfaehigJN'],
                    'ArtVerkaufsfaehigJN' => $data['ArtVerkaufsfaehigJN'],
                ]
            );
            if (!empty($hawaInternArtikelNummerArray)) {
                $HIBEzuHAWA = Ceos_HIBE2HAWA::where('HIBE', $artikel->InterneArtikelnummer)->first()
                    ?? new Ceos_HIBE2HAWA();
                $HIBEzuHAWA->HIBE = $artikel->InterneArtikelnummer;
                foreach ($hawaInternArtikelNummerArray as $key => $hawaInternArtikelNummer) {
                    $prop = 'HAWA0' . $key + 1;
                    $HIBEzuHAWA->$prop = $hawaInternArtikelNummer;
                }
                $HIBEzuHAWA->save();
            }


        } catch (Exception $e) {
            Log::error(
                'mm_31_01_materialstammdaten Save Artikel Error:' . $e->getMessage(),
                ['Material' => $data['Material']]
            );
            return null;
        }

        // add Basisempfindlichkeit
        try {
            Basisempfindlichkeit::updateOrCreate(
                ['InterneArtikelNummer' => $artikel->InterneArtikelnummer],
                [
                    'InterneArtikelNummer' => $artikel->InterneArtikelnummer,
                    'BasisempfindlichkeitSkala' => $data['Basisempfindlichkeit'],
                ]
            );
        } catch (Exception $e) {
            Log::error(
                'mm_31_01_materialstammdaten Save Basisempfindlichkeit Error' . $e->getMessage(),
                ['Material' => $data['Material']]
            );
            return null;
        }

        //  Lieferschein (Hersteller)
        if ($data['Hersteller'] !== null) {
            $adressnummer = ltrim($data['Hersteller'], '0');

            $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
            if ($adresse === null) {
                Log::error(
                    'mm_31_01_materialstammdaten Kein Adresse für Lieferschein gefunden',
                    ['AdressNummer' => $adressnummer]
                );
                return null;
            }
            $interneAdressnummer = $adresse->InterneAdressnummer;
            try {
                ArtikelLieferant::updateOrCreate(
                    [
                        'InterneAdressnummer' => $interneAdressnummer,
                        'InterneArtikelnummer' => $artikel->InterneArtikelnummer
                    ],
                    [
                        'InterneAdressnummer' => $interneAdressnummer,
                        'InterneArtikelnummer' => $artikel->InterneArtikelnummer,
                        'AliBestellnummer' => $data['Herstellerteilenummer'],
                        'AliLetzterEK' => 0,
                        'AliLetzteMenge1' => 0,
                        'AliLetzteMenge2' => 0,
                        'AliLetzterRabatt1' => 0,
                        'AliLetzterRabatt2' => 0,
                        'AliLetzterRabatt3' => 0,
                        'AliLetzterRabattWert1' => 0,
                        'AliLetzterRabattWert2' => 0,
                        'AliMindestbestellmenge' => 0,
                    ]
                );
            } catch (Exception $e) {
                Log::error(
                    "mm_31_01_materialstammdaten Lieferschein Error: " . $e->getMessage(),
                    ['Material' => $data['Material']]
                );
                return null;
            }
        }

        return [
            'interneArtikelnummer' => $artikel->InterneArtikelnummer,
            'Material' => $data['Material'],
        ];
    }


    public function validateHibeZuHawa($data): ?array
    {
        $HibeZuHawaArray = [
            $data['CEOSHIBEzuHAWA1'],
            $data['CEOSHIBEzuHAWA2'],
            $data['CEOSHIBEzuHAWA3']
        ];
        $hawaInternArtikelNummerArray = [];
        foreach ($HibeZuHawaArray as $key => $HIBEzuHawa) {
            if ($HIBEzuHawa !== NULL) {
                $hawaArtikel = Artikel::where('Artikelnummer', $HIBEzuHawa)->first();
                if ($hawaArtikel === null) {
                    Log::error('mm_31_01_materialstammdaten - Kein Material für diese  Hawa gefunden', [$HIBEzuHawa]);
                    return null;
                }
                $hawaInternArtikelNummerArray[$key] = $hawaArtikel->InterneArtikelnummer;

            }
        }
        return $hawaInternArtikelNummerArray;
    }

    //todo what id SAP want to delete HibeZuHawa ? should if "" delete it (current logic dosen't delete)
}
