<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('users/signup', [UserController::class, 'register']);

Route::post('users/login', [UserController::class, 'login']);


Route::get('user', [UserController::class, 'getUserwithReviews']);


Route::apiResource('diners', RestaurantController::class);

Route::delete('diners/delete/{id}', [RestaurantController::class, 'destroy']);

//review route
Route::apiResource('reviews', ReviewController::class);