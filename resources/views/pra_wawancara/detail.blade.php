@extends('layouts.wawancara')

@push('css_khusus')
<style>
    .accordion-button:not(.collapsed){
        color: black;
    }
</style>
@endpush
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body p-4">
            <h4>Data Kelengkapan Seleksi</h4>
            <table class="table table-bordered">
                <tr>
                    <td style="width: 15%">No. Pendaftaran</td>
                    <td style="width: 35%">{{ $calon->uruts }}</td>
                    <td style="width: 15%">Nama Ayah</td>
                    <td style="width: 35%">{{ $calon->ayah_nama }}</td>
                </tr>
                <tr>
                    <td style="width: 15%">Nama Calon Siswa</td>
                    <td style="width: 35%">{{ $calon->name }}</td>
                    <td style="width: 15%">Nama Ibu</td>
                    <td style="width: 35%">{{ $calon->ibu_nama }}</td>
                </tr>
                <tr>
                    <td>Unit</td>
                    <td>{{ $calon->unit }}</td>
                    <td colspan="2"></td>
                </tr>
            </table>
            <div class="accordion">
                @foreach ($data as $d)
                    <div class="accordion-item">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $d->no }}" aria-expanded="true" aria-controls="{{ $d->no }}">
                            {{ $d->no_soal }}. {{ $d->pertanyaan }}
                        </button>
                        <div id="{{ $d->no }}" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        @if($d->jawaban)
                            <div class="accordion-body">
                                @if(strlen($d->jawaban) == 1)
                                    @if($d->jawaban == 1)
                                        Setuju,
                                    @endif
                                    @if($d->jawaban == 0)
                                        Tidak Setuju,
                                    @endif
                                @else
                                    {{ $d->jawaban }}
                                @endif            
                                @if($d->catatan)
                                    <br>{{ $d->catatan }}
                                @endif
                            </div>
                        @endif
                        </div>
                    </div>
                    <br>
                @endforeach
            </div>   
        </div>
    </div>
</div>
@endsection