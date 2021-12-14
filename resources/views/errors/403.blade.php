@extends('layouts.error')

@section('content')
<h2 class="headline text-warning mt-5 mr-4"> 403</h2>
<div class="error-content mt-5">
    <br>
    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Error</h3>
    <p>
        {{ $exception->getMessage() }}
    </p>
</div>
@endsection
