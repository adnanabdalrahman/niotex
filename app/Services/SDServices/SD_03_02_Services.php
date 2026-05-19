<?php

namespace App\Services\SDServices;

use App\Exceptions\DBSaveException;
use App\Exceptions\InvalidInputException;
use App\Exceptions\InvalidTaxRateException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Ceos_DTA_Eigenschaften;
use App\Models\Position;
use App\Models\Position1Wert;
use App\Models\PositionWert;
use App\Models\Vorgang;
use App\Models\Vorgang1Wert;
use App\Models\VorgangWert;
use App\Services\DLBuchungsdateiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;


class SD_03_02_Services
{

    protected array $mwstSatzProzentArray;

    public function __construct(protected DLBuchungsdateiService $dlBuchungsdateiService)
    {
        $this->mwstSatzProzentArray = [
            7 => 2,
            19 => 3,
            0 => 4,
        ];
    }

    /**
     * SAP → CEOS
     * SD-03-02 fakturierte Dienstleistungsrechnung
     * @throws ResourceNotFoundException
     * @throws InvalidInputException
     * @throws InvalidTaxRateException
     * @throws DBSaveException
     * @throws Throwable
     */
    public function sd_03_02_fakturiertedienstleistungsrechnung($requestData): ?array
    {
        return DB::transaction(function () use ($requestData) {
            $interneVorgangsnummer = $requestData['header']['vorgangsnummerInt'];
            $header = $requestData['header'];
            $vorgang = Vorgang::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
            if ($vorgang === null) {
                throw new ResourceNotFoundException('Kein Vorgang gefunden',
                    ['InterneVorgangsnummer' => $interneVorgangsnummer]
                );
            }

            $vorgang1Wert = Vorgang1Wert::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
            if ($vorgang1Wert === null) {
                throw new ResourceNotFoundException('Kein Vorgang1Wert gefunden',
                    ['InterneVorgangsnummer' => $interneVorgangsnummer]
                );
            }

            $vorgangWert = VorgangWert::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
            if ($vorgangWert === null) {
                throw new ResourceNotFoundException('Kein VorgangWert gefunden',
                    ['InterneVorgangsnummer' => $interneVorgangsnummer]
                );
            }

            $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
            if ($adresse === null) {
                throw new ResourceNotFoundException('Keine Adresse für den Vorgang gefunden.',
                    ['InterneVorgangsnummer' => $interneVorgangsnummer]
                );
            }

            if ($header['nettowert'] > 0) {
                $mwstSatzProzent = (($header['gesamtsteuerbetrag'] - $header['nettowert']) / $header['nettowert']) * 100;
                $mwstSatzProzent = (int)round($mwstSatzProzent);
            } else {
                $mwstSatzProzent = 0;
            }
            if (isset($this->mwstSatzProzentArray[$mwstSatzProzent])) {
                $mwstSatzProzentCode = $this->mwstSatzProzentArray[$mwstSatzProzent];
            } else {
                throw new InvalidInputException("Steuersatz ist unklar");
            }

            $carbonVorIndividualT1 = Carbon::parse((string)$header['datumvon']);
            $carbonVorIndividualT2 = Carbon::parse((string)$header['datumbis']);

            $datumvon = $carbonVorIndividualT1->format('Ymd');
            $datumbis = $carbonVorIndividualT2->format('Ymd');

            $vorgang->VorIndividualT1 = $datumvon;
            $vorgang->VorIndividualT2 = $datumbis;

            $vorgang->VorIndividualC1 = $header['fakturanummer'];
            $vorgang->VorIndividualC7 = $header['vorlagebeleg'];
            $vorgang->VorIndividualC3 = $header['liegenschaft'];
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
            $shouldCreateDlBuchungsdatei = true;

            $artikelnummern = collect($positions)
                ->pluck('material')
                ->map(fn($material) => ltrim($material, '0'))
                ->unique();

            $artikelCollection = Artikel::whereIn('Artikelnummer', $artikelnummern
            )->get()->keyBy('Artikelnummer');

            
            foreach ($positions as $position) {
                $artikelnummer = ltrim($position['material'], '0');
                $artikel = $artikelCollection[$artikelnummer] ?? null;
                if ($artikel === null) {
                    throw new ResourceNotFoundException('Kein Material für die Position gefunden.',
                        [
                            'InterneVorgangsnummer' => $interneVorgangsnummer,
                            'positionsnummer' => $position['positionsnummer']
                        ]
                    );
                }

                $currentPosition = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                    ->where('InterneArtikelnummer', $artikel->InterneArtikelnummer)
                    ->first();

                if ($currentPosition === null) {
                    throw new ResourceNotFoundException('Keine Position für den Vorgang gefunden.',
                        [
                            'InterneVorgangsnummer' => $interneVorgangsnummer,
                            'positionsnummer' => $position['positionsnummer']
                        ]
                    );
                }
                if ($position['nettowertposition'] > 0) {
                    $mwstSatzProzentPosition = (($position['steuerwertposition'] - $position['nettowertposition']) / $position['nettowertposition']) * 100;
                    $mwstSatzProzentPosition = (int)round($mwstSatzProzentPosition);
                } else {
                    $mwstSatzProzentPosition = 0;
                }
                if (isset($this->mwstSatzProzentArray[$mwstSatzProzentPosition])) {
                    $mwstSatzProzentPositionCode = $this->mwstSatzProzentArray[$mwstSatzProzentPosition];
                } else {
                    throw new InvalidTaxRateException();
                }
                if ((float)$position['menge'] <= 0) {
                    throw new InvalidTaxRateException('Die Positionsmenge muss größer als 0 sein.');
                }
                $einzelPreis = $position['nettowertposition'] / $position['menge'];

                $position1wert = Position1Wert::where(
                    'InternePositionsnummer',
                    $currentPosition->InternePositionsnummer
                )->first();
                if ($position1wert === null) {
                    throw new ResourceNotFoundException('Kein Position1Wert für den Vorgang gefunden',
                        [
                            'InterneVorgangsnummer' => $interneVorgangsnummer,
                            'positionsnummer' => $position['positionsnummer']
                        ]
                    );
                }
                $position1wert->PosMwstProzent = $mwstSatzProzentPosition;
                $position1wert->MwstNummer = $mwstSatzProzentPositionCode;
                $position1wert->PosGesamteinzelpreis = $einzelPreis;
                $position1wert->PosDBEinzel = $einzelPreis;
                $position1wert->PosPreisEinzel = $einzelPreis;

                $position1wert->PosPreisPosition = $position['nettowertposition'];
                $position1wert->PosGesamtpreis = $position['nettowertposition'];
                $position1wert->PosDBGesamt = $position['nettowertposition'];

                $position1wert->save();


                $positionWert = PositionWert::where(
                    'InternePositionsnummer',
                    $currentPosition->InternePositionsnummer
                )->first();

                if ($positionWert === null) {
                    throw new ResourceNotFoundException('Kein PositionWert für den Vorgang gefunden.',
                        [
                            'InterneVorgangsnummer' => $interneVorgangsnummer,
                            'positionsnummer' => $position['positionsnummer']
                        ]
                    );
                }
                $positionWert->PosWEinzelpreisMinusRabatt = $einzelPreis;
                $positionWert->save();
                $positionsArray[] = $currentPosition->InternePositionsnummer;
            }


            $shouldCreateDlBuchungsdatei = !Position::query()
                ->join(
                    'Artikel',
                    'Position.InterneArtikelnummer',
                    '=',
                    'Artikel.InterneArtikelnummer'
                )
                ->where(
                    'Position.InterneVorgangsnummer',
                    (int)$vorgang->VorIndividualD2
                )
                ->whereIn('Artikel.Artikelnummer', ['12', '52', '90'])
                ->exists();

            if (!empty($positionsArray)) {
                if ($shouldCreateDlBuchungsdatei) {
                    $abrechnungseinheit = Ceos_DTA_Eigenschaften::query()
                        ->where('DatumVon', $datumvon)
                        ->where('DatumBis', $datumbis)
                        ->where('EigenschaftTyp', 1)
                        ->where('LiegenschaftsNummer', (string)$vorgang->VorIndividualC3)
                        ->first();
                    if ($abrechnungseinheit === null) {
                        throw new ResourceNotFoundException('Keine Abrechnungseinheit für den Vorgang gefunden.',
                            ['InterneVorgangsnummer' => $interneVorgangsnummer]
                        );
                    }
                    $header['abrechnungseinheit'] = (string)$abrechnungseinheit->EigenschaftWert;
                    $this->dlBuchungsdateiService->create($header);
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
            throw new DBSaveException('Fehler beim Aktualisieren der Positionen fakturierte Dienstleistungsrechnung.');
        });
    }
}
