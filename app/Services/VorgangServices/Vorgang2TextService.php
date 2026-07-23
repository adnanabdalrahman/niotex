<?php

namespace App\Services\VorgangServices;

use App\Models\Vorgang2Text;

class Vorgang2TextService
{
    public function saveVorgang2Text($data, $interneVorgangsnummer): bool
    {
        return Vorgang2Text::insert([
            'InterneVorgangsnummer' => $interneVorgangsnummer,
            'VorNotiz' => $data['VorNotiz'] ?? null,
        ]);
    }
}
