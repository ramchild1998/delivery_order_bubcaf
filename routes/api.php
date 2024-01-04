<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use app\Http\Controllers\API\VendorController;
use App\Http\Controllers\API\OfficeController;
use App\Http\Controllers\API\KurirController;
use App\Http\Controllers\API\APIController;


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
    Route::get('/users', [UserController::class, 'index']);
});


Route::controller(AuthController::class)->group(function () {
    // Auth
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
    Route::post('sanctum/token', 'create_token')->middleware('auth:sanctum');
    
});

// Route::post('/sanctum/token', 'APIController@create_token');

