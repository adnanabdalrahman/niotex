<?php

namespace App\Services\REServices;

use App\Models\Adresse;
use App\Models\Ceos_GEBAEUDE_TimeLine;
use App\Models\Ceos_LIEGENSCHAFT_TimeLine;
use App\Models\Ceos_MIETER_TimeLine;
use App\Models\Ceos_VERWALTUNG_TimeLine;
use App\Models\Position;
use App\Models\Position1Wert;
use App\Models\Position2Text;
use App\Models\Position3Menge;
use App\Models\Position4Lieferung;
use App\Models\Position5Individual;
use App\Models\Position6Stueckliste;
use App\Models\Position7Zusatz;
use App\Models\PositionWert;
use App\Models\Vorgang;
use App\Services\PositionServices\Position1WertService;
use App\Services\PositionServices\Position2TextService;
use App\Services\PositionServices\Position3MengeService;
use App\Services\PositionServices\Position4LieferungService;
use App\Services\PositionServices\Position5IndividualService;
use App\Services\PositionServices\Position6StuecklisteService;
use App\Services\PositionServices\Position7ZusatzService;
use App\Services\PositionServices\PositionService as PositionServiceTable;
use App\Services\PositionServices\PositionWertService;
use App\Services\VorgangServices\Vorgang1WertService;
use App\Services\VorgangServices\Vorgang2TextService;
use App\Services\VorgangServices\Vorgang3ZahlungService;
use App\Services\VorgangServices\Vorgang4VersandService;
use App\Services\VorgangServices\Vorgang5AngebotService;
use App\Services\VorgangServices\Vorgang6WiederholService;
use App\Services\VorgangServices\VorgangService;
use App\Services\VorgangServices\VorgangWertService;
use Illuminate\Support\Facades\Log;
use Throwable;

class MasterServices
{

