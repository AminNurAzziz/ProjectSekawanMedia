@extends('layouts.layout')

@section('title', 'Bookings')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bookings</h1>
        <div>
            <a href="{{ route('bookings.create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add Booking
            </a>
        </div>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bookings</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Peminjam</th>
                            <th>Kendaraan</th>
                            <th>Driver</th>
                            <th>Booking Date</th>
                            <th>Persetujuan Cabang</th>
                            <th>Persetujuan Pusat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr class="{{ $booking->BookingStatus == 'Approved' ? 'table-success' : 'table-warning' }}">
                            <td>{{ $booking->BookingID }}</td>
                            <td>{{ $booking->BookerName }}</td>
                            <td>{{ $booking->VehicleType }}</td>
                            <td>{{ $booking->Driver }}</td>
                            <td>{{ $booking->BookingDate }}</td>
                            <td>
                                @if($booking->BranchManagerApproval == 'Approved')
                                    <span class="badge badge-success p-2 d-inline-block">Approved</span>
                                @elseif($booking->BranchManagerApproval == 'Rejected')
                                    <span class="badge badge-danger p-2 d-inline-block">Rejected</span>
                                @else
                                    <span class="badge badge-warning p-2 d-inline-block">Pending</span>
                                @endif
                                <div>{{ $booking->BranchManager }}</div>
                            </td>
                            
                            <td>
                                @if($booking->HeadOfficeManagerApproval == 'Approved')
                                    <span class="badge badge-success p-2">Approved</span>
                                    <p>{{ $booking->HeadOfficeManager }}</p>
                                @elseif($booking->HeadOfficeManagerApproval == 'Rejected')
                                    <span class="badge badge-danger p-2">Rejected</span>
                                    <p>{{ $booking->HeadOfficeManager }}</p>
                                @else
                                    <span class="badge badge-warning p-2">Pending</span>
                                    <p>{{ $booking->HeadOfficeManager }}</p>
                                @endif
                            </td>

                            <td>
                                @if($booking->BookingStatus == 'Approved')
                                    <span class="badge badge-success p-2">
                                        Approved
                                    </span>
                                @elseif($booking->BookingStatus == 'Rejected')
                                    <span class="badge badge-danger p-2">
                                        Rejected
                                    </span>
                                @else
                                    <span class="badge badge-warning p-2">
                                        Pending
                                    </span>
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
@endsection
