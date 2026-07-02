<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $incoming_request_id
 * @property array<array-key, mixed>|null $headers
 * @property array<array-key, mixed> $payload
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read IncomingRequest|null $request
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequestPayload newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequestPayload newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequestPayload query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequestPayload whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequestPayload whereHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequestPayload whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequestPayload whereIncomingRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequestPayload wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingRequestPayload whereUpdatedAt($value)
 * @mixin Eloquent
 */
class IncomingRequestPayload extends Model
{
    protected $guarded = [];

    protected $casts = [
        'headers' => 'array',
        'payload' => 'array',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(IncomingRequest::class);
    }
}
