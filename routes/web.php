<?php

use App\Models\BranchManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\LogProcessController;
use App\Http\Controllers\BranchManagerController;
use App\Http\Controllers\CompanyDriverController;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeadOfficeManagerController;

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

Route::middleware(['auth'])->group(function () {
    // Rute-rute yang perlu diakses oleh pengguna yang sudah diotentikasi
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/report', [DashboardController::class, 'dashboardReport'])->name('dashboard.report');
    Route::get('/download-pdf', [DashboardController::class, 'downloadPDF'])->name('dashboard.pdf');
    Route::get('/dashboard-excel', [DashboardController::class, 'downloadExcel'])->name('dashboard.excel');

    Route::prefix('bookings')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/', [BookingController::class, 'store'])->name('bookings.store');
        Route::patch('/return-vehicle', [BookingController::class, 'returnBooking'])->name('return.vehicle');
    });

    Route::resource('booking-histories', BookingHistoryController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('head-office-managers', HeadOfficeManagerController::class);
    Route::resource('company-drivers', CompanyDriverController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('branch-managers', BranchManagerController::class);
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/approval', [BranchManagerController::class, 'approvalsToMake'])->name('approvals.index');


Route::patch('booking/{id}/{status}', [BookingController::class, 'updateApproval'])->name('bookings.approval');

Route::get('/logs', [LogProcessController::class, 'index'])->name('logs.index');
Route::delete('/logs', [LogProcessController::class, 'destroyAll'])->name('logs.reset');

Route::patch('/reset-km-service/{id}', [VehicleController::class, 'resetKMService'])->name('reset.km.service');
Route::patch('/add-bbm/{id}', [VehicleController::class, 'addBBM'])->name('add.bbm');


Route::get('/', function () {
    return redirect('/login');
});
