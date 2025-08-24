<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/login', function () {
    return redirect()->route('auth.form');
})->name('login.redirect');

Route::get('/', [AuthController::class, 'auth'])->name('auth.form');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/signup', [AuthController::class, 'signup'])->name('signup');

Route::middleware(['auth'])->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/search', [ViewController::class, 'search'])->name('search');
    Route::get('/search/by_name', [ViewController::class, 'searchByName'])->name('search.name');
    Route::get('/search/filter', [ViewController::class, 'filterTranslators'])->name('search.filter');

    Route::get('/translator/details/{id}', [ViewController::class, 'translator_detail'])->name('translator.detail');

    Route::get('/translator/bookings/{translator_id}/{date}', [ViewController::class, 'translator_bookings'])->name('bookings.create');
    Route::post('/translator/bookings/store', [ViewController::class, 'storeBooking'])->name('bookings.store');
});
