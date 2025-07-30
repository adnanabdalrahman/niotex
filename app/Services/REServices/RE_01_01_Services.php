<?php

namespace App\Services\REServices;

use App\Models\Adresse;
use App\Models\Ceos_GEBAEUDE;
use App\Models\Ceos_GEBAEUDE_TimeLine;
use App\Models\Ceos_LIEGENSCHAFT;
use App\Models\Ceos_LIEGENSCHAFT_TimeLine;
use App\Models\Ceos_MIETER;
use App\Models\Ceos_VERWALTUNG;
use App\Models\Ceos_VERWALTUNG_TimeLine;
use App\Models\Ceos_WOHNEINHEIT;
use App\Models\Ceos_WOHNEINHEIT_TimeLine;
use Illuminate\Support\Facades\Log;
use Throwable;

class RE_01_01_Services
{

    /**
     * RE-01-01 Liegenschaften
     *  --- Ceos_LIEGENSCHAFT ----
     *  mdmId -> Ceos_LIEGENSCHAFT.LG_FOREIGN_ID
     *
     * --- Ceos_LIEGENSCHAFT_TimeLine ----
     * slgnr -> Ceos_LIEGENSCHAFT_TimeLine.Liegenschaftsnummer
     * fern -> Ceos_LIEGENSCHAFT_TimeLine.Fernablesung_JN
     * fernAb -> Ceos_LIEGENSCHAFT_TimeLine.Fernablesung_Ab
     * opk -> Ceos_LIEGENSCHAFT_TimeLine.OnlinePortal_JN
     * opkAb -> Ceos_LIEGENSCHAFT_TimeLine.OnlinePortal_Ab
     * uvir -> Ceos_LIEGENSCHAFT_TimeLine.UviReady_JN
     * uvirab -> Ceos_LIEGENSCHAFT_TimeLine.UviReady_Ab
     * mdf -> Ceos_LIEGENSCHAFT_TimeLine.Mdf
     * mdfBis -> Ceos_LIEGENSCHAFT_TimeLine.Mdf_Bis
     * validfrom -> Ceos_LIEGENSCHAFT_TimeLine.DatumVon
     * validto -> Ceos_LIEGENSCHAFT_TimeLine.DatumBis
     *
     *
     * ---- ADRESSEN - GEBAEUDE_TIMELINE-----
     * validfrom -> Ceos_GEBAEUDE_TimeLine.DatumVon
     * validto -> Ceos_GEBAEUDE_TimeLine.DatumBis
     * genrCeos -> Ceos_GEBAEUDE_TimeLine.GebaeudeNr
     * lgStr -> Ceos_GEBAEUDE_TimeLine.LG_Strasse
     * lgPlz -> Ceos_GEBAEUDE_TimeLine.LG_PLZ
     * lgOrt -> Ceos_GEBAEUDE_TimeLine.LG_Ort
     * hausHeizanlage -> Ceos_GEBAEUDE_TimeLine.Heizanlage_JN
     *
     * ---- GEBAEUDE ----
     * ADRESSEN.mdmId -> Ceos_GEBAEUDE.GEB_FOREIGN_ID
     *
     *
     *
     * ---- KUNDE - VERWALTUNG ----
     * validfrom -> Ceos_VERWALTUNG_TimeLine.DatumVon
     * validto -> Ceos_VERWALTUNG_TimeLine.DatumBis
     * kunnr -> Ceos_VERWALTUNG_TimeLine.Auftraggeber
     * kdart -> Ceos_VERWALTUNG_TimeLine.Kundenart
     * abrfirst -> Ceos_VERWALTUNG_TimeLine.ErsteAbr
     * abrlast -> Ceos_VERWALTUNG_TimeLine.LetzteAbr
     *
     * --- MIETOBJEKTE - WOHNEINHEIT ---
     * genrCeos -> FK:Ceos_WOHNEINHEIT_TimeLine.[lfd. Adressnummer GE CEOS] (Ceos_GEBAEUDE_TimeLine.GebaeudeNr)
     * menrCeos -> Ceos_WOHNEINHEIT_TimeLine.WE_LfdNr
     * mLage -> Ceos_WOHNEINHEIT_TimeLine.WE_Bezeichnung
     * mdmIdMe -> Ceos_WOHNEINHEIT.WE_FOREIGN_ID
     * gewerblichJn -> Ceos_WOHNEINHEIT_TimeLine.Gewerblich_JN
     * validfrom -> Ceos_WOHNEINHEIT_TimeLine.DatumVon
     * validto -> Ceos_WOHNEINHEIT_TimeLine.DatumBis
     *
     *
     * --- MIETER ---
     * genrCeos -> FK:Ceos_MIETER_TimeLine.GebaeudeNr FK:(Ceos_GEBAEUDE_TimeLine. GebaeudeID)
     * menrCeos -> FK:Ceos_MIETER_TimeLine.[lfd. Adressnummer ME CEOS] (Ceos_GEBAEUDEWOHNEINHEIT_TimeLine.WE_LfdNr)
     * recnnr -> Ceos_MIETER_TimeLine.Mietvertragsnummer
     * mName -> Ceos_MIETER_TimeLine.M_Name1
     * mAnrede -> Ceos_MIETER_TimeLine.M_Anrede
     * datumEinzug -> Ceos_MIETER_TimeLine.DatumVon
     * datumAuszug -> Ceos_MIETER_TimeLine.DatumBis
     *
     * --- ABRECHNUNGSDATEN - ABRECHNUNG ---
     * datab -> Ceos_ABRECHNUNG_TimeLine.DatumVon
     * datbi -> Ceos_ABRECHNUNG_TimeLine.DatumBis
     * sttHka -> Ceos_ABRECHNUNG_TimeLine.[Stichtag HKA]
     * sttKwa -> Ceos_ABRECHNUNG_TimeLine.[Stichtag KWA]
     * sttNka -> Ceos_ABRECHNUNG_TimeLine.[Stichtag NKA]
     * sttSta -> Ceos_ABRECHNUNG_TimeLine.[Stichtag STA]
     * hka -> Ceos_ABRECHNUNG_TimeLine.Heizkostenabrechnung
     * kwa -> Ceos_ABRECHNUNG_TimeLine.Kaltwasserabrechnung
     * nka -> Ceos_ABRECHNUNG_TimeLine.Nebenkostenabrechnung
     * sta -> Ceos_ABRECHNUNG_TimeLine.Stromabrechnung
     * abl -> Ceos_ABRECHNUNG_TimeLine.Ablesung
     * selbstableserJn -> Ceos_ABRECHNUNG_TimeLine.Selbstableser
     * dta -> Ceos_ABRECHNUNG_TimeLine.DTA
     * bkb -> Ceos_ABRECHNUNG_TimeLine.BKB
     * rwm -> Ceos_ABRECHNUNG_TimeLine.ServiceRWM
     * hwabr -> Ceos_ABRECHNUNG_TimeLine.[Abrechnung/Haus]
     * ww -> Ceos_ABRECHNUNG_TimeLine.Warmwasser
     *
     *
     *  ---- Ceos_ID_SAP -----
     *  korrnrHk -> Ceos_ID_SAP.VALUE
     *  korrnrKw -> Ceos_ID_SAP.VALUE
     *  tplnr -> Ceos_ID_SAP.VALUE
     *  tplnr -> Ceos_ID_SAP.VALUE
     *  lgnrExt -> Ceos_ID_SAP.VALUE
     *
     *
     */

