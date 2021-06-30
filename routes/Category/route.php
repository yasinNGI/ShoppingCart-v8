<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::prefix('category')->group(function(){
    Route::get(  '/'             , [CategoryController::class , 'index'])->name('main');
    Route::get(  '/all'          , [CategoryController::class , 'view_all'])->name('all');
    Route::get(  '/add'          , [CategoryController::class , 'create'])->name('add');
    Route::get(  '/store'        , [CategoryController::class , 'store'])->name('store');
    Route::get(  '/edit/{id}'    , [CategoryController::class , 'edit'])->name('edit');
    Route::get(  '/update/{id}'  , [CategoryController::class , 'update'])->name('update');
    Route::get(  '/delete/{id}'  , [CategoryController::class , 'destroy'])->name('delete');
});

