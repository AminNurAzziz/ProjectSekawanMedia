<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\BranchManagerController;
use App\Http\Controllers\CompanyDriverController;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\HeadOfficeManagerController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Models\BranchManager;

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

// Route::get('/', function () {
//     return view('dashboard.dashboard');
//     // return view('bookings.create');
// });

// Route::get('/login', function () {
//     return view('auth.login');
// });
// Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route::get('/dashboard', [BookingController::class, 'dashboard'])->name('dashboard');
// Route::get('/report', [BookingController::class, 'report'])->name('report');
// Route::get('/download-pdf', [BookingController::class, 'downloadPDF'])->name('dashboard.pdf');
// Route::get('/dashboard-excel', [BookingController::class, 'downloadExcel'])->name('dashboard.excel');



// Route::prefix('bookings')->group(function () {
//     Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
//     Route::get('/create', [BookingController::class, 'create'])->name('bookings.create');
//     Route::post('/', [BookingController::class, 'store'])->name('bookings.store');
//     Route::patch('/return-vehicle', [BookingController::class, 'returnBooking'])->name('return.vehicle');
// });


// Route::resource('booking-histories', BookingHistoryController::class);
// Route::resource('vehicles', VehicleController::class);
// Route::resource('head-office-managers', HeadOfficeManagerController::class);
// Route::resource('company-drivers', CompanyDriverController::class);
// Route::resource('positions', PositionController::class);
// Route::resource('branches', BranchController::class);
// Route::resource('branch-managers', BranchManagerController::class);

Route::middleware(['auth'])->group(function () {
    // Rute-rute yang perlu diakses oleh pengguna yang sudah diotentikasi
    Route::get('/dashboard', [BookingController::class, 'dashboard'])->name('dashboard');
    Route::get('/report', [BookingController::class, 'report'])->name('report');
    Route::get('/download-pdf', [BookingController::class, 'downloadPDF'])->name('dashboard.pdf');
    Route::get('/dashboard-excel', [BookingController::class, 'downloadExcel'])->name('dashboard.excel');

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
