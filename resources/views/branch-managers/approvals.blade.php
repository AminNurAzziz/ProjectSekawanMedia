@extends('layouts.layout') <!-- Ganti dengan layout yang sesuai dengan template SB Admin -->

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Bookings for Approval</h1>
        <p class="mb-4">List of bookings that require approval.</p>
        @include('partials.flash')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Booker Name</th>
                                <th>Vehicle ID</th>
                                <th>Driver ID</th>
                                <th>Booking Date</th>
                                <th>Booking Status</th>
                                <th>Branch Manager Approval</th>
                                <th>Head Office Manager Approval</th>
                                <th>Actions</th> <!-- Kolom baru untuk menambahkan tombol aksi -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            {{-- {{ dd($booking->BranchManagerApproval)}} --}}
                            @php
                            $disableApprove = (Auth::user()->role == 'approver1' && $booking->BranchManagerApproval == 'Approved') 
                                            || $booking->BranchManagerApproval == 'Rejected' 
                                            || $booking->BookingStatus == 'Rejected'
                                            || $booking->HeadOfficeManagerApproval == 'Approved'
                                            || $booking->HeadOfficeManagerApproval == 'Rejected'
                                            || $booking->BookingStatus == 'Rejected'
                                            || (Auth::user()->role == 'approver2' && $booking->BranchManagerApproval !== 'Approved');

                            $disableReject =  (Auth::user()->role == 'approver1' && $booking->BranchManagerApproval == 'Approved') 
                                            || $booking->BranchManagerApproval == 'Rejected'
                                            || $booking->BookingStatus == 'Rejected'
                                            || $booking->HeadOfficeManagerApproval == 'Approved'
                                            || $booking->HeadOfficeManagerApproval == 'Rejected'
                                            || $booking->BookingStatus == 'Rejected'
                                            || (Auth::user()->role == 'approver2' && $booking->BranchManagerApproval !== 'Approved');
                        @endphp

                                <tr class=" @if($booking->BookingStatus == 'Rejected') table-danger @elseif($booking->BookingStatus == 'Approved') table-success @elseif($booking->BookingStatus == 'Pending') table-warning @endif">
                                    <td>{{ $booking->BookingID }}</td>
                                    <td>{{ $booking->BookerName }}</td>
                                    <td>{{ $booking->VehicleID }}</td>
                                    <td>{{ $booking->DriverID }}</td>
                                    <td>{{ $booking->BookingDate }}</td>
                                    <td>{{ $booking->BookingStatus }}</td>
                                    <td>{{ $booking->BranchManagerApproval }}</td>
                                    <td>{{ $booking->HeadOfficeManagerApproval }}</td>
                                    <td class="d-flex justify-content-between">
                                        <!-- Tombol approve -->
                                        <form method="POST" action="/booking/{{ $booking->BookingID }}/Approved">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm mr-2" 
                                                @if($disableApprove) disabled @endif
                                            >
                                                Approve
                                            </button>
                                        </form>
                                        
                                        <!-- Tombol reject -->
                                        <form method="POST" action="/booking/{{ $booking->BookingID }}/Rejected">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                @if($disableReject) disabled @endif
                                            >
                                                Reject
                                            </button>
                                        </form>                                    
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
