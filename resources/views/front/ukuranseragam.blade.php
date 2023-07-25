@extends('front.template')

@section('isi')
<section class="faculty-area">
    <div class="container">
        <div class="row justify-content-center d-flex align-items-center">
            <hr>
            <h3 class="mt-40">Seragam TK Putra</h3>
            <div class="col-sm-12">
                @include('uniform.ukuran.TK_Laki-Laki')
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <h3 class="mt-40">Seragam TK Putri</h3>
            <div class="col-sm-12">
                @include('uniform.ukuran.TK_Perempuan')
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <hr>
            <h3 class="mt-40">Seragam SD Putra</h3>
            <div class="col-sm-12">
                @include('uniform.ukuran.SD_Laki-Laki')
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <h3 class="mt-40">Seragam SD Putri</h3>
            <div class="col-sm-12">
                @include('uniform.ukuran.SD_Perempuan')
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <hr>
            <h3 class="mt-40">Seragam SMP Putra</h3>
            <div class="col-sm-12">
                @include('uniform.ukuran.SMP_Laki-Laki')
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <h3 class="mt-40">Seragam SMP Putri</h3>
            <div class="col-sm-12">
                @include('uniform.ukuran.SMP_Perempuan')
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <hr>
            <h3 class="mt-40">Seragam SMA Putra</h3>
            <div class="col-sm-12">
                @include('uniform.ukuran.SMA_Laki-Laki')
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <h3 class="mt-40">Seragam SMA Putri</h3>
            <div class="col-sm-12">
                @include('uniform.ukuran.SMA_Perempuan')
            </div>
        </div>
    </div>
</section>
@endsection