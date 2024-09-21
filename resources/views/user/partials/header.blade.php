<!-- Start Header Top Area -->
<div class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="logo-area">
                    <a href="/"><img style="max-width: 50px" src="/img/logo.png" alt="" /> PPDB SIT Nurul Fikri - Depok</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="logo-area mt-1 text-end">
                    <div class="btn-group me-3" role="group" aria-label="Button group with nested dropdown">
                        <a href="/" class="btn">Home</a>
                        <a href="/jadwal" target="_blank" class="btn">Jadwal</a>
                        <a href="/biaya" target="_blank" class="btn">Biaya Pendidikan</a>
                        <a href="/download" target="_blank" class="btn">Download</a>
                    </div>
                    <a class="btn btn-secondary text-white" href="{{ route('logout')}}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-power-off"></i> &nbsp; {{ __('Logout') }} </b>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Header Top Area -->
@php
    $var = Request::path();
    $ok = 'eko';
    if(str_contains($var, 'ppdb')){
        $ok = 'ok';
    }
@endphp
@if($ok == 'ok')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
        <div class="breadcomb-list">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    @if(Request::path() !== 'ppdb')
                        @isset($calons)
                            @foreach ($calons as $c)
                                <a class="btn btn-warning text-white" href="/ppdb/{{ $c->id }}"><i class="fa-solid fa-user-graduate"></i> {{ $c->name }}</a>
                            @endforeach
                        @endisset
                    @endif
                    <a class="btn btn-primary text-white" href="/tambahcalon"><i class="fa-solid fa-user-plus"></i> Tambah Calon Siswa</a>
                </div>
            </div>
        </div>
    </div>
@else
    <br>
@endif

<!-- Main Menu area End-->