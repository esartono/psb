<div class="text-center">
    <h4 class="mb-3">Pilih Unit</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=2>
        <button type="submit" name="unit" value="ya" class="btn btn-app btn-lg white TK">
            <i class="fas fa-address-card"></i>
            TKIT Nurul Fikri
        </button>
    </form>
</div>

<div role="tabpanel" id="OrangTua5" aria-hidden="true" aria-labelledby="step-OrangTua5" class="wizard-tab-container text-center" style="display: none;">
    <h5>Data Calon Siswa</h5>
    <a class="btn btn-app btn-lg white bg-blue"><i class="fas fa-users"></i> Umum</a>
    <a class="btn btn-app btn-lg white bg-orange"><i class="fas fa-address-card"></i> Siswa SIT NF</a>
    <a class="btn btn-app btn-lg white bg-teal"><img src="/img/logo.png" alt="Logo" class="mb-1" width="60%" height="70%"> Pegawai SIT NF</a>
</div>
