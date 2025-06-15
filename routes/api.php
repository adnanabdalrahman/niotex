<?php

use App\Http\Controllers\V1\BPController;
use App\Http\Controllers\V1\MMController;
use App\Http\Controllers\V1\SDController;
use App\Http\Controllers\V1\SEController;
use App\Http\Middleware\VerifyCeosWebToken;
use App\Http\Middleware\VerifySapToken;
use Illuminate\Support\Facades\Route;


Route::middleware([VerifySapToken::class])->group(function () {

    Route::prefix('v1')
        ->namespace('App\Http\Controllers\V1')
        ->group(function () {

            Route::prefix('mm')->group(function () {
                //mm-31-1: SAP-->CEOS, Materialstammdaten
                Route::post('/3101/materialstammdaten', [MMController::class, 'mm_31_1_materialstammdaten']);


                //mm-37-1: SAP-->CEOS, NU zugelassene Leistungspositionen
                Route::post('/3701/nuleistungspositionen', [MMController::class, 'mm_37_1_NuLeistungspositionen']);
            });


            Route::prefix('bp')->group(function () {
                //bp-01-01: SAP-->CEOS, Geschäftspartner
                Route::post('/0101/geschaeftspartner', [BPController::class, 'bp_01_01_Geschaeftspartner']);

                //bp-01-03: SAP –> CEOS Kundenstammdaten Verwalter
                Route::post('/0103/verwalter', [BPController::class, 'bp_01_03_Verwalter']);
            });


            Route::prefix('sd')->group(function () {
                //SD-01-01: SAP-->CEOS, Beauftragung
                Route::post('/0101/beauftragung', [SDController::class, 'sd_0101_beauftragung']);

                //SD-02-01: SAP-->CEOS, Mietvertragsrechnungen
                Route::post('/0201/mietvertragsrechnungen', [SDController::class, 'sd_02_01_mietvertragsrechnungen']);

                //SD-03-02: SAP-->CEOS, fakturierte Dienstleistungsrechnung
                Route::post('/0302/fakturiertedienstleistungsrechnung', [SDController::class,
                    'sd_03_02_fakturiertedienstleistungsrechnung']);

            });
        });
});


// FROM CEOSWEB TO CEOS --> SAP
Route::middleware([VerifyCeosWebToken::class])->group(function () {

    Route::prefix('v1')
        ->namespace('App\Http\Controllers\V1')
        ->group(function () {
            Route::prefix('mm')->group(function () {
                //mm-22-01: CEOSWEB-->CEOS-->SAP, Abfrage Lagerbestände Hauptlager
                Route::post('/2201/lagerbestaende', [MMController::class, 'mm_22_1_lagerbestaende']);

                //mm-35-01: CEOSWEB-->CEOS-->SAP, Abfrage Lagerbestände Hauptlager
                Route::post('/3301a/leistungsbestaetigung', [MMController::class, 'mm_33_01_a_Leistungsbestaetigung']);


                //mm-34-1: CEOSWEB-->CEOS-->SAP, Umlagerungsreservierung
                Route::post('/3401/umlagerungsreservierung', [MMController::class, 'mm_34_01_umlagerungsreservierung']);


                //mm-35-02: CEOSWEB-->CEOS-->SAP, Materialverbrauch des Monteurs / NU
                Route::post('/3502/materialverbrauch', [MMController::class, 'mm_35_02_materialverbrauch']);
            });


            Route::prefix('sd')->group(function () {
                //SD-01-02: CEOSWEB-->CEOS-->SAP, beauftragungRueckmeldung
                Route::post('/0102/beauftragungRueckmeldung', [SDController::class, 'sd_01_02_beauftragungRueckmeldung']);

                //SD-03-01: CEOSWEB->CEOS->Sap, Dienstleistungsabrechnung
                Route::post('/0301/dienstleistungsrechnung ', [SDController::class, 'sd_03_01_dienstleistungsrechnung']);

            });

            Route::prefix('se')->group(function () {
                //SE-26-01: CEOSWEB-->CEOS-->SAP , reparaturauftrag
                Route::post('/2601/reparaturauftrag', [SEController::class, 'se_26_01_Reparaturauftrag']);
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
