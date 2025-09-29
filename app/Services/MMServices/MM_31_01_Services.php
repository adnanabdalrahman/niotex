<?php

namespace App\Services\MMServices;

use App\Exceptions\DBSaveException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Artikelgruppe;
use App\Models\ArtikelLieferant;
use App\Models\ArtikelUntergruppe;
use App\Models\Basisempfindlichkeit;
use App\Models\Ceos_HIBE2HAWA;
use App\Models\Warengruppe;
use DB;
use Throwable;

class MM_31_01_Services
{
    /**
     * @throws DBSaveException
     * @throws ResourceNotFoundException
     */
    public function mm_31_01_materialstammdaten($data): ?array
    {
        $hawaInternArtikelNummerArray = $this->validateHibeZuHawa($data);

        $data['Material'] = ltrim($data['Material'], '0');
        // Validate Warengruppe
        $validateWarengruppe = Warengruppe::where('KZWarengruppe', $data['CEOSWarengruppe'])->first();
        if ($validateWarengruppe === null) {
            throw new ResourceNotFoundException("Kein Warengruppe für" . $data['Material'] . " Material");
        }

        // Validate Artikelgruppe
        $validateArtikelGruppe = Artikelgruppe::where('KZArtikelgruppe', $data['CEOSArtikelgruppe'])
            ->where('KZWarengruppe', $data['CEOSWarengruppe'])
            ->first();
        if ($validateArtikelGruppe === null) {
            throw new ResourceNotFoundException("Kein Artikelgruppe für" . $data['Material'] . " Material");
        }
        $artikelUntergruppe = ArtikelUntergruppe::where('KZUnterArtikelgruppe', $data['CEOSArtikeluntergruppe'])
            ->where('KZWarengruppe', $data['CEOSWarengruppe'])
            ->where('KZArtikelgruppe', $data['CEOSArtikelgruppe'])
            ->first();

        $data['ArtikelUntergruppeID'] = $artikelUntergruppe?->ArtikelUntergruppeID;

        // default CEOS fields
        $data = array_merge($data, [
            'NRPreisbasis' => 1,
            'MwstNummer' => 3,
            'ArtVerkaufspreis1' => 0,
            'ArtMaterialkosten' => 0,
            'ArtSondereinzelkosten' => 0,
            'ArtStkAuftragLagerbuchung' => 0,
            'ArtFremdFertigungskosten' => 0,
            'ArtFertigungskosten' => 0,
            'ArtRabattfaehigJN' => 0,
            'ArtSeriennummernfaehigJN' => 0,
            'ArtStuecklisteJN' => 0,
            'ArtProvisionsfaehigJN' => 0,
            'ArtLieferantenfaehigJN' => 1,
            'ArtVerkaufsfaehigJN' => 1,
        ]);

        $data['LVorm'] = $data['LVorm'] === null ? 0 : 1;

        $artikel = null;
        try {
            DB::transaction(function () use ($data, $hawaInternArtikelNummerArray, &$artikel) {
                $artikel = Artikel::updateOrCreate(
                    ['Artikelnummer' => $data['Material']],
                    [
                        'Artikelnummer' => $data['Material'],
                        'ArtMatchcode' => mb_substr($data['Materialkurztext'], 0, 20),
                        'ArtBezeichnung1' => $data['Materialkurztext'],
                        'ArtBezeichnung2' => $data['Bezeichnung1'] . "|" . $data['Bezeichnung2'],
                        'KZArtMengeneinheit1' => $data['Basismengeneinheit'],
                        'ArtAltJN' => $data['LVorm'],
                        'ArtIndividualC5' => $data['BKSchluessel'],
                        'KZWarengruppe' => $data['CEOSWarengruppe'],
                        'KZArtikelgruppe' => $data['CEOSArtikelgruppe'],
                        'ArtikelUntergruppeID' => $data['ArtikelUntergruppeID'],
                        'KZProduktgruppe' => $data['Produktgruppe'],
                        'ArtEAN1' => substr($data['EANNummerSAP'], 0, 8),
                        'ArtEAN2' => substr($data['EANNummerSAP'], 8, 8),
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

                // Ceos_HIBE2HAWA
                if (!empty($hawaInternArtikelNummerArray)) {
                    $HIBEzuHAWA = Ceos_HIBE2HAWA::where('HIBE', $artikel->InterneArtikelnummer)->first()
                        ?? new Ceos_HIBE2HAWA();
                    $HIBEzuHAWA->HIBE = $artikel->InterneArtikelnummer;
                    foreach ($hawaInternArtikelNummerArray as $key => $hawaInternArtikelNummer) {
                        $prop = 'HAWA0' . ($key + 1);
                        $HIBEzuHAWA->$prop = $hawaInternArtikelNummer;
                    }
                    $HIBEzuHAWA->save();
                }

                // Basisempfindlichkeit
                Basisempfindlichkeit::updateOrCreate(
                    ['InterneArtikelNummer' => $artikel->InterneArtikelnummer],
                    [
                        'InterneArtikelNummer' => $artikel->InterneArtikelnummer,
                        'BasisempfindlichkeitSkala' => $data['Basisempfindlichkeit'],
                    ]
                );

                // ArtikelLieferant
                if ($data['Hersteller'] !== null) {
                    $adressnummer = ltrim($data['Hersteller'], '0');
                    $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
                    if ($adresse === null) {
                        throw new ResourceNotFoundException('Kein Adresse für Lieferschein ' . $data['Hersteller'] . ' gefunden: ');
                    }
                    $interneAdressnummer = $adresse->InterneAdressnummer;
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
                }
            });
        } catch (Throwable $exception) {
            throw new DBSaveException($exception->getMessage());
        }
        return [
            'interneArtikelnummer' => $artikel->InterneArtikelnummer ?? null,
            'Material' => $data['Material'],
        ];
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function validateHibeZuHawa($data): ?array
    {
        $HibeZuHawaArray = [$data['CEOSHIBEzuHAWA1'], $data['CEOSHIBEzuHAWA2'], $data['CEOSHIBEzuHAWA3']];
        $hawaInternArtikelNummerArray = [];
        foreach ($HibeZuHawaArray as $key => $HIBEzuHawa) {
            if ($HIBEzuHawa !== NULL) {
                $hawaArtikel = Artikel::where('Artikelnummer', $HIBEzuHawa)->first();
                if ($hawaArtikel === null) {
                    throw new ResourceNotFoundException("Kein Material für [$HIBEzuHawa] Hawa gefunden");
                }
                $hawaInternArtikelNummerArray[$key] = $hawaArtikel->InterneArtikelnummer;
            }
        }
        return $hawaInternArtikelNummerArray;
    } //todo what id SAP want to delete HibeZuHawa ? should if "" delete it (current logic dosen't delete)
}
