<div class="text-right">
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=6>
        <div class="card-group">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Data Ayah</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Nama Lengkap</label>
                        <div class="col-md-7">
                            <input type="text" name="ayah_nama" class="form-control" id="ayah_nama" placeholder="Nama Ayah"
                            value="{{ is_null($calon->ayah_nama) ? '' : $calon->ayah_nama }}" required>
                            <has-error :form="form" field="ayah_nama"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">No. Induk Kependudukan</label>
                        <div class="col-md-7">
                            <input type="text" name="ayah_nik" class="form-control" id="ayah_nik" placeholder="No. Induk Kependudukan"
                            value="{{ is_null($calon->ayah_nik) ? '' : $calon->ayah_nik }}" required
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="16" minlength="16">
                            <has-error :form="form" field="ayah_nik"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Pendidikan</label>
                        <div class="col-md-7">
                            <select name="ayah_pendidikan" class="form-control" id="ayah_pendidikan" required>
                                <option selected="true" disabled="disabled">Pilih Pendidikan Ayah</option>
                                @foreach ($pendidikan as $p)
                                    <option value="{{ $p->id }}" {{ $calon->ayah_pendidikan == $p->id ? 'selected="true"' : '' }}>{{ $p->name }}
                                @endforeach
                            </select>
                            <has-error :form="form" field="ayah_pendidikan"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Pekerjaan</label>
                        <div class="col-md-7">
                            <select name="ayah_pekerjaan" class="form-control" id="ayah_pekerjaan" required>
                                <option selected="true" disabled="disabled">Pilih Pekerjaan Ayah</option>
                                @foreach ($pekerjaan as $p)
                                    <option value="{{ $p->id }}" {{ $calon->ayah_pekerjaan == $p->id ? 'selected="true"' : '' }}>{{ $p->name }}
                                @endforeach
                            </select>
                            <has-error :form="form" field="ayah_pekerjaan"></has-error>
                        </div>
                    </div>
                    {{-- <div class="form-group row"> --}}
                        {{-- <label class="col-md-5 col-form-label">Penghasilan</label> --}}
                        {{-- <div class="col-md-7"> --}}
                            {{-- <input type="text" name="ayah_penghasilan" class="form-control" id="ayah_penghasilan" required
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            <select name="ayah_penghasilan" class="form-control" id="ayah_penghasilan" required>
                                <option selected="true" disabled="disabled">Pilih Penghasilan Ayah</option>
                                @foreach ($penghasilan as $p)
                                    <option value="{{ $p->id }}" {{ $calon->ayah_penghasilan == $p->id ? 'selected="true"' : '' }}>{{ $p->name }}
                                @endforeach
                            </select>
                            <has-error :form="form" field="ayah_penghasilan"></has-error>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">No. Ponsel</label>
                        <div class="col-md-7">
                            <input type="text" name="ayah_hp" class="form-control" id="ayah_hp"
                            value="{{ is_null($calon->ayah_hp) ? '' : $calon->ayah_hp }}" required
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15">
                            <has-error :form="form" field="ayah_hp"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Alamat E-mail</label>
                        <div class="col-md-7">
                            <input type="email" name="ayah_email" class="form-control" id="ayah_email"
                            value="{{ is_null($calon->ayah_email) ? '' : $calon->ayah_email }}">
                            <has-error :form="form" field="ayah_email"></has-error>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Data Ibu</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Nama Lengkap</label>
                        <div class="col-md-7">
                            <input type="text" name="ibu_nama" class="form-control" id="ibu_nama" placeholder="Nama Ibu"
                            value="{{ is_null($calon->ibu_nama) ? '' : $calon->ibu_nama }}" required>
                            <has-error :form="form" field="ibu_nama"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">No. Induk Kependudukan</label>
                        <div class="col-md-7">
                            <input type="text" name="ibu_nik" class="form-control" id="ibu_nik" placeholder="No. Induk Kependudukan"
                            value="{{ is_null($calon->ibu_nik) ? '' : $calon->ibu_nik }}" required
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="16" minlength="16">
                            <has-error :form="form" field="ibu_nik"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Pendidikan</label>
                        <div class="col-md-7">
                            <select name="ibu_pendidikan" class="form-control" id="ibu_pendidikan" required>
                                <option selected="true" disabled="disabled">Pilih Pendidikan Ibu</option>
                                @foreach ($pendidikan as $p)
                                    <option value="{{ $p->id }}" {{ $calon->ibu_pendidikan == $p->id ? 'selected="true"' : '' }}>{{ $p->name }}
                                @endforeach
                            </select>
                            <has-error :form="form" field="ibu_pendidikan"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Pekerjaan</label>
                        <div class="col-md-7">
                            <select name="ibu_pekerjaan" class="form-control" id="ibu_pekerjaan" required>
                                <option selected="true" disabled="disabled">Pilih Pekerjaan Ibu</option>
                                @foreach ($pekerjaan as $p)
                                    <option value="{{ $p->id }}" {{ $calon->ibu_pekerjaan == $p->id ? 'selected="true"' : '' }}>{{ $p->name }}
                                @endforeach
                            </select>
                            <has-error :form="form" field="ibu_pekerjaan"></has-error>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-md-5 col-form-label">Penghasilan</label>
                        <div class="col-md-7">
                            {{-- <input type="text" name="ibu_penghasilan" class="form-control" id="ibu_penghasilan" required
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"> --}}
                            {{-- <select name="ibu_penghasilan" class="form-control" id="ibu_penghasilan" required> --}}
                                {{-- <option selected="true" disabled="disabled">Pilih Penghasilan Ibu</option> --}}
                                {{-- @foreach ($penghasilan as $p) --}}
                                    {{-- <option value="{{ $p->id }}" {{ $calon->ibu_penghasilan == $p->id ? 'selected="true"' : '' }}>{{ $p->name }} --}}
                                {{-- @endforeach --}}
                            {{-- </select> --}}
                            {{-- <has-error :form="form" field="ibu_penghasilan"></has-error> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">No. Ponsel</label>
                        <div class="col-md-7">
                            <input type="text" name="ibu_hp" class="form-control" id="ibu_hp"
                            value="{{ is_null($calon->ibu_hp) ? '' : $calon->ibu_hp }}" required
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15">
                            <has-error :form="form" field="ibu_hp"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Alamat E-mail</label>
                        <div class="col-md-7">
                            <input type="email" name="ibu_email" class="form-control" id="ibu_email"
                            value="{{ is_null($calon->ibu_email) ? '' : $calon->ibu_email }}">
                            <has-error :form="form" field="ibu_email"></has-error>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <a href="/tambahcalon/5" class="btn bg-TK float-left white mr-2">
            <i class="fa fa-chevron-circle-left"></i>
            Sebelumnya
        </a>
        @include('user.form.batal')
        <button type="submit" class="btn bg-blue float-right">
            Selanjutnya
            <i class="fa fa-chevron-circle-right"></i>
        </button>
    </form>
</div>
