<?php

namespace App\Services\PositionServices;

use App\Models\Position4Lieferung;

class Position4LieferungService
{

    public function savePosition4Lieferung($data, $internePositionsnummer): bool
    {
        return Position4Lieferung::insert(
            ['InternePositionsnummer' => $internePositionsnummer,
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'PosLiefertermineJN' => $data['PosLiefertermineJN'] ?? 0,
                'PosVerladenJN' => $data['PosVerladenJN'] ?? 0,
                'PosMahnstufe' => $data['PosMahnstufe'] ?? 0,
                'PosMahnstufeBestaetigung' => $data['PosMahnstufeBestaetigung'] ?? 0,
                'PosMahnfolgetage' => $data['PosMahnfolgetage'] ?? 0,
                'PosMahnfolgetageBestaetigung' => $data['PosMahnfolgetageBestaetigung'] ?? 0,
            ]);
    }

}
