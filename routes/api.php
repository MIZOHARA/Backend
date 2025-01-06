<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('user')->group(function () {
    Route::post('check',[\App\Http\Controllers\UserController::class,'login_user']);
    Route::post('login',[\App\Http\Controllers\UserController::class,'check_otp']);
});
Route::post('product/validate',[\App\Http\Controllers\ProductsController::class,'validate_product']);
Route::middleware('auth:sanctum')->group(function (){
   Route::post('product/store',[\App\Http\Controllers\ProductsController::class,'Store_product']);
   Route::put('product/edit',[\App\Http\Controllers\ProductsController::class,'edit_product']);
});
