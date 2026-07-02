<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $incoming_response_id
 * @property array<array-key, mixed> $payload
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read IncomingResponse|null $response
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponsePayload newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponsePayload newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponsePayload query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponsePayload whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponsePayload whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponsePayload whereIncomingResponseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponsePayload wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomingResponsePayload whereUpdatedAt($value)
 * @mixin Eloquent
 */
class IncomingResponsePayload extends Model
{
    protected $guarded = [];

    protected $casts = [
        'payload' => 'array',
    ];

    public function response(): BelongsTo
    {
        return $this->belongsTo(IncomingResponse::class);
    }
}
