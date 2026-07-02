<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $trace_id
 * @property string $target_system
 * @property string $module
 * @property string $interface_no
 * @property string $endpoint_name
 * @property string $endpoint
 * @property string $method
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read OutgoingRequestPayload|null $payload
 * @property-read OutgoingResponse|null $response
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest whereEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest whereEndpointName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest whereInterfaceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest whereTargetSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest whereTraceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequest whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OutgoingRequest extends Model
{
    protected $fillable = [
        'trace_id',

        'target_system',

        'module',
        'interface_no',
        'endpoint_name',
        'endpoint',

        'method',
    ];

    public function payload(): HasOne
    {
        return $this->hasOne(OutgoingRequestPayload::class);
    }

    public function response(): HasOne
    {
        return $this->hasOne(OutgoingResponse::class);
    }
}
