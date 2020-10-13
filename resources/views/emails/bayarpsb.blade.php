@extends('emails.template')

@section('isi')
        <p>
        <b><i>Assalamu'alaikum wa Rahmatullah wa Barakatuh</i></b><br><br>
        Terimakasih Bapak/Ibu telah melakukan pembayaran biaya daftar ulang calon siswa baru SIT Nurul Fikri. Untuk calon siswa sebagai berikut:
        </p>
        <table class="biodata">
            <tr>
                <th width="30%">No. Pendaftaran</th>
                <td>{{ $calon->uruts }}</td>
            </tr>
            <tr>
                <th width="30%">Nama Lengkap</th>
                <td>{{ $calon->name }}</td>
            </tr>
            <tr>
                <th>Unit/Kelas Tujuan</th>
                <td>{{ $calon->gelnya->unitnya->name }} / Kelas {{ $calon->kelasnya->name }}</td>
            </tr>
            <tr>
                <th>Total Tagihan - {{ $tagihan->tagihan['ket'] }}</th>
                <td>{{ number_format($tagihan->tagihan['total']) }}</td>
            </tr>
            <tr>
                <th>Pembayaran</th>
                <td>
                    <table class="details">
                        <tr>
                            <th>Tanggal Bayar</th>
                            <th>Jumlah Pembayaran</th>
                        </tr>
                    @forelse ($bayar as $b)
                        <tr>
                            <td align="center">{{ date('d/m/Y', strtotime( $b->tgl_bayar)) }}</td>
                            <td align="right">{{ number_format($b->bayar) }}</td>
                        </tr>
                    @empty
                        <p>-- KOSONG --</p>
                    @endforelse
                    </table>
                </td>
            </tr>
            <tr>
                <th>Sisa Tagihan</th>
                <td>{{ number_format($tagihan->tagihan['sisa']) }}</td>
            </tr>
        </table>
        <p>Demikian, mohon menjadi perhatian. Terima kasih.<br>
        Wassalamu'alaikum wa Rahmatullah Wa Barakatuh</p>
@endsection
