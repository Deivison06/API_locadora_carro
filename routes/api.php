<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LocacaoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware('jwt.auth')->group(function () {
    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiresource('cliente', ClienteController::class);
    Route::apiresource('carro', CarroController::class);
    Route::apiresource('locacao', LocacaoController::class);
    Route::apiresource('marca', MarcaController::class);
    Route::apiresource('modelo', ModeloController::class);
});



Route::post('login', [AuthController::class, 'login']);
