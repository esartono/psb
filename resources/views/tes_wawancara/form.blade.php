@push('css_khusus')
<style>
    #timer {
        color: white;
        background-color: seagreen;
        font-size: 125%;
        font-weight: 600;
        border: 1px seagreen solid;
        text-align: center;
        padding: 5px;
        /* border-radius: 10px; */
    }

    .nav-tabs .nav-link.active {
        background-color: DodgerBlue !important;
        font-weight: 700;
        color: white;
    }

    .alert-primary {
        text-align: left;
        color: black;
        font-weight: 500;
        font-size: 110%;
    }
    .btn-outline-success {
        color: black;
    }
    .accordion-button:not(.collapsed){
        color: black;
    }
</style>
@endpush
<div class="card" style="padding: 0">
    <form id="formWawancara" method="POST" action="{{ route('simpanJawaban') }}">
        @csrf
        <input type="hidden" name="calon_id" value="{{ $calon->id }}">
        <input type="hidden" name="instrumen_id" value="{{ $instrumen }}">
        <input type="hidden" name="modelWawancara" value="{{ $modelWawancara }}">

        <div class="card-header">
            <div class="row mt-3 mb-2 pb-3" style="border-bottom: 1px solid Gainsboro;">
                <div class="col-10">
                    <h5>{{ $wawancaranya[$modelWawancara] }}</h5>
                </div>
                <div class="col-2 text-end">
                    <div id="timer"></div>
                </div>
            </div>
            
            <ul class="nav nav-tabs" role="tablist" style="border-bottom: 0px;">
                @php
                    $no = 1;
                    $jawab = array();
                    $catatan = array();
                @endphp
                @foreach ($rubrik as $k => $r)
                    @php
                        $aktif[$r->id] = 0;
                        $jawab[$r->id] = 0;
                        $catatan[$r->id] = '';
                        if(isset($jawabannya[0][$r->id])){
                            if($jawabannya[0][$r->id] > 0){
                                $aktif[$r->id] = 1;
                                $jawab[$r->id] = $jawabannya[0][$r->id];
                                
                            }
                            if($jawabannya[1][$r->id] !== ''){
                                $catatan[$r->id] = $jawabannya[1][$r->id];
                            }
                            if($no == 1) {
                                $aktif[$r->id] = 1;
                            }
                        }
                    @endphp
                    @if($mulai == 0 && $no == 1)
                    <li class="nav-item" role="presentation">
                        <button style="border-color: grey; margin-right: 3px;"
                            class="nav-link mb-2 active {{ $aktif[$r->id] == 1 ? 'isi' : '' }}" data-bs-toggle="tab"
                            data-bs-target="#no-{{ $k }}" type="button"
                            onclick="cekAktifTab({{ $k }})"
                            role="tab" aria-controls="#no-{{ $k }}" aria-selected="active">
                            No. {{ sprintf('%02d',$no) }}
                        </button>
                    </li>
                    @endif
                    @if($mulai > 0 || $no > 1)
                    <li class="nav-item" role="presentation">
                        <button style="border-color: grey; margin-right: 3px;"
                            class="nav-link mb-2 {{ $r->id == $mulai ? 'active' : '' }} {{ $aktif[$r->id] == 1 ? 'isi' : '' }}" data-bs-toggle="tab"
                            data-bs-target="#no-{{ $k }}" type="button"
                            onclick="cekAktifTab({{ $k }})"
                            role="tab" aria-controls="#no-{{ $k }}" aria-selected="{{ $r->id == $mulai ? 'active' : '' }}">
                            No. {{ sprintf('%02d',$no) }}
                        </button>
                    </li>
                    @endif
                    @php
                        $no++;
                    @endphp
                @endforeach
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                @php
                    $no = 1;
                @endphp
                @foreach ($rubrik as $k => $r)
                @if($mulai == 0 && $no == 1)
                    <div class="tab-pane active" id="no-{{ $k }}" role="tabpanel" aria-labelledby="no-{{ $k }}-tab">
                        <div class="row">
                            <div class="alert alert-primary" style="text-align: left; color: black !important">
                                {{ $no }}. {{ $r->butir }}<br>
                                <span style="font-size: 90%; color: red !important">{{ $r->keterangan }}</span>
                            </div>
                            <p style="text-align: left">Silahkan klik di salah satu pilihan di bawah ini:</p>
                        </div>
                        @foreach ($r->rubrik as $key => $rk)
                            @if($rk)
                            <div class="row">
                                <div class="btn-group mt-2 mt-2" role="group">
                                    <input type="radio" class="btn-check" name="jawaban[{{ $r->id }}]"
                                        id="jawaban-{{ $r->id }}-{{ $key }}" value="{{ $key }}"
                                        @isset($jawab[$r->id]){{ $jawab[$r->id] == $key ? 'checked' : '' }}@endisset
                                        />
                                    <label class="btn btn-outline-success btn-sm text-start"
                                        for="jawaban-{{ $r->id }}-{{ $key }}">{{ $key }}. {{ $rk }}
                                    </label>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        <div class="row p-3">
                            <p style="text-align: left" class="mt-3">CATATAN :</p>
                            <textarea class="col col-12 form-control" rows="3" name="catatan[{{ $r->id }}]">{{ $catatan[$r->id] }}</textarea>
                        </div>
                            {{-- <div class="row nav-item">
                                <button style="border-color: grey; margin-right: 3px;" class="nav-link mb-2" data-bs-toggle="tab" data-bs-target="#no-{{ $no }}" type="button" role="tab" aria-controls="home" aria-selected="false">Lanjut Pertanyaan No. {{ sprintf('%02d',$no+1) }}</button>
                            </div> --}}
                    </div>
                @endif
                @if($mulai > 0 || $no > 1)
                    <div class="tab-pane {{ $r->id == $mulai ? 'active' : '' }}" id="no-{{ $k }}" role="tabpanel" aria-labelledby="no-{{ $k }}-tab">
                        <div class="row">
                            <div class="alert alert-primary" style="text-align: left; color: black !important">
                                {{ $no }}. {{ $r->butir }}<br>
                                <span style="font-size: 90%; color: red !important">{{ $r->keterangan }}</span>
                            </div>
                            <p style="text-align: left">Silahkan klik di salah satu pilihan di bawah ini:</p>
                        </div>
                        @foreach ($r->rubrik as $key => $rk)
                            @if($rk)
                            <div class="row">
                                <div class="btn-group mt-2 mt-2" role="group">
                                    <input type="radio" class="btn-check" name="jawaban[{{ $r->id }}]"
                                        id="jawaban-{{ $r->id }}-{{ $key }}" value="{{ $key }}"
                                        @isset($jawab[$r->id]){{ $jawab[$r->id] == $key ? 'checked' : '' }}@endisset
                                        {{ $rk == "-" ? 'disabled' : '' }}
                                        />
                                    <label class="btn btn-outline-success btn-sm text-start"
                                        for="jawaban-{{ $r->id }}-{{ $key }}">{{ $key }}. {{ $rk }}
                                    </label>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        <div class="row p-3">
                            <p style="text-align: left" class="mt-3">CATATAN :</p>
                            <textarea class="col col-12 form-control" rows="3" name="catatan[{{ $r->id }}]">{{ $catatan[$r->id] }}</textarea>
                        </div>
                            {{-- <div class="row nav-item">
                                <button style="border-color: grey; margin-right: 3px;" class="nav-link mb-2" data-bs-toggle="tab" data-bs-target="#no-{{ $no }}" type="button" role="tab" aria-controls="home" aria-selected="false">Lanjut Pertanyaan No. {{ sprintf('%02d',$no+1) }}</button>
                            </div> --}}
                    </div>
                @endif
                @php
                    $no++;
                @endphp
                @endforeach
            </div>
            <button id="lanjut" class="btn btn-primary text-white" type="submit">
                Simpan dan Lanjutkan &nbsp;
                <i class="fas fa-arrow-circle-right"></i>
            </button>
        </div>
    </form>
