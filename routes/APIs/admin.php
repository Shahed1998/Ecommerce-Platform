<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin_Api_Controllers\admin_controller;
use App\Http\Controllers\Admin_Api_Controllers\ProductController;
use App\Http\Controllers\Admin_Api_Controllers\UserController;

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

//admin
Route::get("/get",[admin_controller::class,'test']);
Route::post('/ViewProfile',[admin_controller::class,'ProfileView']);
Route::post('/admin/register',[admin_controller::class,'AdminRegistrationPost']);
Route::post('/activities',[admin_controller::class,'AdminActivities']);
Route::post('/activities/clear',[admin_controller::class,'ClearHistory']);

//product
Route::get("product/view",[ProductController::class,'ViewProducts']);
Route::get("product/view/{id}",[ProductController::class,'ViewProductsById']);
Route::post("/product/add",[ProductController::class,'AddProduct']);
Route::post("/product/update",[ProductController::class,'UpdateProduct']);
Route::post("/product/delete",[ProductController::class,'DeleteProduct']);

//User
Route::post("/user/add",[UserController::class,'AddUser']);
Route::post("/user/delete",[UserController::class,'DeleteUser']);
Route::get("user/view/{id}",[UserController::class,'ShowUser']);
Route::get("user/All/view",[UserController::class,'ShowAllUser']);
Route::post("user/change/access",[UserController::class,'ChangeAccess']);