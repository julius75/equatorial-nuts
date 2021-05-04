<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BuyingCentreController;
use App\Http\Controllers\Admin\FarmerController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PriceListController;
use App\Http\Controllers\Admin\RawMaterialController;
use App\Http\Controllers\Admin\AccountBalanceController;
use App\Http\Controllers\Admin\UtilityBalanceController;
use App\Http\Controllers\Admin\OrderController;

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
Route::get('/dashboard/monthly-purchases-filter', [HomeController::class, 'disbursed_payments_filter'])->name('dashboard.disbursed_payments_filter');
Route::post('/dashboard/monthly-purchases-filter', [HomeController::class, 'disbursed_payments_filter'])->name('dashboard.disbursed_payments_filter.post');
//buyers
Route::resource('app-users', UserController::class);
Route::get('view-buyer-assignments/{encryptedID}', [UserController::class, 'view_buyer_assignments'])->name('view-buyer-assignments');
Route::post('update-buyer-assignment/{encryptedID}', [UserController::class, 'update_buyer_assignments'])->name('update-buyer-assignment');


Route::get('/app-users/monthly-purchases-filter-buyer/{region?}/{month?}/{id?}', [UserController::class, 'disbursed_payments_filter_buyer'])->name('monthly-purchases-filter-buyer');

//app-admins
Route::resource('app-admins', AdminController::class);

Route::resource('price-lists', PriceListController::class);
Route::get('price-lists-current', [PriceListController::class,'current'])->name('price-lists.current');
Route::get('price-lists-pending-approval', [PriceListController::class,'pending_approval'])->name('price-lists.pending-approval');
Route::get('price-lists-approve/{priceListID}', [PriceListController::class,'approve'])->name('price-lists.approve');
Route::get('price-lists-suspend/{priceListID}', [PriceListController::class,'suspend'])->name('price-lists.suspend');

Route::get('raw-material-requirements', [RawMaterialController::class,'requirements'])->name('raw-materials.requirements');
Route::get('raw-material-requirements/{id}/view', [RawMaterialController::class,'view_requirements'])->name('raw-materials.view.requirement');
Route::get('raw-material-requirements/{id}/create', [RawMaterialController::class,'create_new_requirement'])->name('raw-materials.create.requirement');
Route::post('raw-material-requirements/store', [RawMaterialController::class,'store_new_requirement'])->name('raw-materials.store.requirement');
Route::get('edit-requirement/{id}/', [RawMaterialController::class,'edit_requirement'])->name('edit-requirement');
Route::get('raw/{raw_material}/{id}', [RawMaterialController::class,'raw_material_requirements'])->name('raw');


//admin status
Route::post('update-status-admin/{id}', [AdminController::class,'statusUpdate']);

//status update
Route::post('update-status/{id}', [UserController::class,'statusUpdate']);
Route::post('update-status-farmers/{id}', [FarmerController::class,'statusUpdate']);

Route::post('delete-farmers/{id}', [FarmerController::class,'DeleteFarmer']);
Route::post('buying-centre/{id}', [BuyingCentreController::class,'AttachCentre']);

Route::get('/getchart/{month?}/{year?}', [HomeController::class, 'getMonthlyPostDataWeekly'])->name('discussions-analytics');

//app-admins
Route::resource('app-admins', AdminController::class);
Route::get('edit-raw-material/{id}/{ids}', [RawMaterialController::class, 'test'])->name('edit-raw-material');
Route::post('update-materials', [RawMaterialController::class,'update_materials'])->name('update-materials');

Route::get('/getSubCounty/{id}', [RegionController::class, 'getSubCounty'])->name('getSubCounty');
//app-admins
//new region
Route::post('updateRegionsDetails/{id}', [RegionController::class, 'updateRegionsDetails'])->name('updateRegionsDetails');

Route::resource('app-admins', AdminController::class);
//farmers
Route::resource('app-farmers', FarmerController::class);
//regions
Route::resource('app-regions', RegionController::class);
//buying centre
Route::resource('app-buying-centre', BuyingCentreController::class);
//orders
Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/map', [OrderController::class, 'map'])->name('orders.map');
    Route::post('/map', [OrderController::class, 'map'])->name('orders.map.post');
    Route::get('/{ref_number}', [OrderController::class, 'show'])->name('orders.show');
});



//datatable routes
Route::prefix('datatables')->group(function () {
    Route::get('get-app-users', [UserController::class, 'getUsers'])->name('get-app-users');
    Route::get('get-admin-users', [AdminController::class, 'getAdminUsers'])->name('get-admin-users');
    Route::get('get-current-pricelists', [PriceListController::class, 'get_current_pricelists'])->name('get-current-pricelists');
    Route::get('get-pending-approval-pricelists', [PriceListController::class, 'get_pending_approval'])->name('get-pending-approval-pricelists');
    Route::get('get-all-pricelists', [PriceListController::class, 'get_all_pricelists'])->name('get-all-pricelists');

    Route::get('get-raw-material-requirements', [RawMaterialController::class, 'get_requirements'])->name('get-raw-material-requirements');
    Route::get('get-raw-material-requirements/{id}', [RawMaterialController::class, 'get_requirements_single'])->name('get-raw-material-requirement-single');
    Route::get('get-app-farmers', [FarmerController::class, 'getAdminFarmers'])->name('get-app-farmers');
    Route::get('get-app-regions', [RegionController::class, 'getAdminRegions'])->name('get-app-regions');
    Route::get('get-app-regions-buying-centers/{id}', [RegionController::class, 'getRegions'])->name('get-app-regions-buying-centers');
    Route::get('get-app-regions-raw/{id}', [RegionController::class, 'getMaterials'])->name('get-app-regions-raw');
    Route::get('get-app-buying-centre', [BuyingCentreController::class, 'getCentres'])->name('get-app-buying-centre');

    Route::get('get-orders', [OrderController::class, 'get_orders'])->name('get-orders');
    Route::get('get-order-raw-material-requirement-submissions/{ref_number}', [OrderController::class, 'get_order_raw_material_requirement_submissions'])->name('get-order-raw-material-requirement-submissions');
    Route::get('get-order-mpesa-transaction/{ref_number}', [OrderController::class, 'get_order_mpesa_transaction'])->name('get-order-mpesa-transaction');

    Route::get('get-buyer-assignments/{encryptedID}', [UserController::class, 'view_buyer_assignments_data'])->name('get-buyer-assignments');
    Route::get('get-buyer-orders/{encryptedID}', [UserController::class, 'get_orders'])->name('get-buyer-orders');


});
//charts routes
Route::prefix('charts')->group(function () {
    //
});



Route::get('/utility-balances', [UtilityBalanceController::class, 'index'])->name('utility-balances');
Route::get('/mpesa-account-balance/post', [AccountBalanceController::class, 'mpesa_balance'])->name('mpesa.post-account-balance');

require __DIR__.'/admin_auth.php';
