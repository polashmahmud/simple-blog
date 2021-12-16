@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 text-center mb-3">
                    <div class="card">
                        <div class="card-header">Today Total Post</div>

                        <div class="card-body">
                            <h1>{{ \App\Classes\Helper::countPost() }}</h1>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('posts.index') }}" class="btn btn-primary">View All Post</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 text-center mb-3">
                    <div class="card">
                        <div class="card-header">Today Post</div>

                        <div class="card-body">
                            <h1>{{ \App\Classes\Helper::totalPost() }}</h1>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('home') }}" class="btn btn-primary">View All Post</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 text-center mb-3">
                    <div class="card">
                        <div class="card-header">Current Package</div>

                        <div class="card-body">
                            <h1>{{ auth()->user()->isFree() ? 'Free' : 'Premium' }}</h1>
                        </div>
                        <div class="card-body">
                            @if(auth()->user()->isFree())
                                <a href="{{ route('plans.index') }}" class="btn btn-primary">Upgrade Package</a>
                            @else
                                <form action="{{ route('subscription.cancel') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="subscription_id" value="{{ $subscriptions->id }}">
                                    <button type="submit" class="btn btn-danger">Cancel Subscription</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 text-center mb-3">
                    <div class="card">
                        <div class="card-header">Total Draft Post</div>

                        <div class="card-body">
                            <h1>{{ \App\Classes\Helper::totalDraftPost() }}</h1>
                        </div>
                        <div class="card-body">
                            <a href="{{ url('/posts?is_published=false') }}" class="btn btn-primary">View All Draft Post</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
