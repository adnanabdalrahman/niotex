<?php

namespace App\Services;

use App\Models\Artikel;
use App\Models\Preisbasis;
use App\Services\PositionServices\Position1WertService;
use App\Services\PositionServices\PositionWertService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class PositionService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
    }

    public function createPosition($data): ?array
    {
        try {
            $interneArtikelnummer = Artikel::where('Artikelnummer', $data['Artikelnummer'])->first();
            if ($interneArtikelnummer === null) {
                Log::error(
                    "Material für Vorgang nicht gefunden",
                    [
                        'Material' => $data['Artikelnummer'],
                        'Vorgangnummer' => $data['VorNummer']
                    ]
                );
                return null;
            }
            $preisbasis = Preisbasis::where('NRPreisbasis', $interneArtikelnummer->NRPreisbasis)->first();

            //todo convert to model
            $internePositionsnummer = DB::connection('sqlsrv2')->table('cis.Position')->insertGetId([
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'PosVorgaenger' => 0,
                'PosHaupt' => 0,
                'PosEbene' => 0,
                'PosNummer' => $data['key'] + 1,
                'PosNummernText' => $data['key'] + 1,
                'InterneArtikelnummer' => $interneArtikelnummer->InterneArtikelnummer,
                'KZArtikelgruppe' => $interneArtikelnummer->KZArtikelgruppe,
                'KZWarengruppe' => $interneArtikelnummer->KZWarengruppe,
                'ArtikelUntergruppeID' => $interneArtikelnummer->ArtikelUntergruppeID,
                'KZProduktgruppe' => $interneArtikelnummer->KZProduktgruppe,
                'PosBezeichnung1' => $interneArtikelnummer->ArtBezeichnung1,
                'KZKalkulationGruppe' => $interneArtikelnummer->KZKalkulationGruppe,

                'PosNeueSeite' => $data['PosNeueSeite'] ?? 0,
                'PosTyp' => $data['PosTyp'] ?? NULL,
                'PosSeriennummernfaehigJN' => $data['PosSeriennummernfaehigJN'] ?? 1,
                'PosChargenfaehigJN' => $data['PosChargenfaehigJN'] ?? 1,
                'PosAutoAbbuchenJN' => $data['PosAutoAbbuchenJN'] ?? 0,
                'PosAutoZubuchenJN' => $data['PosAutoZubuchenJN'] ?? 0,
                'PosGebuchtJN' => $data['PosGebuchtJN'] ?? 0,
                'PosErledigtJN' => $data['PosErledigtJN'] ?? 0,
                'PosLagerbuchungJN' => $data['PosLagerbuchungJN'] ?? 1,
                'PosFremdfertigungJN' => $data['PosFremdfertigungJN'] ?? 0,
                'PosLieferantenfaehigJN' => $data['PosLieferantenfaehigJN'] ?? 0,
                'PosFertigungsfaehigJN' => $data['PosFertigungsfaehigJN'] ?? 0,
                'PosUrsprungsnachweisJN' => $data['PosUrsprungsnachweisJN'] ?? 0,
                'PosEKInNachkalkulationJN' => $data['PosEKInNachkalkulationJN'] ?? 0,
                'PosAnlageAm' => $data['PosAnlageAm'] ?? date('Ymd'),
            ]);


            DB::connection('sqlsrv2')->table('cis.Position2Text')->insertGetId([
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'InternePositionsnummer' => $internePositionsnummer,
                'PosZusatztextLieferschein' => $data['PosZusatztextLieferschein'] ?? null,
                'PosZusatztext' => $data['PosZusatztext'] ?? null,
                'PosNotiz' => $data['PosNotiz'] ?? null,
                'PosBezeichnung2' => $interneArtikelnummer->ArtBezeichnung2,
            ]);

            DB::connection('sqlsrv2')->table('cis.Position3Menge')->insertGetId([
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'InternePositionsnummer' => $internePositionsnummer,
                'PosMenge1' => $data['PosMenge1'],
                'PosKZMengeneinheit1' => $data['PosKZMengeneinheit1'],
                'PosMengeAuftrag1' => $data['PosMengeAuftrag1'] ?? 0,
                'PosMengeLieferung1' => $data['PosMengeLieferung1'] ?? 0,
                'PosMengeAbrechnung1' => $data['PosMengeAbrechnung1'] ?? 0,
                'PosMengeRechnung1' => $data['PosMengeRechnung1'] ?? 0,
                'PosMengeVersand1' => $data['PosMengeVersand1'] ?? 0,
                'PosMengeAusschuss1' => $data['PosMengeAusschuss1'] ?? 0,
                'PosMenge2' => $data['PosMenge2'] ?? 0,//KWmengO
                'PosMengeAuftrag2' => $data['PosMengeAuftrag2'] ?? 0,
                'PosMengeLieferung2' => $data['PosMengeLieferung2'] ?? 0,
                'PosMengeAbrechnung2' => $data['PosMengeAbrechnung2'] ?? 0,
                'PosMengeRechnung2' => $data['PosMengeRechnung2'] ?? 0,
                'PosMengeVersand2' => $data['PosMengeVersand2'] ?? 0,
                'PosMengeAusschuss2' => $data['PosMengeAusschuss2'] ?? 0,
                'PosMultiplikator' => $data['PosMultiplikator'] ?? 0,
                'PosMultiplikatorAuftrag' => $data['PosMultiplikatorAuftrag'] ?? 0,
                'PosMultiplikatorLieferung' => $data['PosMultiplikatorLieferung'] ?? 0,
                'PosMultiplikatorAbrechnung' => $data['PosMultiplikatorAbrechnung'] ?? 0,
                'PosMultiplikatorRechnung' => $data['PosMultiplikatorRechnung'] ?? 0,
                'PosMultiplikatorVersand' => $data['PosMultiplikatorVersand'] ?? 0,
                'PosBundleMenge1' => $data['PosBundleMenge1'] ?? 0,
                'PosBundleMenge2' => $data['PosBundleMenge2'] ?? 0,
            ]);

            DB::connection('sqlsrv2')->table('cis.Position4Lieferung')->insertGetId([
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'InternePositionsnummer' => $internePositionsnummer,
                'PosLiefertermineJN' => $data['PosLiefertermineJN'] ?? 0,
                'PosVerladenJN' => $data['PosVerladenJN'] ?? 0,
                'PosMahnstufe' => $data['PosMahnstufe'] ?? 0,
                'PosMahnstufeBestaetigung' => $data['PosMahnstufeBestaetigung'] ?? 0,
                'PosMahnfolgetage' => $data['PosMahnfolgetage'] ?? 0,
                'PosMahnfolgetageBestaetigung' => $data['PosMahnfolgetageBestaetigung'] ?? 0,
            ]);

            DB::connection('sqlsrv2')->table('cis.Position5Individual')->insertGetId([
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'InternePositionsnummer' => $internePositionsnummer,
                'PosIndividualC3' => $data['PosIndividualC3'] ?? null,
                'PosIndividualD1' => $data['PosIndividualD1'] ?? null,
                'PosIndividualD7' => NULL, // todo  @ErweiterungVertragsNr from Johannes text
                'PosIndividualC7' => $data['VorGruppe'] . ' ' . $data['VorNummer'],
                'PosIndividualT3' => $data['PosIndividualT3'] ?? null,

            ]);

            DB::connection('sqlsrv2')->table('cis.Position6Stueckliste')->insertGetId([
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'InternePositionsnummer' => $internePositionsnummer,
                'PosStkAufAusgabeJN' => $data['PosStkAufAusgabeJN'] ?? 1,
                'PosStkBesAusgabeJN' => $data['PosStkBesAusgabeJN'] ?? 1,
                'PosStkKalkulationsstopJN' => $data['PosStkKalkulationsstopJN'] ?? 0,
                'PosStkBestellbeistellungJN' => $data['PosStkBestellbeistellungJN'] ?? 0,
                'PosStkKundenbeistellungJN' => $data['PosStkKundenbeistellungJN'] ?? 0,
                'PosStkKundenbeistellabgangJN' => $data['PosStkKundenbeistellabgangJN'] ?? 0,
                'PosStkPseudobaugruppeJN' => $data['PosStkPseudobaugruppeJN'] ?? 0,
                'PosStkManuellJN' => $data['PosStkManuellJN'] ?? 0,
                'PosStkDispotermin' => $data['PosStkDispotermin'] ?? 0,
                'PosStkDispodifferenz' => $data['PosStkDispodifferenz'] ?? 0,
            ]);

            DB::connection('sqlsrv2')->table('cis.Position7Zusatz')->insertGetId([
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'InternePositionsnummer' => $internePositionsnummer,
                'PosErsatzteilJN' => $data['PosErsatzteilJN'] ?? 0,
                'PosPraeferenzJNA' => $data['PosPraeferenzJNA'] ?? 0,
                'PosPraeferenzDynamischJN' => $data['PosPraeferenzDynamischJN'] ?? 0,
                'PosPraeferenzWert' => $data['PosPraeferenzWert'] ?? 0,
                'PosServiceJN' => $data['PosServiceJN'] ?? 0,
                'PosAusNachkalkulationJN' => $data['PosAusNachkalkulationJN'] ?? 0,
                'PosMTZFixiertJN' => $data['PosMTZFixiertJN'] ?? 0,
                'PosBuchungsfreigabeJN' => $data['PosBuchungsfreigabeJN'] ?? 0,
            ]);

            if (isset($data['PosPreisEinzel'])) {
                $gesamtPreis = $data['PosMenge1'] * $data['PosPreisEinzel'];
            } else {
                $gesamtPreis = 0;
            }

            /* Position1Wert */
            $data['NRPreisbasis'] = $interneArtikelnummer->NRPreisbasis;
            $data['PosPreisfaktor'] = $preisbasis->Preisfaktor;
            $data['externGesamtPris'] = $gesamtPreis;
            $position1Wert = new Position1WertService($internePositionsnummer);
            $position1Wert->savePosition1Wert($data);


            /* PositionWert */
            $positionWertData['externGesamtPris'] = $gesamtPreis;
            $positionWert = new PositionWertService($internePositionsnummer);
            $positionWert->savePositionWert($positionWertData);


            $positionsResultArray = [
                'InternePositionsnummer' => $internePositionsnummer,
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'vorgn' => $data['VorNummer'],
                'posnr' => $data['PosIndividualD1'],
            ];
        } catch (Throwable $e) {
            Log::error('Create Position' . $e->getMessage());
            return null;
        }
        return $positionsResultArray;
    }

}
