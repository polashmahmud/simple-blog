@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <a href="{{ url('/posts?is_published=all') }}" class="btn btn-sm {{ request()->get('is_published') != 'true' && request()->get('is_published') != 'false' ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
                            <a href="{{ url('/posts?is_published=true') }}" class="btn btn-sm {{ request()->get('is_published') == 'true' ? 'btn-success' : 'btn-outline-success' }}">Published</a>
                            <a href="{{ url('/posts?is_published=false') }}" class="btn btn-sm {{ request()->get('is_published') == 'false' ? 'btn-dark' : 'btn-outline-dark' }}">Draft</a>
                        </div>
                        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-secondary">
                            <svg style="width: 20px; height: 20px" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add New Post
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{ substr(strip_tags($post->title), 0, 20) }}</td>
                                    <td>{{ substr(strip_tags($post->description), 0, 50) }}</td>
                                    <td>
                                        <form action="{{ route('posts.destroy',$post->id) }}" method="POST">

                                            <a class="btn btn-info btn-sm" href="{{ route('posts.show',$post->id) }}">Show</a>

                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('posts.edit',$post->id) }}">Edit</a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mt-5">
                            {!! $posts->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection