@extends('layouts.user')
@push('css_khusus')
    {{-- <link rel="stylesheet" href="/css/detail.css">
    <script src="https://unpkg.com/feather-icons"></script> --}}
@endpush
@section('content')
@isset($cekTotalCalons)
    {{-- @if ($cekTotalCalons == 0)
        @include('user.partials.kosong')
    @endif --}}
    @if ($cekTotalCalons == 1)
        @include('user.partials.detail')
    @endif
    @if ($cekTotalCalons > 1)
        @include('user.partials.calons')
    @endif    
@endisset

@empty($cekTotalCalons)
    @include('user.partials.detail')
@endempty
@push('jawa')
    
@endpush
@endsection
