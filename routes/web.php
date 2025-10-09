<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Auth::routes();

// Dashboard Route (protected by auth middleware)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Redirect /home to /dashboard
Route::get('/home', function () {
    return redirect('/dashboard');
})->middleware('auth');
