<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $outgoing_request_id
 * @property array<array-key, mixed>|null $headers
 * @property array<array-key, mixed>|null $payload
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read OutgoingRequest|null $request
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequestPayload newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequestPayload newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequestPayload query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequestPayload whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequestPayload whereHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequestPayload whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequestPayload whereOutgoingRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequestPayload wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingRequestPayload whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OutgoingRequestPayload extends Model
{
    protected $fillable = [
        'outgoing_request_id',
        'headers',
        'payload',
    ];

    protected $casts = [
        'headers' => 'array',
        'payload' => 'array',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(OutgoingRequest::class);
    }
}
