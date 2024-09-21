<div class="text-center">
    <h4 class="mb-3">Siswa Baru atau Pindahan</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=1>
        <button type="submit" name="pindahan" value="tidak" class="btn btn-app btn-lg white bg-green">
            <i class="fas fa-building"></i>
            SISWA BARU
        </button>
        <button type="submit" name="pindahan" value="ya" class="btn btn-app btn-lg white bg-blue">
            <i class="fas fa-address-card"></i>
            SISWA PINDAHAN
        </button>
    </form>
</div>
