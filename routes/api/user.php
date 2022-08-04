<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

//Private Routes
Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
    Route::get('show/{id}',[UserController::class,'show']);
    Route::put('update/{id}',[UserController::class,'update']);
    Route::post('logout',[LoginController::class,'logout']);

});

//public routes

Route::post('user/login',[LoginController::class, 'userLogin'])->name('userLogin');
Route::post('user/register/',[RegisterController::class,'register']);
