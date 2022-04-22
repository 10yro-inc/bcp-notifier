<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [LoginController::class,'index'])->name('login');;
Route::post('/', [LoginController::class,'login']);


Route::group(['middleware' => 'login'], function () {
    Route::get('/logout', [LoginController::class,'logout']);
    Route::get('/company', [CompanyController::class,'index']);
    Route::post('/company/add', [CompanyController::class,'add']);
    Route::post('/company/update', [CompanyController::class,'update']);
    Route::post('/company/delete', [CompanyController::class,'delete']);
});
