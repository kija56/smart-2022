@if (session('state'))
    <div class="alert alert-success" role="alert">
        {{ session('state') }}
    </div>
@endif
