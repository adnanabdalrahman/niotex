<?php

namespace App\Services\SDServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position1Wert;
use App\Models\PositionWert;
use App\Models\Vorgang;
use App\Models\Vorgang1Wert;
use App\Models\VorgangWert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class SD_03_02_Services
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

        //Storno
        if ($header['fakturanummer'] == $header['vorlagebeleg']) {
            $vorgang->VorStatus = 100430;
        }
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
            $position1wert->PosMwstProzent = $mwstSatzProzentPosition;
            $position1wert->MwstNummer = $mwstSatzProzentPositionCode;
            $position1wert->PosGesamteinzelpreis = $einzelPreis;
            $position1wert->PosDBEinzel = $einzelPreis;
            $position1wert->PosPreisEinzel = $einzelPreis;

            $position1wert->PosPreisPosition = $position['nettowertposition'];
            $position1wert->PosGesamtpreis = $position['nettowertposition'];
            $position1wert->PosDBGesamt = $position['nettowertposition'];

            $position1wert->save();

            //PositionWert
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





