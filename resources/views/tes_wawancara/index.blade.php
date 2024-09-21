@extends('layouts.wawancara')

@push('css_khusus')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css">

<style>
    .isi {
        background-color: #FF8C00 !important;
        color: #fff !important;
    }
    .active.isi {
        background-color: #495057 !important;
        color: #fff !important;
    }
    .thead, .tbody, tr, th, td {
        border: 1px solid grey;
        padding: 0.5rem !important;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
    <div class="breadcomb-list">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                @isset($modelWawancara)
                    @isset($calon)
                    @php
                        $wawancaranya = [
                            'ortu' => 'Wawancara Orangtua Calon Siswa',
                            'siswa' => 'Wawancara Calon Siswa',
                        ]
                    @endphp
                        <br>
                        @include('tes_wawancara.datasiswa')
                    @endisset
                    @empty($calon)
                        <h5 style="font-size: 1.2em" class="mb-3 mt-3">Silahkan Masukan No. Pendaftaran :</h5>
                        <form class="mb-3" role="form" method="GET" action="{{ route('tesWawancara') }}">
                            @if(!empty($message))
                                <div class="alert alert-danger"> {{ $message }}</div>
                            @endif
                            <div class="row justify-content-md-center mb-3">
                                <input type="hidden" name="wawancara" value="{{ $modelWawancara }}">
                                <div class="col align-self-center col-lg-3 col-md-4 col-sm-6">
                                    <input type="text" name="id_pendaftaran" class="form-control" required
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="9" minlength="9">
                                </div>
                            </div>
                            <button class="btn btn-sm btn-success text-white" type="submit">
                                <i class="fa-solid fa-circle-play"></i> Mulai Wawancara
                            </button>        
                        </form>
                    @endempty
                @endisset
                @empty($modelWawancara)
                    <h5 style="font-size: 1.2em" class="mb-3 mt-3">Silahkan Pilih Wawancara :</h5>
                    <form class="mb-3" role="form" method="GET" action="{{ route('tesWawancara') }}">
                        <button class="btn btn-lg btn-success text-white" type="submit" name="wawancara" value="ortu" >
                            <i class="fa-solid fa-user-tie"></i> Wawancara Ortu
                        </button>
                        <button class="btn btn-lg btn-info text-white" type="submit" name="wawancara" value="siswa" >
                            <i class="fa-solid fa-user-graduate"></i> Wawancara Siswa
                        </button>
                    </form>
                @endempty
            </div>
        </div>
    </div>
    <div class="container mt-5">
    <div class="card">
        <div class="card-body p-4">
            <table class="table table-sm align-middle">
                <thead class="align-middle text-center">
                    <tr>
                        <th rowspan="3">No.</th>
                        <th rowspan="3">No. Pendaftaran</th>
                        <th rowspan="3">Nama Calon Siswa</th>
                        <th colspan="4">Wawancara</th>
                    </tr>
                    <tr>
                        <th colspan="2">Orang Tua</th>
                        <th colspan="2">Siswa</th>
                    </tr>
                    <tr>
                        <th>Skor</th>
                        <th>Rekomendasi</th>
                        <th>Skor</th>
                        <th>Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wawancara as $w)
                        <tr>
                            <td class="text-center">{{ $w['no'] }}</td>
                            <td class="text-center">{{ $w['no_pendaftaran'] }}</td>
                            <td>{{ $w['nama'] }}</td>
                            <td>100</td>
                            <td>Rekomendasi Ortu</td>
                            <td>100</td>
                            <td>Rekomendasi Siswa</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>   
        </div>
    </div>
    </div>
</div>
@endsection
@push('jawa')
<script src="//cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
@endpush