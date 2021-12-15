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
                        <div>Add new plan</div>
                        <a href="{{ route('plans.index') }}" class="btn btn-sm btn-secondary">
                            <svg style="width: 20px; height: 20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('store.plan')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="planName">Plan Name</label>
                                <input type="text" id="planName" class="form-control" name="name" placeholder="Enter Plan Name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="cost">Price for month</label>
                                <input type="number" id="cost" class="form-control" name="cost" placeholder="Enter plan cost">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection