@extends('layouts.user')

@section('content')
<style>
    th, td {
        vertical-align: middle;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-lg-6 col-md-8" style="margin-bottom: 75px;">
            <div class="card card-primary card-outline" style="margin-bottom: 5rem !important">
                <div class="card-header bg-primary">
                    <h5 class="card-title text-white">
                        <i class="fas fa-upload"></i>
                        Index Upload Dokumen
                        <a href="/ppdb/{{ $calon->id }}" type="button" class="btn bg-secondary btn-sm text-white float-end">
                            <i class="fas fa-times"></i>
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>No. Pendaftaran</td>
                            <td style="width: 300px !important">{{ $calon->uruts }}</td>
                        </tr>
                        <tr>
                            <td>Nama Calon Siswa</td>
                            <td>{{ $calon->name }}</td>
                        </tr>
                    </table>
                    <hr>
                    <div class="alert alert-danger">
                        File yang diupload hanya file dokumen dalam bentuk <strong>PDF atau Gambar</strong>
                        dan <strong>maksimal file sebesar 15 Mbyte</strong>.
                        Dan apabila ingin mengganti file dokumen yang sudah diupload, dapat dilakukan dengan 
                        cara mengupload ulang dokumen tersebut.
                    </div>
                    <table class="table table-sm ">
                        <thead>
                            <tr>
                                <th width="10%">No.</th>
                                <th>Jenis Dokumen</th>
                                <th width="20%">Status</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                            @foreach(App\JDoku::Dokumen($calon->gel_id, $calon->ck_id, $calon->asal_nf) as $j)
                                @isset($doku[$j->code])
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <td>{{ $j->name }}</td>
                                    <th>
                                        <span class="text-success"><i class="fas fa-thumbs-up"></i><strong> Sudah Terupload</strong></span>
                                    </th>
                                    <th><a class="btn btn-success" href="{{ route('doku.upload', ['calon' => $calon->id, 'code' => $j->code ]) }}">Upload Ulang</a></th>
                                </tr>
                                @endisset
                                @empty($doku[$j->code])
                                <tr>    
                                    <th>{{ $no++ }}</th>
                                    <td>{{ $j->name }}</td>
                                    <th><span class="text-danger">Belum Terupload</span></th>
                                    <th><a class="btn btn-warning" href="{{ route('doku.upload', ['calon' => $calon->id, 'code' => $j->code ]) }}">Upload</a></th>
                                </tr>
                                @endempty
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
