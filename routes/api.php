<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchManagerController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyDriverController;
use App\Http\Controllers\HeadOfficeManagerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\AuthController;


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


Route::resource('branch-managers', BranchManagerController::class);
Route::resource('branches', BranchController::class);
Route::resource('company-drivers', CompanyDriverController::class);
Route::resource('head-office-managers', HeadOfficeManagerController::class);
Route::resource('positions', PositionController::class);
Route::resource('vehicles', VehicleController::class);

Route::post('bookings', [BookingController::class, 'store']);
Route::patch('bookings/approval/{id}', [BookingController::class, 'updateApproval']);
Route::patch('bookings/return-vehicle', [BookingController::class, 'returnBooking']);


Route::resource('booking-histories', BookingHistoryController::class);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
