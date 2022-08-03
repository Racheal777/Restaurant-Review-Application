<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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



//add a restaurant
Route::apiResource('diners', RestaurantController::class);

Route::get('diner/{id}', [RestaurantController::class, "averageRatings"]);


//searching
Route::get('diner', [RestaurantController::class, 'searching']);
//Route::delete('diners/delete/{id}', [RestaurantController::class, 'destroy']);


Route::middleware('auth:api')->group(function(){

//review route
Route::apiResource('reviews', ReviewController::class);

//favorites route
Route::apiResource('favorites', FavoriteController::class);

//user route
Route::get('user', [UserController::class, 'getUserwithReviews']);


//logout
Route::get('user/logout', [UserController::class, 'logout']);


});

//sends
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth:api')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth',  'signed'])->name('verification.verify');


//resend emai
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');