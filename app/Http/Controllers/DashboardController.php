<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\BookingHistory;
use App\Services\BookingService;
use App\Services\VehicleService;
use App\Services\CompanyDriverService;
use App\Services\BranchManagerService;
use App\Services\HeadOfficeManagerService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeriodicReport;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    protected $bookingService;
    protected $vehicleService;
    protected $companyDriverService;
    protected $branchManager;
    protected $headOfficeManager;

    public function __construct(BookingService $bookingService, VehicleService $vehicleService, CompanyDriverService $companyDriverService, BranchManagerService $branchManager, HeadOfficeManagerService $headOfficeManager)
    {
        parent::__construct();
        $this->bookingService = $bookingService;
        $this->vehicleService = $vehicleService;
        $this->companyDriverService = $companyDriverService;
        $this->branchManager = $branchManager;
        $this->headOfficeManager = $headOfficeManager;
    }


    public function dashboard()
    {
        try {
            $totalBookings = Booking::where('BookingStatus', 'Pending')->count();
            $totalAvailableVehicles = Vehicle::where('VehicleStatus', 'Available')->count();
            $totalVehiclesNeedService = Vehicle::where('KM_Need_Service', '<=', 1000)->count();
            $totalVehiclesOnTrip = Vehicle::where('VehicleStatus', 'On-Trip')->count();
            $lastBookingHistories = Booking::orderBy('BookingDate', 'desc')->limit(10)->get();
            $vehicles = $this->vehicleService->index();
            $periodicReportMonth = BookingHistory::getPeriodicReportForMonth();

            $this->logService->createLog('Fetched dashboard data successfully', 'fetch');
            return view('dashboard.dashboard', compact('totalBookings', 'totalAvailableVehicles', 'totalVehiclesNeedService', 'totalVehiclesOnTrip', 'lastBookingHistories', 'vehicles', 'periodicReportMonth'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch dashboard data: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch dashboard data: ' . $e->getMessage());
        }
    }


    public function dashboardReport()
    {
        try {
            $periodicReport = BookingHistory::getPeriodicReportForYear();

            $this->logService->createLog('Fetched periodic report data successfully', 'fetch');
            return view('dashboard.periodic_report', compact('periodicReport'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch periodic report data: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch periodic report data: ' . $e->getMessage());
        }
    }

    public function downloadPDF()
    {
        try {
            $periodicReport = BookingHistory::getPeriodicReportForYear();
            $dompdf = new Dompdf();
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $dompdf->setOptions($options);
            $dompdf->loadHtml(view('dashboard.periodic_report_pdf', compact('periodicReport')));
            $dompdf->render();
            $dompdf->stream('periodic_report.pdf');

            Log::info('PDF downloaded successfully');
        } catch (\Exception $e) {
            Log::error('Failed to download PDF: ' . $e->getMessage());
            return back()->with('error', 'Failed to download PDF: ' . $e->getMessage());
        }
    }

    public function downloadExcel()
    {
        try {
            return Excel::download(new PeriodicReport, 'periodic_report.xlsx');

            Log::info('Excel downloaded successfully');
        } catch (\Exception $e) {
            Log::error('Failed to download Excel: ' . $e->getMessage());
            return back()->with('error', 'Failed to download Excel: ' . $e->getMessage());
        }
    }
}
