<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BcpUserController;
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
Route::get('/bcp/setting', [BcpUserController::class,'index']);
Route::post('/bcp/setting', [BcpUserController::class,'register']);

Route::group(['middleware' => 'login'], function () {
    Route::get('/logout', [LoginController::class,'logout']);
    Route::get('/company', [CompanyController::class,'index']);
    Route::post('/company/add', [CompanyController::class,'add']);
    Route::post('/company/update', [CompanyController::class,'update']);
    Route::post('/company/delete', [CompanyController::class,'delete']);
    Route::post('/bcp/export', [BcpUserController::class,'user_export']);
    
});
