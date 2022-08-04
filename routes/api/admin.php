<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
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

Route::post('admin/login',[LoginController::class, 'adminLogin'])->name('adminLogin');

Route::group( ['prefix' => 'admin','middleware' => ['auth:admin-api','scopes:admin'] ],function(){
    Route::post('company/store',[CompanyController::class,'store']);
    Route::get('company',[CompanyController::class,'index']);
    Route::get('company/show/{id}',[CompanyController::class,'show']);
    Route::put('company/update/{id}',[CompanyController::class,'update']);
    Route::delete('company/delete/{id}',[CompanyController::class,'destroy']);

    Route::post('employee/store',[EmployeeController::class,'store']);
    Route::get('employee',[EmployeeController::class,'index']);
    Route::get('employee/show/{id}',[EmployeeController::class,'show']);
    Route::put('employee/update/{id}',[EmployeeController::class,'update']);
    Route::delete('employee/delete/{id}',[EmployeeController::class,'destroy']);

    Route::post('logout',[LoginController::class,'adminLogout']);
});


