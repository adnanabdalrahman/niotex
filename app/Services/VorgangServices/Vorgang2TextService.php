<?php

namespace App\Services\VorgangServices;

use App\Models\Vorgang2Text;
use Illuminate\Support\Facades\Log;
use Throwable;

class Vorgang2TextService
{
    protected string $interneVorgangsnummer;

    public function __construct($interneVorgangsnummer)
    {
        $this->interneVorgangsnummer = $interneVorgangsnummer;
    }

    public function saveVorgang2Text($data): ?Vorgang2Text
    {

        try {
            return Vorgang2Text::updateOrCreate(
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                ],
                [
                    'VorNotiz' => $data['VorNotiz'] ?? NULL
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
