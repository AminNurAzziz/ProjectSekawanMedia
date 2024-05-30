@extends('layouts.layout')

@section('title', 'Log Processes')

@section('content')
<!-- Content Row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Log Processes</h1>
                <div>
                    <form action="{{ route('logs.reset') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="d-none d-sm-inline-block btn  btn-danger shadow-sm">
                            <i class="fas fa-trash fa-sm text-white-50"></i> Reset Log
                        </button>
                    </form>
                </div>
                
            </div>
            <!-- Log Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Log Processes</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                    <th>Recorded At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logProcesses as $logProcess)
                                <tr @if(stripos($logProcess->message, 'fetched') !== false) class="table-success"
                                    @elseif(stripos($logProcess->message, 'updated') !== false) class="table-warning"
                                    @elseif(stripos($logProcess->message, 'deleted') !== false) class="table-danger"
                                    @elseif(stripos($logProcess->message, 'created') !== false) class="table-info" @endif>
                                
                                    <td>{{ $logProcess->id }}</td>
                                    <td>{{ $logProcess->message }}</td>
                                    <td>{{ $logProcess->action }}</td>
                                    <td>{{ $logProcess->recorded_at }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
