<?php

namespace App\Services\SDServices;

use App\Exceptions\CreationFailedException;
use App\Exceptions\DBSaveException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\ValidationFailedException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Preisbasis;
use App\Services\PositionService;
use App\Services\VorgangServices\Vorgang1WertService;
use App\Services\VorgangServices\Vorgang2TextService;
use App\Services\VorgangServices\Vorgang3ZahlungService;
use App\Services\VorgangServices\Vorgang4VersandService;
use App\Services\VorgangServices\Vorgang5AngebotService;
use App\Services\VorgangServices\Vorgang6WiederholService;
use App\Services\VorgangServices\VorgangService;
use App\Services\VorgangServices\VorgangWertService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class SD_0201_Services
{
    protected array $vorGruppe;
    protected array $mwstSatzProzentArray;


    public function __construct(
        protected VorgangService           $vorgangService,
        protected Vorgang2TextService      $vorgang2TextService,
        protected VorgangWertService       $vorgangWertService,
        protected Vorgang1WertService      $vorgang1WertService,
        protected Vorgang3ZahlungService   $vorgang3ZahlungService,
        protected Vorgang4VersandService   $vorgang4VersandService,
        protected Vorgang5AngebotService   $vorgang5AngebotService,
        protected Vorgang6WiederholService $vorgang6WiederholService,

        protected PositionService          $positionService
    )
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
     * @throws Throwable
     */
    public function sd_0201_mietvertragsrechnungen(array $requestData): ?array
    {
        $header = $requestData['header'];
        $kunnr = ltrim($header['kunnr'], '0');
        $adresse = Adresse::where('AdressNummer', $kunnr)->first();
        if ($adresse === null) {
            throw new ResourceNotFoundException('AdressNummer wurde nicht gefunden', ['AdressNummer' => $kunnr]);
        }
        $fkdat = !empty($header['fkdat'])
            ? Carbon::parse($header['fkdat'])->format('Ymd')
            : null;

        $datumvon = !empty($header['datumvon'])
            ? Carbon::parse($header['datumvon'])->format('Ymd')
            : null;

        $datumbis = !empty($header['datumbis'])
            ? Carbon::parse($header['datumbis'])->format('Ymd')
            : null;

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

        $artikelIds = array_map(
            fn($p) => ltrim($p['matnr'], '0'),
            $requestData['positions']
        );

        $artikelCollection = Artikel::whereIn('Artikelnummer', $artikelIds)
            ->get()
            ->keyBy('Artikelnummer');

        $preisbasisCollection = Preisbasis::whereIn(
            'NRPreisbasis',
            $artikelCollection->pluck('NRPreisbasis')
        )->get()->keyBy('NRPreisbasis');


        return DB::transaction(function () use ($requestData, $vorgangData, $artikelCollection, $preisbasisCollection) {
            $positionsArray = [];

            /* ==================== CREATE VORGANG ==================== */
            $vorgang = $this->createVorgang($vorgangData);

            /* ==================== POSITIONS ==================== */
            foreach ($requestData['positions'] as $key => $position) {
                $positionData = [];
                $artikelNummer = ltrim($position['matnr'], '0');

                $artikel = $artikelCollection[$artikelNummer] ?? null;
                if ($artikel === null) {
                    throw new ResourceNotFoundException('Material wurde nicht gefunden', ['matnr' => $artikelNummer]);
                }
                $preisbasis = $preisbasisCollection[$artikel->NRPreisbasis] ?? null;
                if ($preisbasis === null) {
                    throw new ResourceNotFoundException('Preisbasis wurde nicht gefunden', ['NRPreisbasis' => $artikel->NRPreisbasis]);
                }
                $mwstPos = (int)round((float)$position['zzstproz']);
                if (!isset($this->mwstSatzProzentArray[$mwstPos])) {
                    throw new ValidationFailedException('Unbekannter Steuersatz', ['zzstproz' => $mwstPos]);
                }

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

                try {
                    $createdPosition = $this->positionService->createPosition($positionData, $artikel);
                } catch (Throwable $e) {
                    throw new DBSaveException('Fehler beim Speichern die Position: '
                        . $e->getMessage());
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
        });
    }


    /**
     * @throws CreationFailedException
     */
    protected function createVorgang(array $data): array
    {
        try {
            $vorgang = $this->vorgangService->createVorgang($data);
            $this->vorgang2TextService->saveVorgang2Text($data, $vorgang->InterneVorgangsnummer);
            $this->vorgangWertService->saveVorgangWert($data, $vorgang->InterneVorgangsnummer);
            $this->vorgang1WertService->saveVorgang1Wert($data, $vorgang->InterneVorgangsnummer);
            $this->vorgang3ZahlungService->saveVorgang3Zahlung($data, $vorgang->InterneVorgangsnummer);
            $this->vorgang4VersandService->saveVorgang4Versand($data, $vorgang->InterneVorgangsnummer);
            $this->vorgang5AngebotService->saveVorgang5Angebot($data, $vorgang->InterneVorgangsnummer);
            $this->vorgang6WiederholService->saveVorgang6Wiederhol($data, $vorgang->InterneVorgangsnummer);
            return [
                'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                'VorNummer' => $vorgang->VorNummer,
                'VorGruppe' => $vorgang->VorGruppe,
            ];
        } catch (Throwable $e) {
            throw new CreationFailedException('Fehler beim Vorgang Erstellung: ' . $e->getMessage());
        }
    }


}
