<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\EscuchaController;
use App\Http\Controllers\Api\V1\ProcesoController;
use App\Http\Controllers\Api\V1\SesionController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\Catalogos\TemaController;
use App\Http\Controllers\Api\V1\Catalogos\MemoriaTempranaController;
use App\Http\Controllers\Api\V1\Catalogos\MensajeAngustiosoController;
use App\Http\Controllers\Api\V1\Catalogos\DireccionController;
use App\Http\Controllers\Api\V1\Catalogos\ContradiccionController;
use App\Http\Controllers\Api\V1\Catalogos\ContradiccionEscuchaController;
use App\Http\Controllers\Api\V1\Catalogos\PedacitoRealidadController;
use App\Http\Controllers\Api\V1\Catalogos\RestimulacionController;
use App\Http\Controllers\Api\V1\Catalogos\CompromisoSocialController;
use App\Http\Controllers\Api\V1\Catalogos\ProximoPasoController;
use App\Http\Controllers\Api\V1\Catalogos\SesionFisicaController;
use App\Http\Controllers\Api\V1\Catalogos\NecesidadCongeladaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    // Auth routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // Auth
        Route::post('/logout', [AuthController::class, 'logout']);

        // Users
        Route::get('/users/me', [UserController::class, 'me']);
        Route::apiResource('users', UserController::class)->only(['show']);

        // Escuchas
        Route::apiResource('escuchas', EscuchaController::class);

        // Sesiones
        Route::get('/sesiones/filters', [SesionController::class, 'filters']);
        Route::patch('/sesiones/{sesion}/status', [SesionController::class, 'updateStatus']);
        Route::apiResource('sesiones', SesionController::class);

        // Procesos
        Route::post('/procesos', [ProcesoController::class, 'store']);
        Route::get('/procesos/{proceso}/sesiones', [ProcesoController::class, 'sesiones']);
        Route::apiResource('procesos', ProcesoController::class)->except(['store']);

        // Catálogos
        Route::apiResource('temas', TemaController::class);
        Route::post('/temas/quick', [TemaController::class, 'quickStore']);

        Route::apiResource('memorias-tempranas', MemoriaTempranaController::class);
        Route::post('/memorias-tempranas/quick', [MemoriaTempranaController::class, 'quickStore']);

        Route::apiResource('mensajes-angustiosos', MensajeAngustiosoController::class);
        Route::post('/mensajes-angustiosos/quick', [MensajeAngustiosoController::class, 'quickStore']);

        Route::apiResource('direcciones', DireccionController::class);
        Route::post('/direcciones/quick', [DireccionController::class, 'quickStore']);

        Route::apiResource('contradicciones', ContradiccionController::class);
        Route::post('/contradicciones/quick', [ContradiccionController::class, 'quickStore']);

        Route::apiResource('contradicciones-escuchas', ContradiccionEscuchaController::class);
        Route::post('/contradicciones-escuchas/quick', [ContradiccionEscuchaController::class, 'quickStore']);

        Route::apiResource('pedacitos-realidad', PedacitoRealidadController::class);
        Route::post('/pedacitos-realidad/quick', [PedacitoRealidadController::class, 'quickStore']);

        Route::apiResource('restimulaciones', RestimulacionController::class);
        Route::post('/restimulaciones/quick', [RestimulacionController::class, 'quickStore']);

        Route::apiResource('compromisos-sociales', CompromisoSocialController::class);
        Route::post('/compromisos-sociales/quick', [CompromisoSocialController::class, 'quickStore']);

        Route::apiResource('proximos-pasos', ProximoPasoController::class);
        Route::post('/proximos-pasos/quick', [ProximoPasoController::class, 'quickStore']);

        Route::apiResource('sesiones-fisicas', SesionFisicaController::class);
        Route::post('/sesiones-fisicas/quick', [SesionFisicaController::class, 'quickStore']);

        Route::apiResource('necesidades-congeladas', NecesidadCongeladaController::class);
        Route::post('/necesidades-congeladas/quick', [NecesidadCongeladaController::class, 'quickStore']);

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);
    });
});