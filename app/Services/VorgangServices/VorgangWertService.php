<?php

namespace App\Services\VorgangServices;

use App\Models\VorgangWert;
use Illuminate\Support\Facades\Log;
use Throwable;

class VorgangWertService
{
    protected string $interneVorgangsnummer;

    public function __construct($interneVorgangsnummer)
    {
        $this->interneVorgangsnummer = $interneVorgangsnummer;
    }

    public function saveVorgangWert($data): ?VorgangWert
    {

        try {
            return VorgangWert::updateOrCreate(
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                ],
                [
                    'VorWBruttowertGesamt' => $data['VorWBruttowertGesamt'] ?? 0,
                    'VorWBruttowertAuftrag' => $data['VorWBruttowertAuftrag'] ?? 0,
                    'VorWBruttowertAbrechnung' => $data['VorWBruttowertAbrechnung'] ?? 0,
                    'VorWBruttowertLieferung' => $data['VorWBruttowertLieferung'] ?? 0,
                    'VorWBruttowertVersand' => $data['VorWBruttowertVersand'] ?? 0,
                    'VorWBruttowertGut' => $data['VorWBruttowertGut'] ?? 0,
                    'VorWBruttowertRechnung' => $data['VorWBruttowertRechnung'] ?? 0,
                    'VorWNettoPlusZusatzGesamt' => $data['VorWNettoPlusZusatzGesamt'] ?? 0,
                    'VorWNettoPlusZusatzAuftrag' => $data['VorWNettoPlusZusatzAuftrag'] ?? 0,
                    'VorWNettoPlusZusatzAbrechnung' => $data['VorWNettoPlusZusatzAbrechnung'] ?? 0,
                    'VorWNettoPlusZusatzLieferung' => $data['VorWNettoPlusZusatzLieferung'] ?? 0,
                    'VorWNettoPlusZusatzVersand' => $data['VorWNettoPlusZusatzVersand'] ?? 0,
                    'VorWNettoPlusZusatzGut' => $data['VorWNettoPlusZusatzGut'] ?? 0,
                    'VorWNettoPlusZusatzRechnung' => $data['VorWNettoPlusZusatzRechnung'] ?? 0,
                    'VorWNettoMinusRabattGesamt' => $data['VorWNettoMinusRabattGesamt'] ?? 0,
                    'VorWNettoMinusRabattAuftrag' => $data['VorWNettoMinusRabattAuftrag'] ?? 0,
                    'VorWNettoMinusRabattAbrechnung' => $data['VorWNettoMinusRabattAbrechnung'] ?? 0,
                    'VorWNettoMinusRabattLieferung' => $data['VorWNettoMinusRabattLieferung'] ?? 0,
                    'VorWNettoMinusRabattVersand' => $data['VorWNettoMinusRabattVersand'] ?? 0,
                    'VorWNettoMinusRabattGut' => $data['VorWNettoMinusRabattGut'] ?? 0,
                    'VorWNettoMinusRabattRechnung' => $data['VorWNettoMinusRabattRechnung'] ?? 0,
                    'VorWNettoMinusAKontoAbrechnung' => $data['VorWNettoMinusAKontoAbrechnung'] ?? 0,
                    'VorWNettoMinusAKontoLieferung' => $data['VorWNettoMinusAKontoLieferung'] ?? 0,
                    'VorWNettoMinusAKontoRechnung' => $data['VorWNettoMinusAKontoRechnung'] ?? 0,
                    'VorWNettowertGesamt' => $data['VorWNettowertGesamt'] ?? 0,
                    'VorWNettowertAuftrag' => $data['VorWNettowertAuftrag'] ?? 0,
                    'VorWNettowertAbrechnung' => $data['VorWNettowertAbrechnung'] ?? 0,
                    'VorWNettowertLieferung' => $data['VorWNettowertLieferung'] ?? 0,
                    'VorWNettowertVersand' => $data['VorWNettowertVersand'] ?? 0,
                    'VorWNettowertGut' => $data['VorWNettowertGut'] ?? 0,
                    'VorWNettowertRechnung' => $data['VorWNettowertRechnung'] ?? 0,
                    'VorWNettowertMwst1Gesamt' => $data['VorWNettowertMwst1Gesamt'] ?? 0,
                    'VorWNettowertMwst1Auftrag' => $data['VorWNettowertMwst1Auftrag'] ?? 0,
                    'VorWNettowertMwst1Abrechnung' => $data['VorWNettowertMwst1Abrechnung'] ?? 0,
                    'VorWNettowertMwst1Lieferung' => $data['VorWNettowertMwst1Lieferung'] ?? 0,
                    'VorWNettowertMwst1Versand' => $data['VorWNettowertMwst1Versand'] ?? 0,
                    'VorWNettowertMwst1Gut' => $data['VorWNettowertMwst1Gut'] ?? 0,
                    'VorWNettoEKGesamt' => $data['VorWNettoEKGesamt'] ?? 0,
                    'VorWNettoEKAuftrag' => $data['VorWNettoEKAuftrag'] ?? 0,
                    'VorWNettoEKAbrechnung' => $data['VorWNettoEKAbrechnung'] ?? 0,
                    'VorWNettoEKLieferung' => $data['VorWNettoEKLieferung'] ?? 0,
                    'VorWNettoEKVersand' => $data['VorWNettoEKVersand'] ?? 0,
                    'VorWNettoEKGut' => $data['VorWNettoEKGut'] ?? 0,
                    'VorWNettoEKRechnung' => $data['VorWNettoEKRechnung'] ?? 0,
                    'VorWNettoEKOhneNKGesamt' => $data['VorWNettoEKOhneNKGesamt'] ?? 0,
                    'VorWNettoEKOhneNKVTGesamt' => $data['VorWNettoEKOhneNKVTGesamt'] ?? 0,
                    'VorWNettoEKVTGesamt' => $data['VorWNettoEKVTGesamt'] ?? 0,
                    'VorWNettoEKVTAuftrag' => $data['VorWNettoEKVTAuftrag'] ?? 0,
                    'VorWNettoEKVTAbrechnung' => $data['VorWNettoEKVTAbrechnung'] ?? 0,
                    'VorWNettoEKVTLieferung' => $data['VorWNettoEKVTLieferung'] ?? 0,
                    'VorWNettoEKVTVersand' => $data['VorWNettoEKVTVersand'] ?? 0,
                    'VorWNettoEKVTGut' => $data['VorWNettoEKVTGut'] ?? 0,
                    'VorWNettoEKVTRechnung' => $data['VorWNettoEKVTRechnung'] ?? 0,
                    'VorWGewichtGesamt' => $data['VorWGewichtGesamt'] ?? 0,
                    'VorWGewichtAuftrag' => $data['VorWGewichtAuftrag'] ?? 0,
                    'VorWGewichtAbrechnung' => $data['VorWGewichtAbrechnung'] ?? 0,
                    'VorWGewichtLieferung' => $data['VorWGewichtLieferung'] ?? 0,
                    'VorWGewichtVersand' => $data['VorWGewichtVersand'] ?? 0,
                    'VorWGewichtGut' => $data['VorWGewichtGut'] ?? 0,
                    'VorWGewichtRechnung' => $data['VorWGewichtRechnung'] ?? 0,
                ]
            );


        } catch (Throwable $e) {
            Log::error('Failed to update/create VorgangWert', [
                'error' => $e->getMessage(),
                'InterneVorgangsnummer' => $this->interneVorgangsnummer,
            ]);
            return null;
        }
    }


}
