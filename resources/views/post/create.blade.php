@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>Create Post</div>
                        <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">
                            <svg style="width: 20px; height: 20px" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="postTitle">Post Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" placeholder="Post Title"
                                       class="form-control" id="postTitle">
                            </div>
                            <div class="form-group mb-3">
                                <label for="postDescription">Post Description</label>
                                <textarea rows="5" name="description" placeholder="Post Description"
                                          class="form-control" id="postDescription">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="inlineRadio1" checked type="radio"
                                           name="is_published" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Published</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="inlineRadio2" type="radio" name="is_published"
                                           value="0">
                                    <label class="form-check-label" for="inlineRadio2">Draft</label>
                                </div>
                            </div>

                            @if(!auth()->user()->isFree())
                                <div class="form-group mb-3">
                                    <label for="postDate">Published Date</label>
                                    <input type="datetime-local" name="published_at" placeholder="Post Published Date"
                                           class="form-control" id="postDate">
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Published</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.getElementById('postDate').value = now.toISOString().slice(0, 16);
    </script>
@endsection