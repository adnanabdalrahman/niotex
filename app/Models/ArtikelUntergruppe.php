<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $ArtikelUntergruppeID
 * @property string $KZWarengruppe
 * @property string $KZArtikelgruppe
 * @property string $KZUnterArtikelgruppe
 * @property string|null $AugBezeichnung
 * @property string|null $TimeStamp
 * @property int $AugInaktivJN
 * @method static Builder<static>|ArtikelUntergruppe newModelQuery()
 * @method static Builder<static>|ArtikelUntergruppe newQuery()
 * @method static Builder<static>|ArtikelUntergruppe query()
 * @method static Builder<static>|ArtikelUntergruppe whereArtikelUntergruppeID($value)
 * @method static Builder<static>|ArtikelUntergruppe whereAugBezeichnung($value)
 * @method static Builder<static>|ArtikelUntergruppe whereAugInaktivJN($value)
 * @method static Builder<static>|ArtikelUntergruppe whereKZArtikelgruppe($value)
 * @method static Builder<static>|ArtikelUntergruppe whereKZUnterArtikelgruppe($value)
 * @method static Builder<static>|ArtikelUntergruppe whereKZWarengruppe($value)
 * @method static Builder<static>|ArtikelUntergruppe whereTimeStamp($value)
 * @mixin Eloquent
 */
class ArtikelUntergruppe extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.ArtikelUntergruppe';
    protected $primaryKey = 'InterneArtikelnummer';
    protected $guarded = [];

}
