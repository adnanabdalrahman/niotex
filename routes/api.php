<?php

use App\Http\Controllers\Api\V1\NiotixDigitalTwinController;
use App\Http\Controllers\Api\V1\NiotixInfluxDbController;
use App\Http\Controllers\Api\V1\NiotixVirtualDeviceController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::apiResource(
        'digital-twins',
        NiotixDigitalTwinController::class
    );

    Route::apiResource(
        'virtual-devices',
        NiotixVirtualDeviceController::class
    );

    Route::post('virtual-devices/sync', [NiotixVirtualDeviceController::class, 'sync']);

    Route::post(
        'virtual-devices/{niotixDeviceId}/sync',
        [NiotixVirtualDeviceController::class, 'syncOne']
    );
    Route::post('influxdb/states/gethistory', [NiotixInfluxDbController::class, 'getDeviceStateHistory']);
    Route::post('influxdb/states/syncDeviceStateHistory', [NiotixInfluxDbController::class, 'syncDeviceStateHistory']);
    Route::post('/rak/history/syncDevicesStateHistoryForLiegenschaft', [NiotixInfluxDbController::class, 'syncDevicesStateHistoryForLiegenschaft']);
});
