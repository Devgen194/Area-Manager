<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;

Route::get('/', [AreaController::class, 'index'])->name('areas.index');
Route::post('/store', [AreaController::class, 'store'])->name('areas.store');

