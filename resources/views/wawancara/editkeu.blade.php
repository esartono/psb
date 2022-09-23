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
                                    <option selected='true' disabled='disabled'>Pilih Diskon Khusus</option>
                                    <option value=0>Tidak ada potongan</option>
                                    <option value=1>Asal dari NF (Depok/Bogor)</option>
                                    <option value=2>Memiliki Saudara kandung PERTAMA di NF</option>
                                    <option value=3>Memiliki Saudara kandung KEDUA di NF</option>
                                    <option value=4>Diskon Mendaftarkan lebih dari 1</option>
                                    <option value=5>Diskon anak PEGAWAI TETAP</option>
                                    <option value=6>Diskon anak PEGAWAI KONTRAK</option>
                                    <option value=7>Diskon Undangan Khusus asal NF (Depok/Bogor)</option>
                                    <option value=8>Diskon Pemenang Lomba tingkat Nasional (Bertingkat)</option>
                                    <option value=9>Diskon Hafal minimal 15 Juz</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Infaq SIT Nurul Fikri</label>
                            <div class="col-md-8">
                                <input type="text" name="infaq" class="form-control" id="infaq"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Infaq NF Peduli</label>
                            <div class="col-md-8">
                                <input type="text" name="infaqnfpeduli" class="form-control" id="infaqnfpeduli"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
