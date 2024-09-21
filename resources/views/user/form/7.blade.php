<form role="form" method="POST" action="{{ route('add.calon') }}">
    @csrf
    <input type="hidden" name="step" value=7>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list">
                <div class="basic-tb-hd mb-4">
                    <h2>Data Calon Siswa</h2>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-6 col-form-label mb-3 required">Nama Lengkap</label>
                    <div class="col-lg-5 col-md-6 mb-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama Lengkap"
                            {{ $calon->asal_nf == 1 ? "readonly" : "" }} value="{{ $calon->name == '-' ? '' : $calon->name }}" required>
                    </div>
                    <label class="col-lg-2 col-md-6 col-form-label required">Panggilan</label>
                    <div class="col-lg-3 col-md-6">
                        <input type="text" name="panggilan" class="form-control" id="panggilan" placeholder="Nama Panggilan"
                        value="{{ $calon->panggilan == '-' ? '' : $calon->panggilan }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-6 col-form-label mb-3 required">Tempat Lahir</label>
                    <div class="col-lg-5 col-md-6 mb-3">
                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir"
                            value="{{ $calon->tempat_lahir == null ? '' : $calon->tempat_lahir }}" required>
                    </div>
                    <label class="col-lg-2 col-md-6 col-form-label required">Tanggal Lahir</label>
                    <div class="col-lg-3 col-md-6">
                        <div class="input-group date">
                            {{-- <input type="text" name="tgl_lahir" class="form-control" id="datepicker" readonly value="{{ $age }}"> --}}
                            <input type="date" name="tgl_lahir" class="form-control" value="{{ $age }}" max="{{ $min_age }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-6 col-form-label mb-3 required">Jenis Kelamin</label>
                    <div class="col-lg-5 col-md-6 mb-3">
                        <select v-model="form.jk" name="jk" class="form-control" id="jk" required>
                            <optgroup label="Pilih Jenis Kelamin">
                                <option value=1 {{ $calon->jk == 1 ? 'selected="true"' : '' }}>Laki-Laki</option>
                                <option value=2 {{ $calon->jk == 2 ? 'selected="true"' : '' }}>Perempuan</option>
                            </optgroup>
                        </select>
                    </div>
                    <label class="col-lg-2 col-md-6 col-form-label col-form-label">Agama</label>
                    <div class="col-lg-3 col-md-6">
                        <select name="agama" class="form-control" id="agama">
                            <optgroup label="Pilih Agama">
                                <option value="1" selected="true">Islam</option>
                            {{-- @foreach($agama as $a)
                                <option value="{{ $a->id }}" {{ $calon->agama == $a->id ? 'selected="true"' : '' }}>{{ $a->name }}</option>
                            @endforeach --}}
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('user.form.batal')
<button type="submit" class="btn btn-success float-end">
    Selanjutnya
    <i class="fa fa-chevron-circle-right"></i>
</button>
</form>
