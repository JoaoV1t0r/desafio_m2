<?php

use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\ProductsController;
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

    Route::get('/product', [ProductsController::class, 'index'])->name('index.product');
    Route::post('/product', [ProductsController::class, 'store'])->name('store.product');
    Route::get('/product/{product}', [ProductsController::class, 'show'])->name('show.product');
    Route::put('/product/{product}', [ProductsController::class, 'update'])->name('update.product');
    Route::delete('/product/{product}', [ProductsController::class, 'destroy'])->name('destroy.product');

    Route::get('/campaign', [CampaignController::class, 'index'])->name('index.campaign');
    Route::post('/campaign', [CampaignController::class, 'store'])->name('store.campaign');
    Route::get('/campaign/{campaign}', [CampaignController::class, 'show'])->name('show.campaign');
    Route::put('/campaign/{campaign}', [CampaignController::class, 'update'])->name('update.campaign');
    Route::delete('/campaign/{campaign}', [CampaignController::class, 'destroy'])->name('destroy.campaign');


});
