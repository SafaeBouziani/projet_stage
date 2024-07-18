@extends('layouts.admin.app')

@section('title', 'List Users')

@section('content')
<div class="py-12">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="mb-0">List Users</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
        </div>
        <hr />
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->count() > 0)
                            @foreach($users as $rs)
                                <tr>
                                    <td class="align-middle">{{ $rs->id }}</td>
                                    <td class="align-middle">{{ $rs->name }}</td>
                                    <td class="align-middle">{{ $rs->email }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('users.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                            <a href="{{ route('users.edit', $rs->id) }}" type="button" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('users.destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger custom-rounded-left">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="4">User not found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
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
