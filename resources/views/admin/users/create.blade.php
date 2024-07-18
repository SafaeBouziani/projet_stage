@extends('layouts.admin.app')

@section('title', 'Create User')

@section('content')
<div class="py-12">
    <div class="container">
        <h1 class="mb-4">Add User</h1>
        <hr />
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Role</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="user" value="user" checked>
                                <label class="form-check-label" for="user">
                                    User
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="roleAdmin" value="admin">
                                <label class="form-check-label" for="admin">
                                    Admin
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .form-check-input {
        cursor: pointer;
    }

    .form-check-label {
        cursor: pointer;
    }
</style>

@endsection
