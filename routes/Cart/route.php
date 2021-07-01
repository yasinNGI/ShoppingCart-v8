<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;


Route::prefix('cart')->group(function () {
    Route::post('/add/{id}'     , [CartController::class, 'store'])->name('product_add_to_cart');
    Route::post('/remove/{id}'  , [CartController::class, 'remove'])->name('product_remove_from_cart');
});


