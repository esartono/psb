@if (Session::has('message'))
    @if(Session::get('alert-type') == 'info')
        <div class="alert alert-info alert-mg-b-0" role="alert">
            {{ Session::get('message') }}
        </div>    
    @endif
    @if(Session::get('alert-type') == 'success')
        <div class="alert alert-success alert-mg-b-0" role="alert">
            {{ Session::get('message') }}
        </div>    
    @endif
    @if(Session::get('alert-type') == 'warning')
        <div class="alert alert-warning alert-mg-b-0" role="alert">
            {{ Session::get('message') }}
        </div>    
    @endif
    @if(Session::get('alert-type') == 'error')
        <div class="alert alert-danger alert-mg-b-0" role="alert">
            {{ Session::get('message') }}
        </div>    
    @endif
@endif