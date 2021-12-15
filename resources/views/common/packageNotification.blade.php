@if(auth()->user()->isFree() && !auth()->user()->isAdmin())
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-info d-flex justify-content-between" role="alert">
                    <div>Your package is free, per-day you can create 2 blog post. Please <a href="{{ route('plans.index') }}">upgrade</a></div>
                    <div>Left Post: <span>{{ \App\Classes\Helper::countPost() }}</span></div>
                </div>
            </div>
        </div>
    </div>
@endif