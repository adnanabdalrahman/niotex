<?php

namespace App\Services\PositionServices;

use App\Exceptions\DBSaveException;
use App\Models\Position3Menge;
use Throwable;

class Position3MengeService
{
    public function SavePosition3Menge($data, $internePositionsnummer): bool
    {
        return Position3Menge::insert(
            [
                'InternePositionsnummer' => $internePositionsnummer,
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
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
    }


    /**
     * @throws DBSaveException
     */
    public function updatePosition3Menge($data, $internePositionsnummer): Position3Menge
    {
        try {
            return Position3Menge::updateOrCreate(
                ['InternePositionsnummer' => $internePositionsnummer],
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
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

        } catch (Throwable $e) {
            throw new DBSaveException('Fehler beim Speichern oder Aktualisieren die Position3Menge: ' . $e->getMessage());
        }
    }

}
