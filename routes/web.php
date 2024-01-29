<?php

use Illuminate\Support\Facades\Route;
use App\Models\Location\City;
use App\Http\Controllers\Master\VendorController;
use App\Http\Controllers\Master\OfficeController;
use App\Http\Controllers\Master\KurirController;
use App\Http\Controllers\Utilities\DeviceController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Setting\RoleController;
use App\Http\Controllers\Setting\ParameterController;
use App\Http\Controllers\JobOrder\PickUpController;
use App\Http\Controllers\JobOrder\TrackingController;
use App\Http\Controllers\Report\DRreportController;
use App\Http\Controllers\Report\PUreportController;
use App\Http\Controllers\Report\KTreportController;
use App\Http\Controllers\Auth\AuthController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(KurirController::class)->group(function(){
    Route::get('master/kurir', 'index')->name('master.kurir');
});



Route::get('/fetch-offices', [UserController::class, 'fetchOffices']);

Route::get('/fetch-cities', [OfficeController::class, 'fetchCities']);
Route::get('/fetch-subdistricts', [OfficeController::class, 'fetchSubdistricts']);
Route::get('/fetch-villages', [OfficeController::class, 'fetchVillages']);

Route::get('/fetch-cities', [KurirController::class, 'fetchCities']);
Route::get('/fetch-subdistricts', [KurirController::class, 'fetchSubdistricts']);
Route::get('/fetch-villages', [KurirController::class, 'fetchVillages']);
Route::get('/fetch-offices', [KurirController::class, 'fetchOffices']);


Route::prefix('master')->group(function () {
    
    Route::prefix('vendors')->group(function () {
        Route::get('/', [VendorController::class, 'index'])->name('vendor.index');
        Route::get('/create', [VendorController::class, 'create'])->name('vendor.create');
        Route::post('/create', [VendorController::class, 'store'])->name('vendor.store');
        Route::get('/{vendor}', [VendorController::class, 'show'])->name('vendor.show');
        Route::get('/{vendor}/edit', [VendorController::class, 'edit'])->name('vendor.edit');
        Route::put('/{vendor}', [VendorController::class, 'update'])->name('vendor.update');
        Route::delete('/{vendor}', [VendorController::class, 'destroy'])->name('vendor.destroy');
    });
    
    Route::prefix('offices')->group(function () {
        Route::get('/', [OfficeController::class, 'index'])->name('office.index');
        Route::get('/create', [OfficeController::class, 'create'])->name('office.create');
        Route::post('/create', [OfficeController::class, 'store'])->name('office.store');
        Route::get('/{office}', [OfficeController::class, 'show'])->name('office.show');
        Route::get('/{office}/edit', [OfficeController::class, 'edit'])->name('office.edit');
        Route::put('/{office}', [OfficeController::class, 'update'])->name('office.update');
        Route::delete('/{office}', [OfficeController::class, 'destroy'])->name('office.destroy');
    });

        
    Route::prefix('kurirs')->group(function () {
        Route::get('/', [KurirController::class, 'index'])->name('kurir.index');
        Route::get('/create', [KurirController::class, 'create'])->name('kurir.create');
        Route::post('/create', [KurirController::class, 'store'])->name('kurir.store');
        Route::get('/{kurir}', [KurirController::class, 'show'])->name('kurir.show');
        Route::get('/{kurir}/edit', [KurirController::class, 'edit'])->name('kurir.edit');
        Route::put('/{kurir}', [KurirController::class, 'update'])->name('kurir.update');
        Route::delete('/{kurir}', [KurirController::class, 'destroy'])->name('kurir.destroy');
    });
});

Route::prefix('settings')->group(function () {

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/create', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/export', [UserController::class, 'export'])->name('user.export');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/create', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/{role}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    Route::prefix('parameter')->group(function () {
        Route::get('/', [ParameterController::class, 'index'])->name('parameter.index');
        Route::get('/create', [ParameterController::class, 'create'])->name('parameter.create');
        Route::post('/create', [ParameterController::class, 'store'])->name('parameter.store');
        Route::get('/{parameter}', [ParameterController::class, 'show'])->name('parameter.show');
        Route::get('/{parameter}/edit', [ParameterController::class, 'edit'])->name('parameter.edit');
        Route::put('/{parameter}', [ParameterController::class, 'update'])->name('parameter.update');
        Route::delete('/{parameter}', [ParameterController::class, 'destroy'])->name('parameter.destroy');
    });

});

