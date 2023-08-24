<div class="text-right">
    <h4 class="mb-3 text-center">Data Calon Siswa</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=4>
        <div class="form-group row">
            <label class="col-md-3 col-form-label required">Nama Lengkap</label>
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Lengkap"
                    {{ $calon->asal_nf == 1 ? "readonly" : "" }} value="{{ $calon->name == '-' ? '' : $calon->name }}" required>
            </div>
            <label class="col-md-2 col-form-label required">Panggilan</label>
            <div class="col-md-3">
                <input type="text" name="panggilan" class="form-control" id="panggilan" placeholder="Nama Panggilan"
                value="{{ $calon->panggilan == '-' ? '' : $calon->panggilan }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label required">Tempat Lahir</label>
            <div class="col-md-4">
                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir"
                value="{{ $calon->tempat_lahir == null ? '' : $calon->tempat_lahir }}" required>
            </div>
            <label class="col-md-2 col-form-label required">Tanggal Lahir</label>
            <div class="col-md-3">
                <div class="input-group date">
                    <input type="text" name="tgl_lahir" class="form-control" id="datepicker" readonly value="{{ $age }}">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label required">Jenis Kelamin</label>
            <div class="col-md-3">
                <select v-model="form.jk" name="jk" class="form-control" id="jk" required>
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
        <hr>
        @include('user.form.batal')
        <button type="submit" class="btn bg-blue float-right">
            Selanjutnya
            <i class="fa fa-chevron-circle-right"></i>
        </button>
    </form>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
