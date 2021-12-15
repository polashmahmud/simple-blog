@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>Show Post</div>
                        <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">
                            <svg style="width: 20px; height: 20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Back
                        </a>
                    </div>

                    <div class="card-body">
                       <h1 class="text-center">{{ $post->title }}</h1>
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection