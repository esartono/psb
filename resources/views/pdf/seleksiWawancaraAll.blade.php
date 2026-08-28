@extends('pdf.template_wawancara')
@php
    set_time_limit(0);
    ini_set("memory_limit",-1);
    ini_set('max_execution_time', 0);
@endphp
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
    {{-- @foreach ($instrumen as $i) --}}
        @foreach ($tesWawancara as $tw)
            <div class="main">
                <table class="biodata">
                    <tr>
                        <th width="120px">No. Pendaftaran</th>
                        <td width="2px">:</td>
                        <td width="320px">{{ $tw->calonnya->uruts }}</td>
                        <th width="90px">Tanggal</th>
                        <td width="2px">:</td>
                        <td>{{ formatIndo($tw->created_at) }}</td>
                    </tr>
                    <tr>
                        <th>Nama Calon Siswa</th>
                        <td>:</td>
                        <td>{{ $tw->calonnya->name }}</td>
                        <th>Pewawancara</th>
                        <td>:</td>
                        <td>{{ $tw->usernya->name }}</td>
                    </tr>
                    <tr>
                        <th>Unit/Kelas Tujuan</th>
                        <td>:</td>
                        <td>{{ $tw->calonnya->gelnya->unitnya->name }} - Kelas {{ $tw->calonnya->kelasnya->name }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <hr>
                <h3 style="text-align: center">Data Wawancara {{ $tw->instrumennya->instrumen }}</h3>
                @php
                    $no = 0;
                    $hal = 1;
                @endphp
                <ol>
                    @foreach ($rubrik[$tw->instrumen_id] as $r)
                        <li>
                            {{ $r->butir }}
                            @isset($jawaban[$tw->calon_id][$r->id])
                                <br>{{ $pg[$tw->instrumen_id][$r->id][$jawaban[$tw->calon_id][$r->id]] }}<br>
                                @if($catatan[$tw->calon_id][$r->id])
                                    catatan: {{ $catatan[$tw->calon_id][$r->id] }}
                                @endif
                                <br>
                            @else
                                <br> - <br>
                            @endisset
                        </li>
                        <br>
                        @php
                            $no++;
                        @endphp
                        @if($tw->instrumennya->instrumen == 'Orang Tua Calon Siswa TK dan SD')
                            @if($no % 10 == 0)
                                <div class="halaman">Wawancara {{ $tw->instrumennya->instrumen }} - {{ Str::title($tw->calonnya->name) }} ({{ $tw->calonnya->uruts }}) - hal. {{ $hal++ }}</div>
                                <div class="page-break"></div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            @endif
                        @endif
                        @if($tw->instrumennya->instrumen == 'Orang Tua SMP')
                            @if($no % 10 == 0)
                                <div class="halaman">Wawancara {{ $tw->instrumennya->instrumen }} - {{ Str::title($tw->calonnya->name) }} ({{ $tw->calonnya->uruts }}) - hal. {{ $hal++ }}</div>
                                <div class="page-break"></div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            @endif
                        @endif
                        @if($tw->instrumennya->instrumen == 'Siswa SMP')
                            @if($no % 11 == 0)
                                <div class="halaman">Wawancara {{ $tw->instrumennya->instrumen }} - {{ Str::title($tw->calonnya->name) }} ({{ $tw->calonnya->uruts }}) - hal. {{ $hal++ }}</div>
                                @if($no < 22)
                                    <div class="page-break"></div>
                                @endif
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            @endif
                        @endif
                        @if($tw->instrumennya->instrumen == 'Orang Tua SMA')
                            @if($no % 9 == 0)
                                <div class="halaman">Wawancara {{ $tw->instrumennya->instrumen }} - {{ Str::title($tw->calonnya->name) }} ({{ $tw->calonnya->uruts }}) - hal. {{ $hal++ }}</div>
                                <div class="page-break"></div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            @endif
                        @endif
                        @if($tw->instrumennya->instrumen == 'Siswa SMA')
                            @if($no % 10 == 0)
                                <div class="halaman">Wawancara {{ $tw->instrumennya->instrumen }} - {{ Str::title($tw->calonnya->name) }} ({{ $tw->calonnya->uruts }}) - hal. {{ $hal++ }}</div>
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
                    <div class="halaman">Wawancara {{ $tw->instrumennya->instrumen }} - {{ Str::title($tw->calonnya->name) }} ({{ $tw->calonnya->uruts }}) - hal. {{ $hal++ }}</div>
                    </ol>
                {{-- @endforeach --}}
            </div>
            {{-- <div class="halaman">{{ Str::title($tw->calonnya->name) }} ({{ $tw->calonnya->uruts }}) - hal. {{ $hal++ }}</div> --}}
            <div class="page-break"></div>
        @endforeach
    {{-- @endforeach --}}
@endsection
