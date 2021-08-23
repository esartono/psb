function listKota(e) {
    var provinceID = e.value;
    if(provinceID){
        axios
        .get("../api/kotas/" + e.value)
        .then((data) => {
            if(data){
                $("#kota").empty();
                $("#kota").append('<option selected="true" disabled="disabled">Pilih Kota/Kabupaten</option>');
                $.each(data.data,function(key,value){
                    $("#kota").append('<option value="'+key+'">'+value+'</option>');
                });
            } else {
                $("#kota").empty();
            }
        });
    }
};

function listCamat(e) {
    var kota = e.value;
    if(kota){
        axios
        .get("../api/camats/" + e.value)
        .then((data) => {
            if(data){
                $("#kecamatan").empty();
                $("#kecamatan").append('<option selected="true" disabled="disabled">Pilih Kecamatan</option>');
                $.each(data.data,function(key,value){
                    $("#kecamatan").append('<option value="'+key+'">'+value+'</option>');
                });
            } else {
                $("#kecamatan").empty();
            }
        });
    }
};

function listLurah(e) {
    var kota = e.value;
    if(kota){
        axios
        .get("../api/lurahs/" + e.value)
        .then((data) => {
            if(data){
                $("#kelurahan").empty();
                $("#kelurahan").append('<option selected="true" disabled="disabled">Pilih Kelurahan</option>');
                $.each(data.data,function(key,value){
                    $("#kelurahan").append('<option value="'+key+'">'+value+'</option>');
                });
            } else {
                $("#kelurahan").empty();
            }
        });
    }
};
