@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-md-6">
            <div class="card card-primary card-outline" style="margin-bottom: 5rem !important">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-user-edit"></i>
                        Form Upload Dokumen Calon Siswa
                    </h3>
                    <div class="card-tools">
                        <a href="/psb" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
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
                    <table class="table table-bordered">
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
                            @foreach(App\JDoku::Dokumen($calon->gel_id, $calon->ck_id) as $j)
                                @isset($doku[$j->code])
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <td>{{ $j->name }}</td>
                                    <th>
                                        <span><i class="fas fa-thumbs-up"></i><strong> Sudah Terupload</strong></span>
                                    </th>
                                    <th><a class="btn btn-success" href="{{ route('doku.upload', ['calon' => $calon->id, 'code' => $j->code ]) }}">Upload Ulang</a></th>
                                </tr>
                                @endisset
                                @empty($doku[$j->code])
                                <tr>    
                                    <th>{{ $no++ }}</th>
                                    <td>{{ $j->name }}</td>
                                    <th><code>Belum Terupload</code></th>
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
