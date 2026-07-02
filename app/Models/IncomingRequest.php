<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $trace_id
 * @property string|null $request_id
 * @property string $source_system
 * @property string $module
 * @property string $interface_no
 * @property string $endpoint_name
 * @property string $endpoint
 * @property string $method
 * @property string|null $client_ip
 * @property string|null $user_agent
 * @property string|null $content_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read IncomingRequestPayload|null $payload
 * @property-read IncomingResponse|null $response
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereClientIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereCorrelationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereEndpointName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereInterfaceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereSourceSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequest whereTraceId($value)
 * @mixin Eloquent
 */
class IncomingRequest extends Model
{
    protected $guarded = [];

    public function payload(): HasOne
    {
        return $this->hasOne(IncomingRequestPayload::class);
    }

    public function response(): HasOne
    {
        return $this->hasOne(IncomingResponse::class);
    }
}
