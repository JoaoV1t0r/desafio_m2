<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\GroupController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (){
    Route::get('/city', [CityController::class, 'index'])->name('index.city');
    Route::post('/city', [CityController::class, 'store'])->name('store.city');
    Route::get('/city/{city}', [CityController::class, 'show'])->name('show.city');
    Route::put('/city/{city}', [CityController::class, 'update'])->name('update.city');
    Route::delete('/city/{city}', [CityController::class, 'destroy'])->name('destroy.city');

    Route::get('/group', [GroupController::class, 'index'])->name('index.group');
    Route::post('/group', [GroupController::class, 'store'])->name('store.group');
    Route::get('/group/{group}', [GroupController::class, 'show'])->name('show.group');
    Route::put('/group/{group}', [GroupController::class, 'update'])->name('update.group');
    Route::delete('/group/{group}', [GroupController::class, 'destroy'])->name('destroy.group');
});
