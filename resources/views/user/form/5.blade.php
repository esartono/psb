<div class="text-center">
    <h4 class="mb-3">Data Alamat Calon Siswa</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=5>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Alamat Tempat Tinggal</label>
            <div class="col-md-9">
                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat Tempat Tinggal"
                value="{{ is_null($calon->alamat) ? '' : $calon->alamat }}" required>
                <has-error :form="form" field="alamat"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Provinsi</label>
            <div class="col-md-3">
                <select onchange="listKota(this)" name="provinsi" class="form-control" id="provinsi" required>
                    <option selected='true' disabled='disabled' value="">Pilih Provinsi</option>
                    @foreach ($provinsi as $prov)
                        <option value="{{ $prov->id }}" {{ $calon->provinsi == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                    @endforeach
                </select>
                <has-error :form="form" field="provinsi"></has-error>
            </div>
            <label class="col-md-2 offset-md-1 col-form-label">Kabupaten</label>
            <div class="col-md-3">
                <select onchange="listCamat(this)" name="kota" class="form-control" id="kota" required>
                    <option selected='true' disabled='disabled' value="">Pilih Kota/Kabupaten</option>
                    @if($kota != '')
                        @foreach ($kota as $prov)
                            <option value="{{ $prov->id }}" {{ $calon->kota == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                        @endforeach
                    @endif
                </select>
                <has-error :form="form" field="kota"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Kecamatan</label>
            <div class="col-md-3">
                <select onchange="listLurah(this)" name="kecamatan" class="form-control" id="kecamatan" required>
                    <option selected='true' disabled='disabled'>Pilih Kecamatan</option>
                    @if($kecamatan != '')
                        @foreach ($kecamatan as $prov)
                            <option value="{{ $prov->id }}" {{ $calon->kecamatan == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                        @endforeach
                    @endif
                </select>
                <has-error :form="form" field="kecamatan"></has-error>
            </div>
            <label class="col-md-2 offset-md-1 col-form-label">Kelurahan</label>
            <div class="col-md-3">
                <select name="kelurahan" class="form-control" id="kelurahan" required>
                    <option selected='true' disabled='disabled'>Pilih Kelurahan</option>
                    @if($kelurahan != '')
                        @foreach ($kelurahan as $prov)
                            <option value="{{ $prov->id }}" {{ $calon->kelurahan == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                        @endforeach
                    @endif
                </select>
                <has-error :form="form" field="kelurahan"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">RT</label>
            <div class="col-md-2">
                <input type="text" name="rt" class="form-control" id="rt"
                value="{{ is_null($calon->rt) ? '' : $calon->rt }}" required
                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                <has-error :form="form" field="rt"></has-error>
            </div>
            <label class="offset-md-3 col-md-1 col-form-label">RW</label>
            <div class="col-md-2">
                <input type="text" name="rw" class="form-control" id="rw"
                value="{{ is_null($calon->rw) ? '' : $calon->rw }}" required
                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                <has-error :form="form" field="rw"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Kodepos</label>
            <div class="col-md-3">
                <input type="text" name="kodepos" class="form-control" id="kodepos"
                value="{{ is_null($calon->kodepos) ? '' : $calon->kodepos }}"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="5" minlength="5">
                <has-error :form="form" field="kodepos"></has-error>
            </div>
        </div>
        <hr>
        <a href="/tambahcalon/4" class="btn bg-TK float-left white">
            <i class="fa fa-chevron-circle-left"></i>
            Sebelumnya
        </a>
        <button type="submit" class="btn bg-blue float-right">
            Selanjutnya
            <i class="fa fa-chevron-circle-right"></i>
        </button>
    </form>
</div>

<script type="application/javascript" src="/js/daerah.js"></script>
