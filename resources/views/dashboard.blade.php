@extends('layouts.app')
@section('title','Dashboard - Laravel User Panel')
@section('contents')
    <div class="row">
        Dashboard
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>
    
@endsection
