<?php

namespace App\Services\SDServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Preisbasis;
use App\Services\PositionService;
use App\Services\VorgangService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class SD_0201_Services
{
    protected array $vorGruppe;


    protected array $mwstSatzProzentArray;

    public function __construct()
    {

        $this->vorGruppe = config('vorgruppe');
        $this->mwstSatzProzentArray = [
            7 => 2,
            19 => 3,
            0 => 4,
        ];
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

        $vorgangData['VorIndividualC1'] = $header['vbeln'];// fakturanummer
        $vorgangData['VorDatumRechnung'] = $fkdat;
        $vorgangData['VorDatumAuftragseingang'] = $fkdat;

        $vorgangData['VorIndividualC3'] = $header['zzlgsnr'];
        $vorgangData['VorIndividualC7'] = $header['zuonr'];
        $vorgangData['VorAuftraggeber'] = $adresse->InterneAdressnummer;
        $vorgangData['VorIndividualD4'] = $adresse->VorIndividualD4 ?? ''; // GebäudeNr

        $vorgangData['VorArt'] = 'A';
        $vorgangData['VorUnterArt'] = 'R';  // char 1
        $vorgangData['VorGruppe'] = 'WH'; //  -- Montage/Liefer/Rechnung: 'RE' / Vertr ge: 'WIE' ? / Rahmenauftr ge: 'AB'
        $vorgangData['VNkArt'] = '100000';
        $vorgangData['VorStatus'] = 100400; //-- 100000 Nicht gedruckt / 100010 Angebot / 100100 Auftragsbestätigung

        //Storno
        if ($header['vbeln'] == $header['zuonr']) {
            $vorgangData['VorStatus'] = 100430;
        }


        $vorgangData['VorNettowert'] = $header['netwr'];
        $vorgangData['VorNettowertMwst1'] = $header['netwr'];
        $vorgangData['VorNettoPlusZusatzkosten'] = $header['netwr'];
        $vorgangData['VorNettoMinusRabatt'] = $header['netwr'];
        $vorgangData['VorNettoMinusAKonto'] = $header['netwr'];
        $vorgangData['VorNettowertRabattfaehig'] = $header['netwr'];
        $vorgangData['VorRabattfaehigMwst1'] = $header['netwr'];
        $vorgangData['VorSkontofaehigMwst1'] = $header['netwr'];

        $vorgangData['VorMwstSatz1'] = $mwstSatzProzentCode;
        $vorgangData['VorMwstSatzProzent1'] = $mwstSatzProzent;
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

        $positionsArray = [];
        foreach ($positions as $key => $position) {
            $artikelNummer = ltrim($position['matnr'], '0');
            $artikel = Artikel::where('Artikelnummer', $artikelNummer)->first();
            if ($artikel === null) {
                Log::error(
                    "Material für Position nicht gefunden",
                    [
                        'Material' => $artikelNummer,
                        'Vorgangnummer' => $vorgang['VorNummer']
                    ]
                );
                return null;
            }

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
            $positionData['InterneVorgangsnummer'] = $vorgang['InterneVorgangsnummer'];
            $positionData['VorNummer'] = $vorgang['VorNummer'];
            $positionData['PosIndividualD1'] = $position['posnr'];
            $positionData['PosKZMengeneinheit1'] = 'ST';
            $positionData['PosMenge1'] = $position['fkimg'];
            $positionData['PosMwstProzent'] = $mwstSatzProzentPosition;
            $positionData['externMenge'] = $position['fkimg'];
            $positionData['externEinzelPreis'] = $position['netwr'] / $position['fkimg'];;
            $positionData['externGesamtPreis'] = $position['netwr'];
            $positionData['PosNummer'] = $key + 1;
            $positionData['PosNummernText'] = $key + 1;

            $preisbasis = Preisbasis::where('NRPreisbasis', $artikel->NRPreisbasis)->first();
            $positionData['NRPreisbasis'] = $artikel->NRPreisbasis;
            $positionData['PosPreisfaktor'] = $preisbasis->Preisfaktor;

            $positions = new PositionService();
            $positionsArray[] = $positions->createPosition($positionData, $artikel);
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
}





