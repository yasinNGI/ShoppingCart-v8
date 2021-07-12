<?php

use App\Http\Controllers\Api\ProductController;
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
    Route::get('/test'                  , [App\Http\Controllers\Api\V1\ProductController::class , 'test']);
    Route::get('/fake'                  , [App\Http\Controllers\Api\V1\ProductController::class , 'factory']);
    Route::get('/all'                   , [App\Http\Controllers\Api\V1\ProductController::class , 'viewAll']);
});



