<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\DeliveryStaffController;
use App\Http\Controllers\admin\VendorController;

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
Route::get('activites', [AdminController::class, 'AdminActivities'])->name('admin.activites');

//customer
//pending
Route::get('customer/pendings', [CustomerController::class, 'CustomerPending'])->name('admin.customer.pending');
Route::post('customer/pendings', [CustomerController::class, 'CustomerPendingPost'])->name('admin.customer.pending.Post');
Route::get('customer/pendings/ChangeAccsess/{id?}', [CustomerController::class, 'CustomerPendingChangeAccess'])->name('admin.customer.pending.changeAcssess');
Route::post('customer/pendings/ChangeAccsess/{id?}', [CustomerController::class, 'CustomerPendingChangeAccessPost'])->name('admin.customer.pending.changeAcssess.post');

//active
Route::get('customer/actives', [CustomerController::class, 'CustomerActive'])->name('admin.customer.active');
Route::post('customer/actives', [CustomerController::class, 'CustomerActivePost'])->name('admin.customer.active.Post');
Route::get('customer/actives/ChangeAccsess/{id?}', [CustomerController::class, 'CustomerActiveChangeAccess'])->name('admin.customer.active.changeAcssess');
Route::post('customer/actives/ChangeAccsess/{id?}', [CustomerController::class, 'CustomerActiveChangeAccessPost'])->name('admin.customer.active.changeAcssess.post');

//DeliveryStaff
Route::get('DeliveryStaff/pendings', [DeliveryStaffController::class, 'DeliveryStaffPending'])->name('admin.DeliveryStaff.pending');
Route::post('DeliveryStaff/pendings', [DeliveryStaffController::class, 'DeliveryStaffPendingPost'])->name('admin.DeliveryStaff.pending.Post');
Route::get('DeliveryStaff/pendings/ChangeAccsess/{id?}', [DeliveryStaffController::class, 'DeliveryStaffPendingChangeAccess'])->name('admin.DeliveryStaff.pending.changeAcssess');
Route::post('DeliveryStaff/pendings/ChangeAccsess/{id?}', [DeliveryStaffController::class, 'DeliveryStaffPendingChangeAccessPost'])->name('admin.DeliveryStaff.pending.changeAcssess.post');


//vendors
Route::get('Vendor/pendings', [VendorController::class, 'VendorPending'])->name('admin.Vendor.pending');
Route::post('Vendor/pendings', [VendorController::class, 'VendorPendingPost'])->name('admin.Vendor.pending.Post');
Route::get('Vendor/pendings/ChangeAccsess/{id?}', [VendorController::class, 'VendorPendingChangeAccess'])->name('admin.Vendor.pending.changeAcssess');
Route::post('Vendor/pendings/ChangeAccsess/{id?}', [VendorController::class, 'VendorPendingChangeAccessPost'])->name('admin.Vendor.pending.changeAcssess.post');
