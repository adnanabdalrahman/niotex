<?php

namespace App\Services\VorgangServices;

use App\Models\Vorgang5Angebot;
use Illuminate\Support\Facades\Log;
use Throwable;

class Vorgang5AngebotService
{
    protected string $interneVorgangsnummer;

    public function __construct($interneVorgangsnummer)
    {
        $this->interneVorgangsnummer = $interneVorgangsnummer;
    }

    public function saveVorgang5Angebot($data): ?Vorgang5Angebot
    {

        try {
            return Vorgang5Angebot::updateOrCreate(
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                ],
                [
                    'VorAngebotVerfolgenJN' => $data['VorAngebotVerfolgenJN'] ?? 1,
                    'VorAbschlussOutlookIsTask' => $data['VorAbschlussOutlookIsTask'] ?? 0,
                    'VorWiederVorlageOutlookIsTask' => $data['VorWiederVorlageOutlookIsTask'] ?? 0,
                ]
            );


        } catch (Throwable $e) {
            Log::error('Failed to update/create Vorgang5Angebot', [
                'error' => $e->getMessage(),
                'InterneVorgangsnummer' => $this->interneVorgangsnummer,
            ]);
            return null;
        }
    }


}
