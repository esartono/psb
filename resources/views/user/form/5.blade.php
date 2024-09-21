
<div class="text-center">
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value="5">
        <div class="row justify-content-around">
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="form-example-wrap">
                    <div class="cmp-tb-hd mb-4">
                        <h5>Masukan <br>Nomor Induk Pegawai</h5>
                        {{-- <p>Individual form controls automatically receive some global styling. All textual 'input', 'textarea', and 'select' elements with <code>.form-control</code> are set to width: 100%; by default. Wrap labels and controls in <code>.form-group</code> for optimum
                            spacing.</p> --}}
                    </div>
                    <div class="form-group mb-4">
                        <div class="nk-int-st">
                            <input type="text" class="form-control input-sm" name="nip" placeholder="NIP (7 Angka)" required>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="nk-int-st">
                            <input type="password" class="form-control input-sm" name="sdmsmart" placeholder="Password SDMSmart" required>
                        </div>
                    </div>
                    @include('user.partials.alert')
                    <div class="form-example-int mg-t-15 mt-4">
                        <button class="btn btn-success notika-btn-success waves-effect">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @include('user.form.batal')
    </form>
</div>
