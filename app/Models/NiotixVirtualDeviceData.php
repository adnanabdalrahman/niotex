<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Models\NiotixVirtualDevice|null $virtualDevice
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData query()
 * @property int $id
 * @property int $virtual_device_id
 * @property array<array-key, mixed>|null $device_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData whereDeviceData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData whereVirtualDeviceId($value)
 * @mixin \Eloquent
 */
class NiotixVirtualDeviceData extends Model
{
    protected $connection = 'mysql';

    protected $table = 'niotix_virtual_device_data';

    protected $guarded = [];

    protected $casts = [
        'device_data' => 'array',
    ];

    public function virtualDevice(): BelongsTo
    {
        return $this->belongsTo(
            NiotixVirtualDevice::class,
            'virtual_device_id'
        );
    }
}
