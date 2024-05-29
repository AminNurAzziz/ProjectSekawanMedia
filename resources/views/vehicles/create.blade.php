@extends('layouts.layout')

@section('title', 'Create Vehicle')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Create Vehicle</h1>
            <p class="mb-4">
                <a href="{{ route('vehicles.index') }}" class="btn btn-primary">Back to Vehicle List</a>
            </p>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">New Vehicle Form</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('vehicles.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="VehicleID">Vehicle ID</label>
                        <input type="text" class="form-control @error('VehicleID') is-invalid @enderror" id="VehicleID" name="VehicleID" value="{{ old('VehicleID') }}" required>
                        @error('VehicleID')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="VehicleModel">Vehicle Model</label>
                        <input type="text" class="form-control @error('VehicleModel') is-invalid @enderror" id="VehicleModel" name="VehicleModel" value="{{ old('VehicleModel') }}" required>
                        @error('VehicleModel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="VehicleType">Vehicle Type</label>
                        <input type="text" class="form-control @error('VehicleType') is-invalid @enderror" id="VehicleType" name="VehicleType" value="{{ old('VehicleType') }}" required>
                        @error('VehicleType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="VehicleStatus">Vehicle Status</label>
                        <input type="text" class="form-control @error('VehicleStatus') is-invalid @enderror" id="VehicleStatus" name="VehicleStatus" value="{{ old('VehicleStatus') }}" required>
                        @error('VehicleStatus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="FuelConsumptionPerKM">Fuel Consumption Per KM</label>
                        <input type="number" step="0.01" class="form-control @error('FuelConsumptionPerKM') is-invalid @enderror" id="FuelConsumptionPerKM" name="FuelConsumptionPerKM" value="{{ old('FuelConsumptionPerKM') }}" required>
                        @error('FuelConsumptionPerKM')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ServiceIntervalKM">Service Interval KM</label>
                        <input type="number" class="form-control @error('ServiceIntervalKM') is-invalid @enderror" id="ServiceIntervalKM" name="ServiceIntervalKM" value="{{ old('ServiceIntervalKM') }}" required>
                        @error('ServiceIntervalKM')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="LastBBM">LastBBM</label>
                        <input type="text" class="form-control @error('LastBBM') is-invalid @enderror" id="LastBBM" name="LastBBM" value="{{ old('LastBBM') }}" required>
                        @error('LastBBM')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="LastKM">LastKM</label>
                        <input type="text" class="form-control @error('LastKM') is-invalid @enderror" id="LastKM" name="LastKM" value="{{ old('LastKM') }}" required>
                        @error('LastKM')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Ownership">Ownership</label>
                        <input type="text" class="form-control @error('Ownership') is-invalid @enderror" id="Ownership" name="Ownership" value="{{ old('Ownership') }}" required>
                        @error('Ownership')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Vehicle</button>
                </form>
            </div>
        </div>
    </div>
@endsection
