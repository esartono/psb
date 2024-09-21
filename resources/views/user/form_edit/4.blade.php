<style type="text/css">
    .datepicker tr td-:last-of-type {
        width: 20px !important;
    }
</style>

<form role="form" method="POST" action="{{ route('edit.calon') }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="step" value=4>
    <input type="hidden" name="id" value={{ $calon->id }}>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list">
                <div class="basic-tb-hd mb-4">
                    <h2>Data Calon Siswa</h2>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-6 col-form-label required">Nama Lengkap</label>
                    <div class="col-lg-5 col-md-6 mb-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama Lengkap"
                            {{ $calon->asal_nf == 1 ? "readonly" : "" }} value="{{ $calon->name == '-' ? '' : $calon->name }}" required>
                    </div>
                    <label class="col-lg-2 col-md-6 col-form-label required">Panggilan</label>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <input type="text" name="panggilan" class="form-control" id="panggilan" placeholder="Nama Panggilan"
                        value="{{ $calon->panggilan == '-' ? '' : $calon->panggilan }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-6 col-form-labelrequired">Tempat Lahir</label>
                    <div class="col-lg-5 col-md-6 mb-3">
                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir"
                        value="{{ $calon->tempat_lahir == null ? '' : $calon->tempat_lahir }}" required>
                        <has-error :form="form" field="tempat_lahir"></has-error>
                    </div>
                    <label class="col-lg-2 col-md-6 col-form-label required">Tanggal Lahir</label>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="input-group date">
                            <input type="text" name="tgl_lahir" class="form-control" value="{{ $age }}">
                        </div>
                        <has-error :form="form" field="tgl_lahir"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-6 col-form-label required">Jenis Kelamin</label>
                    <div class="col-lg-5 col-md-6 mb-3">
                        <select name="jk" class="form-control" disabled>
                            <optgroup label="Pilih Jenis Kelamin">
                                <option value=1 {{ $calon->jk == 1 ? 'selected="true"' : '' }}>Laki-Laki</option>
                                <option value=2 {{ $calon->jk == 2 ? 'selected="true"' : '' }}>Perempuan</option>
                            </optgroup>
                        </select>
                        <has-error :form="form" field="jk"></has-error>
                    </div>
                    <label class="col-lg-2 col-md-6 col-form-label required">Agama</label>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <select name="agama" class="form-control" id="agama" disabled>
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
                        <label class="col-lg-2 col-md-6 col-form-label required">NISN</label>
                        <div class="col-lg-5 col-md-6 mb-3">    
                            <input type="text" name="nisn" class="form-control" id="nisn" placeholder="NISN"
                            value="{{ is_null($calon->nisn) ? '' : $calon->nisn }}" required
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10">
                            <has-error :form="form" field="nisn"></has-error>
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <label class="col-lg-2 col-md-6 col-form-label required">NIK</label>
                    <div class="col-lg-5 col-md-6 mb-3">    
                        <input type="text" name="nik" class="form-control" id="nik" placeholder="Nomor Induk Kependudukan"
                        value="{{ $calon->nik == '-' ? '' : $calon->nik }}" required
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="16" minlength="16">
                        <has-error :form="form" field="nik"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-6 col-form-label required">Sumber Informasi PPDB</label>
                    <div class="col-lg-5 col-md-6 mb-3">    
                        <select name="info" class="form-control" id="info" required>
                            <option value='' selected disabled>Pilih sumber informasi PPDB</option>
                            @foreach($infos as $a)
                                <option value="{{ $a->id }}" {{ $calon->info == $a->id ? 'selected="true"' : '' }}>{{ $a->name }}</option>
                            @endforeach
                        </select>
                        <has-error :form="form" field="info"></has-error>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <button type="submit" class="btn btn-success float-end white">
                            Simpan dan Lanjutkan
                            <i class="fa fa-chevron-circle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('js')

@endpush

