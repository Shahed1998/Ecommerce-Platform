<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\DeliveryStaffController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\admin\ChartController;
use App\Http\Controllers\admin\PDFController;
use App\Http\Controllers\Admin_Api_Controllers\MailController;
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

Route::get('mail',[MailController::class,'MailSend']);

Route::get('generate-pdf', [PDFController::class, 'generatePDFCustomer'])->name('admin.dwonloadActiveCustomer');

// Admin routes
Route::get('dashboard', [AdminController::class, 'home'])->name('admin.home');
Route::get('activites', [AdminController::class, 'AdminActivities'])->name('admin.activites');
Route::get('registration', [AdminController::class, 'AdminRegistration'])->name('admin.registration');
Route::post('registration', [AdminController::class, 'AdminRegistrationPost'])->name('admin.registrationPost');
Route::get('profile', [AdminController::class, 'ProfileView'])->name('admin.profileView');
Route::get('profile/edit', [AdminController::class, 'ProfileEdit'])->name('admin.profileEdit');
Route::post('profile/edit', [AdminController::class, 'ProfileEditPost'])->name('admin.profileEditPost');

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
//Blocked
Route::get('customer/blocked', [CustomerController::class, 'CustomerBlocked'])->name('admin.customer.blocked');
Route::post('customer/blocked', [CustomerController::class, 'CustomerBlockedPost'])->name('admin.customer.blocked.Post');
Route::get('customer/blocked/ChangeAccsess/{id?}', [CustomerController::class, 'CustomerBlockedChangeAccess'])->name('admin.customer.blocked.changeAcssess');
Route::post('customer/blocked/ChangeAccsess/{id?}', [CustomerController::class, 'CustomerBlockedChangeAccessPost'])->name('admin.customer.blocked.changeAcssess.post');

//DeliveryStaff
//pending
Route::get('DeliveryStaff/pendings', [DeliveryStaffController::class, 'DeliveryStaffPending'])->name('admin.DeliveryStaff.pending');
Route::post('DeliveryStaff/pendings', [DeliveryStaffController::class, 'DeliveryStaffPendingPost'])->name('admin.DeliveryStaff.pending.Post');
Route::get('DeliveryStaff/pendings/ChangeAccsess/{id?}', [DeliveryStaffController::class, 'DeliveryStaffPendingChangeAccess'])->name('admin.DeliveryStaff.pending.changeAcssess');
Route::post('DeliveryStaff/pendings/ChangeAccsess/{id?}', [DeliveryStaffController::class, 'DeliveryStaffPendingChangeAccessPost'])->name('admin.DeliveryStaff.pending.changeAcssess.post');
//Active
Route::get('DeliveryStaff/actives', [DeliveryStaffController::class, 'DeliveryStaffActive'])->name('admin.DeliveryStaff.active');
Route::post('DeliveryStaff/actives', [DeliveryStaffController::class, 'DeliveryStaffActivePost'])->name('admin.DeliveryStaff.active.Post');
Route::get('DeliveryStaff/actives/ChangeAccsess/{id?}', [DeliveryStaffController::class, 'DeliveryStaffActiveChangeAccess'])->name('admin.DeliveryStaff.active.changeAcssess');
Route::post('DeliveryStaff/actives/ChangeAccsess/{id?}', [DeliveryStaffController::class, 'DeliveryStaffActiveChangeAccessPost'])->name('admin.DeliveryStaff.active.changeAcssess.post');

//Blocked
Route::get('DeliveryStaff/blocked', [DeliveryStaffController::class, 'DeliveryStaffBlocked'])->name('admin.DeliveryStaff.blocked');
Route::post('DeliveryStaff/blocked', [DeliveryStaffController::class, 'DeliveryStaffBlockedPost'])->name('admin.DeliveryStaff.blocked.Post');
Route::get('DeliveryStaff/blocked/ChangeAccsess/{id?}', [DeliveryStaffController::class, 'DeliveryStaffBlockedChangeAccess'])->name('admin.DeliveryStaff.blocked.changeAcssess');
Route::post('DeliveryStaff/blocked/ChangeAccsess/{id?}', [DeliveryStaffController::class, 'DeliveryStaffBlockedChangeAccessPost'])->name('admin.DeliveryStaff.blocked.changeAcssess.post');

//vendors
//pending
Route::get('Vendor/pendings', [VendorController::class, 'VendorPending'])->name('admin.Vendor.pending');
Route::post('Vendor/pendings', [VendorController::class, 'VendorPendingPost'])->name('admin.Vendor.pending.Post');
Route::get('Vendor/pendings/ChangeAccsess/{id?}', [VendorController::class, 'VendorPendingChangeAccess'])->name('admin.Vendor.pending.changeAcssess');
Route::post('Vendor/pendings/ChangeAccsess/{id?}', [VendorController::class, 'VendorPendingChangeAccessPost'])->name('admin.Vendor.pending.changeAcssess.post');

//Active
Route::get('Vendor/actives', [VendorController::class, 'VendorActive'])->name('admin.Vendor.active');
Route::post('Vendor/actives', [VendorController::class, 'VendorActivePost'])->name('admin.Vendor.active.Post');
Route::get('Vendor/actives/ChangeAccsess/{id?}', [VendorController::class, 'VendorActiveChangeAccess'])->name('admin.Vendor.active.changeAcssess');
Route::post('Vendor/actives/ChangeAccsess/{id?}', [VendorController::class, 'VendorActiveChangeAccessPost'])->name('admin.Vendor.active.changeAcssess.post');

//Blocked
Route::get('Vendor/blocked', [VendorController::class, 'VendorBlocked'])->name('admin.Vendor.blocked');
Route::post('Vendor/blocked', [VendorController::class, 'VendorBlockedPost'])->name('admin.Vendor.blocked.Post');
Route::get('Vendor/blocked/ChangeAccsess/{id?}', [VendorController::class, 'VendorBlockedChangeAccess'])->name('admin.Vendor.blocked.changeAcssess');
Route::post('Vendor/blocked/ChangeAccsess/{id?}', [VendorController::class, 'VendorBlockedChangeAccessPost'])->name('admin.Vendor.blocked.changeAcssess.post');


//Charts
Route::get('statistics/UserRatio', [ChartController::class, 'UserRatio'])->name('admin.statistics.UserRatio');
Route::get('statistics/ProductSelling', [ChartController::class, 'ProductSelling'])->name('admin.statistics.ProductSellingStat');