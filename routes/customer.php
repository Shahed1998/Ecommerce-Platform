<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer\dashboardController;
use App\Http\Controllers\customer\edit;
use App\Http\Controllers\customer\delete;
use App\Http\Controllers\customer\product;

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
Route::get('/info/update', [edit::class, 'updateGet'])->name('customer.update');
Route::get('/account/delete', [delete::class, 'getDelete'])->name('customer.delete');
Route::get('/shop/view', [product::class, 'getProduct'])->name('customer.product.view');
Route::get('/shop/view/{id}', [product::class, 'getOneProduct'])->name('customer.product.view.one');
Route::post('/shop/view/{id}', [product::class, 'addToCart']);
Route::patch('/info/update', [edit::class, 'updatePatch'])->middleware('XSSsanitizer');
Route::delete('/account/delete', [delete::class, 'delete'])->middleware('XSSsanitizer');


