<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProfesorController;
use \App\Http\Controllers\ReservaController;
use \App\Http\Controllers\FechaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('profesor', [ProfesorController::class, 'index']);

Route::get('reservas', [ReservaController::class, 'index']);


Route::get('fecha', [FechaController::class, 'index']);
Route::get('fecha/show/{id}', [FechaController::class, 'show'])->name('fecha.show');
Route::get('fecha/create', [FechaController::class, 'create']);
Route::post('fecha/store', [FechaController::class, 'store'])->name('fecha.store');
Route::get('fecha/edit/{id}', [FechaController::class, 'edit'])->name('fecha.edit');

