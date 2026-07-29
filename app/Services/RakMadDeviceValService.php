<?php

namespace App\Services;

use App\Exceptions\DBSaveException;
use App\Models\RakMadDeviceVal;
use Throwable;

class RakMadDeviceValService
{
    /**
     * @throws DBSaveException
     */
    public function store(array $points, array $payload): void
    {
        foreach ($points as $point) {
            try {
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
            } catch (Throwable $e) {
                throw new DBSaveException('Fehler beim Speichern oder Aktualisieren RakMadDeviceVal: ' . $e->getMessage());
            }
        }
    }
}
