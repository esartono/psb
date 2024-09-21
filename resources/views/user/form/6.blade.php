
<div class="text-center">
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value="6">
        <div class="row justify-content-around">
            <div class="col-lg-3 col-md-4 mb-3">
                <button type="submit" name="umum" value="1" class="col-12 inbox-left-sd btn border-success bg-success text-white">
                    <div class="breadcomb-wp" style="padding: 0 !important; display: block !important">
                        <div class="breadcomb-ctn" style="margin: 0px !important">
                            {{-- <h5 class="mt-2">Umum</h5> --}}
                            <h5 class="mt-2 text-white">Umum <br>
                                <hr>
                            </h5>
                            <span style="font-size: smaller">Silahkan klik disini jika Calon Siswa berasal dari Non Siswa SIT Nurul Fikri, <br> Jika berasal dari SIT Nurul Fikri silahkan scroll ke bawah dan masukan nomor induk Siswa</span>
                        </div>
                    </div>
                </button>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12 bg-info">
                <div class="form-example-wrap bg-info text-white">
                    <div class="cmp-tb-hd mb-4">
                        <h5 class="text-white">Masukan <br>Nomor Induk Siswa</h5>
                        <span style="font-size: smaller">Khusus Siswa SIT Nurul Fikri Depok dan Bogor</span>
                    </div>
                    <div class="form-group mb-4">
                        <div class="nk-int-st">
                            <input type="text" class="form-control input-sm" name="nis" placeholder="Nomor Induk Siswa">
                        </div>
                    </div>
                    @include('user.partials.alert')
                    <div class="form-example-int mg-t-15 mt-4">
                        <button class="btn btn-success notika-btn-success waves-effect">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@include('user.form.batal')