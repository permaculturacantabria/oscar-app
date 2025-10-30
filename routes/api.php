<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListenerController;
use App\Http\Controllers\SessionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth')->group(function () {
    Route::get('/listeners', [ListenerController::class, 'index']);
    Route::post('/listeners', [ListenerController::class, 'store']);
    Route::post('/sessions', [SessionController::class, 'store']);
});