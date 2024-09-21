<form role="form" method="POST" action="{{ route('add.calon') }}">
    <div>
        @csrf
        <input type="hidden" name="step" value=11>
        {{-- <h3>LEMBAR PERSETUJUAN</h3> --}}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th colspan="2"><h5>Pernyataan Persetujuan</h5></th>
                    {{-- <th></th> --}}
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                <tr>
                    <td colspan="3" style="text-align: left">
                        <p style="text-align: left">Dengan ini saya menyatakan :</p>
                    </td>
                </tr>
                @foreach ($agreement as $a)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td style="text-align:left">{{ $a->agreement }}</td>
                        <td class="text-center" style="width: 10%">
                            <div class="icheck-success">
                                <input type="checkbox" id="cek{{ $no }}" name="ok1" onchange="ceksetujusemua({{ $no }})">
                                <label id="tidak{{ $no }}"> </label>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <hr> --}}
    {{-- <a href="/tambahcalon/7" class="btn bg-TK float-left white mr-2"> --}}
    <button id="finish" type="submit" class="btn btn-success float-right" disabled>
        Simpan
        <i class="fa fa-chevron-circle-right"></i>
    </button>
</form>
<a href="/tambahcalon/4" class="btn bg-TK float-left white mr-2">    
    <i class="fa fa-chevron-circle-left"></i>
    Sebelumnya
</a>
@include('user.form.batal')

<script type="application/javascript">
function ceksetujusemua(no) {
    const ok = document.getElementsByName('ok1').length
    const ch = document.querySelectorAll('input[type="checkbox"]:checked').length
    const cek = document.getElementById('cek'+no)
    if(cek.checked) {
        $('#tidak'+no).text(' Ya ')
    } else {
        $('#tidak'+no).text('Tidak')
    }
    if(ok == ch) {
        document.getElementById("finish").disabled = false;
    } else {
        document.getElementById("finish").disabled = true;
    }
}
</script>
