@extends('layouts.error')

@section('content')
<h2 class="headline text-danger mt-5 mr-4"> Error 500</h2>
<div class="error-content mt-5">
    <br>
    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Error</h3>
    {{-- <p>{{ $exception->getMessage() }}</p> --}}
</div>
@endsection
