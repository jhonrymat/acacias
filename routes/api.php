<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WsServicioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 🔹 Servicio web para consulta de certificado de residencia (sin autenticación)
Route::get('/wsServicio/{tipoDocumento}/{numeroIdentificacion}',
    [WsServicioController::class, 'consultarCertificado']
)->where([
    'tipoDocumento' => '[A-Za-z]{2,3}',  // CC, TI, CE, etc.
    'numeroIdentificacion' => '[0-9]+',   // Solo números
]);
