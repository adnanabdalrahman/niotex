<?php

namespace App\Services\PositionServices;

use App\Models\Position7Zusatz;
use Illuminate\Support\Facades\Log;
use Throwable;

class Position7ZusatzService
{
    protected string $internePositionsnummer;

    public function __construct($internePositionsnummer)
    {
        $this->internePositionsnummer = $internePositionsnummer;
    }

    public function savePosition7Zusatz($data): ?Position7Zusatz
    {
        try {
            return Position7Zusatz::updateOrCreate(
                ['InternePositionsnummer' => $this->internePositionsnummer],
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                    'PosErsatzteilJN' => $data['PosErsatzteilJN'] ?? 0,
                    'PosPraeferenzJNA' => $data['PosPraeferenzJNA'] ?? 0,
                    'PosPraeferenzDynamischJN' => $data['PosPraeferenzDynamischJN'] ?? 0,
                    'PosPraeferenzWert' => $data['PosPraeferenzWert'] ?? 0,
                    'PosServiceJN' => $data['PosServiceJN'] ?? 0,
                    'PosAusNachkalkulationJN' => $data['PosAusNachkalkulationJN'] ?? 0,
                    'PosMTZFixiertJN' => $data['PosMTZFixiertJN'] ?? 0,
                    'PosBuchungsfreigabeJN' => $data['PosBuchungsfreigabeJN'] ?? 0,
                ]);

        } catch (Throwable $e) {
            Log::error('Failed to update/create Position7Zusatz', [
                'error' => $e->getMessage(),
                'internePositionsnummer' => $this->internePositionsnummer,
            ]);
            return null;
        }
    }

}
