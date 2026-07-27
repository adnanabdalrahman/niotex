<?php

namespace App\Services;

use App\Models\RakMadDeviceVal;

class RakMadDeviceValService
{
    public function store(array $points, array $payload): void
    {
        foreach ($points as $point) {

            RakMadDeviceVal::updateOrCreate(
                [
                    'LS_Nummer' => $payload['LS_Nummer'],
                    'GeraeteNummer' => $payload['GeraeteNummer'],
                    'Datum' => $point['date'],
                ],
                [
                    'Wert' => $point['value'],
                ]
            );
        }
    }
}
