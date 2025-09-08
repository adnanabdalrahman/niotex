<?php

namespace App\Services\REServices;

use App\Models\Adresse;
use App\Models\Ceos_ABRECHNUNG;
use App\Models\Ceos_ABRECHNUNG_TimeLine;
use App\Models\Ceos_GEBAEUDE;
use App\Models\Ceos_GEBAEUDE_TimeLine;
use App\Models\Ceos_ID_SAP;
use App\Models\Ceos_LIEGENSCHAFT;
use App\Models\Ceos_LIEGENSCHAFT_TimeLine;
use App\Models\Ceos_MIETER;
use App\Models\Ceos_MIETER_TimeLine;
use App\Models\Ceos_VERWALTUNG;
use App\Models\Ceos_VERWALTUNG_TimeLine;
use App\Models\Ceos_WOHNEINHEIT;
use App\Models\Ceos_WOHNEINHEIT_TimeLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
     *  lgnrExt -> Ceos_ID_SAP.VALUE
     *
     *
     */

    /*

     ID              - Type            - Value
     LiegenschaftsID - LG_KORR_Nr      - $mietobjekt['lgnrExt'] Liegenschaft
     Geb - GEB_TPlatz     - $mietobjekt['tplnr'] Ge
   --[WE_TPlatz] NVARCHAR(100),			--> Schnittstelle tplnr									-> extra Tabelle "cis.Ceos_ID_SAP"
    --[WE_HK_KORR_Nr] NVARCHAR(20),			--> Schnittstelle korrnrHk (Korrespondenznummer HK)		-> extra Tabelle "cis.Ceos_ID_SAP"
    --[WE_KW_KORR_Nr] NVARCHAR(20),			--> Schnittstelle korrnrKw (Korrespondenznummer KW)		-> extra Tabelle "cis.Ceos_ID_SAP"
    --[GER_Zählpunktnummer] NVARCHAR(40),	--> Schnittstelle ?Zählpunktnummer?						-> extra Tabelle "cis.Ceos_ID_SAP"
    --evtl weitere(s) Feld(er) auf Geräte-Ebene
    [VALUE] NVARCHAR(100) NOT NULL,		-- Wert des Daten-Feldes
    --[User] INT NOT NULL,
    [TimeStamp] TIMESTAMP,
    CONSTRAINT U_Ceos_ID_SAP UNIQUE([TYPE],[ID])
    );
        */


    public function re_01_01_Liegenschaften($receivedLiegenschaften): ?array
    {
        try {
            //---------------- LIEGENSCHAFT -------------------------------
            foreach ($receivedLiegenschaften as $liegenschaft) {
                $receivedLiegenschaft = $liegenschaft['liegenschaft'];

                $liegenschaft = Ceos_LIEGENSCHAFT::updateOrCreate(
                    [
                        'LG_FOREIGN_ID' => $receivedLiegenschaft['mdmId']
                    ],
                    [
                        'User' => 0,
                    ]
                );

                $fullHash = '9b71d224bd62f3785d96d46ad3ea3d73319bfbc2890caadae2df5a9963a96f8ba17f65d4df9ee06b6fe24b6f5df4cbcd1bbac5c3a0b653f9a4c2fdeebb8f5a2c';
                $abrechnungsdaten = $receivedLiegenschaft['abrechnungsdaten'];
                $kunden = $receivedLiegenschaft['kunden'];
                //todo clarify if update or delete and insert
                Ceos_LIEGENSCHAFT_TimeLine::updateOrCreate(
                    [
                        'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                    ],
                    [
                        'Liegenschaftsnummer' => $receivedLiegenschaft['slgnr'],
                        'Fernablesung_JN' => $receivedLiegenschaft['fern'],
                        'Fernablesung_Ab' => $receivedLiegenschaft['fernAb'],
                        'OnlinePortal_JN' => $receivedLiegenschaft['opk'],
                        'OnlinePortal_Ab' => $receivedLiegenschaft['opkAb'],
                        'UviReady_JN' => $receivedLiegenschaft['uvir'],
                        'UviReady_Ab' => $receivedLiegenschaft['uvirAb'],
                        'Mdf' => $receivedLiegenschaft['mdf'],
                        'Vertreter' => $kunden[0]['vtrCeos'],
                        'Mdf_Bis' => $receivedLiegenschaft['mdfBis'],
                        'DatumVon' => $receivedLiegenschaft['validfrom'],
                        'DatumBis' => $receivedLiegenschaft['validto'],
                        'Heizung_JN' => $abrechnungsdaten[0]['hka'],
                        'Kaltwasser_JN' => $abrechnungsdaten[0]['kwa'],
                        'Betriebskosten_JN' => $abrechnungsdaten[0]['nka'],
                        'Stromkosten_JN' => $abrechnungsdaten[0]['sta'],
                        'User' => 0,
                        //todo should be deleted or nullable
                        'FULL_HASH' => DB::raw("CONVERT(varbinary(64), 0x$fullHash)"),
                    ]
                );


                if ($receivedLiegenschaft['lgnrExt'] != null) {
                    Ceos_ID_SAP::updateOrCreate(
                        [
                            'ID' => $liegenschaft->LiegenschaftsID,
                            'TYPE' => 'LG_KORR_Nr',
                        ],
                        [
                            'VALUE' => $receivedLiegenschaft['lgnrExt'],
                        ]
                    );
                }

                //---------------- Adressen - GEBAEUDE -------------------------------
                $adressen = $receivedLiegenschaft['adressen'];

                foreach ($adressen as $adresse) {
                    $gebaeude = Ceos_GEBAEUDE::updateOrCreate(
                        [
                            'GEB_FOREIGN_ID' => $adresse['mdmId']
                        ],
                        [
                            'User' => 0,
                        ]
                    );
                    // delete all adressen
                    Ceos_GEBAEUDE_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)->delete();
                    Ceos_GEBAEUDE_TimeLine::insertGetId(
                        [
                            'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                            'GebaeudeID' => $gebaeude->GebaeudeID,
                            'DatumVon' => $adresse['validfrom'],
                            'DatumBis' => $adresse['validto'],
                            'GebaeudeNr' => $adresse['genrCeos'],
                            'LG_Strasse' => $adresse['lgStr'],
                            'LG_PLZ' => $adresse['lgPlz'],
                            'LG_Ort' => $adresse['lgOrt'],
                            'Heizanlage_JN' => $adresse['hausHeizanlage'],
                            'User' => 0,
                        ]
                    );

                    if ($adresse['tplnr'] != null) {
                        Ceos_ID_SAP::updateOrCreate(
                            [
                                'ID' => $gebaeude->GebaeudeID,
                                'TYPE' => 'GEB_TPlatz',
                            ],
                            [
                                'VALUE' => $adresse['tplnr'],
                            ]
                        );
                    }
                }


                //---------------- KUNDEN - VERWALTUNG -------------------------------
                // delete all Kunden Timeline
                Ceos_VERWALTUNG_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)->delete();

                foreach ($kunden as $kunde) {
                    $verwaltung = Ceos_VERWALTUNG::updateOrCreate(
                        [
                            'VER_FOREIGN_ID' => $kunde['kunnr']
                        ],
                        [
                            'User' => 0,
                        ]
                    );
                    $adressnummer = ltrim($kunde['kunnr'], '0');
                    $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
                    if ($adresse == null) {
                        Log::error('re_01_01_Liegenschaften Kein Adresse gefunden');
                        return null;
                    }
                    Ceos_VERWALTUNG_TimeLine::insertGetId(
                        [
                            'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                            'VerwaltungID' => $verwaltung->VerwaltungID,
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
                // delete all WOHNEINHEIT
                Ceos_WOHNEINHEIT_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)->delete();
                foreach ($mietobjekte as $mietobjekt) {
                    $wohneinheit = Ceos_WOHNEINHEIT::updateOrCreate(
                        [
                            'WE_FOREIGN_ID' => $mietobjekt['mdmIdMe']
                        ],
                        [
                            'User' => 0,
                        ]
                    );

                    $gebaeude = Ceos_GEBAEUDE_TimeLine::where('GebaeudeNr', $mietobjekt['genrCeos'])
                        ->where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                        ->first();
                    if ($gebaeude === null) {
                        return null;
                    }

                    Ceos_WOHNEINHEIT_TimeLine::insertGetId(
                        [
                            'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                            'WohneinheitID' => $wohneinheit->WohneinheitID,
                            'lfd_Adressnummer_GE_CEOS' => $mietobjekt['genrCeos'],
                            'GebaeudeID' => $gebaeude->GebaeudeID,
                            'WE_LfdNr' => $mietobjekt['menrCeos'],
                            'WE_Bezeichnung' => $mietobjekt['mLage'],
                            'Gewerblich_JN' => $mietobjekt['gewerblichJn'],
                            'DatumVon' => $mietobjekt['validfrom'],
                            'DatumBis' => $mietobjekt['validto'],
                            'User' => 0,
                        ]
                    );
                    if ($mietobjekt['tplnr'] != null) {
                        Ceos_ID_SAP::updateOrCreate(
                            [
                                'ID' => $wohneinheit->WohneinheitID,
                                'TYPE' => 'WE_TPlatz',
                            ],
                            [
                                'VALUE' => $mietobjekt['tplnr'],
                            ]
                        );
                    }


                    if ($mietobjekt['korrnrHk'] != null) {
                        Ceos_ID_SAP::updateOrCreate(
                            [
                                'ID' => $wohneinheit->WohneinheitID,
                                'TYPE' => 'WE_HK_KORR_Nr',
                            ],
                            [
                                'VALUE' => $mietobjekt['korrnrHk'],
                            ]
                        );
                    }
                    if ($mietobjekt['korrnrKw'] != null) {

                        Ceos_ID_SAP::updateOrCreate(
                            [
                                'ID' => $wohneinheit->WohneinheitID,
                                'TYPE' => 'WE_KW_KORR_Nr',
                            ],
                            [
                                'VALUE' => $mietobjekt['korrnrKw'],
                            ]
                        );
                    }
                }
                //---------------- MIETER_ MIETER -------------------------------


                $receivedMieters = $receivedLiegenschaft['mieter'];

                // delete all MIETER
                Ceos_MIETER_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)->delete();
                foreach ($receivedMieters as $receivedMieter) {
                    $mieter = Ceos_MIETER::updateOrCreate(
                        [
                            'MI_FOREIGN_ID' => $receivedLiegenschaft['mdmId'] .
                                $receivedMieter['genrCeos'] .
                                $receivedMieter['menrCeos']
                        ],
                        [
                            'User' => 0,
                        ]
                    );

                    $gebaeude = Ceos_GEBAEUDE_TimeLine::where('GebaeudeNr', $receivedMieter['genrCeos'])
                        ->where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                        ->first();

                    $wohneinheit = Ceos_WOHNEINHEIT_TimeLine::where('WE_LfdNr', $receivedMieter['menrCeos'])
                        ->where('GebaeudeID', $gebaeude->GebaeudeID)
                        ->where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                        ->first();
                    Ceos_MIETER_TimeLine::insertGetId(
                        [
                            'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                            'WohneinheitID' => $wohneinheit->WohneinheitID,
                            'MieterID' => $mieter->MieterID,
                            'lfd_Adressnummer_GE_CEOS' => $receivedMieter['genrCeos'],
                            'lfd_Adressnummer_ME_CEOS' => $receivedMieter['menrCeos'],
                            'Mietvertragsnummer' => $receivedMieter['recnnr'],
                            'M_Name1' => $receivedMieter['mName'],
                            'M_Anrede' => $receivedMieter['mAnrede'],
                            'DatumVon' => $receivedMieter['datumEinzug'],
                            'DatumBis' => $receivedMieter['datumAuszug'],
                            'User' => 0,
                        ]
                    );
                }

                //---------------- ABRECHNUNGSDATEN  -------------------------------
                // delete all ABRECHNUNGEN
                Ceos_ABRECHNUNG_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)->delete();
                foreach ($abrechnungsdaten as $receivedAbrechnung) {
                    $abrechnung = Ceos_ABRECHNUNG::updateOrCreate(
                        [
                            'ABR_FOREIGN_ID' => $liegenschaft->LiegenschaftsID
                        ],
                        [
                            'User' => 0,
                        ]
                    );


                    Ceos_ABRECHNUNG_TimeLine::insertGetId(
                        [
                            'AbrechnungID' => $abrechnung->AbrechnungID,
                            'LiegenschaftsID' => $liegenschaft->LiegenschaftsID,
                            'DatumVon' => $receivedAbrechnung['datab'],
                            'DatumBis' => $receivedAbrechnung['datbi'],
                            'Stichtag_HKA' => $this->formatTo1900Date($receivedAbrechnung['sttHka']),
                            'Stichtag_KWA' => $this->formatTo1900Date($receivedAbrechnung['sttKwa']),
                            'Stichtag_NKA' => $this->formatTo1900Date($receivedAbrechnung['sttNka']),
                            'Stichtag_STA' => $this->formatTo1900Date($receivedAbrechnung['sttNka']),
                            'Heizkostenabrechnung' => $receivedAbrechnung['hka'],
                            'Kaltwasserabrechnung' => $receivedAbrechnung['kwa'],
                            'Nebenkostenabrechnung' => $receivedAbrechnung['nka'],
                            'Stromabrechnung' => $receivedAbrechnung['sta'],
                            'Ablesung' => $receivedAbrechnung['abl'],
                            'Selbstableser' => $receivedAbrechnung['selbstableserJn'],
                            'DTA' => $receivedAbrechnung['dta'],
                            'BKB' => $receivedAbrechnung['bkb'],
                            'ServiceRWM' => $receivedAbrechnung['rwm'],
                            'AbrechnungProHaus' => $receivedAbrechnung['hwabr'],
                            'Warmwasser' => $receivedAbrechnung['ww'],
                            'User' => 0,
                        ]
                    );

                }
            }
        } catch (Throwable $e) {


            //todo delete all if Error happens


            Log::error($e);
            return null;
        }
        return ['message' => true];
    }

    function formatTo1900Date($md): ?string
    {
        if ($md === null || $md === '') {
            return null;
        }
        if (!preg_match('/^\d{4}$/', $md)) {
            return null;
        }
        $month = substr($md, 0, 2);
        $day = substr($md, 2, 2);
        $date = "1900-$month-$day";

        try {
            return Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
        } catch (Throwable $e) {
            Log::error('invalid month/day :' . $e->getMessage());
            return null;
        }
    }
}
