<div class="container text-center mt-5">
    <h5 class="mb-5">Siswa Baru atau Pindahan</h5>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value="1">
        <div class="row justify-content-around">
            <div class="col-lg-4 col-md-6">
                <button type="submit" name="pindahan" value="tidak" class="col-12 inbox-left-sd btn border-success" style="border-style: solid; border-width: 1px; text-align: left !important">
                    <div class="breadcomb-wp" style="padding: 0 !important">
                        <div class="breadcomb-icon">
                            <i class="fa-solid fa-user color-success border-success"></i>
                        </div>
                        <div class="breadcomb-ctn">
                            <h4>Siswa Baru</h4>
                            <p>siswa baru untuk tahun ajaran {{ taAktif() }}</p>
                        </div>
                    </div>
                </button>
            </div>
            <div class="col-lg-4 col-md-6">
                <button type="submit" name="pindahan" value="ya" class="col-12 inbox-left-sd btn border-success" style="border-style: solid; border-width: 1px; text-align: left !important">
                    <div class="breadcomb-wp" style="padding: 0 !important">
                        <div class="breadcomb-icon">
                            <i class="fa-solid fa-user color-success border-success"></i>
                        </div>
                        <div class="breadcomb-ctn">
                            <h4>Siswa Pindahan</h4>
                            <p>siswa pindahan untuk tahun ajaran {{ taAktif() }}</p>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </form>
</div>
