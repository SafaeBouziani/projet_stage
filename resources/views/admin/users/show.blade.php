@extends('layouts.admin.app')
  
@section('title', 'Show Product')
  
@section('content')
    <h1 class="mb-0">Detail User</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Id</label>
            <input type="text" name="id" class="form-control" placeholder="Id" value="{{ $user->id }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $user->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $user->updated_at }}" readonly>
        </div>
    </div>
@endsection