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
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);

Route::group(['middleware' => ['apiJwt']], function(){
    Route::get('/', function () {
        return response()->json("PHP Challenge 20201117", 200);
    })->name('api.products.home');

    Route::get('products', [App\Http\Controllers\ProductController::class, 'index'])->name('api.products');
    Route::get('products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('api.products.show');
    Route::post('products', [App\Http\Controllers\ProductController::class, 'store'])->name('api.products.store');
    Route::put('products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('api.products.update');
    Route::delete('products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('api.products.delete');
    Route::post('jsonUpload', [App\Http\Controllers\ProductController::class, 'jsonUpload'])->name('api.products.upload');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
