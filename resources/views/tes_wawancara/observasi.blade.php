@extends('layouts.wawancara')
@section('content')

<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-md-12">
            <div class="card text-dark bg-light mb-3" style="margin-bottom: 10rem !important">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-element-list">
                                    <div class="basic-tb-hd mb-4">
                                        <h2>Data Calon Siswa</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-7">
                                            <table class="table">
                                                <tr><td>Nama Lengkap</td><td>: {{ $calon->name }}</td></tr>
                                                <tr><td>Unit Tujuan</td><td>: {{ $calon->unit }}</td></tr>
                                                <tr><td>Nama Observer</td><td>: {{ $pewawancara }}</td></tr>
                                            </table>
                                        </div>
                                        <div class="col-5">
                                            <table class="table">
                                                <tr><td>Jenis Kelamin</td><td>: {{ $calon->jk == 1 ? 'Laki-Laki' : 'Perempuan' }}</td></tr>
                                                <tr><td>Kelas Tujuan</td><td>: Kelas {{ $calon->kelas }}</td></tr>
                                                <tr><td>Tanggal Observasi</td><td>: {{ formatIndo(now()) }}</td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <form role="form" method="POST" action="{{ route('observasiPPDB') }}">
                            @csrf
                            <input type="hidden" name="calon_id" value="{{ $calon->id }}">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-element-list">
                                    <div class="basic-tb-hd mb-4">
                                        <h2>Form Observasi</h2>
                                    </div>
                                    <div class="row">
                                        <table class="table table-bordered table-sm">
                                            <tr>
                                                <th style="width: 3%; text-align: center;">No.</th>
                                                <th style="width: 40%; text-align: center;">Aspek Perilaku</th>
                                                <th style="width: 15%; text-align: center;">Ya/Tidak</th>
                                                <th style="text-align: center;">Uraian</th>
                                            </tr>
                                            @php
                                                $no=1;
                                                $currentAspek = null;
                                            @endphp
                                            @foreach ($observasi as $ob)
                                                @if ($currentAspek !== $ob->aspek)
                                                    <tr class="table-primary fw-bold"><th colspan="4">{{ $ob->aspek }}</th></tr>
                                                    @php $currentAspek = $ob->aspek; @endphp
                                                @endif
                                                <tr>
                                                    <th class="text-center align-middle">{{ $no }}</th>
                                                    <td>
                                                        <b>{{ $ob->observasi }}</b><br>
                                                        {{ $ob->keterangan }}
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="yatidak[{{ $ob->id }}]" id="setujuYa" value="ya"
                                                                @isset($cekObservasi->poin[$ob->id]){{ $cekObservasi->poin[$ob->id] == 'ya' ? 'checked' : '' }}@endisset>
                                                            <label class="form-check-label" for="setujuYa">Ya</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="yatidak[{{ $ob->id }}]" id="setujuTidak" value="tidak"
                                                                @isset($cekObservasi->poin[$ob->id]){{ $cekObservasi->poin[$ob->id] == 'tidak' ? 'checked' : '' }}@endisset>
                                                            <label class="form-check-label" for="setujuTidak">Tidak</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="uraian[{{ $ob->id }}]" class="form-control" id="uraian"
                                                            value=@isset($cekObservasi->catatan[$ob->id]){{ $cekObservasi->catatan[$ob->id] ?? '' }}@endisset>
                                                    </td>
                                                </tr>
                                                @php $no++; @endphp
                                            @endforeach
                                        </table>
                                        <hr>
                                        <button type="submit" class="btn btn-success">
                                            Simpan Data Observasi
                                            <i class="fa fa-chevron-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection