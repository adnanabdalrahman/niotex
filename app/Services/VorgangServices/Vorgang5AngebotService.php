<?php

namespace App\Services\VorgangServices;

use App\Models\Vorgang5Angebot;

class Vorgang5AngebotService
{

    public function saveVorgang5Angebot($data, $interneVorgangsnummer): bool
    {
        return
            Vorgang5Angebot::insert([
                'InterneVorgangsnummer' => $interneVorgangsnummer,
                'VorAngebotVerfolgenJN' => $data['VorAngebotVerfolgenJN'] ?? 1,
                'VorAbschlussOutlookIsTask' => $data['VorAbschlussOutlookIsTask'] ?? 0,
                'VorWiederVorlageOutlookIsTask' => $data['VorWiederVorlageOutlookIsTask'] ?? 0,
            ]);
    }


}
