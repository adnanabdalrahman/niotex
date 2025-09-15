<?php

namespace App\Services\PositionServices;

use App\Models\Position5Individual;
use Illuminate\Support\Facades\Log;
use Throwable;

class Position5IndividualService
{
    protected string $internePositionsnummer;

    public function __construct($internePositionsnummer)
    {
        $this->internePositionsnummer = $internePositionsnummer;
    }

    public function savePosition5Individual($data): ?Position5Individual
    {
        try {
            return Position5Individual::updateOrCreate(
                ['InternePositionsnummer' => $this->internePositionsnummer],
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                    'PosIndividualD1' => $data['PosIndividualD1'] ?? null,
                    'PosIndividualD2' => $data['PosIndividualD2'] ?? null,
                    'PosIndividualD3' => $data['PosIndividualD3'] ?? null,
                    'PosIndividualD4' => $data['PosIndividualD4'] ?? null,
                    'PosIndividualD5' => $data['PosIndividualD5'] ?? null,
                    'PosIndividualD6' => $data['PosIndividualD6'] ?? null,
                    'PosIndividualD7' => $data['PosIndividualD7'] ?? null,
                    'PosIndividualD8' => $data['PosIndividualD8'] ?? null,
                    'PosIndividualD9' => $data['PosIndividualD9'] ?? null,
                    'PosIndividualD10' => $data['PosIndividualD10'] ?? null,
                    'PosIndividualC1' => $data['PosIndividualC1'] ?? null, // posnr
                    'PosIndividualC2' => $data['PosIndividualC2'] ?? null, //Vgart
                    'PosIndividualC3' => $data['PosIndividualC3'] ?? null,
                    'PosIndividualC4' => $data['PosIndividualC4'] ?? null, // PosAtt
                    'PosIndividualC5' => $data['PosIndividualC5'] ?? null, // kwmeng
                    'PosIndividualC6' => $data['PosIndividualC6'] ?? null,
                    'PosIndividualC7' => $data['PosIndividualC7'] ?? null,
                    'PosIndividualC8' => $data['PosIndividualC8'] ?? null,
                    'PosIndividualC9' => $data['PosIndividualC9'] ?? null,
                    'PosIndividualC10' => $data['PosIndividualC10'] ?? null,
                    'PosIndividualT1' => $data['PosIndividualT1'] ?? null,
                    'PosIndividualT2' => $data['PosIndividualT2'] ?? null,
                    'PosIndividualT3' => $data['PosIndividualT3'] ?? null,//Montagedatum
                    'PosIndividualT4' => $data['PosIndividualT4'] ?? null,//CO_0101 send date
                    'PosIndividualT5' => $data['PosIndividualT5'] ?? null,
                    'PosIndividualT6' => $data['PosIndividualT6'] ?? null,
                    'PosIndividualCombo1' => $data['PosIndividualCombo1'] ?? null,
                    'PosIndividualCombo2' => $data['PosIndividualCombo2'] ?? null,
                    'PosIndividualCombo3' => $data['PosIndividualCombo3'] ?? null,
                    'PosIndividualCombo4' => $data['PosIndividualCombo4'] ?? null,
                    'PosIndividualCombo5' => $data['PosIndividualCombo5'] ?? null,
                    'PosIndividualCombo6' => $data['PosIndividualCombo6'] ?? null,
                    'PosIndividualCombo7' => $data['PosIndividualCombo7'] ?? null,
                    'PosIndividualCombo8' => $data['PosIndividualCombo8'] ?? null,
                ]);

        } catch (Throwable $e) {
            Log::error('Failed to update/create Position5Individual', [
                'error' => $e->getMessage(),
                'internePositionsnummer' => $this->internePositionsnummer,
            ]);
            return null;
        }
    }

}
