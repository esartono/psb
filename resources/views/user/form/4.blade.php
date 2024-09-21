<div class="text-center">
    <h5 class="mb-5">Asal Calon Siswa</h5>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=4>
        <div class="row justify-content-around">
            <div class="col-lg-3 col-md-4">
                <button type="submit" name="ck_id" value="1" class="col-12 inbox-left-sd btn border-success">
                    <div class="breadcomb-wp" style="padding: 0 !important; display: block !important">
                        <div class="breadcomb-ctn" style="margin: 0px !important">
                            {{-- <h5 class="mt-2">Umum</h5> --}}
                            <h5 class="mt-2">Umum <br>
                                <span style="font-size: smaller">Non Pegawai SIT Nurul Fikri</span>
                            </h5>
                        </div>
                    </div>
                </button>
            </div>
            {{-- @if($cekunit <> 1)
            <div class="col-lg-3 col-md-4">
                <button type="submit" name="ck_id" value="2" class="col-12 inbox-left-sd btn border-info">
                    <div class="breadcomb-wp" style="padding: 0 !important; display: block !important">
                        <div class="breadcomb-ctn" style="margin: 0px !important">
                            <h5 class="mt-2">Siswa SIT Nurul Fikri</h5>
                        </div>
                    </div>
                </button>
            </div>
            @endif --}}
            <div class="col-lg-3 col-md-4">
                <button type="submit" name="ck_id" value="3" class="col-12 inbox-left-sd btn border-warning">
                    <div class="breadcomb-wp" style="padding: 0 !important; display: block !important">
                        <div class="breadcomb-ctn" style="margin: 0px !important">
                            <h5 class="mt-2">Pegawai SIT Nurul Fikri</h5>
                        </div>
                    </div>
                </button>
            </div>
        </div>
        <br>
        <br>
        {{-- <span class="alert alert-danger"> Buat alur baru dan ditambahkan kategori ortu, asal calon siswa dari NF Bogor</span> --}}
    </form>
</div>
@include('user.form.batal')