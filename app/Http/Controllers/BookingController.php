<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Branch;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\CompanyDriver;
use App\Models\BookingHistory;
use App\Exports\PeriodicReport;
use App\Services\BookingService;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\BranchManagerService;
use App\Services\CompanyDriverService;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreBookingRequest;
use App\Services\HeadOfficeManagerService;
use App\Http\Requests\ReturnBookingRequest;
use App\Http\Requests\ReturnVehicleRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Validation\ValidationException;





class BookingController extends Controller
{
    protected $bookingService;
    protected $vehicleService;
    protected $companyDriverService;
    protected $branchManager;
    protected $HeadOfficeManager;

    public function __construct(BookingService $bookingService, VehicleService $vehicleService, CompanyDriverService $companyDriverService, BranchManagerService $branchManager, HeadOfficeManagerService $HeadOfficeManager)
    {
        $this->bookingService = $bookingService;
        $this->vehicleService = $vehicleService;
        $this->companyDriverService = $companyDriverService;
        $this->branchManager = $branchManager;
        $this->HeadOfficeManager = $HeadOfficeManager;
    }

    public function dashboard()
    {
        $totalBookings = Booking::where('BookingStatus', 'Pending')->count();
        $totalAvailableVehicles = Vehicle::where('VehicleStatus', 'Available')->count();
        $totalVehiclesNeedService = Vehicle::where('KM_Need_Service', '<=', 1000)->count();
        $totalVehiclesOnTrip = Vehicle::where('VehicleStatus', 'On-Trip')->count();
        $lastBookingHistories = Booking::orderBy('BookingDate', 'desc')->limit(10)->get();

        $vehicles = $this->vehicleService->index();

        $periodicReportMonth = BookingHistory::getPeriodicReportForMonth();
        return view('dashboard.dashboard', compact('totalBookings', 'totalAvailableVehicles', 'totalVehiclesNeedService', 'totalVehiclesOnTrip', 'lastBookingHistories', 'vehicles', 'periodicReportMonth'));
    }

    public function report()
    {
        $periodicReport = BookingHistory::getPeriodicReportForYear();
        return view('dashboard.periodic_report', compact('periodicReport'));
    }


    public function index()
    {
        $bookings = $this->bookingService->index();
        return view('bookings.index', compact('bookings'));
    }


    public function create()
    {
        $vehicles = $this->vehicleService->index();
        $drivers = $this->companyDriverService->getAllCompanyDrivers();
        $branchManagers = $this->branchManager->getAllBranchManagers();
        $headOfficeManagers = $this->HeadOfficeManager->getAllHeadOfficeManagers();
        return view('bookings.create', compact('vehicles', 'drivers', 'branchManagers', 'headOfficeManagers'));
    }


    public function store(StoreBookingRequest $request)
    {
        $bookingData = $request->validated();
        try {
            $this->bookingService->store($bookingData);

            return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
        } catch (ValidationException $e) {
            return redirect()->route('bookings.create')->with('error', 'Validation error: ' . $e->getMessage());
        } catch (QueryException $e) {
            return redirect()->route('bookings.create')->with('error', 'Failed to create booking: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('bookings.create')->with('error', 'Failed to create booking: ' . $e->getMessage());
        }
    }


    public function show(Booking $booking)
    {
        //
    }

    public function edit(Booking $booking)
    {
        //
    }

    public function updateApproval($id, $bookingStatus)
    {
        try {
            $booking = $this->bookingService->find($id);
            if (!$booking) {
                return response()->json(['message' => 'Booking not found'], 404);
            }
            $this->bookingService->updateApproval($booking, $bookingStatus);

            return response()->json(['message' => 'Booking updated successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error: ' . $e->getMessage()], 422);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to update booking: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update booking: ' . $e->getMessage()], 500);
        }
    }

    public function returnBooking(ReturnBookingRequest $request)
    {
        try {
            // Mendapatkan objek Booking dari basis data berdasarkan VehicleID
            $booking = $this->bookingService->getBookingByVehicleID($request->VehicleID);

            // Memanggil metode returnBooking dengan objek Booking dan data yang diperlukan
            $returnData = $request->validated();
            $returnData['BookingID'] = $booking->BookingID; // Memasukkan BookingID ke dalam data
            $this->bookingService->returnBooking($booking, $returnData);

            // Mengembalikan view dengan pesan sukses
            return redirect('/booking-histories')->with('success', 'Booking returned successfully');
        } catch (ValidationException $e) {
            // Mengembalikan view dengan pesan error validasi
            return redirect('/booking-histories')->with('message', 'Validation error: ' . $e->getMessage());
        } catch (QueryException $e) {
            // Mengembalikan view dengan pesan error saat mengakses basis data
            return redirect('/booking-histories')->with('message', 'Failed to update booking: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Mengembalikan view dengan pesan error umum
            return redirect('/booking-histories')->with('message', 'Failed to update booking: ' . $e->getMessage());
        }
    }
    public function destroy(Booking $booking)
    {
        //
    }

    public function downloadPDF()
    {
        // Data laporan periodik
        $periodicReport = BookingHistory::getPeriodicReportForYear();

        // Buat instance Dompdf
        $dompdf = new Dompdf();

        // Buat options untuk konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Set options ke Dompdf
        $dompdf->setOptions($options);

        // Render halaman HTML ke PDF
        $dompdf->loadHtml(view('dashboard.periodic_report_pdf', compact('periodicReport')));

        // Render PDF
        $dompdf->render();

        // Unduh PDF
        $dompdf->stream('periodic_report.pdf');
    }

    public function downloadExcel()
    {
        return Excel::download(new PeriodicReport, 'periodic_report.xlsx');
    }
}
