<!-- resources/views/headmanagers/index.blade.php -->
@extends('layouts.layout')

@section('title', 'Head Managers')

@section('content')
<div class="container-fluid">
    @include('partials.flash')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Vehicles</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Add Head Manager
        </button>
    </div>
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Head Managers List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Position ID</th>
                                <th>Phone Number</th>
                                <th>Actions</th> <!-- Tambah kolom untuk actions -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($headOfficeManagers as $manager)
                            <tr>
                                <td>{{ $manager['HeadManagerID'] }}</td>
                                <td>{{ $manager['Name'] }}</td>
                                <td>{{ $manager['PositionID'] }}</td>
                                <td>{{ $manager['PhoneNumber'] }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{$manager['HeadManagerID']}}">
                                        Edit
                                    </button>
                                    <!-- Tombol Delete -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$manager['HeadManagerID']}}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit -->
@foreach($headOfficeManagers as $manager)
<div class="modal fade" id="editModal{{$manager['HeadManagerID']}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$manager['HeadManagerID']}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{$manager['HeadManagerID']}}">Edit Head Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/head-office-managers/{{ $manager['HeadManagerID'] }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="Name" name="Name" value="{{ $manager['Name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="position_id">Position ID</label>
                        <input type="text" class="form-control" id="position_id" name="position_id" value="{{ $manager['PositionID'] }}">
                    </div>
                    <div class="form-group">
                        <label for="PhoneNumber">Phone Number</label>
                        <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="{{ $manager['PhoneNumber'] }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Delete -->
@foreach($headOfficeManagers as $manager)
<div class="modal fade" id="deleteModal{{$manager['HeadManagerID']}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$manager['HeadManagerID']}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{$manager['HeadManagerID']}}">Delete Head Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this head manager?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="/head-office-managers/{{ $manager['HeadManagerID'] }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Head Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/head-office-managers">
                    @csrf

                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input id="Name" type="text" class="form-control @error('Name') is-invalid @enderror" name="Name" value="{{ old('Name') }}" required autofocus>

                        @error('Name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="PositionID">Position ID</label>
                        <input id="PositionID" type="text" class="form-control @error('PositionID') is-invalid @enderror" name="PositionID" value="{{ old('PositionID') }}" required>

                        @error('PositionID')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="PhoneNumber">Phone Number</label>
                        <input id="PhoneNumber" type="text" class="form-control @error('PhoneNumber') is-invalid @enderror" name="PhoneNumber" value="{{ old('PhoneNumber') }}" required>

                        @error('PhoneNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection