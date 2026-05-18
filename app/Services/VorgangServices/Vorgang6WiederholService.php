<?php

namespace App\Services\VorgangServices;

use App\Models\Vorgang6Wiederhol;

class Vorgang6WiederholService
{

    public function saveVorgang6Wiederhol($data, $interneVorgangsnummer): bool
    {
        return
            Vorgang6Wiederhol::insert([
                'InterneVorgangsnummer' => $interneVorgangsnummer,
                'VorWiederholMonat' => $data['VorWiederholMonat'] ?? 0,
                'VorWiederholKennzeichen' => $data['VorWiederholKennzeichen'] ?? 0,
                'VorDruckKennzeichen' => $data['VorDruckKennzeichen'] ?? 0,
            ]);


    }
}
