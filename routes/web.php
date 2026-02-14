<?php

use App\Http\Controllers\CashRealController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CashRealController::class, 'home'])->name('home');

Route::get('/cashreal', [CashRealController::class, 'home'])->name('cashreal.home');
Route::post('/cashreal/result', [CashRealController::class, 'result'])->name('cashreal.result');
