@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-tshirt"></i>
                        Form Pengisian Ukuran Seragam Calon Siswa
                    </h3>
                    <div class="card-tools">
                        <a href="/home" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                <form role="form" method="POST" action="{{ route('uniform.update', $calon->id) }}">
                @method('PUT')
                @csrf
                    <div class="form-group row">
                        <div class="col-sm-8 row">
                            <label for="name" class="col-sm-7 col-form-label mb-2">Pilih ukuran Baju atau Blouse</label>
                            <div class="col-sm-5 mb-2">
                                <select class="form-control" name="atas" required>
                                    <option disabled selected>Ukuran Baju</option>
                                    <option value="SS">SS - 1</option>
                                    <option value="S">S - 2</option>
                                    <option value="M">M - 3</option>
                                    <option value="L">L - 4</option>
                                    <option value="XL">XL - 5</option>
                                    <option value="XXL">XXL - 6</option>
                                </select>
                            </div>
                            <label for="name" class="col-sm-7 col-form-label">Pilih ukuran Celana atau Rok</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="bawah" required>
                                    <option disabled selected>Ukuran Celana/Rok</option>
                                    <option value="SS">SS - 1</option>
                                    <option value="S">S - 2</option>
                                    <option value="M">M - 3</option>
                                    <option value="L">L - 4</option>
                                    <option value="XL">XL - 5</option>
                                    <option value="XXL">XXL - 6</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="col btn btn-success" style="font-weight: 800; height: 100%";>SIMPAN</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-12 col-md-7">
                        <table style="width: 100%; margin: 0 auto;">
                            <tr>
                                <td style="text-align: center; font-weight:bold">Ukuran Baju atau Blouse</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-weight:bold"><img src="/file/{{ strtolower($tingkat) }}/atas{{ $calon->jk }}.jpg" alt="seragam" style="max-width:100%;"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <table style="width: 100%; margin: 0 auto;">
                            <tr>
                                <td style="text-align: center; font-weight:bold">Ukuran Celana atau Rok</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-weight:bold"><img src="/file/{{ strtolower($tingkat) }}/bawah{{ $calon->jk }}.jpg" alt="seragam" style="max-width:90%;"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