    public function re_01_01_Liegenschaften($request): ?array
    {
        //todo delete all if Error happens
        try {

            //---------------- LIEGENSCHAFT -------------------------------

            $receivedLiegenschaft = $request['liegenschaft'];
            $liegenschaft = Ceos_LIEGENSCHAFT::updateOrCreate(
                [
                    'LG_FOREIGN_ID' => $receivedLiegenschaft['mdmId']
                ],
                [
                    'User' => 0,
                ]
            );
            // Ceos_LIEGENSCHAFT_TimeLine
            //todo check default values
            $fullHash = '9b71d224bd62f3785d96d46ad3ea3d73319bfbc2890caadae2df5a9963a96f8ba17f65d4df9ee06b6fe24b6f5df4cbcd1bbac5c3a0b653f9a4c2fdeebb8f5a2c';

            // update datumBis (DatumVon) for the last LiegenschaftTimeline if Exist
            $lastLiegenschaftTimeLine = Ceos_LIEGENSCHAFT_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                ->orderBy('ID', 'desc')
                ->first();
            $lastLiegenschaftTimeLine->DatumBis = $receivedLiegenschaft['validfrom'];
            $lastLiegenschaftTimeLine->save();

            $liegenschaftTimeLine = Ceos_LIEGENSCHAFT_TimeLine::insertGetId(
                [
                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    'Liegenschaftsnummer' => $receivedLiegenschaft['slgnr'],
                    'Fernablesung_JN' => $receivedLiegenschaft['fern'],
                    'Fernablesung_Ab' => $receivedLiegenschaft['fernAb'],
                    'OnlinePortal_JN' => $receivedLiegenschaft['opk'],
                    'OnlinePortal_Ab' => $receivedLiegenschaft['opkAb'],
                    'UviReady_JN' => $receivedLiegenschaft['uvir'],
                    'UviReady_Ab' => $receivedLiegenschaft['uvirAb'],
                    'Mdf' => $receivedLiegenschaft['mdf'],
                    'Mdf_Bis' => $receivedLiegenschaft['mdfBis'],
                    'DatumVon' => $receivedLiegenschaft['validfrom'],
                    'DatumBis' => $receivedLiegenschaft['validto'],
                    'User' => 0,
                    'FULL_HASH' => \DB::raw("CONVERT(varbinary(64), 0x{$fullHash})"),
                ]
            );

            //---------------- Adressen - GEBAEUDE -------------------------------
            $adressen = $receivedLiegenschaft['adressen'];
            foreach ($adressen as $adress) {
                $gebaeude = Ceos_GEBAEUDE::updateOrCreate(
                    [
                        'GEB_FOREIGN_ID' => $adress['mdmId']
                    ],
                    [
                        'User' => 0,
                    ]
                );

                // update datumBis (DatumVon) for the last record
                $lastGebaeudeTimeLine = Ceos_GEBAEUDE_TimeLine::
                where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                    ->where('GebaeudeID', $gebaeude->GebaeudeID)
                    ->orderBy('ID', 'desc')
                    ->first();
                $lastGebaeudeTimeLine->DatumBis = $adress['validfrom'];
                $lastGebaeudeTimeLine->save();

                $gebaeudeTimeLineID = Ceos_GEBAEUDE_TimeLine::insertGetId(
                    [
                        'GebaeudeID' => $gebaeude->GebaeudeID,
                        'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                        'DatumVon' => $adress['validfrom'],
                        'DatumBis' => $adress['validto'],
                        'GebaeudeNr' => $adress['genrCeos'],
                        'LG_Strasse' => $adress['lgStr'],
                        'LG_PLZ' => $adress['lgPlz'],
                        'LG_Ort' => $adress['lgOrt'],
                        'Heizanlage_JN' => $adress['hausHeizanlage'],
                        'User' => 0,
                    ]
                );
            }

            //---------------- KUNDEN - VERWALTUNG -------------------------------
            $kunden = $receivedLiegenschaft['kunden'];
            foreach ($kunden as $kunde) {
                $verwaltung = Ceos_VERWALTUNG::updateOrCreate(
                    [
                        'VER_FOREIGN_ID' => $kunde['kunnr']
                    ],
                    [
                        'User' => 0,
                    ]
                );

                // update datumBis (DatumVon) for the last record
                $lastVerwaltungTimeLine = Ceos_GEBAEUDE_TimeLine::
                where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                    ->where('VerwaltungID', $verwaltung->VerwaltungID)
                    ->orderBy('ID', 'desc')
                    ->first();
                $lastVerwaltungTimeLine->DatumBis = $kunde['validfrom'];
                $lastVerwaltungTimeLine->save();

                $adressnummer = ltrim($kunde['kunnr'], '0');
                $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
                if ($adresse == null) {
                    Log::error('re_01_01_Liegenschaften Kein Adresse gefunden');
                    return null;
                }

                $verwaltungTimeline = Ceos_VERWALTUNG_TimeLine::insertGetId(
                    [
                        'VerwaltungID' => $verwaltung->VerwaltungID,
                        'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                        'DatumVon' => $kunde['validfrom'],
                        'DatumBis' => $kunde['validto'],
                        'AuftraggeberID' => $adresse->InterneAdressnummer,
                        'Kundenart' => $kunde['kdart'],
                        'ErsteAbr' => $kunde['abrfirst'],
                        'LetzteAbr' => $kunde['abrlast'],
                        'User' => 0,
                    ]
                );
            }


            //---------------- MIETOBJEKTE - WOHNEINHEIT -------------------------------
            $mietobjekte = $receivedLiegenschaft['mietobjekte'];
            foreach ($mietobjekte as $mietobjekt) {
                $mietobjekt = Ceos_WOHNEINHEIT::updateOrCreate(
                    [
                        'WE_FOREIGN_ID' => $mietobjekt['mdmIdMe']
                    ],
                    [
                        'User' => 0,
                    ]
                );

                if ($mietobjekt == null) {
                    Log::error('re_01_01_Liegenschaften $mietobjekt creation Failed ');
                    return null;
                }
                Ceos_WOHNEINHEIT_TimeLine::updateOrCreate(
                    [
                        'VerwaltungID' => $mietobjekt->WohneinheitID,
                        'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    ],
                    [

                        /*
                        Ceos_GEBAEUDE_TimeLine::updateOrCreate(
                                [
                                    'GebaeudeID' => $gebaeude->GebaeudeID,
                                    'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                                ],
                                [
                                    'DatumVon' => $adress['validfrom'],
                                    'DatumBis' => $adress['validto'],
                                    'GebaeudeNr' => $adress['genrCeos'],
                                    'LG_Strasse' => $adress['lgStr'],
                                    'LG_PLZ' => $adress['lgPlz'],
                                    'LG_Ort' => $adress['lgOrt'],
                                    'Heizanlage_JN' => $adress['hausHeizanlage'],
                                    'User' => 0,
                                ]
                            );
                        */
                        'GebaeudeNr' => $mietobjekt['validfrom'], //todo clarify from Benjamin


                        'WE_LfdNr' => $mietobjekt['menrCeos'],
                        'WE_Bezeichnung' => $mietobjekt['mLage'],
                        'Gewerblich_JN' => $mietobjekt['gewerblichJn'],
                        'DatumVon' => $mietobjekt['validfrom'],
                        'DatumBis' => $mietobjekt['validto'],
                        'User' => 0,
                    ]
                );
            }


            //---------------- MIETER_ - MIETER_ -------------------------------
            // continue from hier
            $receivedMieters = $receivedLiegenschaft['mieter'];
            foreach ($receivedMieters as $receivedMieter) {
                $mieter = Ceos_MIETER::updateOrCreate(
                    [
                        'MI_FOREIGN_ID' => $receivedMieter[''] // todo need unique value
                    ],
                    [
                        'User' => 0,
                    ]
                );

                if ($mieter == null) {
                    Log::error('re_01_01_Liegenschaften Mieter creation Failed ');
                    return null;
                }


                /*
                    * genrCeos -> FK:Ceos_MIETER_TimeLine.[lfd. Adressnummer GE CEOS] (Ceos_GEBAEUDE_TimeLine.GebaeudeNr)
                    * menrCeos -> FK:Ceos_MIETER_TimeLine.[lfd. Adressnummer ME CEOS] (Ceos_GEBAEUDEWOHNEINHEIT_TimeLine.WE_LfdNr)
                    * recnnr -> Ceos_MIETER_TimeLine.Mietvertragsnummer
                    * mName -> Ceos_MIETER_TimeLine.M_Name1
                    * mAnrede -> Ceos_MIETER_TimeLine.M_Anrede
                    * datumEinzug -> Ceos_MIETER_TimeLine.DatumVon
                    * datumAuszug -> Ceos_MIETER_TimeLine.DatumBis
                **/

                Ceos_WOHNEINHEIT_TimeLine::updateOrCreate(
                    [
                        'MieterID' => $mieter->MieterID,
                        'WohneinheitID' => $liegenschaft->LiegenschaftsID,
                    ],
                    [
                        /* genrCeos -> FK:Ceos_WOHNEINHEIT_TimeLine.[lfd. Adressnummer GE CEOS] (Ceos_GEBAEUDE_TimeLine.GebaeudeNr)*/
                        'GebaeudeNr' => $mietobjekt['validfrom'], //todo clarify from Benjamin

                        'WE_LfdNr' => $mietobjekt['menrCeos'],
                        'WE_Bezeichnung' => $mietobjekt['mLage'],
                        'Gewerblich_JN' => $mietobjekt['gewerblichJn'],
                        'DatumVon' => $mietobjekt['validfrom'],
                        'DatumBis' => $mietobjekt['validto'],
                        'User' => 0,
                    ]
                );
            }


            return ['message' => true];

        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }
        return $result;
    }
}
