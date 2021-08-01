@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="list-style: none;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if(Session::get('info_message'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <ul style="margin-bottom: -10px;">
                <p> {{ Session::get('info_message') }}</p>
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(Session::get('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul style="margin-bottom: -10px;">
                <p> {{ Session::get('error_message') }}</p>
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
