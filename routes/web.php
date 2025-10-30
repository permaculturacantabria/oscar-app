<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ListenerController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CatalogItemController;

Route::get('/', function () {
    return view('app');
});

Route::get('/emociona', function () {
    return view('app');
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// Privacy Policy
Route::get('/privacidad', [PrivacyController::class, 'show'])->name('privacy');
Route::view('/terminos', 'terms')->name('terms');

// Web + session auth JSON endpoints
Route::middleware('auth')->group(function () {
    Route::get('/api/listeners', [ListenerController::class, 'index']);
    Route::post('/api/listeners', [ListenerController::class, 'store']);
    Route::post('/api/sessions', [SessionController::class, 'store']);

    // Catalog items
    Route::get('/api/catalog-items', [CatalogItemController::class, 'index']);
    Route::post('/api/catalog-items', [CatalogItemController::class, 'store']);

    // Current user info (session-based)
    Route::get('/api/me', function() {
        $user = auth()->user();
        return response()->json($user ? $user->only(['id','name','email','terms_accepted_at']) : null);
    });
});
