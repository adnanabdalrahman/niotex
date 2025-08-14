<?php

namespace App\Services\VorgangServices;

use App\Models\Vorgang4Versand;
use Illuminate\Support\Facades\Log;
use Throwable;

class Vorgang4VersandService
{
    protected string $interneVorgangsnummer;

    public function __construct($interneVorgangsnummer)
    {
        $this->interneVorgangsnummer = $interneVorgangsnummer;
    }

    public function saveVorgang4Versand($data): ?Vorgang4Versand
    {

        try {
            return Vorgang4Versand::updateOrCreate(
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                ],
                [
                    'VorTransportversicherungJN' => $data['VorTransportversicherungJN'] ?? 0,
                    'VorVersandPrivatZustJN' => $data['VorVersandPrivatZustJN'] ?? 0,
                ]
            );


        } catch (Throwable $e) {
            Log::error('Failed to update/create Vorgang4Versand', [
                'error' => $e->getMessage(),
                'InterneVorgangsnummer' => $this->interneVorgangsnummer,
            ]);
            return null;
        }
    }


}
