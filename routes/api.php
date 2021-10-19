<?php

use App\Http\Controllers\Api\CityController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (){
    Route::get('/city', [CityController::class, 'index'])->name('index.city');
    Route::post('/city', [CityController::class, 'store'])->name('store.city');
    Route::get('/city/{city}', [CityController::class, 'show'])->name('show.city');
    Route::put('/city/{city}', [CityController::class, 'update'])->name('update.city');
    Route::delete('/city/{city}', [CityController::class, 'destroy'])->name('destroy.city');
});
