<?php

namespace App\Services\VorgangServices;

use App\Models\Vorgang3Zahlung;

class Vorgang3ZahlungService
{


    public function saveVorgang3Zahlung($data, $interneVorgangsnummer): bool
    {
        return Vorgang3Zahlung::insert([
            'InterneVorgangsnummer' => $interneVorgangsnummer,
            'VorSonderkonditionenJN' => $data['VorSonderkonditionenJN'] ?? 0,
            'VorBonusAbrechnungJN' => $data['VorBonusAbrechnungJN'] ?? 0,
            'VorZbdVariabelJN' => $data['VorZbdVariabelJN'] ?? 0,
        ]);
    }


}
