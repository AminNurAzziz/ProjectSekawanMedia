<!-- vehicles.edit.blade.php -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit BBM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to edit BBM -->
                <form action="/" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="bbm">BBM (Liter)</label>
                        <input type="text" class="form-control" id="bbm" name="bbm" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@extends('layouts.layout')

@section('title', 'Vehicles')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        @include('partials.flash')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Vehicles</h1>
            <div>
                <a href="/vehicles/create" class="btn btn-primary">Add Vehicle</a>

            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Vehicles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Vehicle ID</th>
                                <th>Vehicle Model</th>
                                <th>Vehicle Type</th>
                                <th>Vehicle Status</th>
                                <th>Sisa BBM (Liter)</th>
                                <th>Waktu Service (KM)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehicles as $vehicle)
                                <tr class="{{ $vehicle['VehicleStatus'] == 'Available' && $vehicle['KM_Need_Service'] == 0 ? 'table-success' : ($vehicle['VehicleStatus'] == 'Available' && $vehicle['KM_Need_Service'] < 10 ? 'table-warning' : ($vehicle['VehicleStatus'] == 'Available' ? 'table-info' : 'table-danger')) }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vehicle['VehicleID'] }}</td>
                                    <td>{{ $vehicle['VehicleModel'] }}</td>
                                    <td>{{ $vehicle['VehicleType'] }}</td>
                                    <td>{{ $vehicle['VehicleStatus'] }}</td>
                                    
                                    <td>{{ $vehicle['LastBBM'] }}</td>
                                    <td>
                                        @if($vehicle['KM_Need_Service'] == 0)
                                        <span class="badge badge-danger p-2 mr-2">Needs Immediate Service</span>
                                        <form action="{{ route('reset.km.service', $vehicle['VehicleID']) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-link p-0" title="Reset" onclick="return confirm('Are you sure you want to reset the service KM for this vehicle?');">
                                                <i class="fas fa-redo" style="cursor: pointer;"></i>
                                            </button>
                                        </form>
                                        @elseif($vehicle['KM_Need_Service'] < 10)
                                            <span class="badge badge-warning p-2">{{ $vehicle['KM_Need_Service'] }} KM Left (Service Soon)</span>
                                            <i class="fas fa-redo" title="Reset" style="cursor: pointer;" onclick="resetService({{ $vehicle['VehicleID'] }})"></i>
                                        @else
                                            {{ $vehicle['KM_Need_Service'] }} KM
                                        @endif
                                    </td>
                                    
                                    <td>
                                        
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#bbmEditModal{{ $vehicle['VehicleID'] }}">
                                            <i class="fas fa-gas-pump"></i> <!-- Ikon BBM -->
                                        </button>
                                        
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#vehicleModal{{ $vehicle['VehicleID'] }}">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal{{ $vehicle['VehicleID'] }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $vehicle['VehicleID'] }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    
                                    
                                </tr>
                                @include('vehicles.show')
                                @include('vehicles.edit')
                                @include('vehicles.pop-up-delete')
                                @include('vehicles.pop-up-bbm')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
