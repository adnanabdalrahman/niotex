<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixDigitalTwin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixDigitalTwin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NiotixDigitalTwin query()
 * @mixin \Eloquent
 */
	class NiotixDigitalTwin extends \Eloquent {}
}

namespace App\Models{
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
 * @property \Illuminate\Support\Carbon|null $last_seen
 * @property \Illuminate\Support\Carbon|null $niotix_created_at
 * @property \Illuminate\Support\Carbon|null $niotix_updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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
 * @mixin \Eloquent
 */
	class NiotixVirtualDevice extends \Eloquent {}
}

namespace App\Models{
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
	class NiotixVirtualDeviceMetadata extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $TourID
 * @property string $TourDatum
 * @property int $TourDatumNo
 * @property string $TourName
 * @property string $LSNummer
 * @property int $InterneVorgangsnummer
 * @property int $VorNummer
 * @property string $VorGruppe
 * @property string|null $created
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereLSNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourDatumNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereVorGruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereVorNummer($value)
 * @property string|null $Ceos_Calendar_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereCeosCalendarID($value)
 * @mixin \Eloquent
 */
	class Rak_Mad_Material_Tour extends \Eloquent {}
}

