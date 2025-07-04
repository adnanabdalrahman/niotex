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
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'] ?? 0,
                    'PosWPreisPositionGesamt' => $data['externGesamtPreis'] ?? 0,
                    'PosWPreisPositionAuftrag' => $data['externGesamtPreis'] ?? 0,
                    'PosWPreisPositionAbrechnung' => $data['externGesamtPreis'] ?? 0,
                    'PosWPreisPositionLieferung' => $data['externGesamtPreis'] ?? 0,
                    'PosWPreisPositionVersand' => $data['externGesamtPreis'] ?? 0,
                    'PosWPreisPositionGut' => $data['externGesamtPreis'] ?? 0,
                    'PosWPreisPositionRechnung' => $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisVorRabattGes' => $data['PosWGesamtpreisVorRabattGes'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisVorRabattAuf' => $data['PosWGesamtpreisVorRabattAuf'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisVorRabattAbr' => $data['PosWGesamtpreisVorRabattAbr'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisVorRabattLief' => $data['PosWGesamtpreisVorRabattLief'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisVorRabattVers' => $data['PosWGesamtpreisVorRabattVers'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisVorRabattGut' => $data['PosWGesamtpreisVorRabattGut'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisVorRabattRec' => $data['PosWGesamtpreisVorRabattRec'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisGesamt' => $data['PosWGesamtpreisGesamt'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisAuftrag' => $data['PosWGesamtpreisAuftrag'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisAbrechnung' => $data['PosWGesamtpreisAbrechnung'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisLieferung' => $data['PosWGesamtpreisLieferung'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisVersand' => $data['PosWGesamtpreisVersand'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisGut' => $data['PosWGesamtpreisGut'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWGesamtpreisRechnung' => $data['PosWGesamtpreisRechnung'] ?? $data['externGesamtPreis'] ?? 0,
                    'PosWEinzelpreisMinusRabatt' => $data['PosWEinzelpreisMinusRabatt'] ?? $data['externEinzelPreis'] ?? 0,
                    'PosWMengeGesamt1' => $data['PosWMengeGesamt1'] ?? $data['externMenge'] ?? 0,
                    'PosWMengeAuftrag1' => $data['PosWMengeAuftrag1'] ?? $data['externMenge'] ?? 0,
                    'PosWMengeAbrechnung1' => $data['PosWMengeAbrechnung1'] ?? $data['externMenge'] ?? 0,
                    'PosWMengeLieferung1' => $data['PosWMengeLieferung1'] ?? $data['externMenge'] ?? 0,
                    'PosWMengeVersand1' => $data['PosWMengeVersand1'] ?? $data['externMenge'] ?? 0,
                    'PosWMengeGut1' => $data['PosWMengeGut1'] ?? $data['externMenge'] ?? 0,
                    'PosWMengeRechnung1' => $data['PosWMengeRechnung1'] ?? $data['externMenge'] ?? 0,
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
                'error' => $e->getMessage(),
                'internePositionsnummer' => $this->internePositionsnummer,
            ]);
            return null;
        }
    }

}
