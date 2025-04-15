<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MssqlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SAPStockController;
use App\Http\Controllers\ReceiverController;
use App\Http\Middleware\VerifySapToken;
use App\Http\Middleware\VerifyCeosWebToken;
use App\Http\Controllers\V1\MMController;



Route::middleware([VerifySapToken::class])->group(function () {

    // Route::post('/sap/stock', [SAPStockController::class, 'getStock']);
    // Route::get('/ceos/db', [MssqlController::class, 'getProducts']);

    Route::prefix('v1')
    ->namespace('App\Http\Controllers\V1')
    ->group(function () {
        
        Route::prefix('mm')->group(function () {

            //mm-31-1: SAP-->CEOS, Materialstammdaten
            Route::post('/311/materialstammdaten', [MMController::class, 'Materialstammdaten']);

        });


        // Route::prefix('sd')->group(function () {
        //     Route::post('/sd', [MMController::class, 'store']);
        // });
    
    });

});


// FROM CEOSWEB TO CEOS --> SAP
Route::middleware([VerifyCeosWebToken::class])->group(function () {

    Route::prefix('v1')
    ->namespace('App\Http\Controllers\V1')
    ->group(function () {
        Route::prefix('mm')->group(function () {
            //mm-22-1: CEOSWEB-->CEOS-->SAP, Abfrage Lagerbestände Hauptlager
            Route::post('/221/lagerbestaende', [MMController::class, 'lagerbestaende']);
        });
    
    });

});







   


    


    // MM-Requests //Material Management

        //MM-31-1: SAP-->CEOS, Materialstammdaten
        //MM-22-1: CEOS-->SAP, Abfrage Lagerbestände Hauptlager
        //MM-33-1a: CEOS-->SAP, Liefer-/Leistungsbestätigung mit Erstellung Gutschrift (NU-Abrechnung) (Im Rahmen von Wertkontrakt)
        //MM-34-1: CEOS-->SAP, Umlagerungsreservierung übergeben
        //MM-35-2: CEOS-->SAP, Materialverbrauch des Monteurs buchen [ausgewählt]
        //MM-36-01: Verknüpfung Monteur/NU zu Lagerort
        //MM-33-1b: NU-Auftragspaket CEOS zu SAP-Bestellung
        //MM-37-1: SAP Schnittstelle Übertragung Preise NU Leistungspositionen von SAP an CEOS




    //SD-Requests

    //SE-Requests






