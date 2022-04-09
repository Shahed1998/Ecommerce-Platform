<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer\registrationController;

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

// Sign up
Route::post('/signup', [registrationController::class, 'signup'])->middleware('XSSsanitizer');

// 404 page: not found
// Custom fallback route
Route::any('{any}', function(){
    return response()->json([
        "status"=>"Failed",
        "message"=>"Oops! page not found"
    ], 404);
})->where('any', '.*');