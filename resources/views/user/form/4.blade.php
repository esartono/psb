<style>
    .datepicker tr td-:last-of-type {
        width: 20px !important;
    }
</style>

<div class="text-center">
    <h4 class="mb-3">Data Calon Siswa</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=4>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Nama Lengkap</label>
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Lengkap"
                    {{ $calon->asal_nf == 1 ? "readonly" : "" }} value="{{ $calon->name == '-' ? '' : $calon->name }}" required>
                <has-error :form="form" field="name"></has-error>
            </div>
            <label class="col-md-2 col-form-label">Panggilan</label>
            <div class="col-md-3">
                <input type="text" name="panggilan" class="form-control" id="panggilan" placeholder="Nama Panggilan"
                value="{{ $calon->panggilan == '-' ? '' : $calon->panggilan }}" required>
                <has-error :form="form" field="panggilan"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Tempat Lahir</label>
            <div class="col-md-4">
                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir"
                value="{{ $calon->tempat_lahir == null ? '' : $calon->tempat_lahir }}" required>
                <has-error :form="form" field="tempat_lahir"></has-error>
            </div>
            <label class="col-md-2 col-form-label">Tanggal Lahir</label>
            <div class="col-md-3">
                <div class="input-group date">
                    <input type="text" name="tgl_lahir" class="form-control" id="datepicker" readonly value="{{ $age }}">
                </div>
                <has-error :form="form" field="tgl_lahir"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Jenis Kelamin</label>
            <div class="col-md-3">
                <select v-model="form.jk" name="jk" class="form-control" id="jk">
                    <optgroup label="Pilih Jenis Kelamin">
                        <option value=1 {{ $calon->jk == 1 ? 'selected="true"' : '' }}>Laki-Laki</option>
                        <option value=2 {{ $calon->jk == 2 ? 'selected="true"' : '' }}>Perempuan</option>
                    </optgroup>
                </select>
                <has-error :form="form" field="jk"></has-error>
            </div>
            <label class="col-md-2 offset-md-1 col-form-label">Agama</label>
            <div class="col-md-2">
                <select name="agama" class="form-control" id="agama">
                    <optgroup label="Pilih Agama">
                    @foreach($agama as $a)
                        <option value="{{ $a->id }}" {{ $calon->agama == $a->id ? 'selected="true"' : '' }}>{{ $a->name }}</option>
                    @endforeach
                    </optgroup>
                </select>
                <has-error :form="form" field="agama"></has-error>
            </div>
        </div>
        @if(\App\SchoolCategory::namaDariGelombang($calon->gel_id) === 'SMP' || \App\SchoolCategory::namaDariGelombang($calon->gel_id) === 'SMA')
            <div class="form-group row">
                <label class="col-md-3 col-form-label">NISN</label>
                <div class="col-md-4">
                    <input type="text" name="nisn" class="form-control" id="nisn" placeholder="NISN"
                    value="{{ is_null($calon->nisn) ? '' : $calon->nisn }}" required
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10">
                    <has-error :form="form" field="nisn"></has-error>
                </div>
            </div>
        @endif
        <div class="form-group row">
            <label class="col-md-3 col-form-label">NIK</label>
            <div class="col-md-4">
                <input type="text" name="nik" class="form-control" id="nik" placeholder="Nomor Induk Kependudukan"
                value="{{ $calon->nik == '-' ? '' : $calon->nik }}" required
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="16" minlength="16">
                <has-error :form="form" field="nik"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Sumber Informasi PPDB</label>
            <div class="col-md-4">
                <select name="info" class="form-control" id="info">
                    @foreach($infos as $a)
                        <option value="{{ $a->id }}" {{ $calon->info == $a->id ? 'selected="true"' : '' }}>{{ $a->name }}</option>
                    @endforeach
                </select>
                <has-error :form="form" field="info"></has-error>
            </div>
        </div>
        <hr>
        @include('user.form.batal')
        <button type="submit" class="btn bg-blue float-right">
            Selanjutnya
            <i class="fa fa-chevron-circle-right"></i>
        </button>
    </form>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
