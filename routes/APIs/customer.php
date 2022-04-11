<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer\dashboardController;
use App\Http\Controllers\customer\login;
use App\Http\Controllers\customer\edit;
use App\Http\Controllers\customer\delete;
use App\Http\Controllers\customer\product;
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

// Customer entity
// Note: Signup is in api.php
Route::post('/login', [login::class, 'postLogin']);
Route::post('/dashboard', [dashboardController::class, 'getDashboard']);
Route::put('/edit', [edit::class, 'updatePatch']);
Route::delete('/delete', [delete::class, 'delete']);

// Product entity
Route::get('/product/all', [product::class, 'getProduct']);
Route::post('/addToCart', [product::class, 'addToCart']);
Route::delete('/deleteFromCart', [product::class, 'deleteFromCart']);

// Feedback entity
Route::get("/product/feedback/{review_id}", [product::class, 'viewProdReview']);
Route::post("/product/feedback", [product::class, 'addProdReview']);
Route::patch("/product/feedback/{review_id}", [product::class, 'editProdReview']);
Route::delete("/product/feedback/{review_id}", [product::class, 'deleteProdReview']);
