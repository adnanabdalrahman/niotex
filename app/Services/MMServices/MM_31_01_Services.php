<?php

namespace App\Services\MMServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Artikelgruppe;
use App\Models\ArtikelLieferant;
use App\Models\ArtikelUntergruppe;
use App\Models\Basisempfindlichkeit;
use App\Models\Produktgruppe;
use App\Models\Warengruppe;
use Exception;
use Illuminate\Support\Facades\Log;


class MM_31_01_Services
{

    public function __construct()
    {

    }


    /**
     * MM-31-1 Materialstammdaten
     * SAP -> CEOS
     */
    public function mm_31_01_materialstammdaten($data): ?array
    {

        /*

       todo
       HIBEzuHAWA1 =>  String (18)
       HIBEzuHAWA2 => String (18)
       HIBEzuHAWA3 => String (18)
        */

        //trim Artikelnummer
        $data['Material'] = ltrim($data['Material'], '0');

        //Validate Warengruppe
        $validateWarengruppe = Warengruppe::where('KZWarengruppe', $data['CEOSWarengruppe'])->first();
        if ($validateWarengruppe === null) {
            Log::error('Kein Warengruppe für diese Material ', $data);
            return null;
        }

        //Validate KZWarengruppe+KZArtikelgruppe
        $validateArtikelGruppe = Artikelgruppe::where('KZArtikelgruppe', $data['CEOSArtikelgruppe'])
            ->where('KZWarengruppe', $data['CEOSWarengruppe'])
            ->first();
        if ($validateArtikelGruppe === null) {
            Log::error('Kein Artikelgruppe für diese Material ', $data);
            return null;
        }

        //Validate Produktgruppe saved as it comes directly - NULL ACCEPTED
        $validateProduktgruppe = Produktgruppe::where('KZProduktgruppe', $data['Produktgruppe'])->first();
        if ($validateProduktgruppe === null) {
            Log::info('Kein Produktgruppe für diese Material ', $data);
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
                    'ArtMatchcode' => $data['Material'],
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
            $interneArtikelNummer = $artikel['InterneArtikelnummer'];
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
                ['InterneArtikelNummer' => $interneArtikelNummer],
                [
                    'InterneArtikelNummer' => $interneArtikelNummer,
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
                        'InterneArtikelnummer' => $interneArtikelNummer
                    ],
                    [
                        'InterneAdressnummer' => $interneAdressnummer,
                        'InterneArtikelnummer' => $interneArtikelNummer,
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
            'interneArtikelnummer' => $interneArtikelNummer,
            'Material' => $data['Material'],
        ];
    }

    //MM_34_01 Umlagerungsreservierung

}
