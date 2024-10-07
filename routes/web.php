<?php

use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/confirm', [ConfirmationController::class, 'show'])->name('confirm.show');
    Route::post('/confirm', [ConfirmationController::class, 'confirmCode'])->name('confirm.code');
});


