<?php

namespace App\Services\PositionServices;

use App\Models\Position7Zusatz;

class Position7ZusatzService
{
    public function savePosition7Zusatz($data, $internePositionsnummer): bool
    {
        return Position7Zusatz::insert(
            [
                'InternePositionsnummer' => $internePositionsnummer,
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
    }

}
