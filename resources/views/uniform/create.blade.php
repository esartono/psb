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
                                    <option disabled {{ $calon->seragam['atas'] == '-' ? 'selected' : '' }}>Ukuran Baju</option>
                                    <option value="SS" {{ $calon->seragam['atas'] == 'SS' ? 'selected' : '' }}> SS </option>
                                    <option value="S" {{ $calon->seragam['atas'] == 'S' ? 'selected' : '' }}> S </option>
                                    <option value="M" {{ $calon->seragam['atas'] == 'M' ? 'selected' : '' }}> M </option>
                                    <option value="L" {{ $calon->seragam['atas'] == 'L' ? 'selected' : '' }}> L </option>
                                    <option value="XL" {{ $calon->seragam['atas'] == 'XL' ? 'selected' : '' }}> XL </option>
                                    <option value="XXL" {{ $calon->seragam['atas'] == 'XXL' ? 'selected' : '' }}> XXL </option>
                                </select>
                            </div>
                            <label for="name" class="col-sm-7 col-form-label">Pilih ukuran Celana atau Rok</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="bawah" required>
                                    <option disabled {{ $calon->seragam['bawah'] == '-' ? 'selected' : '' }}>Ukuran Celana/Rok</option>
                                    <option value="SS" {{ $calon->seragam['bawah'] == 'SS' ? 'selected' : '' }}> SS </option>
                                    <option value="S" {{ $calon->seragam['bawah'] == 'S' ? 'selected' : '' }}> S </option>
                                    <option value="M" {{ $calon->seragam['bawah'] == 'M' ? 'selected' : '' }}> M </option>
                                    <option value="L" {{ $calon->seragam['bawah'] == 'L' ? 'selected' : '' }}> L </option>
                                    <option value="XL" {{ $calon->seragam['bawah'] == 'XL' ? 'selected' : '' }}> XL </option>
                                    <option value="XXL" {{ $calon->seragam['bawah'] == 'XXL' ? 'selected' : '' }}> XXL </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="col btn btn-success" style="font-weight: 800; height: 100%";>SIMPAN</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    @include('uniform.ukuran.'.$calon->gelnya->unitnya->catnya->name.'_'.$calon->kelamin)
                    {{-- <div class="col-sm-12 col-md-7">
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
                    </div> --}}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
