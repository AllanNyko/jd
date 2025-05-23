<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('marcas', MarcaController::class); //feito
Route::resource('modelos', ModeloController::class); //em andamento