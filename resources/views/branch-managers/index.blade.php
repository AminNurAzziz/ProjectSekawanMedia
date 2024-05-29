@extends('layouts.layout')

@section('title', 'Branch Managers')

@section('content')
<div class="container-fluid">
    @include('partials.flash')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Branch Managers</h1>
        <div>
            <button class="d-none d-sm-inline-block btn btn-primary shadow-sm" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add Branch Manager
            </button>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Branch Managers List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Branch</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($branchManagers as $manager)
                            <tr>
                                <td>{{ $manager->ManagerID }}</td>
                                <td>{{ $manager->Name }}</td>
                                <td>{{ $manager->PhoneNumber }}</td>
                                <td>{{ $manager->branch_name }}</td>
                                <td>{{ $manager->position_name }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{ $manager->ManagerID }}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $manager->ManagerID }}">Delete</button>
                                </td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $manager->ManagerID }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $manager->ManagerID }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $manager->ManagerID }}">Edit Manager</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('branch-managers.update', $manager->ManagerID) }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="Name">Name</label>
                                                    <input id="Name" type="text" class="form-control" name="Name" value="{{ $manager->Name }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="PhoneNumber">Phone Number</label>
                                                    <input id="PhoneNumber" type="text" class="form-control" name="PhoneNumber" value="{{ $manager->PhoneNumber }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="BranchID">Branch</label>
                                                    <select id="BranchID" class="form-control" name="BranchID" required>
                                                        @foreach($branches as $branch)
                                                            <option value="{{ $branch->BranchID }}" {{ $branch->BranchID == $manager->BranchID ? 'selected' : '' }}>{{ $branch->BranchName }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="PositionID">Position</label>
                                                    <select id="PositionID" class="form-control" name="PositionID" required>
                                                        @foreach($positions as $position)
                                                            <option value="{{ $position->PositionID }}" {{ $position->PositionID == $manager->PositionID ? 'selected' : '' }}>{{ $position->PositionName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $manager->ManagerID }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $manager->ManagerID }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $manager->ManagerID }}">Delete Manager</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this manager?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('branch-managers.destroy', $manager->ManagerID) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Branch Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('branch-managers.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input id="Name" type="text" class="form-control" name="Name" value="{{ old('Name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="PhoneNumber">Phone Number</label>
                        <input id="PhoneNumber" type="text" class="form-control" name="PhoneNumber" value="{{ old('PhoneNumber') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="BranchID">Branch</label>
                        <select id="BranchID" class="form-control" name="BranchID" required>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->BranchID }}">{{ $branch->BranchName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="PositionID">Position</label>
                        <select id="PositionID" class="form-control" name="PositionID" required>
                            @foreach($positions as $position)
                                <option value="{{ $position->PositionID }}">{{ $position->PositionName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
