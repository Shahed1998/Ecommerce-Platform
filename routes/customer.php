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
Route::get('/info', [dashboardController::class, 'getEdit'])->name('customerEdit');
Route::get('/info/update', [dashboardController::class, 'updateGet'])->name('customer.update');
Route::patch('/info/update', [dashboardController::class, 'updatePatch'])->middleware('XSSsanitizer');



