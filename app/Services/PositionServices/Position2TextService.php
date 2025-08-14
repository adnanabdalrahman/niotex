<?php

namespace App\Services\PositionServices;

use App\Models\Artikel;
use App\Models\Position2Text;
use Illuminate\Support\Facades\Log;
use Throwable;

class Position2TextService
{
    protected string $internePositionsnummer;

    public function __construct($internePositionsnummer)
    {
        $this->internePositionsnummer = $internePositionsnummer;
    }

    public function SavePosition2Text($data, Artikel $artikel): ?Position2Text
    {

        try {
            return Position2Text::updateOrCreate(
                ['InternePositionsnummer' => $this->internePositionsnummer],
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                    'PosZusatztextLieferschein' => $data['PosZusatztextLieferschein'] ?? null,
                    'PosZusatztext' => $data['PosZusatztext'] ?? null,
                    'PosNotiz' => $data['PosNotiz'] ?? null,
                    'PosBezeichnung2' => $artikel->ArtBezeichnung2,
                ]);

        } catch (Throwable $e) {
            Log::error('Failed to update/create Position2TextService', [
                'error' => $e->getMessage(),
                'internePositionsnummer' => $this->internePositionsnummer,
            ]);
            return null;
        }
    }


    public function SavePosition2TextMaster($data): ?Position2Text
    {
        try {
            return Position2Text::updateOrCreate(
                ['InternePositionsnummer' => $this->internePositionsnummer],
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                    'PosZusatztextLieferschein' => $data['PosZusatztextLieferschein'] ?? null,
                    'PosZusatztext' => $data['PosZusatztext'] ?? null,
                    'PosNotiz' => $data['PosNotiz'] ?? null,
                    'PosBezeichnung2' => $data['PosBezeichnung2'],
                ]);

        } catch (Throwable $e) {
            Log::error('Failed to update/create Position2TextService', [
                'error' => $e->getMessage(),
                'internePositionsnummer' => $this->internePositionsnummer,
            ]);
            return null;
        }
    }

}
