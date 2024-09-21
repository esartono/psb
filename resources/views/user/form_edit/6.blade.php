<form role="form" method="POST" action="{{ route('edit.calon') }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="step" value=6>
    <input type="hidden" name="id" value={{ $calon->id }}>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list">
                <div class="basic-tb-hd mb-4">
                    <h2>Data Orang Tua Calon Siswa</h2>
                </div>
                <div class="card-group">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Data Ayah</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">Nama Lengkap</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <input type="text" name="ayah_nama" class="form-control" id="ayah_nama" placeholder="Nama Ayah"
                                    value="{{ is_null($calon->ayah_nama) ? '' : $calon->ayah_nama }}" required>
                                    <has-error :form="form" field="ayah_nama"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">No. Induk Kependudukan</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <input type="text" name="ayah_nik" class="form-control" id="ayah_nik" placeholder="No. Induk Kependudukan"
                                    value="{{ is_null($calon->ayah_nik) ? '' : $calon->ayah_nik }}" required
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="16" minlength="16">
                                    <has-error :form="form" field="ayah_nik"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">Pendidikan</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <select name="ayah_pendidikan" class="form-control" id="ayah_pendidikan" required>
                                        <option selected="true" value="" disabled="disabled">Pilih Pendidikan Ayah</option>
                                        @foreach ($pendidikan as $p)
                                            <option value="{{ $p->id }}" {{ $calon->ayah_pendidikan == $p->id ? 'selected="true"' : '' }}>{{ $p->name }}
                                        @endforeach
                                    </select>
                                    <has-error :form="form" field="ayah_pendidikan"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">Pekerjaan</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <select name="ayah_pekerjaan" class="form-control" id="ayah_pekerjaan" required>
                                        <option selected="true" value="" disabled="disabled">Pilih Pekerjaan Ayah</option>
                                        @foreach ($pekerjaan as $p)
                                            <option value="{{ $p->id }}" {{ $calon->ayah_pekerjaan == $p->id ? 'selected="true"' : '' }}>{{ $p->name }}
                                        @endforeach
                                    </select>
                                    <has-error :form="form" field="ayah_pekerjaan"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">No. Ponsel</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <input type="text" name="ayah_hp" class="form-control" id="ayah_hp"
                                    value="{{ is_null($calon->ayah_hp) ? '' : $calon->ayah_hp }}" required
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                    <has-error :form="form" field="ayah_hp"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label">Email</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <input type="email" name="ayah_email" class="form-control" id="ayah_email"
                                    value="{{ is_null($calon->ayah_email) ? '' : $calon->ayah_email }}">
                                    <has-error :form="form" field="ayah_email"></has-error>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center">Data Ibu</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">Nama Lengkap</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <input type="text" name="ibu_nama" class="form-control" id="ibu_nama" placeholder="Nama Ibu"
                                    value="{{ is_null($calon->ibu_nama) ? '' : $calon->ibu_nama }}" required>
                                    <has-error :form="form" field="ibu_nama"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">No. Induk Kependudukan</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <input type="text" name="ibu_nik" class="form-control" id="ibu_nik" placeholder="No. Induk Kependudukan"
                                    value="{{ is_null($calon->ibu_nik) ? '' : $calon->ibu_nik }}" required
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="16" minlength="16">
                                    <has-error :form="form" field="ibu_nik"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">Pendidikan</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <select name="ibu_pendidikan" value="" class="form-control" id="ibu_pendidikan" required>
                                        <option selected="true" value="" disabled="disabled">Pilih Pendidikan Ibu</option>
                                        @foreach ($pendidikan as $p)
                                            <option value="{{ $p->id }}" {{ $calon->ibu_pendidikan == $p->id ? 'selected="true"' : '' }}>{{ $p->name }}
                                        @endforeach
                                    </select>
                                    <has-error :form="form" field="ibu_pendidikan"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">Pekerjaan</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <select name="ibu_pekerjaan" value="" class="form-control" id="ibu_pekerjaan" required>
                                        <option selected="true" value="" disabled="disabled">Pilih Pekerjaan Ibu</option>
                                        @foreach ($pekerjaan as $p)
                                            <option value="{{ $p->id }}" {{ $calon->ibu_pekerjaan == $p->id ? 'selected="true"' : '' }}>{{ $p->name }}
                                        @endforeach
                                    </select>
                                    <has-error :form="form" field="ibu_pekerjaan"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">No. Ponsel</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <input type="text" name="ibu_hp" class="form-control" id="ibu_hp"
                                    value="{{ is_null($calon->ibu_hp) ? '' : $calon->ibu_hp }}" required
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                    <has-error :form="form" field="ibu_hp"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-5 col-md-5 col-form-label required">Email</label>
                                <div class="col-lg-7 col-md-7 mb-3">
                                    <input type="email" name="ibu_email" class="form-control" id="ibu_email"
                                    value="{{ is_null($calon->ibu_email) ? '' : $calon->ibu_email }}">
                                    <has-error :form="form" field="ibu_email"></has-error>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <a href="/editcalon/{{ $calon->id }}/5" class="btn btn-warning float-start white">
                            <i class="fa fa-chevron-circle-left"></i>
                            Sebelumnya
                        </a>
                    </div>
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
