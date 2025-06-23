<?php

namespace App\Services;

use App\Models\Adresse;
use App\Models\AdresseBranche;
use App\Models\Ansprechpartner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;


class BPServices
{
    protected string $baseUrl;


    protected array $auth;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->auth = [
            'client_id' => config('sap.client_id'),
            'client_secret' => config('sap.client_secret'),
        ];
    }


    /**
     * BP-01-01 Geschäftspartner (Adressen)
     */
    public function bp_0101_geschaeftspartner($data)
    {
        // check if Adresse exist in CEOS
        // check Lov => 1/0

        // if not exist, create new Material

        /*
        Geschaeftspartnernummer INT     => INT  AdrFibunummer
        DebitorenKreditorennummer      => INT  AdressNummer
        Anrede                          => INT Code (zb:0001) Anrede.AnredeBezeichnung (n:1) (0001 Frau, 0002 Herr, 0003 Firma, 0005, 0006 Eheleute)
        Titel => TitelBezeichnung       => INT Code (zb:0002)INT Titel.NRTitel (n:1) (0001 DR - 0002 Prof. - 0003 ))
        Vorname (im Debitor Name 1)     => Varchar(40)   AdrFirmenbezeichnung1
        Nachname (im Debitor Name 1)    => Varchar(40)   AdrFirmenbezeichnung1
        Name1                           => Varchar(40)   AdrFirmenbezeichnung2
        Name2                           => Varchar(40)   AdrFirmenbezeichnung3
        Name3                           => Varchar(40)   AdrFirmenbezeichnung4
        Suchbegriff1                    => Varchar(10)   AdrMatchcode
        Suchbegriff2                    => Varchar(10)   ??
        Strasse                         => Varchar(40)   AdrStrasse
        Postleitzahl                    => Varchar(10)   AdrPLZ
        Ort                             => Varchar(40)   AdrOrt
        Land                            => Varchar(3)    Länderschlüssel ZB(DE) KZLand (n:1)
        Postfach                        => Varchar(10)   AdrPostfach
        Postleitzahl_Postfach           => Varchar(10)   AdrPLZPostfach
        Ort_Postfach                    => Varchar(40)   AdrOrtPostfach
        Telefon                         => Varchar(40)   AdrTelefon
        Mobiltelefon                    => Varchar(40)   AdrMobiltelefon
        Fax                             => Varchar(40)   AdrFax
        Email                           => Varchar(80)   AdrEmail
        AutoWEAbr                       => Boolean      AdrGutschriftsverfahrenJN
        Sperrkennzeichen                => Boolean      AdrLiefersperreJN
        Kundengruppe                    => Varchar(2)    ?????????????  //todo
        Kundengruppe1                  => Varchar(3)    ????????????? //todo
        UVI_Mailadresse                 => Varchar(80)
        PDF_Mailadresse                 => Varchar(80)
    */
        try {
            //Vorname + Nachname
            //$AdrFirmenbezeichnung1 = mb_substr($data['Vorname'] . " " . $data['Nachname'], 0, 40);

            $streetArray = $this->splitStreet($data['Strasse']);

            if ($data['Loeschvormerkung'] !== null && $data['Loeschvormerkung'] !== "0") {
                $data['Loeschvormerkung'] = 1;
            } else {
                $data['Loeschvormerkung'] = 0;
            }

            if ($data['AutoWEAbr'] !== null && $data['AutoWEAbr'] !== "0") {
                $data['AutoWEAbr'] = 1;
            } else {
                $data['AutoWEAbr'] = 0;
            }

            if ($data['Sperrkennzeichen'] !== null && $data['AutoWEAbr'] !== "0") {
                $data['Sperrkennzeichen'] = 1;
            } else {
                $data['Sperrkennzeichen'] = 0;
            }

            $data['Suchbegriff1'] = substr($data['Suchbegriff1'], 0, 10);

            if ($data['Anrede'] === null || $data['Anrede'] === "") {
                $data['Anrede'] = 5;
            }
            $kundengruppe1 = null;
            if ($data['Adresstyp'] === "KUN") {
                $kundengruppe1 = $data['Kundengruppe1'];
            }

            // Insert into users' table
            $adresse = Adresse::updateOrCreate(
                ['AdressNummer' => $data['DebitorenKreditorennummer']],
                [
                    'AdrFremdnummer' => $data['Geschaeftspartnernummer'], // Primary
                    'AdressNummer' => $data['DebitorenKreditorennummer'],
                    'KZWaehrung' => "EUR", // ???????
                    'KZAdresstyp' => $data['Adresstyp'],
                    'MwstTypID' => 3, // ???????
                    'AdrKarenztage' => 0, // ???????
                    'KZSprache' => "DE", // ???????
                    'AdrFactoringJN' => 0,
                    'AdrMahnSperreJN' => 0,
                    'NRAnrede' => $data['Anrede'],
                    'NRTitel' => $data['Titel'], // todo
                    'AdrFirmenbezeichnung1' => mb_substr($data['Name1'], 0, 40),
                    'AdrFirmenbezeichnung2' => mb_substr($data['Name2'], 0, 40),
                    'AdrFirmenbezeichnung3' => mb_substr($data['Name3'], 0, 40),
                    'AdrMatchcode' => $data['Suchbegriff1'],
                    'AdrStrasse' => $streetArray['strasse'],
                    'AdrStrasse2' => $streetArray['strasse2'],
                    'AdrStrasse3' => $streetArray['hausnummer'],
                    'AdrPLZ' => $data['Postleitzahl'],
                    'AdrOrt' => $data['Ort'],
                    'KZLand' => $data['Land'],
                    'AdrPostfach' => $data['Postfach'],
                    'AdrPLZPostfach' => $data['PostleitzahlPostfach'],
                    'AdrOrtPostfach' => $data['OrtPostfach'],
                    'AdrTelefon' => $data['Telefon'],
                    'AdrMobiltelefon' => $data['Mobiltelefon'],
                    'AdrFax' => $data['Fax'],
                    'AdrEmail' => $data['EMail'],
                    'AdrGutschriftsverfahrenJN' => $data['AutoWEAbr'],
                    'AdrLiefersperreJN' => $data['Sperrkennzeichen'],
                    'KZAdressgruppe' => $kundengruppe1,
                    'AdrAltJN' => $data['Loeschvormerkung'],
                    'ADRindividualC1' => $data['Suchbegriff2'],
                    'ADRindividualC2' => $data['UVIMailadresse'],
                    'ADRindividualC3' => $data['PDFMailadresse'],
                ]
            );
            $interneAdressnummer = $adresse['InterneAdressnummer'];
            if ($data['Adresstyp'] === "KUN" && $interneAdressnummer !== null) {
                if ($data['Kundengruppe'] === null) {
                    Log::error(' bp_0101_geschaeftspartner Kundengruppe ist leer',
                        ['interneAdressnummer' => $interneAdressnummer]);
                    return null;
                }
                AdresseBranche::updateOrCreate(
                    ['InterneAdressnummer' => $interneAdressnummer],
                    [
                        'KZBranche' => $data['Kundengruppe'],
                        'AbrHauptJN' => 0,
                    ]
                );
            }

        } catch (Throwable $e) {
            Log::error(
                ' Error ' . $e->getMessage(),
                ['Adresse' => $data['DebitorenKreditorennummer']]
            );
            return null;
        }
        return [
            'interneArtikelnummer' => $interneAdressnummer,
            'Adresse' => $data['DebitorenKreditorennummer'],
        ];
    }

    public function splitStreet($receivedStreet): array
    {
        // Strasse + Hausnummer
        // Extract Hausnummer from the end using regex (e.g., "Musterstraße 123a")
        preg_match('/^(.*?)[\s,]+(\d+\w*)$/', $receivedStreet, $matches);

        if ($matches) {
            $street = $matches[1];           // Street name without Hausnummer
            $hausnummer = $matches[2];       // Hausnummer
        } else {
            // No Hausnummer found, use as-is
            $street = $receivedStreet;
            $hausnummer = '';
        }
        return [
            'strasse' => mb_substr($street, 0, 39),
            'strasse2' => mb_substr($street, 39),
            'hausnummer' => $hausnummer,
        ];
    }

    /**
     * BP-01-03 Geschäftspartner (GP-Rolle "Verwalter")
     */
    public function bp_0103_verwalter($data, $interneAdressnummer): ?array
    {
        try {
            $gueltigVon = Carbon::parse($data['GueltigVon'])->format('Ymd');
            $gueltigBis = Carbon::parse($data['GueltigBis'])->format('Ymd');
            if ($data['Anrede'] === null || $data['Anrede'] === "") {
                $data['Anrede'] = 5;
            }

            $ansprechpartner = Ansprechpartner::updateOrCreate(
                ['InterneAdressnummer' => $interneAdressnummer],
                [
                    'InterneAdressnummer' => $interneAdressnummer,
                    'NRTitel' => $data['Titel'],
                    'NRAnrede' => $data['Anrede'],
                    'AnsVorname' => $data['Vorname'],
                    'AnsNachname' => $data['Nachname'],
                    'AnsPrivatStrasse' => $data['Strasse'], // todo 40 CHAR in DB maybe split Hnr
                    'AnsPrivatOrt' => $data['Postleitzahl'] . " " . $data['Ort'],
                    'AnsPrivatTelefon' => $data['Telefon'],
                    'AnsMobiltelefon' => $data['Mobiltelefon'],
                    'AnsFax' => $data['Fax'],
                    'AnsEMail' => $data['EMail'],
                    'AnsIndividualD1' => $gueltigVon,
                    'AnsIndividualD2' => $gueltigBis,
                    'AnsIndividualC1' => $data['Ansprechpartner1'],
                    'AnsIndividualC2' => $data['Ansprechpartner2'],
                ]
            );
            $ansprechpartnerId = $ansprechpartner['AnsprechpartnerID'];
        } catch (Throwable $e) {
            Log::error(
                'bp_0103_verwalter Error ' . $e->getMessage(),
                ['Adresse' => $interneAdressnummer]
            );
            return null;
        }
        return [
            'interneAnsprechpartnerId' => $ansprechpartnerId,
            'Adresse' => $interneAdressnummer
        ];
    }
}
