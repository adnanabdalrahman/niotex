<?php

namespace App\Services;

use App\Models\Artikel;
use App\Models\Preisbasis;
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
                'PosMenge2' => $data['PosMenge2'] ?? 0, // todo Clarify with johannes
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

            DB::connection('sqlsrv2')->table('cis.Position1Wert')->insertGetId([
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'InternePositionsnummer' => $internePositionsnummer,
                'PosRabattfaehig' => $data['PosRabattfaehig'] ?? 1,
                'PosRabattUnterpositionJN' => $data['PosRabattUnterpositionJN'] ?? 0,
                'PosRabattPosition1' => $data['PosRabattPosition1'] ?? 0,
                'PosRabattPosition2' => $data['PosRabattPosition2'] ?? 0,
                'PosRabattPosition3' => $data['PosRabattPosition3'] ?? 0,
                'PosRabattAdresse' => $data['PosRabattAdresse'] ?? 0,
                'PosRabattWert1' => $data['PosRabattWert1'] ?? 0,
                'PosRabattWert2' => $data['PosRabattWert2'] ?? 0,
                'NRPreisbasis' => $interneArtikelnummer->NRPreisbasis,
                'PosPreisfaktor' => $preisbasis->Preisfaktor,
                'PosPreisProME2' => $data['PosPreisProME2'] ?? 0,
                'PosPreisEinzel' => $data['PosPreisEinzel'] ?? 0,
                'PosPreisUnterposition' => $data['PosPreisUnterposition'] ?? 0,
                'PosPreisUnterposLager' => $data['PosPreisUnterposLager'] ?? 0,
                'PosPreisPosition' => $gesamtPreis,
                'PosGesamteinzelpreis' => $data['PosGesamteinzelpreis'] ?? 0,
                'PosGesamtpreisVorRabatt' => $gesamtPreis,
                'PosGesamtpreis' => $gesamtPreis,
                'PosPreisEinkauf' => $data['PosPreisEinkauf'] ?? 0,
                'PosPreisEinkaufOriginal' => $data['PosPreisEinkaufOriginal'] ?? 0,
                'PosPreisEinkaufUnterposition' => $data['PosPreisEinkaufUnterposition'] ?? 0,
                'PosPreisEinkaufVT' => $data['PosPreisEinkaufVT'] ?? 0,
                'PosPreisEinkaufUnterpositionVT' => $data['PosPreisEinkaufUnterpositionVT'] ?? 0,
                'PosGesamteinzelpreisEK' => $data['PosGesamteinzelpreisEK'] ?? 0,
                'PosGesamtpreisEK' => $data['PosGesamtpreisEK'] ?? 0,
                'PosGesamteinzelpreisEKVT' => $data['PosGesamteinzelpreisEKVT'] ?? 0,
                'PosGesamtpreisEKVT' => $data['PosGesamtpreisEKVT'] ?? 0,
                'PosPreisVerbindlichkeit' => $data['PosPreisVerbindlichkeit'] ?? 0,
                'PosRundungsfaktorVK' => $data['PosRundungsfaktorVK'] ?? 0,
                'PosAbzugEK' => $data['PosAbzugEK'] ?? 0,
                'MwstNummer' => $data['MwstNummer'] ?? 3,
                'PosMwstProzent' => $data['PosMwstProzent'] ?? 3,
                'PosVerschnitt' => $data['PosVerschnitt'] ?? 0,
                'PosDBEinzel' => $data['PosDBEinzel'] ?? 0,
                'PosDBGesamt' => $gesamtPreis,
                'PosDBProzent' => $data['PosDBProzent'] ?? 100,
                'PosDBAufschlag' => $data['PosDBAufschlag'] ?? 0,
                'PosSkontofaehigJN' => $data['PosSkontofaehigJN'] ?? 1,

                'PosProvisionProzent' => $data['PosProvisionProzent'] ?? 0,
                'PosPreisermittlungVK' => $data['PosPreisermittlungVK'] ?? null,
                'PosPreisermittlungEK' => $data['PosPreisermittlungEK'] ?? null,
                'PosPreisermittlungRabatt1' => $data['PosPreisermittlungRabatt1'] ?? null,
                'PosPreisermittlungRabatt2' => $data['PosPreisermittlungRabatt2'] ?? null,
                'PosPreisermittlungRabatt3' => $data['PosPreisermittlungRabatt3'] ?? null,
                'PosPreisermittlungRabattWert1' => $data['PosPreisermittlungRabattWert1'] ?? null,
                'PosPreisermittlungRabattWert2' => $data['PosPreisermittlungRabattWert2'] ?? null,
                'WithholdingtaxKategorieID' => $data['WithholdingtaxKategorieID'] ?? null,
                'PosWHTProzent' => $data['PosWHTProzent'] ?? null,
                'PosPreisEinzelBrutto' => $data['PosPreisEinzelBrutto'] ?? 0,
                'PosPreisPositionBrutto' => $data['PosPreisPositionBrutto'] ?? 0,
                'PosGesamtpreisVorRabattBrutto' => $data['PosGesamtpreisVorRabattBrutto'] ?? 0,
                'PosGesamteinzelpreisBrutto' => $data['PosGesamteinzelpreisBrutto'] ?? 0,
                'PosGesamtpreisBrutto' => $data['PosGesamtpreisBrutto'] ?? 0,
            ]);

            DB::connection('sqlsrv2')->table('cis.PositionWert')->insertGetId([
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'InternePositionsnummer' => $internePositionsnummer,

                'PosWPreisPositionGesamt' => $gesamtPreis,
                'PosWPreisPositionAuftrag' => $gesamtPreis,
                'PosWPreisPositionAbrechnung' => $gesamtPreis,
                'PosWPreisPositionLieferung' => $gesamtPreis,
                'PosWPreisPositionVersand' => $gesamtPreis,
                'PosWPreisPositionGut' => $gesamtPreis,
                'PosWPreisPositionRechnung' => $gesamtPreis,
                'PosWGesamtpreisVorRabattGes' => $data['PosWGesamtpreisVorRabattGes'] ?? $gesamtPreis,
                'PosWGesamtpreisVorRabattAuf' => $data['PosWGesamtpreisVorRabattAuf'] ?? $gesamtPreis,
                'PosWGesamtpreisVorRabattAbr' => $data['PosWGesamtpreisVorRabattAbr'] ?? $gesamtPreis,
                'PosWGesamtpreisVorRabattLief' => $data['PosWGesamtpreisVorRabattLief'] ?? $gesamtPreis,
                'PosWGesamtpreisVorRabattVers' => $data['PosWGesamtpreisVorRabattVers'] ?? $gesamtPreis,
                'PosWGesamtpreisVorRabattGut' => $data['PosWGesamtpreisVorRabattGut'] ?? $gesamtPreis,
                'PosWGesamtpreisVorRabattRec' => $data['PosWGesamtpreisVorRabattRec'] ?? $gesamtPreis,
                'PosWGesamtpreisGesamt' => $data['PosWGesamtpreisGesamt'] ?? $gesamtPreis,
                'PosWGesamtpreisAuftrag' => $data['PosWGesamtpreisAuftrag'] ?? $gesamtPreis,
                'PosWGesamtpreisAbrechnung' => $data['PosWGesamtpreisAbrechnung'] ?? $gesamtPreis,
                'PosWGesamtpreisLieferung' => $data['PosWGesamtpreisLieferung'] ?? $gesamtPreis,
                'PosWGesamtpreisVersand' => $data['PosWGesamtpreisVersand'] ?? $gesamtPreis,
                'PosWGesamtpreisGut' => $data['PosWGesamtpreisGut'] ?? $gesamtPreis,
                'PosWGesamtpreisRechnung' => $data['PosWGesamtpreisRechnung'] ?? $gesamtPreis,
                'PosWGesamtpreisEKGesamt' => $data['PosWGesamtpreisEKGesamt'] ?? 0,
                'PosWGesamtpreisEKAuftrag' => $data['PosWGesamtpreisEKAuftrag'] ?? 0,
                'PosWGesamtpreisEKAbrechnung' => $data['PosWGesamtpreisEKAbrechnung'] ?? 0,
                'PosWGesamtpreisEKLieferung' => $data['PosWGesamtpreisEKLieferung'] ?? 0,
                'PosWGesamtpreisEKVersand' => $data['PosWGesamtpreisEKVersand'] ?? 0,
                'PosWGesamtpreisEKGut' => $data['PosWGesamtpreisEKGut'] ?? 0,
                'PosWGesamtpreisEKRechnung' => $data['PosWGesamtpreisEKRechnung'] ?? 0,
                'PosWGesamtpreisEKVTGesamt' => $data['PosWGesamtpreisEKVTGesamt'] ?? 0,
                'PosWGesamtpreisEKVTAuftrag' => $data['PosWGesamtpreisEKVTAuftrag'] ?? 0,
                'PosWGesamtpreisEKVTAbrechnung' => $data['PosWGesamtpreisEKVTAbrechnung'] ?? 0,
                'PosWGesamtpreisEKVTLieferung' => $data['PosWGesamtpreisEKVTLieferung'] ?? 0,
                'PosWGesamtpreisEKVTVersand' => $data['PosWGesamtpreisEKVTVersand'] ?? 0,
                'PosWGesamtpreisEKVTGut' => $data['PosWGesamtpreisEKVTGut'] ?? 0,
                'PosWGesamtpreisEKVTRechnung' => $data['PosWGesamtpreisEKVTRechnung'] ?? 0,
                'PosWEinzelpreisMinusRabatt' => $data['PosWEinzelpreisMinusRabatt'] ?? 0,
                'PosWMengeGesamt1' => $data['PosWMengeGesamt1'],
                'PosWMengeAuftrag1' => $data['PosWMengeAuftrag1'],
                'PosWMengeAbrechnung1' => $data['PosWMengeAbrechnung1'],
                'PosWMengeLieferung1' => $data['PosWMengeLieferung1'],
                'PosWMengeVersand1' => $data['PosWMengeVersand1'],
                'PosWMengeGut1' => $data['PosWMengeGut1'],
                'PosWMengeRechnung1' => $data['PosWMengeRechnung1'],
                'PosWMengeAuftrag2' => $data['PosWMengeAuftrag2'] ?? 0,
                'PosWMengeAbrechnung2' => $data['PosWMengeAbrechnung2'] ?? 0,
                'PosWMengeLieferung2' => $data['PosWMengeLieferung2'] ?? 0,
                'PosWMengeVersand2' => $data['PosWMengeVersand2'] ?? 0,
                'PosWMengeGesamt2' => $data['PosWMengeGesamt2'] ?? 0,
                'PosWMengeGut2' => $data['PosWMengeGut2'] ?? 0,
                'PosWMengeRechnung2' => $data['PosWMengeRechnung2'] ?? 0,
            ]);
            $positionsResultArray = [
                'InternePositionsnummer' => $internePositionsnummer,
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'vorgn' => $data['VorNummer'],
                'posnr' => $data['PosIndividualD1'],
            ];
        } catch (Throwable $e) {
            Log::error('Create Vorgang' . $e->getMessage());
            return null;
        }
        return $positionsResultArray;
    }

}
