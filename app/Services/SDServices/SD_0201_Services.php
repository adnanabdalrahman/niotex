<?php

namespace App\Services\SDServices;

use App\Exceptions\CreationFailedException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\ValidationFailedException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Preisbasis;
use App\Services\PositionService;
use App\Services\VorgangService;
use Carbon\Carbon;

class SD_0201_Services
{
    protected array $vorGruppe;

    protected array $mwstSatzProzentArray;

    public function __construct()
    {
        $this->vorGruppe = config('vorgruppeMapping');
        $this->mwstSatzProzentArray = [
            7 => 2,
            19 => 3,
            0 => 4,
        ];
    }

    /**
     * SAP → CEOS
     * SD-02-01 Mietvertragsrechnungen
     * @throws ResourceNotFoundException
     * @throws ValidationFailedException
     * @throws CreationFailedException
     */
    public function sd_0201_mietvertragsrechnungen(array $requestData): ?array
    {
        $header = $requestData['header'];
        $kunnr = ltrim($header['kunnr'], '0');
        $adresse = Adresse::where('AdressNummer', $kunnr)->first();
        if ($adresse === null) {
            throw new ResourceNotFoundException('AdressNummer wurde nicht gefunden', ['AdressNummer' => $kunnr]);
        }

        $fkdat = Carbon::parse($header['fkdat'])->format('Ymd');
        $datumvon = Carbon::parse($header['datumvon'])->format('Ymd');
        $datumbis = Carbon::parse($header['datumbis'])->format('Ymd');

        /* ============================================================
           MwSt — ALWAYS FROM zzstproz
        ============================================================ */

        $mwstSatzProzent = (int)round((float)$header['zzstproz']);

        if (!isset($this->mwstSatzProzentArray[$mwstSatzProzent])) {
            throw new ValidationFailedException('Unbekannter Steuersatz', ['zzstproz' => $mwstSatzProzent]);
        }
        $mwstSatzCode = $this->mwstSatzProzentArray[$mwstSatzProzent];

        /* ============================================================
           VORGANG DATA — ORIGINAL (UNTOUCHED)
        ============================================================ */

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

        /* ==================== VALUES ==================== */

        $vorgangData['VorNettowert'] = $header['netwr'];
        $vorgangData['VorNettowertMwst1'] = $header['netwr'];
        $vorgangData['VorNettoPlusZusatzkosten'] = $header['netwr'];
        $vorgangData['VorNettoMinusRabatt'] = $header['netwr'];
        $vorgangData['VorNettoMinusAKonto'] = $header['netwr'];
        $vorgangData['VorNettowertRabattfaehig'] = $header['netwr'];
        $vorgangData['VorRabattfaehigMwst1'] = $header['netwr'];
        $vorgangData['VorSkontofaehigMwst1'] = $header['netwr'];

        $vorgangData['VorMwstSatz1'] = $mwstSatzCode;
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


        /* ==================== CREATE VORGANG ==================== */

        $vorgangService = new VorgangService();
        $vorgang = $vorgangService->createVorgang($vorgangData);
        if ($vorgang === null) {
            throw new CreationFailedException('Vorgang Erstellung fehlgeschlagen');
        }
        /* ==================== POSITIONS ==================== */

        $positionsArray = [];

        foreach ($requestData['positions'] as $key => $position) {

            $artikelNummer = ltrim($position['matnr'], '0');

            $artikel = Artikel::where('Artikelnummer', $artikelNummer)->first();

            if ($artikel === null) {
                throw new ResourceNotFoundException('Material wurde nicht gefunden', ['matnr' => $artikelNummer]);
            }
            $mwstPos = (int)round((float)$position['zzstproz']);

            if (!isset($this->mwstSatzProzentArray[$mwstSatzProzent])) {
                throw new ValidationFailedException('Unbekannter Steuersatz', ['zzstproz' => $mwstSatzProzent]);
            }

            $preisbasis = Preisbasis::where('NRPreisbasis', $artikel->NRPreisbasis)->first();

            $positionData['InterneVorgangsnummer'] = $vorgang['InterneVorgangsnummer'];
            $positionData['VorNummer'] = $vorgang['VorNummer'];
            $positionData['PosIndividualC1'] = $position['posnr'];
            $positionData['PosKZMengeneinheit1'] = 'ST';
            $positionData['PosMenge1'] = $position['fkimg'];
            $positionData['PosMwstProzent'] = $mwstPos;
            $positionData['externMenge'] = $position['fkimg'];
            $positionData['externEinzelPreis'] = $position['fkimg'] > 0 ? $position['netwr'] / $position['fkimg'] : 0;
            $positionData['externGesamtPreis'] = $position['netwr'];
            $positionData['PosNummer'] = $key + 1;
            $positionData['PosNummernText'] = $key + 1;

            $positionData['NRPreisbasis'] = $artikel->NRPreisbasis;
            $positionData['PosPreisfaktor'] = $preisbasis->Preisfaktor;

            $positionService = new PositionService();
            $createdPosition = $positionService->createPosition($positionData, $artikel);

            if ($createdPosition === null) {
                throw new CreationFailedException(
                    'Position Erstellung fehlgeschlagen',
                    ["posnr" => $position['posnr']]
                );
            }
            $positionsArray[] = $createdPosition;

        }
        if (empty($positionsArray)) {
            throw new CreationFailedException('Positionen Erstellung fehlgeschlagen');
        }
        return [
            'header' => [
                'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                'VorNummer' => $vorgang['VorNummer'],
                'VorGruppe' => $vorgang['VorGruppe'],
            ],
            'positions' => $positionsArray
        ];

    }
}
