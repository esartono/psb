@extends('layouts.error')

@section('content')
<h2 class="headline text-danger mt-5 mr-4"> UNDER MAINTENANCE</h2>
<div class="error-content mt-5">
    <br>
    <!-- <h3><i class="fas fa-exclamation-triangle text-warning"></i> Error</h3> -->
    <h3>
        {{-- {{ $exception->getMessage() }} --}}
        <br>
        <hr>
        Mohon maaf aplikasi ini, sedang dalam perbaikan, silahkan di cek kembali setelah jam 14.00 WIB
    </h3>
</div>
@endsection
