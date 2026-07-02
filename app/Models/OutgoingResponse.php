<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $outgoing_request_id
 * @property string $status
 * @property int $status_code
 * @property string|null $response_code
 * @property string|null $message
 * @property string $trace_id
 * @property int|null $processing_time_ms
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read OutgoingResponsePayload|null $payload
 * @property-read OutgoingRequest|null $request
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse whereOutgoingRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse whereProcessingTimeMs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse whereResponseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse whereTraceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponse whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OutgoingResponse extends Model
{
    protected $fillable = [
        'outgoing_request_id',

        'status',
        'status_code',
        'response_code',
        'message',

        'trace_id',

        'processing_time_ms',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(OutgoingRequest::class);
    }

    public function payload(): HasOne
    {
        return $this->hasOne(OutgoingResponsePayload::class);
    }
}
