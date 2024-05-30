@extends('layouts.layout')

@section('title', 'Home')

@section('content')
d
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <div>
                <a href="/booking-histories" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
                    <i class="fas fa-car fa-sm text-white-50"></i> History Bookings
                </a>

                <a href="{{ route('dashboard.pdf') }}" class="d-none d-sm-inline-block btn btn-danger shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Download Report (PDF)
                </a>
    
                <a href="{{ route('dashboard.excel') }}" class="d-none d-sm-inline-block btn btn-success shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Download Report (Excel)
                </a>
            </div>
            
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Total Bookings Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Request Booking</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBookings }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Available Vehicles Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Kendaraan Tersedia</div>    
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAvailableVehicles }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-car fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Vehicles Need Service Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kendaraan Butuh Service</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalVehiclesNeedService }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tools fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Rented Vehicles Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Kendaraan Sedang Digunakan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalVehiclesOnTrip}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-car fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 10 Last Booking Histories -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Monitoring Kendaraan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Vehicle Model</th>
                                        <th>Vehicle Type</th>
                                        <th>Vehicle Status</th>
                                        <th>Sisa BBM (Liter)</th>
                                        <th>Waktu Service (KM)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $vehicle['VehicleModel'] }}</td>
                                            <td>{{ $vehicle['VehicleType'] }}</td>
                                            <td class=" @if($vehicle['VehicleStatus'] == 'Available') text-success @elseif($vehicle['VehicleStatus'] == 'Under-Maintenance') text-danger @else text-info @endif"> <b>{{ $vehicle['VehicleStatus'] }}</b></td>
                                            
                                            <td>{{ $vehicle['LastBBM'] }}</td>
                                            <td>
                                                @if($vehicle['KM_Need_Service'] == 0)
                                                <span class="badge badge-danger p-2 mr-2">Needs Service</span>
                                                @elseif($vehicle['KM_Need_Service'] < 10)
                                                    <span class="badge badge-warning p-2">{{ $vehicle['KM_Need_Service'] }} KM Left (Service Soon)</span>
                                                @else
                                                    {{ $vehicle['KM_Need_Service'] }} KM
                                                @endif
                                            </td>                                    
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">10 Current Booking </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Vehicle</th>
                                    <th>Driver</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lastBookingHistories as $booking)
                                <tr class="
                                @if($booking->BookingStatus == 'Approved')
                                    table-success
                                @elseif($booking->BookingStatus == 'Rejected')
                                    table-danger
                                @else
                                    table-warning
                                @endif
                            ">                            
                                    {{-- <td>{{ $booking->BookerName }}</td>
                                    <td>{{ $booking->VehicleID }}</td> --}}
                                    <td>{{ $booking->driver->Name }}</td>
                                    <td>{{ $booking->BookingDate }}</td>
                                    <td class=" {{ $booking->BookingStatus == 'Approved' ? 'text-success' : 'text-warning' }}"><b>{{ $booking->BookingStatus }}</b></td>
                                    {{-- <td>{{ $booking->BookingStatus }}</td> --}}
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