<?php

use App\Http\Controllers\AuthController;
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

Route::group(['middleware' => ['apiJwt']], function(){
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);
    Route::post('products', [App\Http\Controllers\ProductController::class, 'store']);
    Route::put('products/{product}', [App\Http\Controllers\ProductController::class, 'update']);
    Route::delete('products/{product}', [App\Http\Controllers\ProductController::class, 'destroy']);
    Route::post('jsonUpload', [App\Http\Controllers\ProductController::class, 'jsonUpload']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
