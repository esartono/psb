<div class="text-center">
    <h4 class="mb-3">Asal Calon Siswa</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=3>
        <button type="submit" name="ck_id" value="1" class="btn btn-app btn-lg white bg-blue">
            <i class="fas fa-users"></i>
            Umum
        </button>
        <a class="btn btn-app btn-lg white bg-orange" onclick="ceknis()">
            <i class="fas fa-address-card"></i>
            Siswa SIT Nurul Fikri
        </a>
        <a class="btn btn-app btn-lg white bg-teal">
            <img src="/img/logo.png" alt="Logo" width="60%" height="70%">
            Pegawai <br>SIT Nurul Fikri
        </a>
    </form>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
    }).then((result) => {
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
</script>
