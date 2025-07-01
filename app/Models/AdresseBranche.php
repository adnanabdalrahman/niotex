<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $AdresseBrancheID
 * @property int $InterneAdressnummer
 * @property string $KZBranche
 * @property int $AbrHauptJN
 * @property string|null $TimeStamp
 * @method static Builder<static>|AdresseBranche newModelQuery()
 * @method static Builder<static>|AdresseBranche newQuery()
 * @method static Builder<static>|AdresseBranche query()
 * @method static Builder<static>|AdresseBranche whereAbrHauptJN($value)
 * @method static Builder<static>|AdresseBranche whereAdresseBrancheID($value)
 * @method static Builder<static>|AdresseBranche whereInterneAdressnummer($value)
 * @method static Builder<static>|AdresseBranche whereKZBranche($value)
 * @method static Builder<static>|AdresseBranche whereTimeStamp($value)
 * @mixin Eloquent
 */
class AdresseBranche extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.AdresseBranche';
    protected $primaryKey = 'InterneAdressnummer';
    protected $guarded = [];
}
