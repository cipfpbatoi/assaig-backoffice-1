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

Route::resource('profesor', ProfesorController::class);
Route::resource('fecha', FechaController::class);
Route::resource('reserva', ReservaController::class);
