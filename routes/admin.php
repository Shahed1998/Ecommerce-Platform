<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin routes
Route::get('dashboard', [AdminController::class, 'home'])->name('admin.home');
Route::get('customer/pendings', [AdminController::class, 'CustomerPending'])->name('admin.customer.pending');
