<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $outgoing_response_id
 * @property array<array-key, mixed>|null $payload
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read OutgoingResponse|null $response
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponsePayload newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponsePayload newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponsePayload query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponsePayload whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponsePayload whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponsePayload whereOutgoingResponseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponsePayload wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OutgoingResponsePayload whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OutgoingResponsePayload extends Model
{
    protected $fillable = [
        'outgoing_response_id',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function response(): BelongsTo
    {
        return $this->belongsTo(OutgoingResponse::class);
    }
}
