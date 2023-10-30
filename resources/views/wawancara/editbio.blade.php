@extends('layouts.keu')
<style type="text/css">

table.table-invoice {
    width: 100%;
}
table.table-invoice th, table.table-invoice td {
    padding: 5px;
    font-size: 13px;
    border: 1px solid #dee2e6;
}
</style>

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card offset-md-2 col-md-8 mt-3">
                <div class="card-body" style="padding: 10px 0px 5px 0px">
                    <div class="text-center">
                        <h4 class="mb-4">Data Biodata Calon Siswa</h4>
                    </div>
                    <form role="form" method="POST" action="{{ route('updatebio') }}">
                        @csrf
                        <input type="hidden" name="id" value={{ $calon->id }}>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nama Lengkap</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ $calon->name }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Alamat</label>
                            <div class="col-md-9">
                                <input type="text" name="alamat" class="form-control" id="alamat"
                                    value="{{ $calon->alamat }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">RT</label>
                            <div class="col-md-3">
                                <input type="text" name="rt" class="form-control" id="alamat"
                                    value="{{ $calon->rt }}" required>
                            </div>
                            <label class="col-md-3 col-form-label">RW</label>
                            <div class="col-md-3">
                                <input type="text" name="rw" class="form-control" id="alamat"
                                    value="{{ $calon->rw }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Provinsi</label>
                            <div class="col-md-3">
                                <select onchange="listKota(this.value)" name="provinsi" class="form-control" id="provinsi" required>
                                    <option selected='true' disabled='disabled' value="">Pilih Provinsi</option>
                                    @foreach ($provinsi as $prov)
                                        <option value="{{ $prov->id }}" {{ $calon->provinsi == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-md-2 offset-md-1 col-form-label">Kabupaten</label>
                            <div class="col-md-3">
                                <select onchange="listCamat(this.value)" name="kota" class="form-control" id="kota" required>
                                    <option selected='true' disabled='disabled' value="">Pilih Kota/Kabupaten</option>
                                    @if($kota != '')
                                        @foreach ($kota as $prov)
                                            <option value="{{ $prov->id }}" {{ $calon->kota == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Kecamatan</label>
                            <div class="col-md-3">
                                <select onchange="listLurah(this.value)" name="kecamatan" class="form-control" id="kecamatan" required>
                                    <option selected='true' disabled='disabled'>Pilih Kecamatan</option>
                                    @if($kecamatan != '')
                                        @foreach ($kecamatan as $prov)
                                            <option value="{{ $prov->id }}" {{ $calon->kecamatan == $prov->id ? 'selected="true"' : '' }}>{{ $prov->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
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
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nama Ayah</label>
                            <div class="col-md-3">
                                <input type="text" name="ayah_nama" class="form-control" id="ayah_nama"
                                    value="{{ $calon->ayah_nama }}" required>
                            </div>
                            <label class="col-md-2 offset-md-1 col-form-label">Handphone Ayah</label>
                            <div class="col-md-3">
                                <input type="text" name="ayah_hp" class="form-control" id="ayah_hp"
                                    value="{{ $calon->ayah_hp }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nama Ibu</label>
                            <div class="col-md-3">
                                <input type="text" name="ibu_nama" class="form-control" id="ibu_nama"
                                    value="{{ $calon->ibu_nama }}" required>
                            </div>
                            <label class="col-md-2 offset-md-1 col-form-label">Handphone Ibu</label>
                            <div class="col-md-3">
                                <input type="text" name="ibu_hp" class="form-control" id="ibu_hp"
                                    value="{{ $calon->ibu_hp }}" required>
                            </div>
                        </div>
                        <hr>
                        <center>
                            <a href="/keuangan/{{ $calon->id }}" class="btn btn-danger col-md-2">
                                <i class="fa fa-times"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn bg-blue col-md-2">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                        </center>
                    </form>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@push('js')
<script>
    var url = window.location.origin;
    var kotaasal = "{{ $calon->kota }}"
    var camatasal = "{{ $calon->kecamatan }}"
    var lurahasal = "{{ $calon->kelurahan }}"

    $(document).ready(function() {
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

    var listKota = function(e, a) {
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

    var listCamat = function(e, a) {
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
  
    var listLurah = function(e, a) {
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