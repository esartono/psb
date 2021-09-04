<div class="text-center">
    <h4 class="mb-3">Data Asal Sekolah</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=7>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Nama Sekolah</label>
            <div class="col-md-9">
                <input type="text" name="asal_sekolah" class="form-control" id="asal_sekolah" placeholder="Nama Sekolah"
                value="{{ is_null($calon->asal_sekolah) ? '' : $calon->asal_sekolah }}" required>
                <has-error :form="form" field="asal_sekolah"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Alamat Asal Sekolah</label>
            <div class="col-md-9">
                <input type="text" name="asal_alamat_sekolah" class="form-control" id="asal_alamat_sekolah" placeholder="Alamat Asal Sekolah"
                value="{{ is_null($calon->asal_alamat_sekolah) ? '' : $calon->asal_alamat_sekolah }}" required>
                <has-error :form="form" field="asal_alamat_sekolah"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Provinsi</label>
            <div class="col-md-3">
                <select onchange="listKota(this)" name="provinsi" class="form-control" id="provinsi" required>
                    <option selected='true' disabled='disabled' value="">Pilih Provinsi</option>
                    @foreach ($provinsi as $prov)
                        <option value="{{ $prov->id }}" {{ $calon->asal_propinsi_sekolah == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
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
                            <option value="{{ $prov->id }}" {{ $calon->asal_kota_sekolah == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
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
                    <option selected='true' disabled='disabled' value="">Pilih Kecamatan</option>
                    @if($kecamatan != '')
                        @foreach ($kecamatan as $prov)
                            <option value="{{ $prov->id }}" {{ $calon->asal_kecamatan_sekolah == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                        @endforeach
                    @endif
                </select>
                <has-error :form="form" field="kecamatan"></has-error>
            </div>
            <label class="col-md-2 offset-md-1 col-form-label">Kelurahan</label>
            <div class="col-md-3">
                <select name="kelurahan" class="form-control" id="kelurahan" required>
                    <option selected='true' disabled='disabled' value="">Pilih Kelurahan</option>
                    @if($kelurahan != '')
                        @foreach ($kelurahan as $prov)
                            <option value="{{ $prov->id }}" {{ $calon->asal_kelurahan_sekolah == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                        @endforeach
                    @endif
                </select>
                <has-error :form="form" field="kelurahan"></has-error>
            </div>
        </div>
        <hr>
        <a href="/tambahcalon/6" class="btn bg-TK float-left white">
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
