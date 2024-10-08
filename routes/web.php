<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/sanctum/csrf-cookie', function (Request $request) {
    $request->session()->regenerateToken();

    return response('CSRF cookie set.', 200);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'showLogoutForm'])->name('logout');

Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');
