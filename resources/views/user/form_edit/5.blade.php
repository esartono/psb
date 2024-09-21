<form role="form" method="POST" action="{{ route('edit.calon') }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="step" value=5>
    <input type="hidden" name="id" value={{ $calon->id }}>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list">
                <div class="basic-tb-hd mb-4">
                    <h2>Data Alamat Calon Siswa</h2>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-6 col-form-label mb-3 required">Alamat Tempat Tinggal</label>
                    <div class="col-lg-9 col-md-6 mb-3">
                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat Tempat Tinggal"
                        value="{{ is_null($calon->alamat) ? '' : ($calon->alamat === '-' ? '' : $calon->alamat) }}" required>
                        <has-error :form="form" field="alamat"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-6 col-form-label mb-3 required">Provinsi</label>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <select onchange="listKota(this.value)" name="provinsi" class="form-control" id="provinsi" required>
                            <option selected='true' disabled='disabled' value="">Pilih Provinsi</option>
                            @foreach ($provinsi as $prov)
                                <option value="{{ $prov->id }}" {{ $calon->provinsi == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                            @endforeach
                        </select>
                        <has-error :form="form" field="provinsi"></has-error>
                    </div>
                    <label class="col-lg-2 col-md-6 col-form-label required">Kabupaten</label>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <select onchange="listCamat(this.value)" name="kota" class="form-control" id="kota" required>
                            {{-- <option selected='true' disabled='disabled' value="">Pilih Kota/Kabupaten</option>
                            @foreach ($kota as $k)
                                <option value="{{ $k->id }}" {{ $calon->kota == $k->id ? 'selected="true"' : '' }}>{{ $k->name }}</option>
                            @endforeach --}}
                        </select>
                        <has-error :form="form" field="kota"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-6 col-form-label mb-3 required">Kecamatan</label>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <select onchange="listLurah(this.value)" name="kecamatan" class="form-control" id="kecamatan" required></select>
                        <has-error :form="form" field="kecamatan"></has-error>
                    </div>
                    <label class="col-lg-2 col-md-6 col-form-label required">Kelurahan</label>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <select name="kelurahan" class="form-control" id="kelurahan" required></select>
                        <has-error :form="form" field="kelurahan"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-6 col-form-label mb-3 required">RT.</label>
                    <div class="col-lg-2 col-md-3 mb-3">
                        <input type="text" name="rt" class="form-control" id="rt"
                        value="{{ is_null($calon->rt) ? '' : ($calon->rt === '-' ? '' : $calon->rt) }}" required
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        <has-error :form="form" field="rt"></has-error>
                    </div>
                    <div class="col-lg-2 col-md-3 mb-3"></div>
                    <label class="col-lg-2 col-md-6 col-form-label mb-3 required">RW.</label>
                    <div class="col-lg-2 col-md-3 mb-3">
                        <input type="text" name="rw" class="form-control" id="rw"
                        value="{{ is_null($calon->rw) ? '' : ($calon->rw === '-' ? '' : $calon->rw) }}" required
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        <has-error :form="form" field="rw"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-md-6 col-form-label mb-3">Kodepos</label>
                    <div class="col-lg-2 col-md-3 mb-3">
                        <input type="text" name="kodepos" class="form-control" id="kodepos"
                        value="{{ is_null($calon->kodepos) ? '' : $calon->kodepos }}"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="5" minlength="5">
                        <has-error :form="form" field="kodepos"></has-error>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <a href="/editcalon/{{ $calon->id }}/4" class="btn btn-warning float-start white">
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
