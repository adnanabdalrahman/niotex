<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
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
 * @method static Builder<static>|Position newModelQuery()
 * @method static Builder<static>|Position newQuery()
 * @method static Builder<static>|Position query()
 * @method static Builder<static>|Position whereArtikelUntergruppeID($value)
 * @method static Builder<static>|Position whereFKtoNummer($value)
 * @method static Builder<static>|Position whereFibuKontoGruppeID($value)
 * @method static Builder<static>|Position whereInterneArtikelnummer($value)
 * @method static Builder<static>|Position whereInternePositionsnummer($value)
 * @method static Builder<static>|Position whereInterneVorgangsnummer($value)
 * @method static Builder<static>|Position whereKZArtikelgruppe($value)
 * @method static Builder<static>|Position whereKZKalkulationGruppe($value)
 * @method static Builder<static>|Position whereKZProduktgruppe($value)
 * @method static Builder<static>|Position whereKZWarengruppe($value)
 * @method static Builder<static>|Position whereLagerGruppe($value)
 * @method static Builder<static>|Position whereLagerortnummer($value)
 * @method static Builder<static>|Position whereMagazinID($value)
 * @method static Builder<static>|Position whereNRKostentraeger($value)
 * @method static Builder<static>|Position wherePosAnlageAm($value)
 * @method static Builder<static>|Position wherePosAnlageDurch($value)
 * @method static Builder<static>|Position wherePosAutoAbbuchenJN($value)
 * @method static Builder<static>|Position wherePosAutoZubuchenJN($value)
 * @method static Builder<static>|Position wherePosBezeichnung1($value)
 * @method static Builder<static>|Position wherePosChargenfaehigJN($value)
 * @method static Builder<static>|Position wherePosEKInNachkalkulationJN($value)
 * @method static Builder<static>|Position wherePosEbene($value)
 * @method static Builder<static>|Position wherePosErledigtJN($value)
 * @method static Builder<static>|Position wherePosFaktorAnsicht($value)
 * @method static Builder<static>|Position wherePosFertigungsfaehigJN($value)
 * @method static Builder<static>|Position wherePosFremdfertigungJN($value)
 * @method static Builder<static>|Position wherePosGebuchtJN($value)
 * @method static Builder<static>|Position wherePosHaupt($value)
 * @method static Builder<static>|Position wherePosKZMengeneinheit1Ansicht($value)
 * @method static Builder<static>|Position wherePosLagerbuchungJN($value)
 * @method static Builder<static>|Position wherePosLetzteAenderungAm($value)
 * @method static Builder<static>|Position wherePosLetzteAenderungDurch($value)
 * @method static Builder<static>|Position wherePosLieferantenfaehigJN($value)
 * @method static Builder<static>|Position wherePosNeueSeite($value)
 * @method static Builder<static>|Position wherePosNummer($value)
 * @method static Builder<static>|Position wherePosNummernText($value)
 * @method static Builder<static>|Position wherePosSeriennummernfaehigJN($value)
 * @method static Builder<static>|Position wherePosTyp($value)
 * @method static Builder<static>|Position wherePosUeberschrift($value)
 * @method static Builder<static>|Position wherePosUrsprungsnachweisJN($value)
 * @method static Builder<static>|Position wherePosVorgaenger($value)
 * @method static Builder<static>|Position whereTimeStamp($value)
 * @mixin Eloquent
 */
class Position extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Position';
    protected $guarded = [];
    protected $primaryKey = 'InternePositionsnummer';
    protected $keyType = 'int';
}
