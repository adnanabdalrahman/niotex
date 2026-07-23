<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $niotix_device_id
 * @property string $device_id
 * @property string $name
 * @property string|null $description
 * @property int $device_type
 * @property int $device_driver_id
 * @property string $connector_type
 * @property int $connector_config_id
 * @property string|null $region
 * @property string|null $activation
 * @property int|null $parent_id
 * @property int|null $account_id
 * @property int|null $scope_id
 * @property bool $disabled
 * @property Carbon|null $last_seen
 * @property Carbon|null $niotix_created_at
 * @property Carbon|null $niotix_updated_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\NiotixVirtualDeviceMetadata|null $metadata
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereActivation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereConnectorConfigId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereConnectorType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereDeviceDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereDeviceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereLastSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereLineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereNiotixCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereNiotixDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereNiotixUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereScopeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereUpdatedAt($value)
 * @property int|null $device_template_id
 * @property string|null $operational_status
 * @property int $class_c
 * @property string|null $rx2_data_rate
 * @property int $skip_fcnt_check
 * @property-read \App\Models\NiotixVirtualDeviceData|null $deviceData
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereClassC($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereDeviceTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereOperationalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereRx2DataRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixVirtualDevice whereSkipFcntCheck($value)
 * @mixin \Eloquent
 */
class NiotixVirtualDevice extends Model
{
    protected $connection = 'mysql';

    protected $table = 'niotix_virtual_devices';

    protected $guarded = [];

    protected $casts = [
        'disabled' => 'boolean',

        'last_seen' => 'datetime',
        'niotix_created_at' => 'datetime',
        'niotix_updated_at' => 'datetime',
    ];

    public function metadata(): HasOne
    {
        return $this->hasOne(
            NiotixVirtualDeviceMetadata::class,
            'virtual_device_id'
        );
    }

    public function deviceData(): HasOne
    {
        return $this->hasOne(
            NiotixVirtualDeviceData::class,
            'virtual_device_id'
        );
    }
}
