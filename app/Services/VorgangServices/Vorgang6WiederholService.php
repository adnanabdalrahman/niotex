<?php

namespace App\Services\VorgangServices;

use App\Models\Vorgang6Wiederhol;
use Illuminate\Support\Facades\Log;
use Throwable;

class Vorgang6WiederholService
{
    protected string $interneVorgangsnummer;

    public function __construct($interneVorgangsnummer)
    {
        $this->interneVorgangsnummer = $interneVorgangsnummer;
    }

    public function saveVorgang6Wiederhol($data): ?Vorgang6Wiederhol
    {
        try {
            return Vorgang6Wiederhol::updateOrCreate(
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                ],
                [
                    'VorWiederholMonat' => $data['VorWiederholMonat'] ?? 0,
                    'VorWiederholKennzeichen' => $data['VorWiederholKennzeichen'] ?? 0,
                    'VorDruckKennzeichen' => $data['VorDruckKennzeichen'] ?? 0,
                ]
            );


        } catch (Throwable $e) {
            Log::error('Failed to update/create Vorgang2Text', [
                'error' => $e->getMessage(),
                'InterneVorgangsnummer' => $this->interneVorgangsnummer,
            ]);
            return null;
        }
    }


}
