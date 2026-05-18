<?php

namespace App\Services\PositionServices;

use App\Models\Position1Wert;

class Position1WertService
{

    public function savePosition1Wert($data, $internePositionsnummer): bool
    {
        return Position1Wert::insert(
            [
                'InternePositionsnummer' => $internePositionsnummer,
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'PosRabattfaehig' => $data['PosRabattfaehig'] ?? 1,
                'PosRabattUnterpositionJN' => $data['PosRabattUnterpositionJN'] ?? 0,
                'PosRabattPosition1' => $data['PosRabattPosition1'] ?? 0,
                'PosRabattPosition2' => $data['PosRabattPosition2'] ?? 0,
                'PosRabattPosition3' => $data['PosRabattPosition3'] ?? 0,
                'PosRabattAdresse' => $data['PosRabattAdresse'] ?? 0,
                'PosRabattWert1' => $data['PosRabattWert1'] ?? 0,
                'PosRabattWert2' => $data['PosRabattWert2'] ?? 0,
                'NRPreisbasis' => $data['NRPreisbasis'],
                'PosPreisfaktor' => $data['PosPreisfaktor'] ?? 1,
                'PosPreisProME2' => $data['PosPreisProME2'] ?? 0,
                'PosPreisEinzel' => $data['PosPreisEinzel'] ?? $data['externEinzelPreis'] ?? 0,
                'PosPreisUnterposition' => $data['PosPreisUnterposition'] ?? 0,
                'PosPreisUnterposLager' => $data['PosPreisUnterposLager'] ?? 0,
                'PosPreisPosition' => $data['PosPreisPosition'] ?? $data['externGesamtPreis'] ?? 0,
                'PosGesamteinzelpreis' => $data['PosGesamteinzelpreis'] ?? $data['externEinzelPreis'] ?? 0,
                'PosGesamtpreisVorRabatt' => $data['PosGesamtpreisVorRabatt'] ?? $data['externGesamtPreis'] ?? 0,
                'PosGesamtpreis' => $data['PosGesamtpreis'] ?? $data['externGesamtPreis'] ?? 0,
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
                'PosMwstProzent' => $data['PosMwstProzent'] ?? 19,
                'PosVerschnitt' => $data['PosVerschnitt'] ?? 0,
                'PosDBEinzel' => $data['PosDBEinzel'] ?? $data['externEinzelPreis'] ?? 0,
                'PosDBGesamt' => $data['PosDBGesamt'] ?? $data['externGesamtPreis'] ?? 0,
                'PosDBProzent' => $data['PosDBProzent'] ?? 100,
                'PosDBAufschlag' => $data['PosDBAufschlag'] ?? 0,
                'PosSkontofaehigJN' => $data['PosSkontofaehigJN'] ?? 1,
                'PosProvisionProzent' => $data['PosProvisionProzent'] ?? 0,
                'PosPreisEinzelBrutto' => $data['PosPreisEinzelBrutto'] ?? 0,
                'PosPreisPositionBrutto' => $data['PosPreisPositionBrutto'] ?? 0,
                'PosGesamtpreisVorRabattBrutto' => $data['PosGesamtpreisVorRabattBrutto'] ?? 0,
                'PosGesamteinzelpreisBrutto' => $data['PosGesamteinzelpreisBrutto'] ?? 0,
                'PosGesamtpreisBrutto' => $data['PosGesamtpreisBrutto'] ?? 0,

                'PosPreisermittlungVK' => $data['PosPreisermittlungVK'] ?? null,
                'PosPreisermittlungEK' => $data['PosPreisermittlungEK'] ?? null,
                'PosPreisermittlungRabatt1' => $data['PosPreisermittlungRabatt1'] ?? null,
                'PosPreisermittlungRabatt2' => $data['PosPreisermittlungRabatt2'] ?? null,
                'PosPreisermittlungRabatt3' => $data['PosPreisermittlungRabatt3'] ?? null,
                'PosPreisermittlungRabattWert1' => $data['PosPreisermittlungRabattWert1'] ?? null,
                'PosPreisermittlungRabattWert2' => $data['PosPreisermittlungRabattWert2'] ?? null,
                'WithholdingtaxKategorieID' => $data['WithholdingtaxKategorieID'] ?? null,
                'PosWHTProzent' => $data['PosWHTProzent'] ?? null,
            ]);
    }


