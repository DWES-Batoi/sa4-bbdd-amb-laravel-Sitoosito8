<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\JugadoraController;

Route::get('/', function () {
    return redirect()->route('estadis.index');
});

Route::resource('/estadis', EstadiController::class);
Route::resource('/equips', EquipController::class);
Route::resource('/jugadora', JugadoraController::class);