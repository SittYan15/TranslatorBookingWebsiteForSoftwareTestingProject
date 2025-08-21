<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', [AuthController::class, 'auth'])->name('auth.form');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/signup', [AuthController::class, 'signup'])->name('signup');

Route::middleware(['auth'])->group(function () {

    Route::get('/search', [ViewController::class, 'search'])->name('search');

});
