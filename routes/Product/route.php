
<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::prefix('product')->group(function(){
    Route::get(  '/'             , [ProductController::class , 'index'])->name('main');
    Route::get(  '/all'          , [ProductController::class , 'view_all'])->name('all');
    Route::get(  '/add'          , [ProductController::class , 'create'])->name('add');
    Route::get(  '/store'        , [ProductController::class , 'store'])->name('store');
    Route::get(  '/edit/{id}'    , [ProductController::class , 'edit'])->name('edit');
    Route::get(  '/update/{id}'  , [ProductController::class , 'update'])->name('update');
    Route::get(  '/delete/{id}'  , [ProductController::class , 'destroy'])->name('delete');
    Route::get(  '/fake'         , [ProductController::class , 'makeFactory'])->name('fake');
});

