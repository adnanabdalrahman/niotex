<?php

namespace App\Services\PositionServices;

use App\Models\Position6Stueckliste;
use Illuminate\Support\Facades\Log;
use Throwable;

class Position6StuecklisteService
{
    protected string $internePositionsnummer;

    public function __construct($internePositionsnummer)
    {
        $this->internePositionsnummer = $internePositionsnummer;
    }

    public function savePosition6Stueckliste($data): ?Position6Stueckliste
    {
        try {
            return Position6Stueckliste::updateOrCreate(
                ['InternePositionsnummer' => $this->internePositionsnummer],
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
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

        } catch (Throwable $e) {
            Log::error('Failed to update/create Position6Stueckliste', [
                'error' => $e->getMessage(),
                'internePositionsnummer' => $this->internePositionsnummer,
            ]);
            return null;
        }
    }

}
