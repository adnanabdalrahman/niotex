<?php

namespace App\Services\PositionServices;

use App\Models\Position4Lieferung;
use Illuminate\Support\Facades\Log;
use Throwable;

class Position4LieferungService
{
    protected string $internePositionsnummer;

    public function __construct($internePositionsnummer)
    {
        $this->internePositionsnummer = $internePositionsnummer;
    }

    public function savePosition4Lieferung($data): ?Position4Lieferung
    {
        try {
            return Position4Lieferung::updateOrCreate(
                ['InternePositionsnummer' => $this->internePositionsnummer],
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                    'PosLiefertermineJN' => $data['PosLiefertermineJN'] ?? 0,
                    'PosVerladenJN' => $data['PosVerladenJN'] ?? 0,
                    'PosMahnstufe' => $data['PosMahnstufe'] ?? 0,
                    'PosMahnstufeBestaetigung' => $data['PosMahnstufeBestaetigung'] ?? 0,
                    'PosMahnfolgetage' => $data['PosMahnfolgetage'] ?? 0,
                    'PosMahnfolgetageBestaetigung' => $data['PosMahnfolgetageBestaetigung'] ?? 0,
                ]);

        } catch (Throwable $e) {
            Log::error('Failed to update/create Position4Lieferung', [
                'error' => $e->getMessage(),
                'internePositionsnummer' => $this->internePositionsnummer,
            ]);
            return null;
        }
    }

}
