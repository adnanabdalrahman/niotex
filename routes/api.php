<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MssqlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SAPStockController;
use App\Http\Controllers\ReceiverController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);



    Route::post('/sap/stock', [SAPStockController::class, 'getStock']);

    Route::get('/ceos/db', [MssqlController::class, 'getProducts']);


    Route::post('/receive-data', [ReceiverController::class, 'receivePostData']);


});






