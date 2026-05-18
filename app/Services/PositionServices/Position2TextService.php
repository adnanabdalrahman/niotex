<?php

namespace App\Services\PositionServices;

use App\Models\Artikel;
use App\Models\Position2Text;

class Position2TextService
{
    public function SavePosition2Text($data, Artikel $artikel, $internePositionsnummer): bool
    {
        return Position2Text::insert(
            [
                'InternePositionsnummer' => $internePositionsnummer,
                'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                'PosZusatztextLieferschein' => $data['PosZusatztextLieferschein'] ?? null,
                'PosZusatztext' => $data['PosZusatztext'] ?? null,
                'PosNotiz' => $data['PosNotiz'] ?? null,
                'PosBezeichnung2' => $artikel->ArtBezeichnung2,
            ]);


    }
    
}
