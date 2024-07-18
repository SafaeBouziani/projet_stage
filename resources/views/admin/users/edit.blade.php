@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')
<div class="py-12">
    <div class="container">
        <h1 class="mb-4">Edit User</h1>
        <hr />
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" value="{{ $user->password }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Role</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="user" value="user" {{ $user->hasRole('user') ? 'checked' : '' }}>
                                <label class="form-check-label" for="user">
                                    User
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="roleAdmin" value="admin" {{ $user->hasRole('admin') ? 'checked' : '' }}>
                                <label class="form-check-label" for="admin">
                                    Admin
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-warning w-100">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
