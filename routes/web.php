<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\admin\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

// Login routes
Route::get('/login', [Login::class, 'loginGet'])->name('login');
Route::post('/login', [Login::class, 'loginPost'])->name('login.submit');


// Admin routes
Route::get('admin/home', [AdminController::class, 'home'])->name('admin.home');