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

//customer
Route::get('customer/pendings', [AdminController::class, 'CustomerPending'])->name('admin.customer.pending');
Route::post('customer/pendings', [AdminController::class, 'CustomerPendingPost'])->name('admin.customer.pending.Post');
Route::get('customer/pendings/ChangeAccsess/{id?}', [AdminController::class, 'CustomerPendingChangeAccess'])->name('admin.customer.pending.changeAcssess');
Route::post('customer/pendings/ChangeAccsess/{id?}', [AdminController::class, 'CustomerPendingChangeAccessPost'])->name('admin.customer.pending.changeAcssess.post');

//DeliveryStaff
Route::get('DeliveryStaff/pendings', [AdminController::class, 'DeliveryStaffPending'])->name('admin.DeliveryStaff.pending');
Route::post('DeliveryStaff/pendings', [AdminController::class, 'DeliveryStaffPendingPost'])->name('admin.DeliveryStaff.pending.Post');
Route::get('DeliveryStaff/pendings/ChangeAccsess/{id?}', [AdminController::class, 'DeliveryStaffPendingChangeAccess'])->name('admin.DeliveryStaff.pending.changeAcssess');
Route::post('DeliveryStaff/pendings/ChangeAccsess/{id?}', [AdminController::class, 'DeliveryStaffPendingChangeAccessPost'])->name('admin.DeliveryStaff.pending.changeAcssess.post');
