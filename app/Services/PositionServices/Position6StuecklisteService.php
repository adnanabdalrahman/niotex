<?php

namespace App\Services\PositionServices;

use App\Models\Position6Stueckliste;

class Position6StuecklisteService
{
    public function savePosition6Stueckliste($data, $internePositionsnummer): bool
    {
        return Position6Stueckliste::insert(
            [
                'InternePositionsnummer' => $internePositionsnummer,
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
    }

}
