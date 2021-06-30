<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::prefix('category')->group(function(){
    Route::get(  '/'              , [CategoryController::class , 'index'])->name('main_category_page');
    Route::get(  '/all'           , [CategoryController::class , 'view_all'])->name('category_all');
    Route::get(  '/add'           , [CategoryController::class , 'create'])->name('category_add');
    Route::post(  '/store'        , [CategoryController::class , 'store'])->name('category_store');
    Route::get(  '/edit/{id}'     , [CategoryController::class , 'edit'])->name('category_edit');
    Route::post(  '/update/{id}'  , [CategoryController::class , 'update'])->name('category_update');
    Route::post(  '/delete/{id}'  , [CategoryController::class , 'destroy'])->name('category_delete');
});

