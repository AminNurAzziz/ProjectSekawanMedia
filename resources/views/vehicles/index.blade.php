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
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vehicle['VehicleID'] }}</td>
                                    <td>{{ $vehicle['VehicleModel'] }}</td>
                                    <td>{{ $vehicle['VehicleType'] }}</td>
                                    <td>{{ $vehicle['VehicleStatus'] }}</td>
                                    
                                    <td>{{ $vehicle['LastBBM'] }}</td>
                                    <td>
                                        @if($vehicle['KM_Need_Service'] == 0)
                                        <span class="badge badge-danger p-2 mr-2">Needs Immediate Service</span>
                                        <i class="fas fa-redo" title="Reset" style="cursor: pointer;" onclick="resetService({{ $vehicle['VehicleID'] }})"></i>
                                        @elseif($vehicle['KM_Need_Service'] < 10)
                                            <span class="badge badge-warning p-2">{{ $vehicle['KM_Need_Service'] }} KM Left (Service Soon)</span>
                                            <i class="fas fa-redo" title="Reset" style="cursor: pointer;" onclick="resetService({{ $vehicle['VehicleID'] }})"></i>
                                        @else
                                            {{ $vehicle['KM_Need_Service'] }} KM
                                        @endif
                                    </td>
                                    
                                    <td>
                                        
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#bbmModal{{ $vehicle['VehicleID'] }}">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
