@extends('layouts.admin.app')

@section('title', 'List Pending Requests')

@section('content')
<div class="py-12">
    <div class="container">
        <div class="card shadow mb-4">
            @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
            @endif
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Pending Requests</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Employee</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Employee</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if($requests->count() > 0)
                            @foreach($requests as $rs)
                                <tr>
                                    <td class="align-middle">{{ $rs->id }}</td>
                                    <td class="align-middle">{{ $rs->user->name }}</td>
                                    <td class="align-middle">{{ $rs->created_at }}</td>
                                    <td class="align-middle">{{ $rs->status }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.request.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                            <!-- Approve Button -->
                                            <form action="{{ route('admin.request.approve', $rs->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary bg-gradient-success">Approve</button>
                                            </form>

                                            <!-- Reject Button -->
                                            <form action="{{ route('admin.request.decline', $rs->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger custom-rounded-left">Reject</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5">No requests found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .custom-rounded-left {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }
</style>
@endsection
