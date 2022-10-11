@extends('layouts.keu')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card offset-md-3 col-md-6 mt-3">
                <div class="card-body" style="padding: 10px 0px 5px 0px">
                    <div class="text-center">
                        <h4 class="mb-4">Edit Wawancara Keuangan</h4>
                    </div>
                    <form role="form" method="POST" action="{{ route('updatekeu') }}">
                        @csrf
                        <input type="hidden" name="id" value={{ $calon->id }}>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Nama Lengkap</label>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ $calon->name }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Potongan</label>
                            <div class="col-md-8">
                                <select name="potongan" class="form-control" id="potongan" required>
                                    <option @if(is_null($potongan)) selected='true' @endif disabled='disabled'>Pilih Diskon Khusus</option>
                                    <option @if($potongan->keterangan === 'Tidak ada potongan') selected='true' @endif value=0>Tidak ada potongan</option>
                                    <option @if($potongan->keterangan === 'Asal dari NF (Depok/Bogor)') selected='true' @endif value=1>Asal dari NF (Depok/Bogor)</option>
                                    <option @if($potongan->keterangan === 'Memiliki Saudara kandung PERTAMA di NF') selected='true' @endif value=2>Memiliki Saudara kandung PERTAMA di NF</option>
                                    <option @if($potongan->keterangan === 'Memiliki Saudara kandung KEDUA di NF') selected='true' @endif value=3>Memiliki Saudara kandung KEDUA di NF</option>
                                    <option @if($potongan->keterangan === 'Diskon Mendaftarkan lebih dari 1') selected='true' @endif value=4>Diskon Mendaftarkan lebih dari 1</option>
                                    <option @if($potongan->keterangan === 'Diskon anak PEGAWAI TETAP') selected='true' @endif value=5>Diskon anak PEGAWAI TETAP</option>
                                    <option @if($potongan->keterangan === 'Diskon anak PEGAWAI KONTRAK') selected='true' @endif value=6>Diskon anak PEGAWAI KONTRAK</option>
                                    <option @if($potongan->keterangan === 'Diskon Undangan Khusus asal NF (Depok/Bogor)') selected='true' @endif value=7>Diskon Undangan Khusus asal NF (Depok/Bogor)</option>
                                    <option @if($potongan->keterangan === 'Diskon Pemenang Lomba tingkat Nasional (Bertingkat)') selected='true' @endif value=8>Diskon Pemenang Lomba tingkat Nasional (Bertingkat)</option>
                                    <option @if($potongan->keterangan === 'Diskon Hafal minimal 15 Juz') selected='true' @endif value=9>Diskon Hafal minimal 15 Juz</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Infaq SIT Nurul Fikri</label>
                            <div class="col-md-8">
                                <input type="text" name="infaq" class="form-control" id="infaq"
                                value={{ $potongan->infaq == 0 ? 0 : $potongan->infaq }}
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Infaq NF Peduli</label>
                            <div class="col-md-8">
                                <input type="text" name="infaqnfpeduli" class="form-control" id="infaqnfpeduli"
                                value={{ $potongan->infaqnfpeduli == 0 ? 0 : $potongan->infaqnfpeduli }}
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Saudara</label>
                            <div class="col-md-8">
                                <input type="text" name="saudara" class="form-control" id="saudara"
                                    @if($potongan->saudara)
                                        value={{ $potongan->saudara }}
                                    @endif
                                >
                            </div>
                        </div>
                        <hr>
                        <center>
                            <a href="/wawancara-keu" class="btn btn-danger col-md-2">
                                <i class="fa fa-times"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn bg-blue col-md-2">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                        </center>
                    </form>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

<script type="application/javascript" src="/js/daerah.js"></script>
