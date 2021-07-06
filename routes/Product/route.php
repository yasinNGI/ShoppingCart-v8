<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('main_product_page');
    Route::get('/all', [ProductController::class, 'view_all'])->name('product_all');
    Route::get('/add', [ProductController::class, 'create'])->name('product_add');
    Route::post('/store', [ProductController::class, 'store'])->name('product_store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product_edit');
    Route::post('/update/{id}', [ProductController::class, 'update'])->name('product_update');
    Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('product_delete');
    Route::get('/fake/{counter}', [ProductController::class, 'factory'])->name('product_fake');
    Route::get('/delete-records/{limit}', [ProductController::class, 'destroyRecord'])->name('product_delete_limit');
    Route::get('/truncate', [ProductController::class, 'truncate'])->name('product_truncate');
});


