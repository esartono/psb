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
                        Form Kelengkapan Data Wawancara
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
                        <p>Bapak/ibu yang dirahmati Allah, terima kasih kami sampaikan atas kepercayaan Bapak/Ibu mendaftarkan ananda dalam proses PPDB Nurul Fikri Islamic School.</p>
                        <p>Berikut adalah formulir kelengkapan seleksi. Mohon Bapak/Ibu mengisi dengan sebenarnya, sebagai bagian dari proses PPDB Nurul Fikri Islamic School.
                        Jawaban yang Bapak/Ibu berikan sangat bermakna bagi kami dalam proses PPDB ananda.</p>
                        <p>Pertanyaan dan jawaban ini bersifat rahasia, mohon tidak mengambil gambar (memfoto atau screenshot) dan membagikan dalam bentuk apa pun. Terimakasih atas kerjasama Bapak/Ibu.</p>
                    </div>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Silahkan klik salah satu tombol di bawah ini:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><a class="btn btn-info" style="color: white" href="{{ route('praWawancara.create', ['calon' => $calon->id]) }}">1. Form Kelengkapan seleksi Orang Tua</a></th>
                            </tr>
                            <tr>
                                @if($calon->gelnya->unitnya->catnya->name == 'SMP')
                                    <th><a class="btn btn-success" href="https://bit.ly/RH-NF-SMP">2. Form Kelengkapan Siswa SMP</a></th>
                                @endif
                                @if($calon->gelnya->unitnya->catnya->name == 'SMA')
                                    <th><a class="btn btn-success" href="https://bit.ly/RH-NF-SMA">2. Form Kelengkapan Siswa SMA</a></th>
                                @endif
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
