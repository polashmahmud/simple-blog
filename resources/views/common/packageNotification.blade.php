@if(!auth()->user()->subscribed('default'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-info" role="alert">
                    Your plan is free. Please <a href="{{ route('plans.index') }}">upgrade</a> your panel and continue.
                </div>
            </div>
        </div>
    </div>
@endif