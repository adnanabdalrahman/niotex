<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $ArtikelKundeID
 * @property int $InterneArtikelnummer
 * @property int $InterneAdressnummer
 * @property int|null $AkuErsatzartikel
 * @property string|null $AkuBestellnummer
 * @property float $AkuLetzterVK
 * @property float|null $AkuLetzterRabatt1
 * @property float|null $AkuLetzterRabatt2
 * @property float|null $AkuLetzterRabatt3
 * @property float $AkuLetzterRabattWert1
 * @property float $AkuLetzterRabattWert2
 * @property float $AkuLetzteMenge1
 * @property float $AkuLetzteMenge2
 * @property float|null $AkuMindestverkaufsmenge
 * @property float|null $AkuMengeProVerpackungseinheit
 * @property int|null $AkuLieferzeitTage
 * @property string|null $AkuArtikelBezeichnung2
 * @property string|null $AkuNotiz
 * @property float|null $AkuProvisionProzent
 * @property int|null $AkuTerminguete
 * @property string|null $AkuLetzterVerkaufAm
 * @property int|null $AkuLetzterVerkaufDurch
 * @property int|null $NRPreisbasis
 * @property string|null $AkuEdiKennung
 * @property int|null $AkuGarantieLaufzeit
 * @property int $AkuLiefersperreJN
 * @property string|null $KZAdresseRabattgruppe
 * @property int|null $AkuPreisNummer
 * @property string|null $AkuZeichnungsnummer
 * @property string|null $AkuZeichnungsformat
 * @property string|null $AkuIndividualC1
 * @property string|null $AkuIndividualC2
 * @property string|null $AkuIndividualC3
 * @property float|null $AkuIndividualD1
 * @property float|null $AkuIndividualD2
 * @property float|null $AkuIndividualD3
 * @property string|null $AkuIndividualT1
 * @property string|null $AkuIndividualT2
 * @property string|null $AkuArtikelBezeichnung1
 * @property int $AkuPreisProMengeneinheit2
 * @property string|null $AkuIndividualT3
 * @property int|null $AkuIndividualCombo1
 * @property int|null $AkuIndividualCombo2
 * @property int|null $AkuIndividualCombo3
 * @property string|null $TimeStamp
 * @property float|null $AkuVKBrutto
 * @property float|null $AkuVKNeu
 * @property string|null $AkuVKNeuDatum
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuArtikelBezeichnung1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuArtikelBezeichnung2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuBestellnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuEdiKennung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuErsatzartikel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuGarantieLaufzeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualC1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualC2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualC3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualCombo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualCombo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualCombo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualD1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualD2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualD3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualT1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualT2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuIndividualT3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLetzteMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLetzteMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLetzterRabatt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLetzterRabatt2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLetzterRabatt3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLetzterRabattWert1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLetzterRabattWert2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLetzterVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLetzterVerkaufAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLetzterVerkaufDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLiefersperreJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuLieferzeitTage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuMengeProVerpackungseinheit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuMindestverkaufsmenge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuPreisNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuPreisProMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuProvisionProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuTerminguete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuVKBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuVKNeu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuVKNeuDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuZeichnungsformat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereAkuZeichnungsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereArtikelKundeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereInterneAdressnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereInterneArtikelnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereKZAdresseRabattgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereNRPreisbasis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelKunde whereTimeStamp($value)
 * @mixin \Eloquent
 */
class ArtikelKunde extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.ArtikelKunde';
    protected $primaryKey = 'ArtikelKundeID';
    protected $guarded = [];
}


