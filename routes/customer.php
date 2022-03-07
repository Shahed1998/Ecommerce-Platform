<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer\dashboardController;

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Customer routes
Route::get('/dashboard', [dashboardController::class, 'getDashboard'])->name('customerDashboard');


