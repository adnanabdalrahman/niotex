<?php
return [

    'devices' => [

        '9ZR' => [
            'device_type' => 'WMZ',
            'description' => '9ZRI0124858364',
            'state_identifiers' => [
                'value_1',
            ],
        ],

        '8ZR' => [
            'device_type' => 'WMZ',
            'description' => 'Zenner PDC Water Meter (EMM metering)',
            'state_identifiers' => [
                'value_1',
            ],
        ],

        '6ZR' => [
            'device_type' => 'WMZ',
            'description' => ' Zenner WMZ ',
            'state_identifiers' => [
                'daily_cooling',
                'daily_heating',
            ],
        ],

        '04B' => [
            'device_type' => 'HKVE',
            'description' => 'Zenner HKVE',
            'state_identifiers' => [
                'value_1',
            ],
        ],

        '4SO' => [
            'device_type' => 'HKV',
            'description' => 'Sontex HKV 878',
            'state_identifiers' => [
                'totalizer_heating',
                'totalizer_heating_at_set_day',
            ]
        ],

        '9SO' => [
            'device_type' => 'WATER',
            'description' => 'Sontex Superaqua 1 (SCS)',
            'state_identifiers' => [
                'volume_totalizer',
            ],
        ],

    ],

];
