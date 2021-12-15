@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card w-25 text-center">
                    <div class="card-header">
                        {{ $subscriptions->name }}
                    </div>
                    <div class="card-body">
                        <h3>${{ $subscriptions->cost  }}</h3>
                        <p class="text-success">{{ \Carbon\Carbon::parse($subscriptions->ends_at)->format('M d Y')  }}</p>
                    </div>
                    <div class="card-footer">
                        <form action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Cancel Subscription</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
