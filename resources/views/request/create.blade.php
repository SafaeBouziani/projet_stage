@extends('layouts.app')

@section('title', 'Create Request')

@section('content')
<div class="py-12">
    <div class="container">
        <h1 class="mb-4">Make a request</h1>
        <hr />
        <div class="card">
            <div class="card-body">
                <form action="{{ route('request.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <label class="form-label" for="file_input">Upload Photo</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="photo" name="photo" type="file">
                    <br>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $cardInfo->full_name ?? Auth::user()->name) }}" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $cardInfo->email ?? Auth::user()->email) }}" required readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" value="{{ old('phone', $cardInfo->phone_number ?? '') }}" placeholder="Phone Number" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">CIN</label>
                            <input type="text" name="cin" class="form-control" value="{{ old('cin', $cardInfo->CIN ?? '') }}" placeholder="CIN" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Institution</label>
                            <input type="text" name="institution" class="form-control" value="{{ old('institution', $cardInfo->institution ?? '') }}" placeholder="Institution" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Position</label>
                            <input type="text" name="position" class="form-control" value="{{ old('position', $cardInfo->position ?? '') }}" placeholder="Position" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="academic" value="academic" {{ old('type', $cardInfo->type ?? 'academic') == 'academic' ? 'checked' : '' }}>
                                <label class="form-check-label" for="academic">
                                    Academic Staff
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="administrative" value="administrative" {{ old('type', $cardInfo->type ?? 'administrative') == 'administrative' ? 'checked' : '' }}>
                                <label class="form-check-label" for="administrative">
                                    Administrative Staff
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Reason for Another Card Request</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="motive" id="losing_card" value="losing_card" {{ old('motive', $cardInfo->motive) == 'losing_card' ? 'checked' : '' }}>
                                <label class="form-check-label" for="losing_card">
                                    Losing Card
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="motive" id="info_change" value="info_change" {{ old('motive', $cardInfo->motive) == 'info_change' ? 'checked' : '' }}>
                                <label class="form-check-label" for="info_change">
                                    Info Change
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
