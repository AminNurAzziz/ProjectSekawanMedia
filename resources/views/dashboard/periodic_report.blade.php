@extends('layouts.layout')

@section('title', 'Home')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Periodic Vehicle Report</h1>
            <div>
                <a href="{{ route('dashboard.pdf') }}" class="d-none d-sm-inline-block btn btn-danger shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Download Report (PDF)
                </a>
    
                <a href="{{ route('dashboard.excel') }}" class="d-none d-sm-inline-block btn btn-success shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Download Report (Excel)
                </a>
            </div>
            
        </div>


         <!-- Periodic Vehicle Report -->
         <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Periodic Vehicle Report</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="periodicReportTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Vehicle</th>
                                        <th>Return Date</th>
                                        <th>Last Odometer Reading</th>
                                        <th>Fuel Used</th>
                                        <th>Booking Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($periodicReport as $report)
                                    <tr class="{{ $report->BookingStatus === 'Cancelled' ? 'table-danger' : ($report->BookingStatus === 'On-Trip' ? 'table-warning' : ($report->BookingStatus === 'Completed' ? 'table-success' : '')) }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $report->booking->VehicleID }}</td>
                                        <td>{{ $report->ReturnDate }}</td>
                                        <td>{{ $report->LastOdometerReading }} KM</td>
                                        <td>{{ $report->FuelUsed }} Liters</td>
                                        <td>{{ $report->BookingStatus }}</td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

        </div>
    </div>

@endsection