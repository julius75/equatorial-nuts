<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FarmerController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PriceListController;
use App\Http\Controllers\Admin\RawMaterialController;

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
Route::post('/dashboard', [HomeController::class, 'index'])->name('dashboard.filter');
//buyers
Route::resource('app-users', UserController::class);
//app-admins
Route::resource('app-admins', AdminController::class);

Route::resource('price-lists', PriceListController::class);
Route::get('price-lists-current', [PriceListController::class,'current'])->name('price-lists.current');
Route::get('price-lists-pending-approval', [PriceListController::class,'pending_approval'])->name('price-lists.pending-approval');
Route::get('price-lists-approve/{priceListID}', [PriceListController::class,'approve'])->name('price-lists.approve');

Route::get('raw-material-requirements', [RawMaterialController::class,'requirements'])->name('raw-materials.requirements');
Route::get('raw-material-requirements/{id}/view', [RawMaterialController::class,'view_requirements'])->name('raw-materials.view.requirement');

//admin status
Route::post('update-status-admin/{id}', [AdminController::class,'statusUpdate']);

//status update
Route::post('update-status/{id}', [UserController::class,'statusUpdate']);
Route::post('update-status-farmers/{id}', [FarmerController::class,'statusUpdate']);
Route::post('delete-farmers/{id}', [FarmerController::class,'DeleteFarmer']);

Route::get('/getchart/{month?}/{year?}', [HomeController::class, 'getMonthlyPostDataWeekly'])->name('discussions-analytics');

//app-admins
Route::resource('app-admins', AdminController::class);
Route::get('/test', [RegionController::class, 'regions'])->name('regions');
Route::get('/getSubCounty/{id}', [RegionController::class, 'getSubCounty'])->name('getSubCounty');
//app-admins
Route::resource('app-admins', AdminController::class);
//farmers
Route::resource('app-farmers', FarmerController::class);
//regions
Route::resource('app-regions', RegionController::class);
//default list
Route::get('/default', [UserController::class, 'default'])->name('default');

//datatable routes
Route::prefix('datatables')->group(function () {
    Route::get('get-app-users', [UserController::class, 'getUsers'])->name('get-app-users');
    Route::get('get-admin-users', [AdminController::class, 'getAdminUsers'])->name('get-admin-users');
    Route::get('get-all-pricelists', [PriceListController::class, 'get_all_pricelists'])->name('get-all-pricelists');
    Route::get('get-current-pricelists', [PriceListController::class, 'get_current_pricelists'])->name('get-current-pricelists');
    Route::get('get-pending-approval-pricelists', [PriceListController::class, 'get_pending_approval'])->name('get-pending-approval-pricelists');
    Route::get('get-raw-material-requirements', [RawMaterialController::class, 'get_requirements'])->name('get-raw-material-requirements');
    Route::get('get-raw-material-requirements/{id}', [RawMaterialController::class, 'get_requirements_single'])->name('get-raw-material-requirement-single');
    Route::get('get-app-farmers', [FarmerController::class, 'getAdminFarmers'])->name('get-app-farmers');
    Route::get('get-app-regions', [RegionController::class, 'getAdminRegions'])->name('get-app-regions');

});
//charts routes
Route::prefix('charts')->group(function () {
    //
});

require __DIR__.'/admin_auth.php';
