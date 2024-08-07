<?php

use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\UserApiController;
// use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });


Route::post('/login',[UserApiController::class, 'login']);

Route::middleware(['jwt'])->group(function(){
    Route::get('/logout',[UserApiController::class, 'logout']);
    Route::post('/create',[CategoryApiController::class,'create']);
    Route::post('/search',[CategoryApiController::class,'get']);
    Route::get('/delete/{id}',[CategoryApiController::class,'delete']);
    Route::get('/edit/{id}',[CategoryApiController::class,'edit']);
    Route::post('/edit/{id}',[CategoryApiController::class,'update']);
});