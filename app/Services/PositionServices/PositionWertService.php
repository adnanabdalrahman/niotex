<?php

namespace App\Services\PositionServices;

use App\Models\PositionWert;
use Illuminate\Support\Facades\Log;
use Throwable;

class PositionWertService
{
    protected string $internePositionsnummer;

    public function __construct($internePositionsnummer)
    {
        $this->internePositionsnummer = $internePositionsnummer;
    }


    public function savePositionWert($data): ?PositionWert
    {
        try {
            return PositionWert::updateOrCreate(
                ['InternePositionsnummer' => $this->internePositionsnummer],
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                    'PosWPreisPositionGesamt' => $data['externGesamtPris'],
                    'PosWPreisPositionAuftrag' => $data['externGesamtPris'],
                    'PosWPreisPositionAbrechnung' => $data['externGesamtPris'],
                    'PosWPreisPositionLieferung' => $data['externGesamtPris'],
                    'PosWPreisPositionVersand' => $data['externGesamtPris'],
                    'PosWPreisPositionGut' => $data['externGesamtPris'],
                    'PosWPreisPositionRechnung' => $data['externGesamtPris'],
                    'PosWGesamtpreisVorRabattGes' => $data['PosWGesamtpreisVorRabattGes'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisVorRabattAuf' => $data['PosWGesamtpreisVorRabattAuf'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisVorRabattAbr' => $data['PosWGesamtpreisVorRabattAbr'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisVorRabattLief' => $data['PosWGesamtpreisVorRabattLief'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisVorRabattVers' => $data['PosWGesamtpreisVorRabattVers'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisVorRabattGut' => $data['PosWGesamtpreisVorRabattGut'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisVorRabattRec' => $data['PosWGesamtpreisVorRabattRec'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisGesamt' => $data['PosWGesamtpreisGesamt'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisAuftrag' => $data['PosWGesamtpreisAuftrag'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisAbrechnung' => $data['PosWGesamtpreisAbrechnung'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisLieferung' => $data['PosWGesamtpreisLieferung'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisVersand' => $data['PosWGesamtpreisVersand'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisGut' => $data['PosWGesamtpreisGut'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisRechnung' => $data['PosWGesamtpreisRechnung'] ?? $data['externGesamtPris'],
                    'PosWGesamtpreisEKGesamt' => $data['PosWGesamtpreisEKGesamt'] ?? 0,
                    'PosWGesamtpreisEKAuftrag' => $data['PosWGesamtpreisEKAuftrag'] ?? 0,
                    'PosWGesamtpreisEKAbrechnung' => $data['PosWGesamtpreisEKAbrechnung'] ?? 0,
                    'PosWGesamtpreisEKLieferung' => $data['PosWGesamtpreisEKLieferung'] ?? 0,
                    'PosWGesamtpreisEKVersand' => $data['PosWGesamtpreisEKVersand'] ?? 0,
                    'PosWGesamtpreisEKGut' => $data['PosWGesamtpreisEKGut'] ?? 0,
                    'PosWGesamtpreisEKRechnung' => $data['PosWGesamtpreisEKRechnung'] ?? 0,
                    'PosWGesamtpreisEKVTGesamt' => $data['PosWGesamtpreisEKVTGesamt'] ?? 0,
                    'PosWGesamtpreisEKVTAuftrag' => $data['PosWGesamtpreisEKVTAuftrag'] ?? 0,
                    'PosWGesamtpreisEKVTAbrechnung' => $data['PosWGesamtpreisEKVTAbrechnung'] ?? 0,
                    'PosWGesamtpreisEKVTLieferung' => $data['PosWGesamtpreisEKVTLieferung'] ?? 0,
                    'PosWGesamtpreisEKVTVersand' => $data['PosWGesamtpreisEKVTVersand'] ?? 0,
                    'PosWGesamtpreisEKVTGut' => $data['PosWGesamtpreisEKVTGut'] ?? 0,
                    'PosWGesamtpreisEKVTRechnung' => $data['PosWGesamtpreisEKVTRechnung'] ?? 0,
                    'PosWEinzelpreisMinusRabatt' => $data['PosWEinzelpreisMinusRabatt'] ?? 0,
                    'PosWMengeGesamt1' => $data['PosWMengeGesamt1'],
                    'PosWMengeAuftrag1' => $data['PosWMengeAuftrag1'],
                    'PosWMengeAbrechnung1' => $data['PosWMengeAbrechnung1'],
                    'PosWMengeLieferung1' => $data['PosWMengeLieferung1'],
                    'PosWMengeVersand1' => $data['PosWMengeVersand1'],
                    'PosWMengeGut1' => $data['PosWMengeGut1'],
                    'PosWMengeRechnung1' => $data['PosWMengeRechnung1'],
                    'PosWMengeAuftrag2' => $data['PosWMengeAuftrag2'] ?? 0,
                    'PosWMengeAbrechnung2' => $data['PosWMengeAbrechnung2'] ?? 0,
                    'PosWMengeLieferung2' => $data['PosWMengeLieferung2'] ?? 0,
                    'PosWMengeVersand2' => $data['PosWMengeVersand2'] ?? 0,
                    'PosWMengeGesamt2' => $data['PosWMengeGesamt2'] ?? 0,
                    'PosWMengeGut2' => $data['PosWMengeGut2'] ?? 0,
                    'PosWMengeRechnung2' => $data['PosWMengeRechnung2'] ?? 0,
                ]);

        } catch (Throwable $e) {
            Log::error('Failed to update/create Position1Wert', [
                'error' => $e,
                'internePositionsnummer' => $this->internePositionsnummer,
                'data' => $data
            ]);
            return null;
        }
    }

}