    public function buildMaster(): ?array
    {
        //todo delete all if Error happens
        try {
            //todo get all Liegenschaften in timeline
            $liegenschaften = Ceos_LIEGENSCHAFT_TimeLine::get();
            $vorgangData = [];
            foreach ($liegenschaften as $liegenschaft) {
                $verwaltung = Ceos_VERWALTUNG_TimeLine::where(
                    'LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                    ->first();
                if ($verwaltung === null) {
                    Log::error('buildMaster no Verwaltung gefunden');
                    return null;
                }

                $liegenschaftenGebaeude = Ceos_GEBAEUDE_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)
                    ->where('GebaeudeNr', 0)
                    ->first();

                $interneAdressnummer = $verwaltung->AuftraggeberID;
                $adresse = Adresse::where('InterneAdressnummer', $interneAdressnummer)->first();

                $vorgangData['VorAuftraggeber'] = $adresse->InterneAdressnummer;
                $vorgangData['VorIndividualD4'] = $adresse->VorIndividualD4 ?? ''; // GebäudeNr
                $vorgangData['VorIndividualC3'] = $liegenschaft->Liegenschaftsnummer;
                #$vorgangData['VorIndividualT1'] = $liegenschaft->DatumVon;
                #$vorgangData['VorIndividualT2'] = $liegenschaft->DatumBis;

                $vorgangData['VorArt'] = 'R';
                $vorgangData['VorUnterArt'] = 'M';
                $vorgangData['VorGruppe'] = 'ABM';
                $vorgangData['VNkArt'] = '108000';
                $vorgangData['VorStatus'] = 108100;


                $vorgangData['VorBetrefftextZeile1'] = $liegenschaftenGebaeude->LG_Strasse;
                $vorgangData['VorBetrefftextZeile2'] = $liegenschaftenGebaeude->LG_PLZ;
                $vorgangData['VorLieferanschrift'] = $adresse->InterneAdressnummer;
                $vorgangData['VorRechnungsanschrift'] = $adresse->InterneAdressnummer;
                $vorgangData['VorSammelRechnungsanschrift'] = $adresse->InterneAdressnummer;


                $currentVorgang = Vorgang::where(
                    'VorIndividualC3', $liegenschaft->Liegenschaftsnummer)
                    ->where('VorGruppe', $vorgangData['VorGruppe'])
                    ->where('VorArt', $vorgangData['VorArt'])
                    ->first();
                if ($currentVorgang !== null) {
                    $vorgangData['InterneVorgangsnummer'] = $currentVorgang->InterneVorgangsnummer;
                    $vorgang = new VorgangService;
                    $vorgang = $vorgang->updateVorgang($vorgangData);
                } else {
                    $vorgang = new VorgangService;
                    $vorgang = $vorgang->createVorgang($vorgangData);
                }
                $interneVorgangsnummer = $vorgang['InterneVorgangsnummer'];
                $vorgang2TextService = new Vorgang2TextService($interneVorgangsnummer);
                $vorgang2TextService->saveVorgang2Text($vorgangData);

                $vorgang3ZahlungService = new Vorgang3ZahlungService($interneVorgangsnummer);
                $vorgang3ZahlungService->saveVorgang3Zahlung($vorgangData);

                $vorgang4VersandService = new Vorgang4VersandService($interneVorgangsnummer);
                $vorgang4VersandService->saveVorgang4Versand($vorgangData);

                $vorgang5AngebotService = new Vorgang5AngebotService($interneVorgangsnummer);
                $vorgang5AngebotService->saveVorgang5Angebot($vorgangData);

                $vorgang6WiederholService = new Vorgang6WiederholService($interneVorgangsnummer);
                $vorgang6WiederholService->saveVorgang6Wiederhol($vorgangData);

                $vorgangWertService = new VorgangWertService($interneVorgangsnummer);
                $vorgangWertService->saveVorgangWert($vorgangData);

                $vorgang1WertService = new Vorgang1WertService($interneVorgangsnummer);
                $vorgang1WertService->saveVorgang1Wert($vorgangData);

                Position::where('InterneVorgangsnummer', $interneVorgangsnummer)->delete();
                Position1Wert::where('InterneVorgangsnummer', $interneVorgangsnummer)->delete();
                Position2Text::where('InterneVorgangsnummer', $interneVorgangsnummer)->delete();
                Position3Menge::where('InterneVorgangsnummer', $interneVorgangsnummer)->delete();
                Position4Lieferung::where('InterneVorgangsnummer', $interneVorgangsnummer)->delete();
                Position5Individual::where('InterneVorgangsnummer', $interneVorgangsnummer)->delete();
                Position6Stueckliste::where('InterneVorgangsnummer', $interneVorgangsnummer)->delete();
                Position7Zusatz::where('InterneVorgangsnummer', $interneVorgangsnummer)->delete();
                PositionWert::where('InterneVorgangsnummer', $interneVorgangsnummer)->delete();
                // ------------------------  1 Gesamtliegenschaft ------------------------------------------

                $positionData['InterneVorgangsnummer'] = $interneVorgangsnummer;
                $positionData['PosEbene'] = 0;
                $positionData['PosNummer'] = 1;
                $positionData['PosNummernText'] = "1";
                $positionData['PosVorgaenger'] = 0;
                $positionData['KZArtikelgruppe'] = 'GESAMT';
                $positionData['KZWarengruppe'] = 'LGS';
                $positionData['InterneArtikelnummer'] = NULL;
                $positionData['PosBezeichnung1'] = 'Gesamtliegenschaft';

                $positionService = new PositionServiceTable();
                $position = $positionService->createPositionMaster($positionData);
                $internePositionsnummer = $position->InternePositionsnummer;
                $positionData['VorNummer'] = $vorgang->VorNummer;

                $positionData['PosKZMengeneinheit1'] = 'I';
                $positionData['PosMenge1'] = 0;
                $positionData['externMenge'] = 0;
                $positionData['externEinzelPreis'] = 0;;
                $positionData['externGesamtPreis'] = 0;
                $positionData['NRPreisbasis'] = 1;

                $position1Wert = new Position1WertService($internePositionsnummer);
                $position1Wert->savePosition1Wert($positionData);

                $positionData['PosBezeichnung2'] = $liegenschaftenGebaeude->LG_Strasse . ' ' . $liegenschaftenGebaeude->LG_PLZ;;;
                $position2Text = new Position2TextService($internePositionsnummer);
                $position2Text->savePosition2TextMaster($positionData);

                $position3Menge = new Position3MengeService($internePositionsnummer);
                $position3Menge->SavePosition3Menge($positionData);

                $position4Lieferung = new Position4LieferungService($internePositionsnummer);
                $position4Lieferung->savePosition4Lieferung($positionData);

                $position5Individual = new Position5IndividualService($internePositionsnummer);
                $position5Individual->savePosition5Individual($positionData);

                $position6Stueckliste = new Position6StuecklisteService($internePositionsnummer);
                $position6Stueckliste->savePosition6Stueckliste($positionData);

                $position7Zusatz = new Position7ZusatzService($internePositionsnummer);
                $position7Zusatz->savePosition7Zusatz($positionData);

                $positionWert = new PositionWertService($internePositionsnummer);
                $positionWert->savePositionWert($positionData);

                // ------------------------  1.1 Heizungskosten ------------------------------------------

                $positionData['InterneVorgangsnummer'] = $interneVorgangsnummer;
                $positionData['PosEbene'] = 1;
                $positionData['PosNummer'] = 2;
                $positionData['PosNummernText'] = "1.1";
                $positionData['PosVorgaenger'] = $position->InternePositionsnummer;
                $positionData['KZArtikelgruppe'] = 'HK';
                $positionData['KZWarengruppe'] = 'WK';
                $positionData['InterneArtikelnummer'] = $liegenschaft->Heizung_JN ? 164834 : 164814;
                $positionData['PosBezeichnung1'] = $liegenschaft->Heizung_JN ? 'Heizungskosten' : 'Kein Heizungskosten';

                $positionService = new PositionServiceTable();
                $position = $positionService->createPositionMaster($positionData);
                $internePositionsnummer = $position->InternePositionsnummer;

                $positionData['VorNummer'] = $vorgang->VorNummer;

                $positionData['PosKZMengeneinheit1'] = 'QM';
                $positionData['PosMenge1'] = 0;
                $positionData['externMenge'] = 0;
                $positionData['externEinzelPreis'] = 0;;
                $positionData['externGesamtPreis'] = 0;

                $positionData['NRPreisbasis'] = 1;
                $position1Wert = new Position1WertService($internePositionsnummer);
                $position1Wert->savePosition1Wert($positionData);

                $positionData['PosBezeichnung2'] = $liegenschaftenGebaeude->LG_Strasse . ' ' . $liegenschaftenGebaeude->LG_PLZ;;;
                $position2Text = new Position2TextService($internePositionsnummer);
                $position2Text->savePosition2TextMaster($positionData);

                $position3Menge = new Position3MengeService($internePositionsnummer);
                $position3Menge->savePosition3Menge($positionData);

                $position4Lieferung = new Position4LieferungService($internePositionsnummer);
                $position4Lieferung->savePosition4Lieferung($positionData);

                $position5Individual = new Position5IndividualService($internePositionsnummer);
                $position5Individual->savePosition5Individual($positionData);

                $position6Stueckliste = new Position6StuecklisteService($internePositionsnummer);
                $position6Stueckliste->savePosition6Stueckliste($positionData);

                $position7Zusatz = new Position7ZusatzService($internePositionsnummer);
                $position7Zusatz->savePosition7Zusatz($positionData);

                /* PositionWert */
                $positionWert = new PositionWertService($internePositionsnummer);
                $positionWert->savePositionWert($positionData);

                // ------------------------  1.2 Warmwasser ------------------------------------------

                $positionData['InterneVorgangsnummer'] = $interneVorgangsnummer;
                $positionData['PosEbene'] = 1;
                $positionData['PosNummer'] = 3;
                $positionData['PosNummernText'] = "1.2";
                $positionData['PosVorgaenger'] = $position->InternePositionsnummer;
                $positionData['KZArtikelgruppe'] = 'WWK';
                $positionData['KZWarengruppe'] = 'WK';
                $positionData['InterneArtikelnummer'] = $liegenschaft->Warmwasser_JN ? 164863 : 164857;
                $positionData['PosBezeichnung1'] = $liegenschaft->Warmwasser_JN ? 'Warmwasserkosten' : 'Kein Warmwasserkosten';

                $positionService = new PositionServiceTable();
                $position = $positionService->createPositionMaster($positionData);
                $internePositionsnummer = $position->InternePositionsnummer;

                $positionData['VorNummer'] = $vorgang->VorNummer;

                $positionData['PosKZMengeneinheit1'] = 'QM';
                $positionData['PosMenge1'] = 0;
                $positionData['externMenge'] = 0;
                $positionData['externEinzelPreis'] = 0;;
                $positionData['externGesamtPreis'] = 0;

                $positionData['NRPreisbasis'] = 1;
                $position1Wert = new Position1WertService($internePositionsnummer);
                $position1Wert->savePosition1Wert($positionData);

                $positionData['PosBezeichnung2'] = $liegenschaftenGebaeude->LG_Strasse . ' ' . $liegenschaftenGebaeude->LG_PLZ;;;
                $position2Text = new Position2TextService($internePositionsnummer);
                $position2Text->savePosition2TextMaster($positionData);

                $position3Menge = new Position3MengeService($internePositionsnummer);
                $position3Menge->savePosition3Menge($positionData);

                $position4Lieferung = new Position4LieferungService($internePositionsnummer);
                $position4Lieferung->savePosition4Lieferung($positionData);

                $position5Individual = new Position5IndividualService($internePositionsnummer);
                $position5Individual->savePosition5Individual($positionData);

                $position6Stueckliste = new Position6StuecklisteService($internePositionsnummer);
                $position6Stueckliste->savePosition6Stueckliste($positionData);

                $position7Zusatz = new Position7ZusatzService($internePositionsnummer);
                $position7Zusatz->savePosition7Zusatz($positionData);

                /* PositionWert */
                $positionWert = new PositionWertService($internePositionsnummer);
                $positionWert->savePositionWert($positionData);


                // ------------------------  1.2 Warmwasser ------------------------------------------

                $positionData['InterneVorgangsnummer'] = $interneVorgangsnummer;
                $positionData['PosEbene'] = 1;
                $positionData['PosNummer'] = 4;
                $positionData['PosNummernText'] = "1.3";
                $positionData['PosVorgaenger'] = $position->InternePositionsnummer;
                $positionData['KZArtikelgruppe'] = 'NUTZER';
                $positionData['KZWarengruppe'] = 'LGS';
                $positionData['InterneArtikelnummer'] = NULL;
                $positionData['PosBezeichnung1'] = 'Allgemein';

                $positionService = new PositionServiceTable();
                $position = $positionService->createPositionMaster($positionData);
                $internePositionsnummer = $position->InternePositionsnummer;

                $positionData['VorNummer'] = $vorgang->VorNummer;

                $positionData['PosKZMengeneinheit1'] = 'QM';
                $positionData['PosMenge1'] = 0;
                $positionData['externMenge'] = 0;
                $positionData['externEinzelPreis'] = 0;;
                $positionData['externGesamtPreis'] = 0;

                $positionData['NRPreisbasis'] = 1;
                $position1Wert = new Position1WertService($internePositionsnummer);
                $position1Wert->savePosition1Wert($positionData);

                $positionData['PosBezeichnung2'] = $liegenschaftenGebaeude->LG_Strasse . ' ' . $liegenschaftenGebaeude->LG_PLZ;;;
                $position2Text = new Position2TextService($internePositionsnummer);
                $position2Text->savePosition2TextMaster($positionData);

                $position3Menge = new Position3MengeService($internePositionsnummer);
                $position3Menge->savePosition3Menge($positionData);

                $position4Lieferung = new Position4LieferungService($internePositionsnummer);
                $position4Lieferung->savePosition4Lieferung($positionData);

                $position5Individual = new Position5IndividualService($internePositionsnummer);
                $position5Individual->savePosition5Individual($positionData);

                $position6Stueckliste = new Position6StuecklisteService($internePositionsnummer);
                $position6Stueckliste->savePosition6Stueckliste($positionData);

                $position7Zusatz = new Position7ZusatzService($internePositionsnummer);
                $position7Zusatz->savePosition7Zusatz($positionData);

                /* PositionWert */
                $positionWert = new PositionWertService($internePositionsnummer);
                $positionWert->savePositionWert($positionData);


                // get all mieter
                $mieters = Ceos_MIETER_TimeLine::where('LiegenschaftsID', $liegenschaft->LiegenschaftsID)->get();
                $posNr = 4;
                foreach ($mieters as $key => $mieter) {

                    $positionData['InterneVorgangsnummer'] = $interneVorgangsnummer;
                    $positionData['PosEbene'] = 1;
                    $posNr = 4 + $key + 1;
                    $positionData['PosNummer'] = $posNr;
                    $positionData['PosNummernText'] = "1." . $key + 3;
                    $positionData['PosVorgaenger'] = $position->InternePositionsnummer;
                    $positionData['KZArtikelgruppe'] = 'NUTZER';
                    $positionData['KZWarengruppe'] = 'LGS';
                    $positionData['InterneArtikelnummer'] = NULL;
                    $positionData['PosBezeichnung1'] = $mieter->M_Name1;

                    $positionService = new PositionServiceTable();
                    $position = $positionService->createPositionMaster($positionData);
                    $internePositionsnummer = $position->InternePositionsnummer;

                    $positionData['VorNummer'] = $vorgang->VorNummer;

                    $positionData['PosKZMengeneinheit1'] = 'ST';
                    $positionData['PosMenge1'] = 0;
                    $positionData['externMenge'] = 0;
                    $positionData['externEinzelPreis'] = 0;;
                    $positionData['externGesamtPreis'] = 0;

                    $positionData['NRPreisbasis'] = 1;
                    $position1Wert = new Position1WertService($internePositionsnummer);
                    $position1Wert->savePosition1Wert($positionData);

                    $positionData['PosBezeichnung2'] = $liegenschaftenGebaeude->LG_Strasse . ' ' . $liegenschaftenGebaeude->LG_PLZ;;;
                    $position2Text = new Position2TextService($internePositionsnummer);
                    $position2Text->savePosition2TextMaster($positionData);

                    $position3Menge = new Position3MengeService($internePositionsnummer);
                    $position3Menge->savePosition3Menge($positionData);

                    $position4Lieferung = new Position4LieferungService($internePositionsnummer);
                    $position4Lieferung->savePosition4Lieferung($positionData);

                    $position5Individual = new Position5IndividualService($internePositionsnummer);
                    $position5Individual->savePosition5Individual($positionData);

                    $position6Stueckliste = new Position6StuecklisteService($internePositionsnummer);
                    $position6Stueckliste->savePosition6Stueckliste($positionData);

                    $position7Zusatz = new Position7ZusatzService($internePositionsnummer);
                    $position7Zusatz->savePosition7Zusatz($positionData);

                    /* PositionWert */
                    $positionWert = new PositionWertService($internePositionsnummer);
                    $positionWert->savePositionWert($positionData);
                }

                // ------------------------  2 Kaltwasser ------------------------------------------
                $positionData['InterneVorgangsnummer'] = $interneVorgangsnummer;
                $positionData['PosEbene'] = 0;
                $positionData['PosNummer'] = $posNr + 2;
                $positionData['PosNummernText'] = "2";
                $positionData['PosVorgaenger'] = 0;
                $positionData['KZArtikelgruppe'] = 'KWK';
                $positionData['KZWarengruppe'] = 'WK';
                $positionData['InterneArtikelnummer'] = $liegenschaft->Kaltwasser_JN ? 164848 : 168026;

                $positionData['PosBezeichnung1'] = $liegenschaft->Kaltwasser_JN ? 'Kaltwasserkosten' : 'Kein Kaltwasserkosten';

                $positionService = new PositionServiceTable();
                $position = $positionService->createPositionMaster($positionData);
                $internePositionsnummer = $position->InternePositionsnummer;

                $positionData['VorNummer'] = $vorgang->VorNummer;

                $positionData['PosKZMengeneinheit1'] = 'VKWW';
                $positionData['PosMenge1'] = 0;
                $positionData['externMenge'] = 0;
                $positionData['externEinzelPreis'] = 0;;
                $positionData['externGesamtPreis'] = 0;

                $positionData['NRPreisbasis'] = 1;
                $position1Wert = new Position1WertService($internePositionsnummer);
                $position1Wert->savePosition1Wert($positionData);

                $positionData['PosBezeichnung2'] = $liegenschaftenGebaeude->LG_Strasse . ' ' . $liegenschaftenGebaeude->LG_PLZ;;;
                $position2Text = new Position2TextService($internePositionsnummer);
                $position2Text->savePosition2TextMaster($positionData);

                $position3Menge = new Position3MengeService($internePositionsnummer);
                $position3Menge->savePosition3Menge($positionData);

                $position4Lieferung = new Position4LieferungService($internePositionsnummer);
                $position4Lieferung->savePosition4Lieferung($positionData);

                $position5Individual = new Position5IndividualService($internePositionsnummer);
                $position5Individual->savePosition5Individual($positionData);

                $position6Stueckliste = new Position6StuecklisteService($internePositionsnummer);
                $position6Stueckliste->savePosition6Stueckliste($positionData);

                $position7Zusatz = new Position7ZusatzService($internePositionsnummer);
                $position7Zusatz->savePosition7Zusatz($positionData);

                /* PositionWert */
                $positionWert = new PositionWertService($internePositionsnummer);
                $positionWert->savePositionWert($positionData);


                // ------------------------  3 Kaltwasser ------------------------------------------
                $positionData['InterneVorgangsnummer'] = $interneVorgangsnummer;
                $positionData['PosEbene'] = 0;
                $positionData['PosNummer'] = $posNr + 1;
                $positionData['PosNummernText'] = "3";
                $positionData['PosVorgaenger'] = 0;
                $positionData['KZArtikelgruppe'] = 'HNK';
                $positionData['KZWarengruppe'] = 'HNK';

                $positionData['InterneArtikelnummer'] = $liegenschaft->Betriebskosten_JN ? 164783 : 164784;

                $positionData['PosBezeichnung1'] = $liegenschaft->Betriebskosten_JN ? 'Hausnebenkosten' : 'kein Hausnebenkosten';;

                $positionService = new PositionServiceTable();
                $position = $positionService->createPositionMaster($positionData);
                $internePositionsnummer = $position->InternePositionsnummer;

                $positionData['VorNummer'] = $vorgang->VorNummer;

                $positionData['PosKZMengeneinheit1'] = 'QM';
                $positionData['PosMenge1'] = 0;
                $positionData['externMenge'] = 0;
                $positionData['externEinzelPreis'] = 0;;
                $positionData['externGesamtPreis'] = 0;

                $positionData['NRPreisbasis'] = 1;
                $position1Wert = new Position1WertService($internePositionsnummer);
                $position1Wert->savePosition1Wert($positionData);

                $positionData['PosBezeichnung2'] = $liegenschaftenGebaeude->LG_Strasse . ' ' . $liegenschaftenGebaeude->LG_PLZ;;;
                $position2Text = new Position2TextService($internePositionsnummer);
                $position2Text->savePosition2TextMaster($positionData);

                $position3Menge = new Position3MengeService($internePositionsnummer);
                $position3Menge->savePosition3Menge($positionData);

                $position4Lieferung = new Position4LieferungService($internePositionsnummer);
                $position4Lieferung->savePosition4Lieferung($positionData);

                $position5Individual = new Position5IndividualService($internePositionsnummer);
                $position5Individual->savePosition5Individual($positionData);

                $position6Stueckliste = new Position6StuecklisteService($internePositionsnummer);
                $position6Stueckliste->savePosition6Stueckliste($positionData);

                $position7Zusatz = new Position7ZusatzService($internePositionsnummer);
                $position7Zusatz->savePosition7Zusatz($positionData);

                /* PositionWert */
                $positionWert = new PositionWertService($internePositionsnummer);
                $positionWert->savePositionWert($positionData);


                // ------------------------  4 Strom ------------------------------------------
                $positionData['InterneVorgangsnummer'] = $interneVorgangsnummer;
                $positionData['PosEbene'] = 0;
                $positionData['PosNummer'] = $posNr + 3;
                $positionData['PosNummernText'] = "4";
                $positionData['PosVorgaenger'] = 0;
                $positionData['KZArtikelgruppe'] = 'HNK';
                $positionData['KZWarengruppe'] = 'HNK';

                $positionData['InterneArtikelnummer'] = $liegenschaft->Stromkosten_JN ? 164850 : 164851;

                $positionData['PosBezeichnung1'] = $liegenschaft->Stromkosten_JN ? 'Strom' : 'kein Strom';

                $positionService = new PositionServiceTable();
                $position = $positionService->createPositionMaster($positionData);
                $internePositionsnummer = $position->InternePositionsnummer;

                $positionData['VorNummer'] = $vorgang->VorNummer;

                $positionData['PosKZMengeneinheit1'] = 'QM';
                $positionData['PosMenge1'] = 0;
                $positionData['externMenge'] = 0;
                $positionData['externEinzelPreis'] = 0;;
                $positionData['externGesamtPreis'] = 0;

                $positionData['NRPreisbasis'] = 1;
                $position1Wert = new Position1WertService($internePositionsnummer);
                $position1Wert->savePosition1Wert($positionData);

                $positionData['PosBezeichnung2'] = $liegenschaftenGebaeude->LG_Strasse . ' ' . $liegenschaftenGebaeude->LG_PLZ;;;
                $position2Text = new Position2TextService($internePositionsnummer);
                $position2Text->savePosition2TextMaster($positionData);

                $position3Menge = new Position3MengeService($internePositionsnummer);
                $position3Menge->savePosition3Menge($positionData);

                $position4Lieferung = new Position4LieferungService($internePositionsnummer);
                $position4Lieferung->savePosition4Lieferung($positionData);

                $position5Individual = new Position5IndividualService($internePositionsnummer);
                $position5Individual->savePosition5Individual($positionData);

                $position6Stueckliste = new Position6StuecklisteService($internePositionsnummer);
                $position6Stueckliste->savePosition6Stueckliste($positionData);

                $position7Zusatz = new Position7ZusatzService($internePositionsnummer);
                $position7Zusatz->savePosition7Zusatz($positionData);

                /* PositionWert */
                $positionWert = new PositionWertService($internePositionsnummer);
                $positionWert->savePositionWert($positionData);

                dd('done');
            }


            //---------------- LIEGENSCHAFT -------------------------------


        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }
        return ['message' => true];
    }
}
