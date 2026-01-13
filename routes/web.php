<?php

use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Dashboard protegido por login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// -------------------------
// RUTAS PÚBLICAS
// Solo index y show
// -------------------------
Route::resource('equips', EquipController::class)->only(['index', 'show']);
Route::resource('estadis', EstadiController::class)->only(['index', 'show']);
Route::resource('partit', PartitsController::class)->only(['index', 'show']);
Route::resource('jugadora', JugadoraController::class)->only(['index', 'show']);

// -------------------------
// RUTAS PROTEGIDAS
// Crear, editar, borrar (store, update, destroy)
// -------------------------
Route::middleware('auth')->group(function () {

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recursos protegidos
    Route::resource('equips', EquipController::class)->except(['index', 'show']);
    Route::resource('estadis', EstadiController::class)->except(['index', 'show']);
    Route::resource('partit', PartitsController::class)->except(['index', 'show']);
    Route::resource('jugadora', JugadoraController::class)->except(['index', 'show']);
});

// Autenticación (Breeze)
require __DIR__.'/auth.php';
