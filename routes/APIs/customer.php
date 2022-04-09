<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer\dashboardController;
use App\Http\Controllers\customer\login;
use App\Models\Customer\UserCredential;
use App\Models\Customer\UserInfo;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Note: Signup is in api.php
Route::post('/login', [login::class, 'postLogin']);
Route::post('/dashboard', [dashboardController::class, 'getDashboard']);


