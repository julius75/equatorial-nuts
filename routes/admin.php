<?php

use App\Http\Controllers\Admin\AdminController;
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
//status update
Route::post('update-status/{id}', [UserController::class,'statusUpdate']);
Route::get('/getchart/{month?}/{year?}', [HomeController::class, 'getMonthlyPostDataWeekly'])->name('discussions-analytics');

Route::get('/test', [UserController::class, 'test'])->name('test');


//app-admins
Route::resource('app-admins', AdminController::class);
//profile update
Route::resource('profile', ProfileController::class);
//transaction
//default list
Route::get('/default', [UserController::class, 'default'])->name('default');


//datatable routes
Route::prefix('datatables')->group(function () {
    Route::get('get-app-users', [UserController::class, 'getUsers'])->name('get-app-users');
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
