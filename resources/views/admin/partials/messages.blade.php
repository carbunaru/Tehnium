@if (Session::has('success'))

    <div class="alert alert-info mt-4">
        {!!Session::get('success')!!}
    </div>

@endif

@if (Session::has('err'))

    <div class="alert alert-danger mt-4">
        {!!Session::get('err')!!}
    </div>

@endif


