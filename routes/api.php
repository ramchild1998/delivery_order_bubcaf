<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use app\Http\Controllers\API\VendorController;
// use app\Http\Controllers\Master\VendorController;
use App\Http\Controllers\API\OfficeController;
use App\Http\Controllers\API\KurirController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{user}', [UserController::class, 'update']);
    Route::delete('users/{user}', [UserController::class, 'destroy']);

    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('roles', [RoleController::class, 'store']);
    Route::put('roles/{role}', [RoleController::class, 'update']);
    Route::delete('roles/{role}', [RoleController::class, 'destroy']);

    Route::get('/offices', [OfficeController::class, 'index']);
    Route::post('offices', [OfficeController::class, 'store']);
    Route::put('offices/{office}', [OfficeController::class, 'update']);
    Route::delete('offices/{office}', [OfficeController::class, 'destroy']);

    // Vendors
    Route::get('vendors', [VendorController::class, 'search']);
    Route::get('vendors', [VendorController::class, 'getDataVendor']);
    Route::get('vendors/detail', [VendorController::class, 'detailVendor']);
    Route::post('vendors', [VendorController::class, 'insertVendor']);
    Route::put('vendors/update', [VendorController::class, 'updateVendor']);
    Route::delete('vendors/delete', [VendorController::class, 'deleteVendor']);
});


Route::controller(AuthController::class)->group(function () {
    // Auth
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
    Route::post('sanctum/token', 'create_token')->middleware('auth:sanctum');
    
});

// Route::post('/sanctum/token', 'APIController@create_token');


