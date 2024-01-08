<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\VendorController;
use App\Http\Controllers\Master\OfficeController;
use App\Http\Controllers\Master\KurirController;
use App\Http\Controllers\Setting\UserController;
use App\Http\Controllers\Setting\RoleController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::controller(VendorController::class)->group(function(){
//     Route::get('master/vendor', 'index')->name('master.vendor');
// });
// Route::controller(OfficeController::class)->group(function(){
//     Route::get('master/office', 'index')->name('master.office');
// });
Route::controller(KurirController::class)->group(function(){
    Route::get('master/kurir', 'index')->name('master.kurir');
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
});
Route::get('/cities', [OfficeController::class, 'getCitiesByProvince'])->name('cities.get');
Route::get('dropdown', [DropdownController::class, 'index']);
Route::post('api/fetch-city', [DropdownController::class, 'fetchCity']);
Route::post('api/fetch-subdistrict', [DropdownController::class, 'fetchSubdistrict']);
Route::post('api/fetch-village', [DropdownController::class, 'fetchVillage']);



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
