<?php

namespace App\Services\PositionServices;

use App\Models\Position3Menge;
use Illuminate\Support\Facades\Log;
use Throwable;

class Position3MengeService
{
    protected string $internePositionsnummer;

    public function __construct($internePositionsnummer)
    {
        $this->internePositionsnummer = $internePositionsnummer;
    }

    public function SavePosition3Menge($data): ?Position3Menge
    {
        try {
            return Position3Menge::updateOrCreate(
                ['InternePositionsnummer' => $this->internePositionsnummer],
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
            Log::error('Failed to update/create Position3Menge', [
                'error' => $e->getMessage(),
                'internePositionsnummer' => $this->internePositionsnummer,
            ]);
            return null;
        }
    }

}
