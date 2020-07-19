@extends('layouts.app')
<style>

table.table-invoice {
    width: 100%;
}
table.table-invoice th, table.table-invoice td {
    padding: 5px;
    font-size: 13px;
    border: 1px solid #dee2e6;
}
</style>

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-3">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h5>
                                <b>Detail Data Tagihan Siswa Baru SIT Nurul Fikri Cimanggis Depok {{ auth()->user()->tpname }}</b>
                                <small class="float-right">Tanggal: {{ date('d/m/Y')}}</small>
                            </h5>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row mt-3">
                        <div class="card col-5">
                            <div class="card-body" style="padding: 10px 0px 5px 0px">
                                <p class="card-title">Biodata Calon Siswa</p>
                                <table class="table table-striped">
                                    <tr>
                                        <td width="30%">Nama Lengkap</td>
                                        <td width="1%">:</td>
                                        <td>{{ $calon->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Asal Sekolah</td>
                                        <td>:</td>
                                        <td>{{ $calon->asal_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Pendaftaran</td>
                                        <td>:</td>
                                        <td>{{ $calon->uruts }}</td>
                                    </tr>
                                    <tr>
                                        <td>Unit</td>
                                        <td>:</td>
                                        <td>{{ $calon->gelnya->unitnya->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td>:</td>
                                        <td>{{ $calon->kelasnya->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Ponsel</td>
                                        <td>:</td>
                                        <td>Ayah : {{ $calon->ayah_hp }}<br>Ibu : {{ $calon->ibu_hp }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card col-7">
                            <form action="{{ route('calontagihans.store') }}" method="POST" class="keuangan">
                            @csrf
                            <div class="card-body" style="padding: 10px 0px 5px 0px">
                                <h5 class="card-title">Detail Tagihan Calon Siswa</h5>
                                <table class="table-invoice">
                                    <tr>
                                        <th style="width: 5%; vertical-align: middle">No</th>
                                        <th style="width: 40%; vertical-align: middle">Jenis Pembayaran</th>
                                        <th style="width: 55%; vertical-align: middle">Jumlah Pembayaran</th>
                                    </tr>
                                    @foreach ($tagihans as $tagihan)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $tagihan->keterangan }}</td>
                                            <td class="text-right">Rp. {{ number_format($tagihan->biaya) }},-</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>Biaya Seragam</td>
                                        <td class="text-right">Rp. {{ number_format($tagihanseragam->biaya) }},-</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">SUBTOTAL</th>
                                        <td class="text-right"><b>Rp. {{ number_format($totaltagihan) }},-</b></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Pilih Potongan</th>
                                        <td class="text-right">
                                            <select >
                                                <option value="1">Saudara Kandung di NF</option>
                                                <option value="2">Prestasi Sekolah di SIT NF atau NFBS Bogor</option>
                                                <option value="3">Asal SIT NF atau NFBS Bogor</option>
                                                <option value="4">Prestasi tingkat Nasional</option>
                                                <option value="5">Hafalan min 15 Juz</option>
                                                <option value="6">Tidak Perlu</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Infaq</th>
                                        <td class="text-right">
                                            <input type="number" class="form-control keu">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">TOTAL</th>
                                        <td class="text-right"><p id='TOTAL'></p></td>
                                    </tr>
                                    <!-- <tr>
                                        <th colspan="2">Jumlah Terbilang</th>
                                        <td class="text-right" style="font-weight:bold; font-size: 12px">
                                            <i>Tiga Puluh Delapan Juta Lima Ratus Enam Puluh Ribu Rupiah</i>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <input type="hidden" name="calon_id" value={{ $calon->id }}>
                                        <input type="hidden" name="tagihanseragam_id" value={{ $tagihanseragam->id }}>
                                        <td colspan="3" class="text-right"><button type="submit" class="btn btn-primary">Simpan</button></td>
                                    </tr>
                                </table>
                            </div>
                            </form>
                        </div>
                        <!-- @include('wawancara.ketentuan') -->
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<script>
    $('.keuangan').on('input', 'keu', function(){
        var totalSum = 0;
        $('keu').each(function(){
            var inputVal = $(this).val();
            if($.isNumeric(inputVal)){
                totalSum = parseFloat(inputVal);
            }
        });
        alert(totalSum);
    })
</script>
@endsection
