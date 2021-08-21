<div class="text-center">
    <h4 class="mb-3">Asal Calon Siswa</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=3>
        <button type="submit" name="ck_id" value="1" class="btn btn-app btn-lg white bg-blue">
            <i class="fas fa-users"></i>
            Umum
        </button>
        <button class="btn btn-app btn-lg white bg-orange">
            <i class="fas fa-address-card"></i>
            Siswa SIT Nurul Fikri
        </button>
        <button type="submit" name="ck_id" value="3" class="btn btn-app btn-lg white bg-teal">
            <img src="/img/logo.png" alt="Logo" width="60%" height="70%">
            Pegawai <br>SIT Nurul Fikri
        </button>
    </form>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    (async () => {
        const { value: ipAddress } = await Swal.fire({
            title: 'Enter your IP address',
            input: 'text',
            inputLabel: 'Your IP address',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to write something!'
                }
            }
        })

        if (ipAddress) {
            Swal.fire(`Your IP address is ${ipAddress}`)
        }
    })()
</script>
