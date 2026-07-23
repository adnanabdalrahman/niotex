<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Models\NiotixVirtualDevice|null $virtualDevice
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceData query()
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
