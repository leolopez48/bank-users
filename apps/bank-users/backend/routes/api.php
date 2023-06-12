<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
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


Route::group(['middleware' => 'auth:api', 'throttle:api'], function () {
    // Services
    Route::post('/service/pay', [ServiceController::class, 'payService']);
    Route::resource('/service', ServiceController::class);

    Route::resource('/account', AccountController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/history', HistoryController::class);

    Route::get('/transfer', [HistoryController::class, 'transferHistory']);
    Route::post('/userInfo', fn () => request()->user());
});
