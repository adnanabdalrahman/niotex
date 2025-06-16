<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property int $PosEbene
 * @property int $PosNummer
 * @property string|null $PosNummernText
 * @property int|null $PosVorgaenger
 * @property int|null $PosHaupt
 * @property string|null $KZArtikelgruppe
 * @property string|null $KZWarengruppe
 * @property int|null $ArtikelUntergruppeID
 * @property string|null $KZProduktgruppe
 * @property int|null $InterneArtikelnummer
 * @property string|null $PosBezeichnung1
 * @property int|null $FibuKontoGruppeID
 * @property int|null $FKtoNummer
 * @property int $PosNeueSeite
 * @property int $PosSeriennummernfaehigJN
 * @property int $PosChargenfaehigJN
 * @property int $PosAutoAbbuchenJN
 * @property int $PosAutoZubuchenJN
 * @property int|null $PosTyp
 * @property int $PosGebuchtJN
 * @property int $PosErledigtJN
 * @property int $PosLagerbuchungJN
 * @property string|null $LagerGruppe
 * @property int|null $Lagerortnummer
 * @property int|null $MagazinID
 * @property string|null $PosUeberschrift
 * @property int $PosFremdfertigungJN
 * @property int $PosLieferantenfaehigJN
 * @property int $PosFertigungsfaehigJN
 * @property int $PosUrsprungsnachweisJN
 * @property int $PosEKInNachkalkulationJN
 * @property string|null $PosKZMengeneinheit1Ansicht
 * @property float|null $PosFaktorAnsicht
 * @property string|null $PosAnlageAm
 * @property int|null $PosAnlageDurch
 * @property string|null $PosLetzteAenderungAm
 * @property int|null $PosLetzteAenderungDurch
 * @property string|null $KZKalkulationGruppe
 * @property string|null $TimeStamp
 * @property int|null $NRKostentraeger
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereArtikelUntergruppeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereFKtoNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereFibuKontoGruppeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereInterneArtikelnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereKZArtikelgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereKZKalkulationGruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereKZProduktgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereKZWarengruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereLagerGruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereLagerortnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereMagazinID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereNRKostentraeger($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosAnlageAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosAnlageDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosAutoAbbuchenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosAutoZubuchenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosBezeichnung1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosChargenfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosEKInNachkalkulationJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosEbene($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosErledigtJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosFaktorAnsicht($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosFertigungsfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosFremdfertigungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosGebuchtJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosHaupt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosKZMengeneinheit1Ansicht($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosLagerbuchungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosLetzteAenderungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosLetzteAenderungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosLieferantenfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosNeueSeite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosNummernText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosSeriennummernfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosUeberschrift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosUrsprungsnachweisJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position wherePosVorgaenger($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereTimeStamp($value)
 * @mixin \Eloquent
 */
class Position extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Position';
    protected $guarded = [];
    protected $primaryKey = ['InterneVorgangsnummer', 'InternePositionsnummer'];
    protected $keyType = 'int';
}
