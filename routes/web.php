<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/users', function () {
echo "Hello";
    $users = User::all();
    dd($users);

});



Route::get('/test', function () {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);      
        
    });