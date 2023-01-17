<div class="text-right">
    <h4 class="mb-3 text-center">Data Calon Siswa</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=4>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Nama Lengkap</label>
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Lengkap"
                    {{ $calon->asal_nf == 1 ? "readonly" : "" }} value="{{ $calon->name == '-' ? '' : $calon->name }}" required>
            </div>
            <label class="col-md-2 col-form-label">Panggilan</label>
            <div class="col-md-3">
                <input type="text" name="panggilan" class="form-control" id="panggilan" placeholder="Nama Panggilan"
                value="{{ $calon->panggilan == '-' ? '' : $calon->panggilan }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Tempat Lahir</label>
            <div class="col-md-4">
                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir"
                value="{{ $calon->tempat_lahir == null ? '' : $calon->tempat_lahir }}" required>
            </div>
            <label class="col-md-2 col-form-label">Tanggal Lahir</label>
            <div class="col-md-3">
                <div class="input-group date">
                    <input type="text" name="tgl_lahir" class="form-control" id="datepicker" readonly value="{{ $age }}">
                </div>
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
            </div>
        </div>
        @if(\App\SchoolCategory::namaDariGelombang($calon->gel_id) === 'SMP' || \App\SchoolCategory::namaDariGelombang($calon->gel_id) === 'SMA')
            <div class="form-group row">
                <label class="col-md-3 col-form-label">No. Induk Siswa Nasional (NISN)</label>
                <div class="col-md-4">
                    <input type="text" name="nisn" class="form-control" id="nisn" placeholder="NISN"
                    value="{{ is_null($calon->nisn) ? '' : $calon->nisn }}" required
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10">
                </div>
            </div>
        @endif
        <div class="form-group row">
            <label class="col-md-3 col-form-label">No. Induk Kependudukan (NIK)</label>
            <div class="col-md-4">
                <input type="text" name="nik" class="form-control" id="nik" placeholder="Nomor Induk Kependudukan"
                value="{{ $calon->nik == '-' ? '' : $calon->nik }}" required
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="16" minlength="16">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Rencana Masuk Sekolah</label>
            <div class="col-md-4">
                <select name="rencana_masuk" class="form-control" id="rencana_masuk">
                    <option value="8">Agustus - {{ (int)substr(Auth::user()->tp_name, 0, 4) - 1 }}</option>
                    <option value="9">September - {{ (int)substr(Auth::user()->tp_name, 0, 4) - 1 }}</option>
                    <option value="10">Oktober - {{ (int)substr(Auth::user()->tp_name, 0, 4) - 1 }}</option>
                    <option value="11">November - {{ (int)substr(Auth::user()->tp_name, 0, 4) - 1 }}</option>
                    <option value="12">Desember - {{ (int)substr(Auth::user()->tp_name, 0, 4) - 1 }}</option>
                    <option value="1">Januari - {{ (int)substr(Auth::user()->tp_name, 0, 4) }}</option>
                    <option value="2">Februari - {{ (int)substr(Auth::user()->tp_name, 0, 4) }}</option>
                    <option value="3">Maret - {{ (int)substr(Auth::user()->tp_name, 0, 4) }}</option>
                    <option value="4">April - {{ (int)substr(Auth::user()->tp_name, 0, 4) }}</option>
                    <option value="5">Mei - {{ (int)substr(Auth::user()->tp_name, 0, 4) }}</option>
                    <option value="6">Juni - {{ (int)substr(Auth::user()->tp_name, 0, 4) }}</option>
                    <option value="7" selected>Juli - {{ (int)substr(Auth::user()->tp_name, 0, 4) }}</option>
                </select>
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
