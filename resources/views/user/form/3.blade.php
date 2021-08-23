<div class="text-center">
    <h4 class="mb-3">Asal Calon Siswa</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=3>
        <button type="submit" name="ck_id" value="1" class="btn btn-app btn-lg white bg-blue">
            <i class="fas fa-users"></i>
            Umum
        </button>
        <a class="btn btn-app btn-lg white bg-orange" id="ceknis">
            <i class="fas fa-address-card"></i>
            Siswa SIT Nurul Fikri
        </a>
        <a class="btn btn-app btn-lg white bg-teal" onclick="ceknip()">
            <img src="/img/logo.png" alt="Logo" width="60%" height="70%">
            Pegawai <br>SIT Nurul Fikri
        </a>
    </form>
</div>
<div class="modal fade" id="modal{{ $unit->catnya->name }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header white bg-{{ $unit->catnya->name }}">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Kelas</h5>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <form role="form" method="POST" action="{{ route('add.calon') }}">
                    @csrf
                    <input type="hidden" name="step" value=3>
                    <input type="hidden" name="step" value=3>
                    <button type="submit" name="ck_id" value="1" class="btn btn-app btn-lg white bg-blue">
                        <i class="fas fa-users"></i>
                        Umum
                    </button>
                    <a class="btn btn-app btn-lg white bg-orange" id="ceknis">
                        <i class="fas fa-address-card"></i>
                        Siswa SIT Nurul Fikri
                    </a>
                    <a class="btn btn-app btn-lg white bg-teal" onclick="ceknip()">
                        <img src="/img/logo.png" alt="Logo" width="60%" height="70%">
                        Pegawai <br>SIT Nurul Fikri
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById("ceknis").onclick = function() {ceknis()};

function ceknis() {
    Swal.fire({
        title: 'Cek Data Siswa',
        html: `<input type="text" id="nis" class="swal2-input" placeholder="NIS">`,
        confirmButtonText: 'Cek Data',
        focusConfirm: false,
        preConfirm: () => {
            const nis = Swal.getPopup().querySelector('#nis').value
            if (!nis) {
                Swal.showValidationMessage(`Masukan Nomor Induk Siswa`)
            }
            return { nis: nis}
        }
    })
    .then((result) => {
        axios
        .get("../api/siswanfs/"+result.value.nis)
        .then((data) => {
            if(data.data.cek == 1){
                window.location.replace("{{URL::to('/tambahcalon/4')}}");
            }
            if(data.data.cek == 0){
                Swal.fire({
                    type: 'error',
                    title: 'Data tidak ditemukan!',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        })
    })
}
function pegawai_asal_nf() {
    Swal.fire({
        title: 'Asal Siswa',
        html: `<button type="submit" name="ck_id" value="1" class="btn btn-app btn-lg white bg-blue">
            <i class="fas fa-users"></i>
            Umum
        </button>
        <a class="btn btn-app btn-lg white bg-orange" id="ceknis">
            <i class="fas fa-address-card"></i>
            Siswa SIT Nurul Fikri
        </a>`,
    })
}
function ceknip() {
    Swal.fire({
        title: 'Cek Data Pegawai',
        html: `<input type="text" id="nip" class="swal2-input" placeholder="NIP">`,
        confirmButtonText: 'Cek Data',
        focusConfirm: false,
        preConfirm: () => {
            const nip = Swal.getPopup().querySelector('#nip').value
            if (!nip) {
                Swal.showValidationMessage(`Masukan Nomor Induk Pegawai`)
            }
            return { nip: nip}
        }
    })
    .then((result) => {
        axios
        .get("../api/pegawais/"+result.value.nip)
        .then((data) => {
            if(data.data.cek == 1){
                pegawai_asal_nf();
                // window.location.replace("{{URL::to('/tambahcalon/4')}}");
            }
            if(data.data.cek == 0){
                Swal.fire({
                    type: 'error',
                    title: 'Data tidak ditemukan!',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        })
    })
}
</script>
