<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Throwable;


class BPServices
{
    protected string $baseUrl;
    /*
            Geschaeftspartnernummer INT     => INT          AdrFibunummer
            Debitoren_Kreditorennummer      => INT          AdressNummer
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
            Kundengruppe                    => Varchar(2)    ?????????????
            Kundengruppe12                  => Varchar(3)    ?????????????
            UVI_Mailadresse                 => Varchar(80)
            PDF_Mailadresse                 => Varchar(80)
        */

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

        try {
            DB::transaction(function () use ($data) {
                //todo
                //Vorname + Nachname
                $AdrFirmenbezeichnung1 = $data['Vorname'] . " " . $data['Nachname'];

                $streetArray = $this->splitStreet($data['Strasse']);
                //todo
                if ($data['LVorm'] == 1) {
                    //todo delete (as ALT)
                }

                //todo LAND CODE

                //todo
                //        'InternAdressnummer'      =>  $data['Kundengruppe'],    /// N:N
                //                                  =>  $data['Kundengruppe12'],    /// N:N


                // Insert into users table
                return DB::connection('sqlsrv2')->table('cis.Adresse')->updateOrInsert([
                    'KZAdresstyp' => "KUN", // ???????
                    'KZWaehrung' => "EUR", // ???????
                    'MwstTypID' => 3, // ???????
                    'AdrKarenztage' => 0, // ???????
                    'KZSprache' => "DE", // ???????
                    'AdrFactoringJN' => 0, // ???????
                    'AdrMahnSperreJN' => 0, // ???????
                    'AdrFibunummer' => $data['Geschaeftspartnernummer'],
                    'AdressNummer' => $data['Debitoren_Kreditorennummer'],
                    'NRAnrede' => $data['Anrede'],
                    'NRTitel' => $data['Titel'],
                    'AdrFirmenbezeichnung1' => $AdrFirmenbezeichnung1,
                    'AdrFirmenbezeichnung2' => $data['Name1'],
                    'AdrFirmenbezeichnung3' => $data['Name2'],
                    'AdrFirmenbezeichnung4' => $data['Name3'],
                    'AdrMatchcode' => $data['Suchbegriff1'],
                    //'AdrMatchcode'                =>  $data['Suchbegriff2'], //?? es gibt nur 1 Matchcode-Feld
                    'AdrStrasse' => $streetArray['strasse'],
                    'AdrStrasse2' => $streetArray['strasse2'],
                    'AdrStrasse3' => $streetArray['hausnummer'],
                    'AdrPLZ' => $data['Postleitzahl'],
                    'AdrOrt' => $data['Ort'],
                    'KZLand' => $data['Land'],
                    'AdrPostfach' => $data['Postfach'],
                    'AdrPLZPostfach' => $data['Postleitzahl_Postfach'],
                    'AdrOrtPostfach' => $data['Ort_Postfach'],
                    'AdrTelefon' => $data['Telefon'],
                    'AdrMobiltelefon' => $data['Mobiltelefon'],
                    'AdrFax' => $data['Fax'],
                    'AdrEmail' => $data['Email'],
                    'AdrGutschriftsverfahrenJN' => $data['AutoWEAbr'],
                    'AdrLiefersperreJN' => $data['Sperrkennzeichen'],
                    //'InternAdressnummer'          =>  $data['Kundengruppe'],    /// N:N
                    // ''                           =>  $data['Kundengruppe12'],    /// N:N
                    'ADRindividualC2' => $data['UVI_Mailadresse'],
                    'ADRindividualC3' => $data['PDF_Mailadresse'],
                ]);
            });
        } catch (Throwable $e) {
            return $e->getMessage();
        }
        return $data;
    }

    public function splitStreet($recievedStreet): array
    {
        // Strasse + Hausnummer
        // Extract Hausnummer from the end using regex (e.g., "Musterstraße 123a")
        preg_match('/^(.*?)[\s,]+(\d+\w*)$/', $recievedStreet, $matches);

        if ($matches) {
            $street = $matches[1];           // Street name without Hausnummer
            $hausnummer = $matches[2];       // Hausnummer
        } else {
            // No Hausnummer found, use as-is
            $street = $recievedStreet;
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
    public function bp_0103_verwalter($data)
    {
        // check if Adresse exist in CEOS
        // check Lov => 1/0

        // if not exist, create new Material

        try {
            DB::transaction(function () use ($data) {
                //Vorname + Nachname
                $AdrFirmenbezeichnung1 = $data['Vorname'] . " " . $data['Nachname'];

                $streetArray = $this->splitStreet($data['Strasse']);

                // LAND CODE


                //        'InternAdressnummer'      =>  $data['Kundengruppe'],    /// N:N
                //                                  =>  $data['Kundengruppe12'],    /// N:N


                // Insert into users table
                return DB::connection('sqlsrv2')->table('cis.Adresse')->updateOrInsert([
                    'KZAdresstyp' => "KUN", // ???????
                    'KZWaehrung' => "EUR", // ???????
                    'MwstTypID' => 3, // ???????
                    'AdrKarenztage' => 0, // ???????
                    'KZSprache' => "DE", // ???????
                    'AdrFactoringJN' => 0, // ???????
                    'AdrMahnSperreJN' => 0, // ???????
                    'AdrFibunummer' => $data['Geschaeftspartnernummer'],
                    'AdressNummer' => $data['Debitoren_Kreditorennummer'],
                    'NRAnrede' => $data['Anrede'],
                    'NRTitel' => $data['Titel'],
                    'AdrFirmenbezeichnung1' => $AdrFirmenbezeichnung1,
                    'AdrFirmenbezeichnung2' => $data['Name1'],
                    'AdrFirmenbezeichnung3' => $data['Name2'],
                    'AdrFirmenbezeichnung4' => $data['Name3'],
                    'AdrMatchcode' => $data['Suchbegriff1'],
                    //'AdrMatchcode'                =>  $data['Suchbegriff2'], //?? es gibt nur 1 Matchcode-Feld
                    'AdrStrasse' => $streetArray['strasse'],
                    'AdrStrasse2' => $streetArray['strasse2'],
                    'AdrStrasse3' => $streetArray['hausnummer'],
                    'AdrPLZ' => $data['Postleitzahl'],
                    'AdrOrt' => $data['Ort'],
                    'KZLand' => $data['Land'],
                    'AdrPostfach' => $data['Postfach'],
                    'AdrPLZPostfach' => $data['Postleitzahl_Postfach'],
                    'AdrOrtPostfach' => $data['Ort_Postfach'],
                    'AdrTelefon' => $data['Telefon'],
                    'AdrMobiltelefon' => $data['Mobiltelefon'],
                    'AdrFax' => $data['Fax'],
                    'AdrEmail' => $data['Email'],
                    'AdrGutschriftsverfahrenJN' => $data['AutoWEAbr'],
                    'AdrLiefersperreJN' => $data['Sperrkennzeichen'],
                    //'InternAdressnummer'            =>  $data['Kundengruppe'],    /// N:N
                    // ''                              =>  $data['Kundengruppe12'],    /// N:N
                    'ADRindividualC2' => $data['UVI_Mailadresse'],
                    'ADRindividualC3' => $data['PDF_Mailadresse'],
                ]);
            });
        } catch (Throwable $e) {
            return $e->getMessage();
        }
        return $data;
    }
}
