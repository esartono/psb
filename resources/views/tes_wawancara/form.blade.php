<div class="card" style="padding: 0">
    <form method="POST" action="{{ route('simpanJawaban') }}">
        @csrf
        <input type="hidden" name="calon_id" value="{{ $calon->id }}">
        <input type="hidden" name="instrumen_id" value="{{ $instrumen }}">
        <div class="card-header">
            <h5 class="mt-3 pb-3" style="border-bottom: 1px solid grey;">{{ $wawancaranya[$modelWawancara] }}</h5>
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
                            if($jawabannya[1][$r->id] > 0){
                                $catatan[$r->id] = $jawabannya[1][$r->id];
                            }
                            if($no == 1) {
                                $aktif[$r->id] = 1;
                            }
                        }
                    @endphp
                    <li class="nav-item" role="presentation">
                        <button style="border-color: grey; margin-right: 3px;"
                            class="nav-link mb-2 {{ $r->id == $mulai ? 'active' : '' }} {{ $aktif[$r->id] == 1 ? 'isi' : '' }}" data-bs-toggle="tab"
                            data-bs-target="#no-{{ $k }}" type="button"
                            role="tab" aria-controls="#no-{{ $k }}" aria-selected="{{ $r->id == $mulai ? 'active' : '' }}">
                            No. {{ sprintf('%02d',$no) }}
                        </button>
                    </li>
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
                        <div class="tab-pane {{ $r->id == $mulai ? 'active' : '' }}" id="no-{{ $k }}" role="tabpanel" aria-labelledby="no-{{ $k }}-tab">
                            <div class="row">
                                <div class="alert alert-primary" style="text-align: left"> {{ $no }}. {{ $r->butir }}</div>
                                <p style="text-align: left">Silahkan klik di salah satu pilihan di bawah ini:</p>
                            </div>
                            @foreach ($r->rubrik as $key => $rk)
                                @if($rk)
                                <div class="row">
                                    <div class="btn-group mt-2 mt-2" role="group">
                                        <input type="radio" class="btn-check" name="jawaban[{{ $r->id }}]"
                                            id="jawaban-{{ $r->id }}-{{ $key }}" value="{{ $key }}"
                                            {{ $jawab[$r->id] == $key ? 'checked' : '' }}
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
                                <textarea class="col col-12 form-control" name="catatan[{{ $r->id }}]">{{ $catatan[$r->id] }}</textarea>
                            </div>
                            {{-- <div class="row nav-item">
                                <button style="border-color: grey; margin-right: 3px;" class="nav-link mb-2" data-bs-toggle="tab" data-bs-target="#no-{{ $no }}" type="button" role="tab" aria-controls="home" aria-selected="false">Lanjut Pertanyaan No. {{ sprintf('%02d',$no+1) }}</button>
                            </div> --}}
                        </div>
                    @php
                        $no++;
                    @endphp
                @endforeach
            </div>
            <button class="btn btn-primary text-white" type="submit">
                Simpan dan Lanjutkan &nbsp;
                <i class="fas fa-arrow-circle-right"></i>
            </button>
        </div>
    </form>
</div>

@push('jawa')
<script src="//cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
@endpush