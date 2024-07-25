@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
    <div class="container py-5">

        @if($requests->isEmpty())
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 60vh; background:white;">
                <img src="{{ asset('request_none.png') }}" alt="No requests" class="img-fluid mb-4 " style="max-width: 400px;">
                <div class="alert alert-info text-center bg-gradient-primary text-white" role="alert" style="max-width: 300px; ">
                    You haven't made any requests yet.
                </div>
            </div>
        @else
        <div class="row">
            <div class="col-12  mb-4">
                <h2>Dashboard</h2>
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Your Requests</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($requests as $request)
                                    <tr>
                                        <td class="align-middle">{{ $request->id }}</td>
                                        <td class="align-middle">{{ $request->created_at }}</td>
                                        <td class="align-middle">{{ $request->status }}</td>
                                        <td class="align-middle">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('request.edit', $request->id) }}" type="button" class="btn btn-warning {{ $request->status !== 'rejected' ? 'disabled' : '' }}">Edit</a>
                                                <a href="{{ route('request.show', $request->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