Route::prefix('job-order')->group(function () {

    Route::prefix('pick-up')->group(function () {
        Route::get('/', [PickUpController::class, 'index'])->name('pickup.index');
        Route::get('/create', [PickUpController::class, 'create'])->name('pickup.create');
        Route::post('/create', [PickUpController::class, 'store'])->name('pickup.store');
        Route::get('/{pickup}', [PickUpController::class, 'show'])->name('pickup.show');
        Route::get('/{pickup}/edit', [PickUpController::class, 'edit'])->name('pickup.edit');
        Route::put('/{pickup}', [PickUpController::class, 'update'])->name('pickup.update');
        Route::delete('/{pickup}', [PickUpController::class, 'destroy'])->name('pickup.destroy');
        Route::post('/update-status', [PickupController::class, 'updateStatus'])->name('update.status');
    });

    Route::prefix('tracking')->group(function () {
        Route::get('/', [TrackingController::class, 'index'])->name('tracking.index');
        Route::get('/create', [TrackingController::class, 'create'])->name('tracking.create');
        Route::post('/create', [TrackingController::class, 'store'])->name('tracking.store');
        Route::get('/{tracking}', [TrackingController::class, 'show'])->name('tracking.show');
        Route::get('/{tracking}/edit', [TrackingController::class, 'edit'])->name('tracking.edit');
        Route::put('/{tracking}', [TrackingController::class, 'update'])->name('tracking.update');
        Route::delete('/{tracking}', [TrackingController::class, 'destroy'])->name('tracking.destroy');
    });

});


Route::prefix('utilities')->group(function () {

    Route::prefix('device')->group(function () {
        Route::get('/', [DeviceController::class, 'index'])->name('device.index');
        Route::get('/create', [DeviceController::class, 'create'])->name('device.create');
        Route::post('/create', [DeviceController::class, 'store'])->name('device.store');
        Route::get('/{device}', [DeviceController::class, 'show'])->name('device.show');
        Route::get('/{device}/edit', [DeviceController::class, 'edit'])->name('device.edit');
        Route::put('/{device}', [DeviceController::class, 'update'])->name('device.update');
        Route::delete('/{device}', [DeviceController::class, 'destroy'])->name('device.destroy');
    });

});

Route::prefix('report')->group(function () {

    Route::prefix('dr-report')->group(function () {
        Route::get('/', [DRreportController::class, 'index'])->name('dr.index');
        // Route::get('/create', [UserController::class, 'create'])->name('users.create');
        // Route::post('/create', [UserController::class, 'store'])->name('users.store');
        // Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        // Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        // Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        // Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::prefix('pu-report')->group(function () {
        Route::get('/', [PUreportController::class, 'index'])->name('pu.index');
        // Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        // Route::post('/create', [RoleController::class, 'store'])->name('roles.store');
        // Route::get('/{role}', [RoleController::class, 'show'])->name('roles.show');
        // Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        // Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
        // Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    Route::prefix('kt-report')->group(function () {
        Route::get('/', [KTreportController::class, 'index'])->name('kt.index');
        // Route::get('/create', [ParameterController::class, 'create'])->name('parameter.create');
        // Route::post('/create', [ParameterController::class, 'store'])->name('parameter.store');
        // Route::get('/{parameter}', [ParameterController::class, 'show'])->name('parameter.show');
        // Route::get('/{parameter}/edit', [ParameterController::class, 'edit'])->name('parameter.edit');
        // Route::put('/{parameter}', [ParameterController::class, 'update'])->name('parameter.update');
        // Route::delete('/{parameter}', [ParameterController::class, 'destroy'])->name('parameter.destroy');
    });

});