@extends('layouts.layout')

@section('title', 'Vehicles')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @include('partials.flash')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">History Bookings</h1>
            <div>
                <button class="d-none d-sm-inline-block btn btn-primary shadow-sm" data-toggle="modal" data-target="#returnVehicleModal">
                    <i class="fas fa-car fa-sm text-white-50"></i> Return Vehicle  
                </button>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">History Bookings</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Booker Name</th>
                                <th>Vehicle Type</th>
                                <th>Name</th>
                                <th>Return Date</th>
                                <th>Last Odometer Reading</th>
                                <th>Fuel Used</th>
                                <th>Booking Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getHistoryBooking as $booking)
                            <tr class="{{ $booking->BookingStatus === 'Cancelled' ? 'table-danger' : ($booking->BookingStatus === 'On-Trip' ? 'table-warning' : ($booking->BookingStatus === 'Completed' ? 'table-success' : '')) }}">
                                <td>{{ $booking->BookerName }}</td>
                                <td>{{ $booking->VehicleType }}</td>
                                <td>{{ $booking->Name }}</td>
                                <td>{{ $booking->ReturnDate }}</td>
                                <td>{{ $booking->LastOdometerReading }}</td>
                                <td>{{ $booking->FuelUsed }}</td>
                                <td>
                                <span class="badge  @if($booking->BookingStatus == 'Cancelled') badge-danger p-2 @elseif($booking->BookingStatus == 'On-Trip') badge-warning p-2 @else badge-success p-2 @endif">
                                        {{ $booking->BookingStatus }}
                                </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Return Vehicle Modal -->
    <div class="modal fade" id="returnVehicleModal" tabindex="-1" role="dialog" aria-labelledby="returnVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="returnVehicleModalLabel">Return Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to submit return vehicle -->
                    <form method="POST" action="{{ route('return.vehicle') }}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label for="VehicleID">Vehicle ID</label>
                            <input type="text" class="form-control" id="VehicleID" name="VehicleID" placeholder="Enter Vehicle ID">
                        </div>
                        <div class="form-group">
                            <label for="LastKM">Last Odometer Reading</label>
                            <input type="number" class="form-control" id="LastKM" name="LastKM" placeholder="Enter Last Odometer Reading">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
