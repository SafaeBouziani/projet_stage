@extends('layouts.admin.app')
@section('title', 'Dashboard - Laravel Admin Panel')
@section('content')
    <div class="container mt-4">
        <h1>Dashboard</h1>
        <br>
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
            @if(session('cardPdfPath') && session('receiptPdfPath'))
                <p><a href="{{ session('cardPdfPath') }}" target="_blank">Download Card PDF</a></p>
                <p><a href="{{ session('receiptPdfPath') }}" target="_blank">Download Receipt PDF</a></p>
            @endif
        </div>
        @endif
        <br>
        <div class="row">

            <div class="col-md-4 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('yelloworange.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-gray-900">Pending Requests</h5>
                        <p class="card-text">click below to view pending requests.</p>
                        <br>
                        <a href="{{ route('requests.pending') }}" class="btn btn-primary">view</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('yelloworange.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-gray-900">Approved Requests</h5>
                        <p class="card-text">click below to view approved requests.</p>
                        <br>
                        <a href="{{ route('requests.approved') }}" class="btn btn-primary">view</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('yelloworange.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-gray-900">Rejected requests</h5>
                        <p class="card-text">click below to view rejected requests.</p>
                        <br>
                        <a href="{{ route('requests.rejected') }}" class="btn btn-primary">view</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
