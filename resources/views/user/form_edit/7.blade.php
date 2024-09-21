<form role="form" method="POST" action="{{ route('edit.calon') }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="step" value=7>
    <input type="hidden" name="id" value={{ $calon->id }}>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list">
                <div class="basic-tb-hd mb-4">
                    <h2>Data Asal Sekolah</h2>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-3 col-form-label required">Nama Asal Sekolah</label>
                    <div class="col-lg-9 col-md-9 mb-3">
                        <input type="text" name="asal_sekolah" class="form-control" id="asal_sekolah" placeholder="Nama Sekolah"
                        value="{{ is_null($calon->asal_sekolah) ? '' : $calon->asal_sekolah }}" required>
                        <has-error :form="form" field="asal_sekolah"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-3 col-form-label required">Alamat Asal Sekolah</label>
                    <div class="col-lg-9 col-md-9 mb-3">
                        <input type="text" name="asal_alamat_sekolah" class="form-control" id="asal_alamat_sekolah" placeholder="Alamat Asal Sekolah"
                        value="{{ is_null($calon->asal_alamat_sekolah) ? '' : $calon->asal_alamat_sekolah }}" required>
                        <has-error :form="form" field="asal_alamat_sekolah"></has-error>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-lg-3 col-md-6 col-form-label required">Provinsi</label>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <select onchange="listKota(this.value)" name="provinsi" class="form-control" id="provinsi" required {{ $edited }}>
                            <option selected='true' disabled='disabled' value="">Pilih Provinsi</option>
                            @foreach ($provinsi as $prov)
                                <option value="{{ $prov->id }}" {{ $calon->asal_propinsi_sekolah == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                            @endforeach
                        </select>
                        <has-error :form="form" field="provinsi"></has-error>
                    </div>
                    <label class="col-lg-3 col-md-6 col-form-label required">Kota/Kabupaten</label>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <select onchange="listCamat(this.value)" name="kota" class="form-control" id="kota" required {{ $edited }}>
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
                    <label class="col-lg-3 col-md-6 col-form-label required">Kecamatan</label>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <select onchange="listLurah(this.value)" name="kecamatan" class="form-control" id="kecamatan" required {{ $edited }}>
                            <option selected='true' disabled='disabled' value="">Pilih Kecamatan</option>
                            @if($kecamatan != '')
                                @foreach ($kecamatan as $prov)
                                    <option value="{{ $prov->id }}" {{ $calon->asal_kecamatan_sekolah == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <has-error :form="form" field="kecamatan"></has-error>
                    </div>
                    <label class="col-lg-3 col-md-6 col-form-label required">Kelurahan</label>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <select name="kelurahan" class="form-control" id="kelurahan" required {{ $edited }}>
                            <option selected='true' disabled='disabled' value="">Pilih Kelurahan</option>
                            @if($kelurahan != '')
                                @foreach ($kelurahan as $prov)
                                    <option value="{{ $prov->id }}" {{ $calon->asal_kelurahan_sekolah == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <has-error :form="form" field="kelurahan"></has-error>
                    </div>
                </div> --}}
                <hr>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <a href="/editcalon/{{ $calon->id }}/6" class="btn btn-warning float-start white">
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

@push('jawa')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    var url = window.location.origin;
    var kotaasal = "{{ $calon->kota }}"
    var camatasal = "{{ $calon->kecamatan }}"
    var lurahasal = "{{ $calon->kelurahan }}"

    $(function() {
        var provinceID = $("#provinsi").find(":selected").val();
        if(provinceID){
            if(kotaasal){
                listKota(provinceID, kotaasal)
                if(camatasal){
                    listCamat(kotaasal, camatasal)
                    if(lurahasal){
                        listLurah(camatasal, lurahasal)
                    } else {
                        listLurah(camatasal)
                    }
                } else {
                    listCamat(kotaasal)
                }
            } else {
                listKota(provinceID)
            }
        }
    });

    function listKota(e, a) {
        if(e){
            axios
            .get( url + "/api/kotas/" + e)
            .then((data) => {
                if(data){
                    $("#kota").empty();
                    $("#kecamatan").empty();
                    $("#kelurahan").empty();
                    if(a){
                        $("#kota").append('<option disabled="disabled" value="">Pilih Kota/Kabupaten</option>');    
                    } else {
                        $("#kota").append('<option selected="true" disabled="disabled" value="">Pilih Kota/Kabupaten</option>');
                    }
                    $.each(data.data,function(key,value){
                        if(a == key){
                            $("#kota").append('<option selected="true" value="'+key+'">'+value+'</option>');
                        } else{
                            $("#kota").append('<option value="'+key+'">'+value+'</option>');
                        }
                    });
                } else {
                    $("#kota").empty();
                    $("#kecamatan").empty();
                    $("#kelurahan").empty();
                }
            });
        }
    };

    function listCamat (e, a) {
        var url = window.location.origin;
        if(e){
            axios
            .get( url + "/api/camats/" + e)
            .then((data) => {
                if(data){
                    $("#kecamatan").empty();
                    $("#kelurahan").empty();
                    if(a) {
                        $("#kecamatan").append('<option disabled="disabled" value="">Pilih Kecamatan</option>');
                    } else {
                        $("#kecamatan").append('<option selected="true" disabled="disabled" value="">Pilih Kecamatan</option>');
                    }
                    $.each(data.data,function(key,value){
                        if(a == key) {
                            $("#kecamatan").append('<option selected="true" value="'+key+'">'+value+'</option>');
                        } else {
                            $("#kecamatan").append('<option value="'+key+'">'+value+'</option>');
                        }
                        
                    });
                } else {
                    $("#kecamatan").empty();
                    $("#kelurahan").empty();
                }
            });
        }
    };
  
    function listLurah (e, a) {
        var url = window.location.origin;
        if(e){
            axios
            .get( url + "/api/lurahs/" + e)
            .then((data) => {
                if(data){
                    $("#kelurahan").empty();
                    if(a) {
                        $("#kelurahan").append('<option disabled="disabled" value="">Pilih Kelurahan</option>');
                    } else {
                        $("#kelurahan").append('<option selected="true" disabled="disabled" value="">Pilih Kelurahan</option>');
                    }
                    $.each(data.data,function(key,value){
                        if(a == key) {
                            $("#kelurahan").append('<option selected="true" value="'+key+'">'+value+'</option>');
                        } else {
                            $("#kelurahan").append('<option value="'+key+'">'+value+'</option>');
                        }
                    });
                } else {
                    $("#kelurahan").empty();
                }
            });
        }
    };

</script>
    
@endpush
