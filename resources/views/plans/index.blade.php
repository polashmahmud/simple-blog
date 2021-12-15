@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    @foreach($plans as $plan)
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    {{ $plan->name }}
                                </div>
                                <div class="card-body text-center">
                                    <h1>${{ number_format($plan->cost, 2) }}</h1>
                                    <h3 class="text-uppercase text-black-50">Monthly</h3>
                                    <p>{{ $plan->description }}</p>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('plans.show', $plan->slug) }}"
                                       class="btn btn-outline-dark pull-right">Choose</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(auth()->user()->role == 1)
                    <div class="row">
                        <div class="col-12 text-center mt-5">
                            <a class="btn btn-outline-primary" href="{{ route('create.plan') }}">Add New Plan</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection