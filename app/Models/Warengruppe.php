<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $KZWarengruppe
 * @property string|null $WgrBezeichnung
 * @property string|null $WgrArtikelart
 * @property string|null $KZWgrMengeneinheit1
 * @property string|null $KZWgrMengeneinheit2
 * @property int|null $WgrTypMengeneinheit2
 * @property string|null $WgrTextArtikelnummer
 * @property string|null $WgrTextAbmasse1
 * @property string|null $WgrTextAbmasse2
 * @property string|null $WgrTextAbmasse3
 * @property string|null $WgrTextAbmasse4
 * @property int|null $WgrNummerAbmasse1
 * @property int|null $WgrNummerAbmasse2
 * @property int|null $WgrNummerAbmasse3
 * @property int|null $WgrNummerAbmasse4
 * @property int|null $WgrNachkommaAbmasse1
 * @property int|null $WgrNachkommaAbmasse2
 * @property int|null $WgrNachkommaAbmasse3
 * @property int|null $WgrNachkommaAbmasse4
 * @property int $WgrArtikelgruppenfaehig
 * @property int $WgrLieferantenfaehig
 * @property int $WgrLagerfaehig
 * @property int $WgrDisponierbar
 * @property int $WgrFertigungsfaehig
 * @property int $WgrVerkaufsfaehig
 * @property int $WgrFremdfertigungJN
 * @property int $WgrBonusberechtigt
 * @property int $WgrUrsprungsnachweisJN
 * @property int $WgrBaugruppeJN
 * @property int $WgrMengeneinheit2faehig
 * @property int $WgrPreisProMengeneinheit2
 * @property string|null $WgrFormelVerkaufspreis
 * @property string|null $WgrPicture
 * @property string|null $WgrWhen
 * @property string|null $WgrValid
 * @property float $WgrVerschnitt
 * @property int $WgrAutoAbbuchen
 * @property int $WgrAutoZubuchen
 * @property int|null $WgrAbbuchungsmethode
 * @property int|null $WgrDispoart
 * @property float $WgrRundungsfaktorVK
 * @property float $WgrRestmenge
 * @property int $WgrRestmengeME
 * @property float $WgrAbzugEK
 * @property float|null $WgrSpeditionProzent
 * @property int|null $WgrEigenmasseField
 * @property float|null $WgrProvisionProzent
 * @property int|null $WgrWiederbeschaffungszeit
 * @property int|null $FKtoNummer
 * @property int|null $LinecardID
 * @property int|null $WgrFibuKontoGruppeAR
 * @property int|null $WgrFibuKontoGruppeVB
 * @property int $WgrFilialExportJN
 * @property int $WgrSeriennummernfaehigJN
 * @property int $WgrChargenfaehigJN
 * @property int $WgrSnrHerstelldatum
 * @property int $WgrSnrVerfallsdatum
 * @property int|null $WgrSnrHaltbarkeitszeitraum
 * @property int $WgrChargeHerstelldatum
 * @property int $WgrChargeVerfallsdatum
 * @property int|null $WgrChargeHaltbarkeitszeitraum
 * @property int|null $WgrWPTyp
 * @property string|null $TimeStamp
 * @property int|null $WgrPickingMethode
 * @property int $WgrInaktivJN
 * @property int $WgrWerkzeugJN
 * @property int $WgrPruefmittelJN
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereFKtoNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereKZWarengruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereKZWgrMengeneinheit1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereKZWgrMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereLinecardID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrAbbuchungsmethode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrAbzugEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrArtikelart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrArtikelgruppenfaehig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrAutoAbbuchen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrAutoZubuchen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrBaugruppeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrBezeichnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrBonusberechtigt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrChargeHaltbarkeitszeitraum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrChargeHerstelldatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrChargeVerfallsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrChargenfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrDispoart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrDisponierbar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrEigenmasseField($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrFertigungsfaehig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrFibuKontoGruppeAR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrFibuKontoGruppeVB($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrFilialExportJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrFormelVerkaufspreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrFremdfertigungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrInaktivJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrLagerfaehig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrLieferantenfaehig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrMengeneinheit2faehig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrNachkommaAbmasse1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrNachkommaAbmasse2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrNachkommaAbmasse3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrNachkommaAbmasse4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrNummerAbmasse1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrNummerAbmasse2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrNummerAbmasse3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrNummerAbmasse4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrPickingMethode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrPicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrPreisProMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrProvisionProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrPruefmittelJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrRestmenge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrRestmengeME($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrRundungsfaktorVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrSeriennummernfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrSnrHaltbarkeitszeitraum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrSnrHerstelldatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrSnrVerfallsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrSpeditionProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrTextAbmasse1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrTextAbmasse2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrTextAbmasse3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrTextAbmasse4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrTextArtikelnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrTypMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrUrsprungsnachweisJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrVerkaufsfaehig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrVerschnitt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrWPTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrWerkzeugJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrWhen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warengruppe whereWgrWiederbeschaffungszeit($value)
 * @mixin \Eloquent
 */
class Warengruppe extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Warengruppe';
    protected $primaryKey = 'KZWarengruppe';
    protected $guarded = [];

}
