@extends('layouts.admin.app')

@section('title', 'Show Card Request')

@section('content')
<div class="py-12">
    <div class="container">
        <h1 class="mb-4">Card Request Details</h1>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Photo</label>
                        <div>
                            <img src="{{ asset('storage/photos/' . $info->photo) }}" alt="User Photo" class="profile-pic">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Request ID</label>
                        <input type="text" name="request_id" class="form-control" placeholder="Request ID" value="{{ $request->id }}" readonly>
                    </div>
                    <div class="col">
                        <label class="form-label">Request Status</label>
                        <input type="text" name="request_status" class="form-control" placeholder="Request Status" value="{{ $request->status }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">User Name</label>
                        <input type="text" name="user_name" class="form-control" placeholder="User Name" value="{{ $info->full_name }}" readonly>
                    </div>
                    <div class="col">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ $info->phone_number }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $info->email }}" readonly>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">CIN</label>
                        <input type="text" name="cin" class="form-control" placeholder="CIN" value="{{ $info->CIN }}" readonly>
                    </div>
                    <div class="col">
                        <label class="form-label">Institution</label>
                        <input type="text" name="institution" class="form-control" placeholder="Institution" value="{{ $info->institution }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Position</label>
                        <input type="text" name="position" class="form-control" placeholder="Position" value="{{ $info->position }}" readonly>
                    </div>
                    <div class="col">
                        <label class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" placeholder="Type" value="{{ $info->type }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Created At</label>
                        <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $request->created_at }}" readonly>
                    </div>
                    <div class="col">
                        <label class="form-label">Updated At</label>
                        <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $request->updated_at }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .profile-pic-container {
        text-align: center; /* Center align the image */
        margin: 20px 0; /* Add some vertical margin */
    }

    .profile-pic {
        width: 150px; /* Set a fixed width */
        height: 150px; /* Set a fixed height */
        object-fit: cover; /* Maintain aspect ratio and cover the entire area */
        border: 2px solid; /* Add a light border */
        background-color: #f8f9fa; /* Add a background color for contrast */
    }
</style>
@endsection
