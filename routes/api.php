<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\FarmerController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\RawMaterialController;
use App\Http\Controllers\Api\BagTypeController;

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
            Route::post('/verify-otp', [AuthController::class, 'verify_OTP'])->middleware('auth:api');
            Route::post('/resend-otp', [AuthController::class, 'resend_OTP'])->middleware('auth:api');
        });
        //password
        Route::prefix('password')->group(function () {
            Route::post('forgot', [PasswordResetController::class, 'forgotPassword']);
            Route::post('update', [PasswordResetController::class, 'updatePassword']);
        });
    });
    Route::middleware(['auth:api', 'ensure.otp.auth'])->group(function (){
        //farmers
        Route::resource('farmers', FarmerController::class)->except(['create', 'edit', 'update', 'destroy']);
        Route::post('farmers-search', [FarmerController::class, 'search']);
        Route::post('farmers-region-filter', [FarmerController::class, 'filter']);
        Route::post('farmers-verify-phone-number', [FarmerController::class, 'verify_OTP']);
        Route::post('farmers-resend-otp', [FarmerController::class, 'resend_OTP']);

        Route::post('/regions', RegionController::class);
        Route::post('/bag-types', BagTypeController::class);

        Route::post('/raw-materials', [RawMaterialController::class, 'index']);
        Route::post('/raw-materials-prices', [RawMaterialController::class, 'fetch_price']);
        Route::post('/raw-materials-requirements', [RawMaterialController::class, 'fetch_requirements']);
        Route::post('/raw-materials-requirement-submission/create', [RawMaterialController::class, 'create_raw_material_requirements_submission']);
        Route::post('/raw-materials-requirement-submission/view', [RawMaterialController::class, 'view_raw_material_requirements_submission']);

    });
});
