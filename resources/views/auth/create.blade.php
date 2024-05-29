@extends('layouts.layout')

@section('title', 'Bookings')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center"> <!-- Menambahkan kelas 'justify-content-center' -->
        <div class="col-md-6 mx-auto"> <!-- Menambahkan kelas 'mx-auto' -->
        @include('partials.flash')
        
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajukan Peminjaman Kendaraan Tambang</h6>
                </div>
                <div class="card-body">
                        <form method="POST" action="{{ route('bookings.store') }}">
                            @csrf
                                <div class="form-group">
                                    <label for="BookerName">Nama Peminjam</label>
                                    <input type="text" class="form-control" id="BookerName" name="BookerName" required>
                                </div>
                                <div class="form-group">
                                    <label for="BookingDate">Booking Date</label>
                                    <input type="date" class="form-control" id="BookingDate" name="BookingDate" required>
                                </div>
                                <div class="form-group">
                                    <label for="VehicleID">Vehicle</label>
                                    <select class="form-control" id="VehicleID" name="VehicleID" required>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->VehicleID }}">{{ $vehicle->VehicleModel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="DriverID">Driver</label>
                                    <select class="form-control" id="DriverID" name="DriverID" required>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->DriverID }}">{{ $driver->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="BranchManagerID">Branch Manager</label>
                                    <select class="form-control" id="BranchManagerID" name="BranchManagerID" required>
                                        @foreach ($branchManagers as $manager)
                                            <option value="{{ $manager->ManagerID }}">{{ $manager->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="HeadOfficeManagerID">Head Office Manager</label>
                                    <select class="form-control" id="HeadOfficeManagerID" name="HeadOfficeManagerID" required>
                                        @foreach ($headOfficeManagers as $manager)
                                            <option value="{{ $manager->HeadManagerID  }}">{{ $manager->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection