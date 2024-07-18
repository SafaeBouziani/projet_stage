@extends('layouts.admin.app')

@section('title', 'Show User')

@section('content')
<div class="py-12">
    <div class="container">
        <h1 class="mb-4">Detail User</h1>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Id</label>
                        <input type="text" name="id" class="form-control" placeholder="Id" value="{{ $user->id }}" readonly>
                    </div>
                    <div class="col">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="col">
                        <label class="form-label">Role</label>
                        <input type="text" name="role" class="form-control" placeholder="Role" value="{{ $user->role() }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Created At</label>
                        <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $user->created_at }}" readonly>
                    </div>
                    <div class="col">
                        <label class="form-label">Updated At</label>
                        <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $user->updated_at }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
