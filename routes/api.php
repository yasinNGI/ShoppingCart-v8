<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register'  ,[App\Http\Controllers\Auth\UserAuthController::class , 'register']);
Route::post('/login'     ,[App\Http\Controllers\Auth\UserAuthController::class , 'login']);
Route::get('/logout'     ,[App\Http\Controllers\Auth\UserAuthController::class , 'logout'])->middleware('auth:api');;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//Products
Route::prefix('product')->middleware('auth:api')->group(function () {
    Route::get(   '/test'                        ,[App\Http\Controllers\Api\V1\ProductController::class , 'test']);
    Route::get(   '/fake'                        ,[App\Http\Controllers\Api\V1\ProductController::class , 'factory']);
    Route::get(   '/all'                         ,[App\Http\Controllers\Api\V1\ProductController::class , 'viewAll']);
    Route::get(   '/delete-records/{limit}'      ,[App\Http\Controllers\Api\V1\ProductController::class , 'destroyRecords']);
    Route::get(   '/truncate'                    ,[App\Http\Controllers\Api\V1\ProductController::class , 'truncate']);
    Route::post(  '/store'                       ,[App\Http\Controllers\Api\V1\ProductController::class , 'store']);
    Route::post(  '/update/{id}'                 ,[App\Http\Controllers\Api\V1\ProductController::class , 'update']);
    Route::delete('/delete/{id}'                 ,[App\Http\Controllers\Api\V1\ProductController::class , 'destroy']);
});

//Products
Route::prefix('category')->middleware('auth:api')->group(function () {
    Route::get(   '/all'                        ,[App\Http\Controllers\Api\V1\CategoryController::class , 'viewAll']);
    Route::get(   '/edit/{id}'                  ,[App\Http\Controllers\Api\V1\CategoryController::class , 'edit']);
    Route::post(  '/store'                      ,[App\Http\Controllers\Api\V1\CategoryController::class , 'store']);
    Route::post(  '/update/{id}'                ,[App\Http\Controllers\Api\V1\CategoryController::class , 'update']);
    Route::post(  '/delete/{id}'                ,[App\Http\Controllers\Api\V1\CategoryController::class , 'destroy']);
});


