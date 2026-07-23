<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $virtual_device_id
 * @property string|null $fa_icon
 * @property array<array-key, mixed>|null $groups
 * @property array<array-key, mixed>|null $tags
 * @property array<array-key, mixed>|null $key_value_data
 * @property array<array-key, mixed>|null $target_reference_ids
 * @property array<array-key, mixed>|null $location_data
 * @property array<array-key, mixed>|null $header_image
 * @property array<array-key, mixed>|null $attachments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\NiotixVirtualDevice $virtualDevice
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereFaIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereHeaderImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereKeyValueData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereLocationData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereTargetReferenceIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDeviceMetadata whereVirtualDeviceId($value)
 * @mixin \Eloquent
 */
class NiotixVirtualDeviceMetadata extends Model
{
    protected $connection = 'mysql';

    protected $table = 'niotix_virtual_device_metadata';

    protected $guarded = [];

    protected $casts = [
        'groups' => 'array',
        'tags' => 'array',
        'key_value_data' => 'array',
        'target_reference_ids' => 'array',
        'location_data' => 'array',
        'header_image' => 'array',
        'attachments' => 'array',
    ];

    public function virtualDevice(): BelongsTo
    {
        return $this->belongsTo(
            NiotixVirtualDevice::class,
            'virtual_device_id'
        );
    }
}
