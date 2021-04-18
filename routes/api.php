<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\FarmerController;
use App\Http\Controllers\Api\RegionController;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('v1')->group(function () {
    //user
    Route::prefix('user')->group(function () {
        //login, forgot and update passwords
        Route::prefix('login')->group(function (){
            Route::post('/', [AuthController::class, 'login']);
        });
        //password
        Route::prefix('password')->group(function () {
            Route::post('forgot', [PasswordResetController::class, 'forgotPassword']);
            Route::post('update', [PasswordResetController::class, 'updatePassword']);
        });
    });
    Route::middleware('auth:api')->group(function (){
        //farmers
        Route::resource('farmers', FarmerController::class)->except(['create', 'edit', 'update', 'destroy']);
        Route::post('farmers-search', [FarmerController::class, 'search']);
        Route::post('farmers-region-filter', [FarmerController::class, 'filter']);
        Route::post('farmers-verify-phone-number', [FarmerController::class, 'verify_OTP']);
        Route::post('farmers-resend-otp', [FarmerController::class, 'resend_OTP']);

        Route::post('/regions', RegionController::class);

    });
});
