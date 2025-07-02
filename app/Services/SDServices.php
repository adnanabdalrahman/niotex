<?php

namespace App\Services;

use App\Exceptions\AdresseGesperrtException;
use App\Exceptions\AdresseNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position1Wert;
use App\Models\Position3Menge;
use App\Models\PositionWert;
use App\Models\Vorgang;
use App\Models\Vorgang1Wert;
use App\Models\VorgangWert;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;


class SDServices
{
    protected string $baseUrl;
    protected string $sd0102_path;
    protected string $sd0301_path;


    protected array $auth;

    protected array $mwstSatzProzentArray;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->auth = [
            'client_id' => config('sap.client_id'),
            'client_secret' => config('sap.client_secret'),
        ];
        $this->sd0102_path = config('sap.sd0102_path');
        $this->sd0301_path = config('sap.sd0301_path');

        $this->mwstSatzProzentArray = [
            7 => 2,
            19 => 3,
            0 => 4,
        ];
    }

    /**
     * SAP -> CEOS
     * SD-01-01 Beauftragung
     * @throws Throwable
     */
    public function sd_0101_beauftragung_vorgang($requestData): ?array
    {
        // todo Important Adresse.Sperrkennzeichen ist 1 (gesperrt) darf keinen Auftrag anlegen.
        /*
            'vbeln' → Verkaufsbeleg Vorgang.VorIndividualC1
            'auart' → Vorgang.VorIndividualC2
            'kunnr' → Adresse.AdressNummer → Adresse.InterneAdressnummer(zu speichernde nummer in: Vorgang.VorAuftraggeber)
            'vdatu' → Vorgang.VorLieferung-WunschDatum Wunschlieferdatum
            'zzlgsnr' → Vorgang.VorIndividualC3 Liegenschaftsnummer
            'genrCeos' → Vorgang.VorIndividualD4
            'txtZ012' → Vorgang2Text.VorNotiz Bemerkung zur Liegenschaft
            'txtZ013' → Vorgang.VorStichwort für Reparaturaufträge Ausstattung / Austauschgrund
        */
        return DB::transaction(function () use (&$requestData) {
            $adresse = Adresse::where('AdressNummer', $requestData['kunnr'])->first();
            if ($adresse !== null) {
                if ($adresse->AdrLiefersperreJN == "1") {
                    throw new AdresseGesperrtException($adresse->AdressNummer);
                }

                $data['VorAuftraggeber'] = $adresse->InterneAdressnummer; // Kunnr
                $data['VorLieferanschrift'] = $adresse->InterneAdressnummer;
                $data['VorRechnungsanschrift'] = $adresse->InterneAdressnummer;
                $data['VorSammelRechnungsanschrift'] = $adresse->InterneAdressnummer;
            } else {
                throw new AdresseNotFoundException($requestData['vbeln'], $requestData['kunnr']);
            }

            //vdatu
            $data['VorLieferungWunschDatum'] = Carbon::parse($requestData['vdatu'])->format('Ymd');
            $data['VorStichwort'] = $requestData['txtZ013'] ?? 'MONTAGEAUFTRAG';
            $data['VorIndividualC1'] = $requestData['vbeln'];
            $data['VorIndividualC2'] = $requestData['auart'];
            $data['VorIndividualC3'] = $requestData['zzlgsnr'];
            $data['VorIndividualD4'] = $requestData['genrCeos'];// GebäudeNr

            $data['VorNotiz'] = $requestData['txtZ012'];
            $data['VorArt'] = 'A';
            $data['VorUnterArt'] = 'R';  // char 1
            $data['VorGruppe'] = 'RE'; //  -- Montage/Liefer/Rechnung: 'RE' / Vertr ge: 'WIE' ? / Rahmenauftr ge: 'AB'
            $data['VNkArt'] = '100000';
            $data['VorStatus'] = '100100'; //-- 100000 Nicht gedruckt / 100010 Angebot / 100100 Auftragsbestätigung

            $vorgang = new VorgangService();
            $vorgang = $vorgang->createVorgang($data);
            if ($vorgang !== null) {
                return [
                    'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                    'VorNummer' => $vorgang['VorNummer'],
                    'VorGruppe' => $vorgang['VorGruppe'],
                    'Verkaufsbeleg' => $requestData['vbeln'],
                ];
            }
            Log::error('sd_0101_beauftragung_vorgang creation Failed');
            return null;
        });

    }

    public function sd_0101_beauftragung_positions($positions, $vorgangDataArray): ?array
    {
        //todo important delete all position if one fails also vorgang
        /*
        matnr  Materialnummer => Position.InterneArtikelnummer   (FK):Artikel.Artikelnummer→Artikel.InterneArtikelnummer
        kondm  Materialgruppe => Position5Individual.PosIndividualC3  (FK):Position5Individual.InterneVorgangsnumer&InternePositionsnummer]→Position.InterneVorgangsnumer&InternePositionsnummer
        posnr  Verkaufsbelegposition => Position5Individual.PosIndividualD1
        kwmeng Menge/Positionsmenge erledigt => Position3Menge.PosMenge1  (FK):Position3Menge.InterneVorgangsnumer&InternePositionsnummer]→Position.InterneVorgangsnumer&InternePositionsnummer
        vrkme Mengeneinheit => Position3Menge.PosKZMengeneinheit1  FK):Mengeneinheit.KZMengeneinheit
        posErl Position erledigt => 1 = erledigt 2  = // todo Clarify now ignore
        txtZ002 Bemerkung NU / Monteur => Position2Text.PosZusatztextLieferschein    (FK): Position2Text.InterneVorgangsnumer&InternePositionsnummer→Position.InterneVorgangsnumer&InternePositionsnummer
        txtZ009 Info zur Montage SAP => Position2Text.PosZusatztext  (FK):Position2Text.InterneVorgangsnumer&InternePositionsnummer]→Position.InterneVorgangsnumer&InternePositionsnummer
        txtZ010 Info zur Montage CEOS => Position2Text.PosNotiz   (FK):Position2Text.InterneVorgangsnumer&InternePositionsnummer→Position.InterneVorgangsnumer&InternePositionsnummer

        kwmengO Menge offen => //todo clarify later with Johannes ignore
        aufnr Kontierungsobjekt =>  Ignorieren
        vorgn Vorgangsnummer CEOS => Vorgang.VorNummer (FK):Position.InterneVorgangsnummer→Vorgang.InterneVorgangsnummer // todo clarify in header
        VBELN => From Header
        VORGNINT => InterneVorgangsnummer
         */

        $data['InterneVorgangsnummer'] = $vorgangDataArray['InterneVorgangsnummer'];
        $data['VorNummer'] = $vorgangDataArray['VorNummer'];
        $data['VorGruppe'] = $vorgangDataArray['VorGruppe'];
        $data['Verkaufsbeleg'] = $vorgangDataArray['Verkaufsbeleg'];

        $positionsArray = [];
        foreach ($positions as $key => $position) {
            $data['Artikelnummer'] = ltrim($position['matnr'], '0');
            $data['key'] = $key;
            $data['PosIndividualC3'] = $position['kondm'];
            $data['PosIndividualD1'] = $position['posnr'];
            $data['PosZusatztextLieferschein'] = $position['txtZ002'];
            $data['PosZusatztext'] = $position['txtZ009'];
            $data['PosNotiz'] = $position['txtZ010'];

            $data['PosMenge1'] = $position['kwmeng'];
            $data['PosKZMengeneinheit1'] = $position['vrkme'];

            $data['PosWMengeGesamt1'] = $position['kwmeng'];
            $data['PosWMengeAuftrag1'] = $position['kwmeng'];
            $data['PosWMengeAbrechnung1'] = $position['kwmeng'];
            $data['PosWMengeLieferung1'] = $position['kwmeng'];
            $data['PosWMengeVersand1'] = $position['kwmeng'];
            $data['PosWMengeGut1'] = $position['kwmeng'];
            $data['PosWMengeRechnung1'] = $position['kwmeng'];

            $data['current_date'] = date('Ymd');
            $carbonMontagedatum = Carbon::parse((string)$position['montagedatum']);
            $montagedatum = $carbonMontagedatum->format('Ymd');
            $data['PosIndividualT3'] = $montagedatum;

            $positions = new PositionService();
            $positionsArray[] = $positions->createPosition($data);
        }
        if (!empty($positionsArray)) {
            return $positionsArray;
        }
        Log::error('sd_0101_beauftragung_positions Positions Creation Failed');
        return null;
    }


    /**
     * SD-01-02: CEOS-->SAP, beauftragung Rückmeldung
     */
    public function sd_0102_beauftragung_rueckmeldung($request)
    {
        try {
            $data = [];
            $vorgang = Vorgang::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();
            if ($vorgang === null) {
                Log::error(
                    "sd_0102_beauftragung_rueckmeldung Kein Vorgang gefunden",
                    ['Vorgangnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
            if ($adresse === null) {
                Log::error(
                    "Kein Adresse für Vorgang gefunden",
                    ['Vorgangnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $data['Kunnr'] = $adresse->AdressNummer;

            $data['Vbeln'] = (string)$vorgang->VorIndividualC1;
            $data['Auart'] = (string)$vorgang->VorIndividualC2;
            $data['Vdatu'] = Carbon::parse($vorgang->VorLieferungWunschDatum)->format('Y-m-d');
            $data['Zzlgsnr'] = (string)$vorgang->VorIndividualC3;
            $data['GenrCeos'] = (string)(int)$vorgang->VorIndividualD4;
            $data['TxtZ013'] = (string)$vorgang->VorStichwort;
            $data['Augru'] = "MW";//todo dynamic most cases MW , should with Pante clarify

            $vorgang2Text = DB::connection('sqlsrv2')->table('cis.Vorgang2Text')
                ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();

            $vorNotiz = (string)$vorgang2Text?->VorNotiz;
            $data['TxtZ012'] = $vorNotiz;

            //---------------------------------------------------------------------------------------------
            $positions = DB::connection('sqlsrv2')->table('cis.Position')
                ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->get();
            foreach ($positions as $position) {

                $artikel = Artikel::where('InterneArtikelnummer', $position->InterneArtikelnummer)->first();
                if (is_null($artikel)) {
                    Log::error(
                        "Artikel für Position nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InterneArtikelnummer' => $position->InterneArtikelnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $position5Individual = DB::connection('sqlsrv2')->table('cis.Position5Individual')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position5Individual)) {
                    Log::error(
                        "Position5Individual nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $position3Menge = Position3Menge::where('InternePositionsnummer', $position->InternePositionsnummer)->first();
                if (is_null($position3Menge)) {
                    Log::error(
                        "Position3Menge nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $position1wert = Position1Wert::where('InternePositionsnummer', $position->InternePositionsnummer)->first();
                if (is_null($position1wert)) {
                    Log::error(
                        "Position1wert nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $position2Text = DB::connection('sqlsrv2')->table('cis.Position2Text')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position2Text)) {
                    Log::error(
                        "Position2Text nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $data['to_Items'][] = [
                    'Matnr' => $artikel->Artikelnummer,
                    'PosErl' => (string)$position1wert->PosPreisProME2,
                    'KwmengO' => (string)$position3Menge->PosMenge2,
                    'Vorgn' => (string)$vorgang->VorNummer,
                    'Vbeln' => (string)$vorgang->VorIndividualC1,
                    'VorgnInt' => (string)$vorgang->InterneVorgangsnummer,
                    'Kondm' => (string)$position5Individual->PosIndividualC3,
                    'Posnr' => (string)(int)$position5Individual->PosIndividualD1,
                    'Kwmeng' => (string)$position3Menge->PosMenge1,
                    'Vrkme' => (string)$position3Menge->PosKZMengeneinheit1,
                    'TxtZ002' => (string)$position2Text->PosZusatztextLieferschein,
                    'TxtZ009' => (string)$position2Text->PosZusatztext,
                    'TxtZ010' => (string)$position2Text->PosNotiz,
                    'Montagedatum' => "20250701"// todo come from CEOS(string)$position5Individual->PosIndividualT3, //
                ];
            }
            Log::info('sd-01-02 Sent data', $data);
            $result = app(SapApiClient::class)->post($this->sd0102_path, $data);
            if ($result === null) {
                Log::error('sd-01-02 Error received');
                return null;
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }
        return $result;
    }


    /**
     * SAP → CEOS
     * Übergabe Rechnung aus einem Mietvertrag an CEOS
     * SD-02-01 Mietvertragsrechnungen
     */
    public function sd_0201_mietvertragsrechnungen($requestData): ?array
    {
        $header = $requestData['header'];
        $kunnr = ltrim($header['kunnr'], '0');
        $adresse = Adresse::where('AdressNummer', $kunnr)->first();
        if ($adresse === null) {
            Log::error(
                "sd_0201_mietvertragsrechnungen Kein Adresse für Vorgang gefunden",
                ['kunnr' => $requestData['kunnr']]
            );
            return null;
        }
        $carbonFkdat = Carbon::parse((string)$header['fkdat']);
        $carbonVorIndividualT1 = Carbon::parse((string)$header['datumvon']);
        $carbonVorIndividualT2 = Carbon::parse((string)$header['datumbis']);

        $fkdat = $carbonFkdat->format('Ymd');
        $datumvon = $carbonVorIndividualT1->format('Ymd');
        $datumbis = $carbonVorIndividualT2->format('Ymd');

        if ($header['netwr'] > 0) {
            $mwstSatzProzent = (($header['mwsbk'] - $header['netwr']) / $header['netwr']) * 100;
            $mwstSatzProzent = (int)round($mwstSatzProzent);
        } else {
            $mwstSatzProzent = 0;
        }
        if (isset($this->mwstSatzProzentArray[$mwstSatzProzent])) {
            $mwstSatzProzentCode = $this->mwstSatzProzentArray[$mwstSatzProzent];
        } else {
            Log::error('sd_0201_mietvertragsrechnungen Steuersatz ist unklar');
            return null;
        }

        $vorgangData['VorIndividualT1'] = $datumvon;
        $vorgangData['VorIndividualT2'] = $datumbis;

        $vorgangData['VorIndividualC1'] = $header['vbeln'];
        $vorgangData['VorDatumRechnung'] = $fkdat;
        $vorgangData['VorDatumAuftragseingang'] = $fkdat;


        $vorgangData['VorIndividualC7'] = $header['zuonr'];
        $vorgangData['VorIndividualC3'] = $header['zzlgsnr'];
        $vorgangData['VorAuftraggeber'] = $adresse->InterneAdressnummer;
        $vorgangData['VorIndividualD4'] = $adresse->VorIndividualD4 ?? ''; // GebäudeNr

        $vorgangData['VorArt'] = 'A';
        $vorgangData['VorUnterArt'] = 'R';  // char 1
        $vorgangData['VorGruppe'] = 'WH-'; //  -- Montage/Liefer/Rechnung: 'RE' / Vertr ge: 'WIE' ? / Rahmenauftr ge: 'AB'
        $vorgangData['VNkArt'] = '100000';
        $vorgangData['VorStatus'] = '100400'; //-- 100000 Nicht gedruckt / 100010 Angebot / 100100 Auftragsbestätigung

        $vorgangData['VorNettowert'] = $header['netwr'];
        $vorgangData['VorNettowertMwst1'] = $header['netwr'];
        $vorgangData['VorNettoPlusZusatzkosten'] = $header['netwr'];
        $vorgangData['VorNettoMinusRabatt'] = $header['netwr'];
        $vorgangData['VorNettoMinusAKonto'] = $header['netwr'];
        $vorgangData['VorNettowertRabattfaehig'] = $header['netwr'];
        $vorgangData['VorRabattfaehigMwst1'] = $header['netwr'];
        $vorgangData['VorSkontofaehigMwst1'] = $header['netwr'];

        $vorgangData['VorMwstSatz1'] = $mwstSatzProzentCode;
        $vorgangData['VorMwstSatzProzent1'] = $mwstSatzProzentCode;
        $vorgangData['VorBruttowert'] = $header['mwsbk'];
        $vorgangData['VorSkontofaehigBrutto'] = $header['mwsbk'];

        $vorgangData['VorWBruttowertGesamt'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertAuftrag'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertAbrechnung'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertLieferung'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertVersand'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertGut'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertRechnung'] = $header['mwsbk'];
        $vorgangData['VorWNettoPlusZusatzGesamt'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzAuftrag'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzAbrechnung'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzLieferung'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzVersand'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzGut'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzRechnung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattGesamt'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattAuftrag'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattAbrechnung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattLieferung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattVersand'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattGut'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattRechnung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusAKontoAbrechnung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusAKontoLieferung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusAKontoRechnung'] = $header['netwr'];
        $vorgangData['VorWNettowertGesamt'] = $header['netwr'];
        $vorgangData['VorWNettowertAuftrag'] = $header['netwr'];
        $vorgangData['VorWNettowertAbrechnung'] = $header['netwr'];
        $vorgangData['VorWNettowertLieferung'] = $header['netwr'];
        $vorgangData['VorWNettowertVersand'] = $header['netwr'];
        $vorgangData['VorWNettowertGut'] = $header['netwr'];
        $vorgangData['VorWNettowertRechnung'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Gesamt'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Auftrag'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Abrechnung'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Lieferung'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Versand'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Gut'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Rechnung'] = $header['netwr'];

        $vorgang = new VorgangService();
        $vorgang = $vorgang->createVorgang($vorgangData);
        if ($vorgang === null) {
            Log::error('sd_0201_mietvertragsrechnungen Vorgang Creation Failed');
            return null;
        }
        //------------------------------------------------------------------------------------
        $positions = $requestData['positions'];

        $positionData['InterneVorgangsnummer'] = $vorgang['InterneVorgangsnummer'];
        $positionData['VorNummer'] = $vorgang['VorNummer'];
        $positionData['VorGruppe'] = $vorgang['VorGruppe'];
        $positionsArray = [];
        foreach ($positions as $key => $position) {

            if ($position['netwr'] > 0) {
                $mwstSatzProzentPosition = (($position['mwsbp'] - $position['netwr']) / $position['netwr']) * 100;
                $mwstSatzProzentPosition = (int)round($mwstSatzProzentPosition);
            } else {
                $mwstSatzProzentPosition = 0;
            }
            if (isset($this->mwstSatzProzentArray[$mwstSatzProzentPosition])) {
                $mwstSatzProzentPositionCode = $this->mwstSatzProzentArray[$mwstSatzProzentPosition];
            } else {
                Log::error('sd_0201_mietvertragsrechnungen Position Steuersatz ist unklar');
                return null;
            }

            $positionData['PosIndividualD1'] = $position['posnr'];
            $positionData['Artikelnummer'] = ltrim($position['matnr'], '0');

            $positionData['PosKZMengeneinheit1'] = 'ST';
            $positionData['PosMenge1'] = $position['fkimg'];
            $positionData['PosWMengeGesamt1'] = $position['fkimg'];
            $positionData['PosWMengeAuftrag1'] = $position['fkimg'];
            $positionData['PosWMengeAbrechnung1'] = $position['fkimg'];
            $positionData['PosWMengeLieferung1'] = $position['fkimg'];
            $positionData['PosWMengeVersand1'] = $position['fkimg'];
            $positionData['PosWMengeGut1'] = $position['fkimg'];
            $positionData['PosWMengeRechnung1'] = $position['fkimg'];
            $positionData['PosMwstProzent'] = $mwstSatzProzentPositionCode;
            // MwstNummer ??
            $einzelPreis = $position['netwr'] / $position['fkimg'];

            $positionData['PosGesamteinzelpreis'] = $einzelPreis;
            $positionData['PosDBEinzel'] = $einzelPreis;
            $positionData['PosPreisEinzel'] = $einzelPreis;
            $positionData['PosPreisPosition'] = $position['netwr'];
            $positionData['PosGesamtpreis'] = $position['netwr'];
            $positionData['PosDBGesamt'] = $position['netwr'];

            $positionData['PosWEinzelpreisMinusRabatt'] = $einzelPreis;

            $positionData['key'] = $key;

            $positions = new PositionService();
            $positionsArray[] = $positions->createPosition($positionData);
        }
        if (!empty($positionsArray)) {
            return [
                'header' => [
                    'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                    'VorNummer' => $vorgang['VorNummer'],
                    'VorGruppe' => $vorgang['VorGruppe'],
                ],
                'positions' => $positionsArray
            ];
        }
        Log::error('sd_0201_mietvertragsrechnungen Positions Creation Failed');
        return null;
    }


    /**
     * CEOSWeb -> CEOS --> SAP
     * SD-03-01 Dienstleistungsrechnung
     */
    public function sd_0301_dienstleistungsrechnung($request): ?array
    {
        try {
            $data = [];
            $vorgang = Vorgang::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();
            if ($vorgang === null) {
                Log::error(
                    "sd_0301_dienstleistungsrechnung Kein Vorgang gefunden",
                    ['InterneVorgangsnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
            if ($adresse === null) {
                Log::error(
                    "Kein Adresse für Vorgang gefunden",
                    ['InterneVorgangsnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $data['Kunnr'] = $adresse->AdressNummer;
            $data['Auart'] = (string)$vorgang->VorIndividualC2;
            $data['Zzlgsnr'] = (string)$vorgang->VorIndividualC3;
            $data['Vorgn'] = (string)$vorgang->VorNummer;
            $data['VorgnInt'] = (string)$vorgang->InterneVorgangsnummer;
            $carbonAbrVon = Carbon::parse((string)$vorgang->VorIndividualT1);
            $data['AbrVon'] = $carbonAbrVon->format('Ymd');
            $carbonAbrBis = Carbon::parse((string)$vorgang->VorIndividualT2);
            $data['AbrBis'] = $carbonAbrBis->format('Ymd');
            //---------------------------------------------------------------------------------------------
            $positions = DB::connection('sqlsrv2')->table('cis.Position')
                ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->get();

            foreach ($positions as $position) {
                $artikel = Artikel::where('InterneArtikelnummer', $position->InterneArtikelnummer)->first();
                if (is_null($artikel)) {
                    Log::error(
                        "sd_0301_dienstleistungsrechnung Artikel für Position nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InterneArtikelnummer' => $position->InterneArtikelnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $position5Individual = DB::connection('sqlsrv2')->table('cis.Position5Individual')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position5Individual)) {
                    Log::error(
                        "Position5Individual nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $position3Menge = DB::connection('sqlsrv2')->table('cis.Position3Menge')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position3Menge)) {
                    Log::error(
                        "Position3Menge nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $position2Text = DB::connection('sqlsrv2')->table('cis.Position2Text')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position2Text)) {
                    Log::error(
                        "Position2Text nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $data['to_ServItems'][] = [
                    'Matnr' => $artikel->Artikelnummer,
                    'Kwmeng' => (string)$position3Menge->PosMenge1,
                    'Vrkme' => (string)$position3Menge->PosKZMengeneinheit1,
                    'Vorgn' => (string)$vorgang->VorNummer,
                    'VorgnInt' => (string)$vorgang->InterneVorgangsnummer,
                ];
            }
            Log::info('sd-03-01 Sent data', $data);
            $result = app(SapApiClient::class)->post($this->sd0301_path, $data);
            if ($result === null) {
                Log::error('sd-03-01 Error received');
                return null;
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }
        Log::info('sd-03-01 received data: ', $result);

        return $result;
    }


    /**
     * SAP → CEOS
     * SD-03-02 fakturierte Dienstleistungsrechnung
     */
    public function sd_03_02_fakturiertedienstleistungsrechnung($requestData): ?array
    {
        $interneVorgangsnummer = $requestData['header']['vorgangsnummerInt'];
        $header = $requestData['header'];
        $vorgang = Vorgang::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
        if ($vorgang === null) {
            Log::error(
                "sd_03_02_fakturiertedienstleistungsrechnung Kein Vorgang gefunden",
                ['InterneVorgangsnummer' => $interneVorgangsnummer]
            );
            return null;
        }

        $vorgang1Wert = Vorgang1Wert::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
        if ($vorgang1Wert === null) {
            Log::error(
                "sd_03_02_fakturiertedienstleistungsrechnung Kein Vorgang1Wert gefunden",
                ['InterneVorgangsnummer' => $interneVorgangsnummer]
            );
            return null;
        }

        $vorgang1Wert = Vorgang1Wert::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
        if ($vorgang1Wert === null) {
            Log::error(
                "sd_03_02_fakturiertedienstleistungsrechnung Kein Vorgang1Wert gefunden",
                ['InterneVorgangsnummer' => $interneVorgangsnummer]
            );
            return null;
        }
        $vorgangWert = VorgangWert::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
        if ($vorgangWert === null) {
            Log::error(
                "sd_03_02_fakturiertedienstleistungsrechnung Kein VorgangWert gefunden",
                ['InterneVorgangsnummer' => $interneVorgangsnummer]
            );
            return null;
        }


        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            Log::error("sd_03_02_fakturiertedienstleistungsrechnung Kein Adresse für Vorgang gefunden");
            return null;
        }

        $carbonVorIndividualT1 = Carbon::parse((string)$header['datumvon']);
        $carbonVorIndividualT2 = Carbon::parse((string)$header['datumbis']);

        $datumvon = $carbonVorIndividualT1->format('Ymd');
        $datumbis = $carbonVorIndividualT2->format('Ymd');

        if ($header['nettowert'] > 0) {
            $mwstSatzProzent = (($header['gesamtsteuerbetrag'] - $header['nettowert']) / $header['nettowert']) * 100;
            $mwstSatzProzent = (int)round($mwstSatzProzent);
        } else {
            $mwstSatzProzent = 0;
        }
        if (isset($this->mwstSatzProzentArray[$mwstSatzProzent])) {
            $mwstSatzProzentCode = $this->mwstSatzProzentArray[$mwstSatzProzent];
        } else {
            Log::error('sd_03_02_fakturiertedienstleistungsrechnung Steuersatz ist unklar');
            return null;
        }


        $vorgang->VorIndividualT1 = $datumvon;
        $vorgang->VorIndividualT2 = $datumbis;

        $vorgang->VorIndividualC1 = $header['fakturanummer'];
        $vorgang->VorIndividualC7 = $header['vorlagebeleg'];
        $vorgang->VorIndividualC3 = $header['liegenschaft'];
        $vorgang->VorRechnungsNummer = $vorgang->VorRechnungsnummer ?? '';
        $vorgang->VorStatus = 100400; //-- 100000 Nicht gedruckt / 100010 Angebot / 100100 Auftragsbestätigung
        $vorgang->save();

        $vorgang1Wert->VorNettowert = $header['nettowert'];
        $vorgang1Wert->VorNettowertMwst1 = $header['nettowert'];
        $vorgang1Wert->VorNettoPlusZusatzkosten = $header['nettowert'];
        $vorgang1Wert->VorNettoMinusRabatt = $header['nettowert'];
        $vorgang1Wert->VorNettoMinusAKonto = $header['nettowert'];
        $vorgang1Wert->VorNettowertRabattfaehig = $header['nettowert'];
        $vorgang1Wert->VorRabattfaehigMwst1 = $header['nettowert'];
        $vorgang1Wert->VorSkontofaehigMwst1 = $header['nettowert'];
        $vorgang1Wert->VorMwstSatz1 = $mwstSatzProzentCode;
        $vorgang1Wert->VorMwstSatzProzent1 = $mwstSatzProzentCode;
        $vorgang1Wert->VorBruttowert = $header['gesamtsteuerbetrag'];
        $vorgang1Wert->VorSkontofaehigBrutto = $header['gesamtsteuerbetrag'];
        $vorgang1Wert->save();

        $vorgangWert->VorWBruttowertGesamt = $header['gesamtsteuerbetrag'];
        $vorgangWert->VorWBruttowertAuftrag = $header['gesamtsteuerbetrag'];
        $vorgangWert->VorWBruttowertAbrechnung = $header['gesamtsteuerbetrag'];
        $vorgangWert->VorWBruttowertLieferung = $header['gesamtsteuerbetrag'];
        $vorgangWert->VorWBruttowertVersand = $header['gesamtsteuerbetrag'];
        $vorgangWert->VorWBruttowertGut = $header['gesamtsteuerbetrag'];
        $vorgangWert->VorWBruttowertRechnung = $header['gesamtsteuerbetrag'];
        $vorgangWert->VorWNettoPlusZusatzGesamt = $header['nettowert'];
        $vorgangWert->VorWNettoPlusZusatzAuftrag = $header['nettowert'];
        $vorgangWert->VorWNettoPlusZusatzAbrechnung = $header['nettowert'];
        $vorgangWert->VorWNettoPlusZusatzLieferung = $header['nettowert'];
        $vorgangWert->VorWNettoPlusZusatzVersand = $header['nettowert'];
        $vorgangWert->VorWNettoPlusZusatzGut = $header['nettowert'];
        $vorgangWert->VorWNettoPlusZusatzRechnung = $header['nettowert'];
        $vorgangWert->VorWNettoMinusRabattGesamt = $header['nettowert'];
        $vorgangWert->VorWNettoMinusRabattAuftrag = $header['nettowert'];
        $vorgangWert->VorWNettoMinusRabattAbrechnung = $header['nettowert'];
        $vorgangWert->VorWNettoMinusRabattLieferung = $header['nettowert'];
        $vorgangWert->VorWNettoMinusRabattVersand = $header['nettowert'];
        $vorgangWert->VorWNettoMinusRabattGut = $header['nettowert'];
        $vorgangWert->VorWNettoMinusRabattRechnung = $header['nettowert'];
        $vorgangWert->VorWNettoMinusAKontoAbrechnung = $header['nettowert'];
        $vorgangWert->VorWNettoMinusAKontoLieferung = $header['nettowert'];
        $vorgangWert->VorWNettoMinusAKontoRechnung = $header['nettowert'];
        $vorgangWert->VorWNettowertGesamt = $header['nettowert'];
        $vorgangWert->VorWNettowertAuftrag = $header['nettowert'];
        $vorgangWert->VorWNettowertAbrechnung = $header['nettowert'];
        $vorgangWert->VorWNettowertLieferung = $header['nettowert'];
        $vorgangWert->VorWNettowertVersand = $header['nettowert'];
        $vorgangWert->VorWNettowertGut = $header['nettowert'];
        $vorgangWert->VorWNettowertRechnung = $header['nettowert'];
        $vorgangWert->VorWNettowertMwst1Gesamt = $header['nettowert'];
        $vorgangWert->VorWNettowertMwst1Auftrag = $header['nettowert'];
        $vorgangWert->VorWNettowertMwst1Abrechnung = $header['nettowert'];
        $vorgangWert->VorWNettowertMwst1Lieferung = $header['nettowert'];
        $vorgangWert->VorWNettowertMwst1Versand = $header['nettowert'];
        $vorgangWert->VorWNettowertMwst1Gut = $header['nettowert'];
        $vorgangWert->VorWNettowertMwst1Rechnung = $header['nettowert'];
        $vorgangWert->save();

        //------------------------------------------------------------------------------------
        $positions = $requestData['positions'];
        $positionsArray = [];
        foreach ($positions as $position) {
            $artikelnummer = ltrim($position['material'], '0');
            $artikel = Artikel::where('Artikelnummer', $artikelnummer)->first();
            if ($artikel === null) {
                Log::error(
                    "sd_03_02_fakturiertedienstleistungsrechnung Kein Material für Position gefunden",
                    [
                        'InterneVorgangsnummer' => $interneVorgangsnummer,
                        'positionsnummer' => $position['positionsnummer']
                    ],
                );
                return null;
            }

            $currentPosition = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                ->where('InterneArtikelnummer', $artikel->InterneArtikelnummer)
                ->first();
            if ($currentPosition === null) {
                Log::error(
                    "sd_03_02_fakturiertedienstleistungsrechnung Kein Position für Vorgang gefunden",
                    [
                        'InterneVorgangsnummer' => $interneVorgangsnummer,
                        'positionsnummer' => $position['positionsnummer']
                    ],
                );
                return null;
            }

            //todo ask Pante if we should update also this data (menge)
            /*
                //Position3Menge
                $positionData['PosKZMengeneinheit1'] = 'ST';
                $positionData['PosMenge1'] = $position['menge'];

                //PositionWert
                $positionData['PosWMengeGesamt1'] = $position['menge'];
                $positionData['PosWMengeAuftrag1'] = $position['menge'];
                $positionData['PosWMengeAbrechnung1'] = $position['menge'];
                $positionData['PosWMengeLieferung1'] = $position['menge'];
                $positionData['PosWMengeVersand1'] = $position['menge'];
                $positionData['PosWMengeGut1'] = $position['menge'];
                $positionData['PosWMengeRechnung1'] = $position['menge'];
            */

            if ($position['nettowertposition'] > 0) {
                $mwstSatzProzentPosition = (($position['steuerwertposition'] - $position['nettowertposition']) / $position['nettowertposition']) * 100;
                $mwstSatzProzentPosition = (int)round($mwstSatzProzentPosition);
            } else {
                $mwstSatzProzentPosition = 0;
            }
            if (isset($this->mwstSatzProzentArray[$mwstSatzProzentPosition])) {
                $mwstSatzProzentPositionCode = $this->mwstSatzProzentArray[$mwstSatzProzentPosition];
            } else {
                Log::error('sd_03_02_fakturiertedienstleistungsrechnung Position Steuersatz ist unklar');
                return null;
            }
            $einzelPreis = $position['nettowertposition'] / $position['menge'];

            $position1wert = Position1Wert::where('InternePositionsnummer', $currentPosition->InternePositionsnummer)->first();
            $position1wert->PosMwstProzent = $mwstSatzProzentPositionCode;
            $position1wert->PosGesamteinzelpreis = $einzelPreis;
            $position1wert->PosDBEinzel = $einzelPreis;
            $position1wert->PosPreisEinzel = $einzelPreis;

            $position1wert->PosPreisPosition = $position['nettowertposition'];
            $position1wert->PosGesamtpreis = $position['nettowertposition'];
            $position1wert->PosDBGesamt = $position['nettowertposition'];


            $position1wert->save();


            $positionWert = PositionWert::where('InternePositionsnummer', $currentPosition->InternePositionsnummer)->first();
            $positionWert->PosWEinzelpreisMinusRabatt = $einzelPreis;
            $positionWert->save();

            $positionsArray[] = $currentPosition->InternePositionsnummer;
        }
        if (!empty($positionsArray)) {
            return [
                'header' => [
                    'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                    'VorNummer' => $vorgang['VorNummer'],
                    'VorGruppe' => $vorgang['VorGruppe'],
                ],
                'positions' => $positionsArray
            ];
        }
        Log::error('sd_0201_mietvertragsrechnungen Positions Update Failed');
        return null;
    }
}

