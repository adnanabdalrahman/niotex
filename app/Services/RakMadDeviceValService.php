<?php

namespace App\Services;

use App\Models\RakMadDeviceVal;

class RakMadDeviceValService
{
    public function store(array $points, array $payload): void
    {
        foreach ($points as $month) {

            foreach (['first', 'middle', 'last'] as $type) {

                $point = $month[$type];

                RakMadDeviceVal::updateOrCreate(
                    [
                        'LS_Nummer' => $payload['dtwin_title'],
                        'GeraeteNummer' => $payload['dtwin_title'],
                        'Datum' => $point['date'],
                    ],
                    [
                        'Wert' => $point['value'],
                    ]
                );
            }
        }
    }
}
