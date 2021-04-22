<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FarmerController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

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
    return \Illuminate\Support\Facades\Redirect::to('admin/dashboard');
});
//homepage
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
//buyers
Route::resource('app-users', UserController::class);
//app-admins
Route::resource('app-admins', AdminController::class);
//admin status
Route::post('update-status-admin/{id}', [AdminController::class,'statusUpdate']);

//status update
Route::post('update-status/{id}', [UserController::class,'statusUpdate']);
Route::post('update-status-farmers/{id}', [FarmerController::class,'statusUpdate']);
Route::post('delete-farmers/{id}', [FarmerController::class,'DeleteFarmer']);

Route::get('/getchart/{month?}/{year?}', [HomeController::class, 'getMonthlyPostDataWeekly'])->name('discussions-analytics');

Route::get('/test', [RegionController::class, 'regions'])->name('regions');
Route::get('/getSubCounty/{id}', [RegionController::class, 'getSubCounty'])->name('getSubCounty');


//app-admins
Route::resource('app-admins', AdminController::class);
//farmers
Route::resource('app-farmers', FarmerController::class);
Route::resource('app-regions', RegionController::class);

//profile update
Route::resource('profile', ProfileController::class);
//transaction
//default list
Route::get('/default', [UserController::class, 'default'])->name('default');


//datatable routes
Route::prefix('datatables')->group(function () {
    Route::get('get-app-users', [UserController::class, 'getUsers'])->name('get-app-users');
    Route::get('get-admin-users', [AdminController::class, 'getAdminUsers'])->name('get-admin-users');
    Route::get('get-app-farmers', [FarmerController::class, 'getAdminFarmers'])->name('get-app-farmers');
    Route::get('get-app-regions', [RegionController::class, 'getAdminRegions'])->name('get-app-regions');

});
//charts routes
Route::prefix('charts')->group(function () {
//for charts
//area chart for transaction
    Route::get('/getchart/{month?}/{year?}', [HomeController::class, 'getMonthlyPostDataWeekly'])->name('discussions-analytics');
});

//test
//Route::get('/test', [HomeController::class, 'getAllMonthsUsers'])->name('test');

require __DIR__.'/admin_auth.php';