</div>

@push('jawa')
<script>
    $(function() {
        cekLengkap();
    })

    function cekLengkap() {
        var terakhir = {{ $lengkap }}
        if(terakhir == 1) {
            let btnLanjut = document.getElementById("lanjut");
            if (btnLanjut) {
                btnLanjut.remove();
            }

            if ($("#selesai").length === 0) {
                $("<button id='selesai' class='btn btn-danger text-white' type='submit'> Simpan &nbsp; <i class='fas fa-arrow-circle-right'></i></button>")
                .attr("id", "selesai")
                .attr("name", "selesai")
                .attr("value", "selesai")
                .appendTo("#formWawancara .card-body");
            }
        } else {
            let btnSelesai = document.getElementById("selesai");
            if (btnSelesai) {
                btnSelesai.remove();
            }
        }
    }
    var sec = Number({!! $waktu !!}),
        countDiv = document.getElementById("timer"),
        secpass,
        countDown = setInterval(function () {
            'use strict';
            secpass();
        }, 1000);

    function secpass() {
        'use strict';
        var min = Math.floor(sec / 60),
            remSec  = sec % 60;
        
        if (remSec < 10) {
            remSec = '0' + remSec;
        }
        if(min < 15) {
            countDiv.style.backgroundColor = 'DarkOrange';
            countDiv.style.borderColor = 'DarkOrange';
        }
        if (min < 10) {
            min = '0' + min;
            countDiv.style.backgroundColor = 'White';
            countDiv.style.color = 'Red';
            countDiv.style.borderColor = 'Red';
        }
        countDiv.innerHTML = min + ":" + remSec;
        if (sec > 0) {    
            sec = sec - 1;
        } else {
            clearInterval(countDown);
            countDiv.innerHTML = '00:00';
        }
    }
</script>
@endpush