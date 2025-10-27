<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $TourID
 * @property string $TourDatum
 * @property int $TourDatumNo
 * @property string $TourName
 * @property string $LSNummer
 * @property int $InterneVorgangsnummer
 * @property int $VorNummer
 * @property string $VorGruppe
 * @property string|null $created
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereLSNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourDatumNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereVorGruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereVorNummer($value)
 * @mixin \Eloquent
 */
class Rak_Mad_Material_Tour extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Rak_Mad_Material_Tour';
    protected $guarded = [];
}
