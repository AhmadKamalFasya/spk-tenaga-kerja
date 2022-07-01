<?php

use App\Http\Controllers\auth\loginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\SalesRevenueController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  // Route::post('/logouts', [loginController::class, 'logout']);s
  return $request->user();
});

// Regiser
Route::prefix('auth')->group(function () {
  Route::post('/register', RegisterController::class);
  Route::post('/login', [loginController::class, 'login']);
  Route::post('/logout', [loginController::class, 'logout'])->middleware('auth:sanctum');
});

// === CLIENT ===

// Karyawan 
Route::resource('/karyawan', KaryawanController::class)->except('create', 'edit');
