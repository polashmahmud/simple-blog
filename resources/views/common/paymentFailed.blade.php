@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="alert alert-danger" role="alert">
                    <h1>Payment Failed!</h1>
                    <p>Something went wrong! Please try again later....</p>
                </div>
                <a class="btn btn-secondary mt-3" href="{{ route('home') }}">Go To Home</a>
            </div>
        </div>
    </div>
@endsection