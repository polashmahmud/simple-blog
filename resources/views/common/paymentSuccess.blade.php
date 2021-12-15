@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="alert alert-success" role="alert">
                    <h1>Payment Success!</h1>
                    <p>Congratulation :)</p>
                </div>
                <a class="btn btn-secondary mt-3" href="{{ route('home') }}">Go To Home</a>
            </div>
        </div>
    </div>
@endsection