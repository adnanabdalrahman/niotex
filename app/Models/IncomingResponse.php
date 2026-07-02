<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $incoming_request_id
 * @property string $status
 * @property int $status_code
 * @property string|null $response_code
 * @property string|null $message
 * @property string|null $trace_id
 * @property string|null $path
 * @property int|null $processing_time_ms
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read IncomingResponsePayload|null $payload
 * @property-read IncomingRequest|null $request
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse whereIncomingRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse whereProcessingTimeMs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse whereResponseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse whereTraceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponse whereUpdatedAt($value)
 * @mixin Eloquent
 */
class IncomingResponse extends Model
{
    protected $guarded = [];

    public function request(): BelongsTo
    {
        return $this->belongsTo(IncomingRequest::class);
    }

    public function payload(): HasOne
    {
        return $this->hasOne(IncomingResponsePayload::class);
    }
}
