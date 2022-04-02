<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\customer\registrationController;
use App\Http\Controllers\logout;


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
    return view('home');
})->name('home');

// Login routes
Route::get('/login', [Login::class, 'loginGet'])->name('login');
Route::post('/login', [Login::class, 'loginPost'])->name('login.submit');

// Logout
Route::get('/logout', [logout::class, 'logout'])->name('logout');


// Registration
Route::get('/registration', [registrationController::class, 'getRegister'])->name('register');
Route::post('/registration', [registrationController::class, 'postRegister'])->middleware('XSSsanitizer');