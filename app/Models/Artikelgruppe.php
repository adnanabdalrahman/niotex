<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

/**
 *
 *
 * @property string $KZWarengruppe
 * @property string $KZArtikelgruppe
 * @property string|null $AgrBezeichnung
 * @property string|null $AgrArtikelbezeichnung1
 * @property string|null $AgrArtikelbezeichnung2
 * @property string|null $KZAgrMengeneinheit1
 * @property string|null $KZAgrMengeneinheit2
 * @property float|null $AgrEKRabatt
 * @property float|null $AgrProvisionProzent
 * @property int|null $LinecardID
 * @property string|null $TimeStamp
 * @property int $AgrInaktivJN
 * @method static Builder<static>|Artikelgruppe newModelQuery()
 * @method static Builder<static>|Artikelgruppe newQuery()
 * @method static Builder<static>|Artikelgruppe query()
 * @method static Builder<static>|Artikelgruppe whereAgrArtikelbezeichnung1($value)
 * @method static Builder<static>|Artikelgruppe whereAgrArtikelbezeichnung2($value)
 * @method static Builder<static>|Artikelgruppe whereAgrBezeichnung($value)
 * @method static Builder<static>|Artikelgruppe whereAgrEKRabatt($value)
 * @method static Builder<static>|Artikelgruppe whereAgrInaktivJN($value)
 * @method static Builder<static>|Artikelgruppe whereAgrProvisionProzent($value)
 * @method static Builder<static>|Artikelgruppe whereKZAgrMengeneinheit1($value)
 * @method static Builder<static>|Artikelgruppe whereKZAgrMengeneinheit2($value)
 * @method static Builder<static>|Artikelgruppe whereKZArtikelgruppe($value)
 * @method static Builder<static>|Artikelgruppe whereKZWarengruppe($value)
 * @method static Builder<static>|Artikelgruppe whereLinecardID($value)
 * @method static Builder<static>|Artikelgruppe whereTimeStamp($value)
 * @mixin Eloquent
 */
class Artikelgruppe extends Model
{
    use HasCompositeKey;

    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Artikelgruppe';
    protected $guarded = [];
    protected $primaryKey = ['KZArtikelgruppe', 'KZArtikelgruppe'];
    protected $keyType = 'int';
}
