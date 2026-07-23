<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixDigitalTwin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixDigitalTwin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixDigitalTwin query()
 * @mixin \Eloquent
 */
class NiotixDigitalTwin extends Model
{
    protected $connection = 'mysql';

    protected $table = 'niotix_digital_twins';

    protected $guarded = [];


}