    public function updatePosition1Wert($data, $internePositionsnummer): Position1Wert
    {
        return Position1Wert::updateOrCreate(
            ['InternePositionsnummer' => $internePositionsnummer],
            [
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'PosRabattfaehig' => $data['PosRabattfaehig'] ?? 1,
                'PosRabattUnterpositionJN' => $data['PosRabattUnterpositionJN'] ?? 0,
                'PosRabattPosition1' => $data['PosRabattPosition1'] ?? 0,
                'PosRabattPosition2' => $data['PosRabattPosition2'] ?? 0,
                'PosRabattPosition3' => $data['PosRabattPosition3'] ?? 0,
                'PosRabattAdresse' => $data['PosRabattAdresse'] ?? 0,
                'PosRabattWert1' => $data['PosRabattWert1'] ?? 0,
                'PosRabattWert2' => $data['PosRabattWert2'] ?? 0,
                'NRPreisbasis' => $data['NRPreisbasis'],
                'PosPreisfaktor' => $data['PosPreisfaktor'] ?? 1,
                'PosPreisProME2' => $data['PosPreisProME2'] ?? 0,
                'PosPreisEinzel' => $data['PosPreisEinzel'] ?? $data['externEinzelPreis'] ?? 0,
                'PosPreisUnterposition' => $data['PosPreisUnterposition'] ?? 0,
                'PosPreisUnterposLager' => $data['PosPreisUnterposLager'] ?? 0,
                'PosPreisPosition' => $data['PosPreisPosition'] ?? $data['externGesamtPreis'] ?? 0,
                'PosGesamteinzelpreis' => $data['PosGesamteinzelpreis'] ?? $data['externEinzelPreis'] ?? 0,
                'PosGesamtpreisVorRabatt' => $data['PosGesamtpreisVorRabatt'] ?? $data['externGesamtPreis'] ?? 0,
                'PosGesamtpreis' => $data['PosGesamtpreis'] ?? $data['externGesamtPreis'] ?? 0,
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
                'PosMwstProzent' => $data['PosMwstProzent'] ?? 19,
                'PosVerschnitt' => $data['PosVerschnitt'] ?? 0,
                'PosDBEinzel' => $data['PosDBEinzel'] ?? $data['externEinzelPreis'] ?? 0,
                'PosDBGesamt' => $data['PosDBGesamt'] ?? $data['externGesamtPreis'] ?? 0,
                'PosDBProzent' => $data['PosDBProzent'] ?? 100,
                'PosDBAufschlag' => $data['PosDBAufschlag'] ?? 0,
                'PosSkontofaehigJN' => $data['PosSkontofaehigJN'] ?? 1,
                'PosProvisionProzent' => $data['PosProvisionProzent'] ?? 0,
                'PosPreisEinzelBrutto' => $data['PosPreisEinzelBrutto'] ?? 0,
                'PosPreisPositionBrutto' => $data['PosPreisPositionBrutto'] ?? 0,
                'PosGesamtpreisVorRabattBrutto' => $data['PosGesamtpreisVorRabattBrutto'] ?? 0,
                'PosGesamteinzelpreisBrutto' => $data['PosGesamteinzelpreisBrutto'] ?? 0,
                'PosGesamtpreisBrutto' => $data['PosGesamtpreisBrutto'] ?? 0,

                'PosPreisermittlungVK' => $data['PosPreisermittlungVK'] ?? null,
                'PosPreisermittlungEK' => $data['PosPreisermittlungEK'] ?? null,
                'PosPreisermittlungRabatt1' => $data['PosPreisermittlungRabatt1'] ?? null,
                'PosPreisermittlungRabatt2' => $data['PosPreisermittlungRabatt2'] ?? null,
                'PosPreisermittlungRabatt3' => $data['PosPreisermittlungRabatt3'] ?? null,
                'PosPreisermittlungRabattWert1' => $data['PosPreisermittlungRabattWert1'] ?? null,
                'PosPreisermittlungRabattWert2' => $data['PosPreisermittlungRabattWert2'] ?? null,
                'WithholdingtaxKategorieID' => $data['WithholdingtaxKategorieID'] ?? null,
                'PosWHTProzent' => $data['PosWHTProzent'] ?? null,
            ]);


    }

}
