<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Log in</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse($posts as $post)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('home.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </h5>
                        <p class="card-text">
                            {{Str::limit($post->description, 190, '....')}}
                        </p>
                        <p class="card-text d-flex justify-content-between">
                            <small class="text-muted">
                                Update: {{ $post->created_at->diffForHumans() }}
                            </small>
                            <small class="text-muted">
                                Auther: {{ $post->user->name }}
                            </small>

                        </p>
                    </div>
                </div>
            @empty
                    <div class="d-flex justify-content-center align-items-center text-center vh-100">
                        <h3>No data found, Add a new <a href="{{ route('posts.create') }}">post</a> </h3>
                    </div>
            @endforelse

            <div class="d-flex justify-content-center mt-5">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</div>

</body>
</html>