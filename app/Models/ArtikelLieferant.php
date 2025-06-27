<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $ArtikelLieferantID
 * @property int $InterneAdressnummer
 * @property int $InterneArtikelnummer
 * @property string|null $AliBestellnummer
 * @property string|null $AliLieferzeit
 * @property float $AliLetzterEK
 * @property float|null $AliProzentualeZusatzKostenEK
 * @property string|null $AliLetzterEinkaufAm
 * @property float $AliLetzteMenge1
 * @property float $AliLetzteMenge2
 * @property float $AliLetzterRabatt1
 * @property float $AliLetzterRabatt2
 * @property float $AliLetzterRabatt3
 * @property float $AliLetzterRabattWert1
 * @property float $AliLetzterRabattWert2
 * @property string|null $AliLetzteAnfrageAm
 * @property string|null $AliLetztesAngebotAm
 * @property string|null $AliAngebotGueltigBis
 * @property float $AliMindestbestellmenge
 * @property float|null $AliMengeProVerpackungseinheit
 * @property string|null $AliNotiz
 * @property string|null $AliArtikelBezeichnung2
 * @property int $AliStammlieferantJN
 * @property int|null $AliTerminguete
 * @property int|null $AliQualitaetsguete
 * @property int|null $AliLieferzeitTage
 * @property int $AliErstmusterFreigabeJN
 * @property string|null $AliErstmusterFreigabeAm
 * @property string|null $AliAnlageAm
 * @property int|null $AliAnlageDurch
 * @property string|null $AliLetzteAenderungAm
 * @property int|null $AliLetzteAenderungDurch
 * @property int|null $NRPreisbasis
 * @property string|null $AliEdiKennung
 * @property int|null $AliGarantieLaufzeit
 * @property int $AliLiefersperreJN
 * @property string|null $KZAdresseRabattgruppe
 * @property int|null $AliPreisNummer
 * @property string|null $AliIndividualC1
 * @property string|null $AliIndividualC2
 * @property string|null $AliIndividualC3
 * @property float|null $AliIndividualD1
 * @property float|null $AliIndividualD2
 * @property float|null $AliIndividualD3
 * @property string|null $AliIndividualT1
 * @property string|null $AliIndividualT2
 * @property string|null $AliArtikelBezeichnung1
 * @property int $AliPreisProMengeneinheit2
 * @property string|null $AliIndividualT3
 * @property int|null $AliIndividualCombo1
 * @property int|null $AliIndividualCombo2
 * @property int|null $AliIndividualCombo3
 * @property string|null $TimeStamp
 * @property float|null $AliEKNeu
 * @property string|null $AliEKNeuDatum
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliAngebotGueltigBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliAnlageAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliAnlageDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliArtikelBezeichnung1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliArtikelBezeichnung2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliBestellnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliEKNeu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliEKNeuDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliEdiKennung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliErstmusterFreigabeAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliErstmusterFreigabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliGarantieLaufzeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualC1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualC2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualC3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualCombo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualCombo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualCombo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualD1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualD2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualD3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualT1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualT2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualT3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzteAenderungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzteAenderungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzteAnfrageAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzteMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzteMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterEinkaufAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterRabatt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterRabatt2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterRabatt3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterRabattWert1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterRabattWert2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetztesAngebotAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLiefersperreJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLieferzeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLieferzeitTage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliMengeProVerpackungseinheit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliMindestbestellmenge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliPreisNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliPreisProMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliProzentualeZusatzKostenEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliQualitaetsguete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliStammlieferantJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliTerminguete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereArtikelLieferantID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereInterneAdressnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereInterneArtikelnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereKZAdresseRabattgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereNRPreisbasis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereTimeStamp($value)
 * @mixin Eloquent
 */
class ArtikelLieferant extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.ArtikelLieferant';
    protected $primaryKey = 'ArtikelLieferantID';
    protected $guarded = [];
}
