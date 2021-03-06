<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\FarmerController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\RawMaterialController;
use App\Http\Controllers\Api\BagTypeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\DisbursementController;
use App\Http\Controllers\Admin\AccountBalanceController;


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

        Route::post('/orders', [OrderController::class, 'list_orders']);
        Route::post('/orders-view', [OrderController::class, 'view_order']);
        Route::post('/orders-create-new', [OrderController::class, 'create_order']);
        Route::post('/order-reports', [OrderController::class, 'order_reports']);

        Route::post('/initiate-mpesa-disbursement', [DisbursementController::class, 'post_disbursement']);
    });

    Route::post('/mpesa-disbursement-result-url', [DisbursementController::class, 'result'])->name('mpesa_disbursement.result');
    Route::post('/mpesa-disbursement-timeout-url', [DisbursementController::class, 'timeout'])->name('mpesa_disbursement.timeout');
    Route::post('/mpesa-account-balance/result', [AccountBalanceController::class, 'mpesa_balance_result'])->name('mpesa_account_balance.result');
    Route::post('/mpesa-account-balance/timeout', [AccountBalanceController::class, 'mpesa_balance_timeout'])->name('mpesa_account_balance.timeout');

});
