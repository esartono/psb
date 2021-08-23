<style>
    .datepicker tr td-:last-of-type {
        width: 20px !important;
    }
</style>

<div class="text-center">
    <h4 class="mb-3">Data Calon Siswa</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=7>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Nama Sekolah</label>
            <div class="col-md-9">
                <input type="text" name="asal_sekolah" class="form-control" id="asal_sekolah" placeholder="Nama Sekolah" required>
                <has-error :form="form" field="asal_sekolah"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Alamat Asal Sekolah</label>
            <div class="col-md-9">
                <input type="text" name="asal_alamat_sekolah" class="form-control" id="asal_alamat_sekolah" placeholder="Alamat Asal Sekolah" required>
                <has-error :form="form" field="asal_alamat_sekolah"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Provinsi</label>
            <div class="col-md-3">
                <select onchange="listKota(this)" name="provinsi" class="form-control" id="provinsi" required>
                    <option selected='true' disabled='disabled'>Pilih Provinsi</option>
                    @foreach ($provinsi as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                    @endforeach
                </select>
                <has-error :form="form" field="provinsi"></has-error>
            </div>
            <label class="col-md-2 offset-md-1 col-form-label">Kabupaten</label>
            <div class="col-md-3">
                <select onchange="listCamat(this)" name="kota" class="form-control" id="kota" required></select>
                <has-error :form="form" field="kota"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Kecamatan</label>
            <div class="col-md-3">
                <select onchange="listLurah(this)" name="kecamatan" class="form-control" id="kecamatan" required></select>
                <has-error :form="form" field="kecamatan"></has-error>
            </div>
            <label class="col-md-2 offset-md-1 col-form-label">Kelurahan</label>
            <div class="col-md-3">
                <select name="kelurahan" class="form-control" id="kelurahan" required></select>
                <has-error :form="form" field="kelurahan"></has-error>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn bg-blue float-right">
            Selanjutnya
            <i class="fa fa-chevron-circle-right"></i>
        </button>
    </form>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<script type="application/javascript" src="/js/daerah.js"></script>
