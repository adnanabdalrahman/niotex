<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $VorgangWertID
 * @property int $InterneVorgangsnummer
 * @property float|null $VorWBruttowertGesamt
 * @property float|null $VorWBruttowertAuftrag
 * @property float|null $VorWBruttowertAbrechnung
 * @property float|null $VorWBruttowertLieferung
 * @property float|null $VorWBruttowertVersand
 * @property float|null $VorWBruttowertGut
 * @property float|null $VorWBruttowertRechnung
 * @property float|null $VorWNettoPlusZusatzGesamt
 * @property float|null $VorWNettoPlusZusatzAuftrag
 * @property float|null $VorWNettoPlusZusatzAbrechnung
 * @property float|null $VorWNettoPlusZusatzLieferung
 * @property float|null $VorWNettoPlusZusatzVersand
 * @property float|null $VorWNettoPlusZusatzGut
 * @property float|null $VorWNettoPlusZusatzRechnung
 * @property float|null $VorWNettoMinusRabattGesamt
 * @property float|null $VorWNettoMinusRabattAuftrag
 * @property float|null $VorWNettoMinusRabattAbrechnung
 * @property float|null $VorWNettoMinusRabattLieferung
 * @property float|null $VorWNettoMinusRabattVersand
 * @property float|null $VorWNettoMinusRabattGut
 * @property float|null $VorWNettoMinusRabattRechnung
 * @property float|null $VorWNettoMinusAKontoAbrechnung
 * @property float|null $VorWNettoMinusAKontoLieferung
 * @property float|null $VorWNettoMinusAKontoRechnung
 * @property float|null $VorWNettowertGesamt
 * @property float|null $VorWNettowertAuftrag
 * @property float|null $VorWNettowertAbrechnung
 * @property float|null $VorWNettowertLieferung
 * @property float|null $VorWNettowertVersand
 * @property float|null $VorWNettowertGut
 * @property float|null $VorWNettowertRechnung
 * @property float|null $VorWNettowertMwst1Gesamt
 * @property float|null $VorWNettowertMwst1Auftrag
 * @property float|null $VorWNettowertMwst1Abrechnung
 * @property float|null $VorWNettowertMwst1Lieferung
 * @property float|null $VorWNettowertMwst1Versand
 * @property float|null $VorWNettowertMwst1Gut
 * @property float|null $VorWNettowertMwst1Rechnung
 * @property float|null $VorWNettowertMwst2Gesamt
 * @property float|null $VorWNettowertMwst2Auftrag
 * @property float|null $VorWNettowertMwst2Abrechnung
 * @property float|null $VorWNettowertMwst2Lieferung
 * @property float|null $VorWNettowertMwst2Versand
 * @property float|null $VorWNettowertMwst2Gut
 * @property float|null $VorWNettowertMwst2Rechnung
 * @property float|null $VorWNettowertMwst3Gesamt
 * @property float|null $VorWNettowertMwst3Auftrag
 * @property float|null $VorWNettowertMwst3Abrechnung
 * @property float|null $VorWNettowertMwst3Lieferung
 * @property float|null $VorWNettowertMwst3Versand
 * @property float|null $VorWNettowertMwst3Gut
 * @property float|null $VorWNettowertMwst3Rechnung
 * @property float|null $VorWNettoEKGesamt
 * @property float|null $VorWNettoEKAuftrag
 * @property float|null $VorWNettoEKAbrechnung
 * @property float|null $VorWNettoEKLieferung
 * @property float|null $VorWNettoEKVersand
 * @property float|null $VorWNettoEKGut
 * @property float|null $VorWNettoEKRechnung
 * @property float|null $VorWNettoEKOhneNKGesamt
 * @property float|null $VorWNettoEKOhneNKVTGesamt
 * @property float|null $VorWNettoEKVTGesamt
 * @property float|null $VorWNettoEKVTAuftrag
 * @property float|null $VorWNettoEKVTAbrechnung
 * @property float|null $VorWNettoEKVTLieferung
 * @property float|null $VorWNettoEKVTVersand
 * @property float|null $VorWNettoEKVTGut
 * @property float|null $VorWNettoEKVTRechnung
 * @property float|null $VorWGewichtGesamt
 * @property float|null $VorWGewichtAuftrag
 * @property float|null $VorWGewichtAbrechnung
 * @property float|null $VorWGewichtLieferung
 * @property float|null $VorWGewichtVersand
 * @property float|null $VorWGewichtGut
 * @property float|null $VorWGewichtRechnung
 * @property string|null $TimeStamp
 * @method static Builder<static>|VorgangWert newModelQuery()
 * @method static Builder<static>|VorgangWert newQuery()
 * @method static Builder<static>|VorgangWert query()
 * @method static Builder<static>|VorgangWert whereInterneVorgangsnummer($value)
 * @method static Builder<static>|VorgangWert whereTimeStamp($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertGut($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtGut($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKGut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKOhneNKGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKOhneNKVTGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTGut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusAKontoAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusAKontoLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusAKontoRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattGut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzGut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertGut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Abrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Auftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Gesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Gut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Lieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Rechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Versand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Abrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Auftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Gesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Gut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Lieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Rechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Versand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Abrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Auftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Gesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Gut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Lieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Rechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Versand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertVersand($value)
 * @method static Builder<static>|VorgangWert whereVorgangWertID($value)
 * @mixin Eloquent
 */
class VorgangWert extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.VorgangWert';
    protected $primaryKey = 'InterneVorgangsnummer';
    protected $guarded = [];
}
