<?php

namespace App\Services\VorgangServices;

use App\Models\Vorgang3Zahlung;
use Illuminate\Support\Facades\Log;
use Throwable;

class Vorgang3ZahlungService
{
    protected string $interneVorgangsnummer;

    public function __construct($interneVorgangsnummer)
    {
        $this->interneVorgangsnummer = $interneVorgangsnummer;
    }

    public function saveVorgang3Zahlung($data): ?Vorgang3Zahlung
    {

        try {
            return Vorgang3Zahlung::updateOrCreate(
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                ],
                [
                    'VorSonderkonditionenJN' => $data['VorSonderkonditionenJN'] ?? 0,
                    'VorBonusAbrechnungJN' => $data['VorBonusAbrechnungJN'] ?? 0,
                    'VorZbdVariabelJN' => $data['VorZbdVariabelJN'] ?? 0,
                ]
            );


        } catch (Throwable $e) {
            Log::error('Failed to update/create Vorgang3Zahlung', [
                'error' => $e->getMessage(),
                'InterneVorgangsnummer' => $this->interneVorgangsnummer,
            ]);
            return null;
        }
    }


}
