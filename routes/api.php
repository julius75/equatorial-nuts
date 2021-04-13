<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordResetController;

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

            Route::prefix('password')->group(function () {
                Route::post('forgot', [PasswordResetController::class, 'forgotPassword']);
                Route::get('find/{token}', [PasswordResetController::class, 'find']);
                Route::post('update', [PasswordResetController::class, 'updatePassword']);
            });
        });
    });
});
