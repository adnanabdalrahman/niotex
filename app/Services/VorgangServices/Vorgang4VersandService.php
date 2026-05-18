<?php

namespace App\Services\VorgangServices;

use App\Models\Vorgang4Versand;

class Vorgang4VersandService
{

    public function saveVorgang4Versand($data, $interneVorgangsnummer): bool
    {
        return Vorgang4Versand::insert([
            'InterneVorgangsnummer' => $interneVorgangsnummer,
            'VorTransportversicherungJN' => $data['VorTransportversicherungJN'] ?? 0,
            'VorVersandPrivatZustJN' => $data['VorVersandPrivatZustJN'] ?? 0,
        ]);

    }


}
