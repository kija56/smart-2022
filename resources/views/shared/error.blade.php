@if (session('message'))
    <div class="alert alert-danger" role="alert">
        {{ session('message') }}
    </div>
@endif
