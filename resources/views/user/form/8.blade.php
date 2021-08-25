<style>
    .datepicker tr td-:last-of-type {
        width: 20px !important;
    }
</style>

<div class="text-center">
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=8>
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pernyataan Persetujuan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($agreement as $a)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td style="text-align:left">{{ $a->agreement }}</td>
                        <td class="text-center">
                            <div class="icheck-success">
                                <input type="checkbox" name="ok1" onchange="ceksetujusemua()">
                                <label>Ya</label>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <button id="finish" type="submit" class="btn bg-blue float-right" disabled>
            Simpan
            <i class="fa fa-chevron-circle-right"></i>
        </button>
    </form>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<script type="application/javascript">
function ceksetujusemua() {
    const ok = document.getElementsByName('ok1').length
    const ch = document.querySelectorAll('input[type="checkbox"]:checked').length
    if(ok == ch) {
        document.getElementById("finish").disabled = false;
    } else {
        document.getElementById("finish").disabled = true;
    }
}
</script>
