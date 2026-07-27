<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $resource_type
 * @property int|null $resource_id
 * @property string $message
 * @property string|null $exception
 * @property array<array-key, mixed> $payload
 * @property bool $resolved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $attempts
 * @property string|null $last_failed_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError whereAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError whereException($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError whereLastFailedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError whereResolved($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError whereResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError whereResourceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixImportError whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NiotixImportError extends Model
{
    protected $connection = 'mysql';

    protected $table = 'niotix_import_errors';

    protected $guarded = [];

    protected $casts = [
        'payload' => 'array',
        'resolved' => 'boolean',
    ];
}
