@extends('pdf.template_wawancara')

@section('isi')
    <style type="text/css">
        .biodata, .rubrik {
            width: 100%;
        }
        .biodata th, .rubrik th {
            text-align: left;
            vertical-align: text-top;
        }
        .biodata td, .rubrik td {
            vertical-align: text-top;
        }
        .rubrik {}
    </style>
<div class="main">
    <table class="biodata">
        <tr>
            <th width="120px">No. Pendaftaran</th>
            <td width="2px">:</td>
            <td width="320px">{{ $calon->uruts }}</td>
            <th width="90px">Tanggal</th>
            <td width="2px">:</td>
            <td>{{ $tanggalWawancara }}</td>
        </tr>
        <tr>
            <th>Nama Calon Siswa</th>
            <td>:</td>
            <td>{{ $calon->name }}</td>
            <th rowspan="2">Pewawancara</th>
            <td rowspan="2">:</td>
            <td rowspan="2">{{ $pewawancara }}</td>
        </tr>
        <tr>
            <th>Unit/Kelas Tujuan</th>
            <td>:</td>
            <td>{{ $calon->unit }} - Kelas {{ $calon->kelas }}</td>
        </tr>
    </table>
    <hr>
    @foreach ( $instrumen as $i)
        <h3 style="text-align: center"><u>Data Wawancara {{ $i->instrumen }}</u></h3>
        @php
            $no = 1;
        @endphp
        <ol>
            @foreach ($rubrik as $r)
                <li>
                    {{ $r->butir }}
                    <br>{{ $pg[$r->id][$jawaban[$r->id]] }}<br>
                        @if($catatan[$r->id])
                            catatan: {{ $catatan[$r->id] }}<br>
                        @endif
                </li>
                <br>
                <br>
                @php
                    $no++;
                @endphp
                @if($i->instrumen == 'Orang Tua Calon Siswa TK dan SD')
                    @if($no % 9 == 0)
                        <div class="page-break"></div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    @endif
                @endif
                @if($i->instrumen == 'Orang Tua SMP')
                    @if($no % 9 == 0)
                        <div class="page-break"></div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    @endif
                @endif
                @if($i->instrumen == 'Siswa SMP')
                    @if($no % 10 == 0)
                        <div class="page-break"></div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    @endif
                @endif
                @if($i->instrumen == 'Orang Tua SMA')
                    @if($no % 9 == 0)
                        <div class="page-break"></div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    @endif
                @endif
                @if($i->instrumen == 'Siswa SMA')
                    @if($no % 10 == 0)
                        <div class="page-break"></div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    @endif
                @endif
            @endforeach
        </ol>
    @endforeach
</div>
@endsection
