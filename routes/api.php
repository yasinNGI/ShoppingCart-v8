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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Products
Route::get('/product/test'                  , [App\Http\Controllers\Api\ProductController::class , 'test']);
Route::get('/product/fake'                  , [App\Http\Controllers\Api\ProductController::class , 'factory']);
Route::get('/product/all'                   , [App\Http\Controllers\Api\ProductController::class , 'viewAll']);




