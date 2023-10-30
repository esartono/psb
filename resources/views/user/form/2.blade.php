<style type="text/css">
    .jk-warna {
        color:white;
        position: relative;
        top: -30px;
        padding: 5px;
        background-color: red;
        margin-bottom: -35px;
    }
    .jk-bening {
        color:white;
        position: relative;
        top: -30px;
        padding: 5px;
        margin-bottom: -35px;
    }
</style>
<div class="text-center">
    <h4 class="mb-5">Pilih Unit</h4>
    @if($calon->pindahan == false)
        <form role="form" method="POST" action="{{ route('add.calon') }}">
            @csrf
            <input type="hidden" name="step" value=2>
            @forelse ($units as $unit)
                @if($unit->catnya->name == 'TK')
                    <button type="button" class="btn btn-app btn-lg white {{ $unit->catnya->name }}"
                        data-toggle="modal" data-target="#modal{{ $unit->catnya->name }}"
                        data-backdrop="static" data-keyboard="false">
                        <p class="@if(\App\Kelasnya::cjk($unit->catnya->name) === 0) jk-bening @else jk-warna @endif">@include('user.form.cekjk',['cek' => $unit->catnya->name])</p>
                        <i class="fas fa-address-card"></i>
                        {{ $unit->name }} <br> <span style="padding: 2px 27px"></span>
                    </button>
                @endif
                @if($unit->catnya->name == 'SD' || $unit->catnya->name == 'SMP' || $unit->catnya->name == 'SMA')
                    <button type="submit" name="unit" value="{{ $unit->id }}" class="btn btn-app btn-lg white {{ $unit->catnya->name }}">
                        <p class="@if(\App\Kelasnya::cjk($unit->catnya->name) === 0) jk-bening @else jk-warna @endif">@include('user.form.cekjk',['cek' => $unit->catnya->name])</p>
                        <i class="fas fa-address-card"></i>
                        {{ $unit->name }} <br> <span style="padding: 2px 27px"></span>
                    </button>
                @endif
                {{-- @if($unit->catnya->name == 'SMA')
                    @if($csma == 'TIDAK' || $csma == 'MIPA')
                        <button type="submit" name="unit" value="{{ $unit->id }}-MIPA" class="btn btn-app btn-lg white {{ $unit->catnya->name }}">
                            <p class="@if(\App\Kelasnya::cjk($unit->catnya->name) === 0) jk-bening @else jk-warna @endif">@include('user.form.cekjk',['cek' => $unit->catnya->name])</p>
                            <i class="fas fa-address-card"></i>
                            {{ $unit->name }} <br> <span class="bg-green" style="padding: 2px 27px">Jurusan MIPA</span>
                        </button>
                    @endif
                    @if($csma == 'TIDAK' || $csma == 'IPS')
                        <button type="submit" name="unit" value="{{ $unit->id }}-IPS" class="btn btn-app btn-lg white {{ $unit->catnya->name }}">
                            <p class="@if(\App\Kelasnya::cjk($unit->catnya->name) === 0) jk-bening @else jk-warna @endif">@include('user.form.cekjk',['cek' => $unit->catnya->name])</p>
                            <i class="fas fa-address-card"></i>
                            {{ $unit->name }} <br> <span class="bg-blue" style="padding: 2px 27px">Jurusan IPS</span>
                        </button>
                    @endif
                @endif --}}
            @empty
                <h2 class="bg-red" style="padding: 20px;">MAAF BELUM ADA KELAS YANG TERSEDIA</h2>
            @endforelse
            <hr>
            @include('user.form.batal')
        </form>
    @endif
    @if($calon->pindahan == true)
        @foreach ($units as $unit)
            <button type="button" class="btn btn-app btn-lg white {{ $unit->catnya->name }}"
                data-toggle="modal" data-target="#modal{{ $unit->catnya->name }}"
                data-backdrop="static" data-keyboard="false">
                <i class="fas fa-address-card"></i>
                {{ $unit->name }}
            </button>
        @endforeach
        <hr>
        @include('user.form.batal')
    @endif
</div>
<!-- Modal -->
@foreach ($units as $unit)
    <div class="modal fade" id="modal{{ $unit->catnya->name }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header white bg-{{ $unit->catnya->name }}">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Kelas</h5>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form role="form" method="POST" action="{{ route('add.calon') }}">
                        @csrf
                        <input type="hidden" name="step" value=2>
                        <input type="hidden" name="unit" value={{ $unit->id }}>
                        @foreach (\App\Kelasnya::units($unit->catnya->name, $calon->pindahan) as $k)
                            @if($unit->catnya->name != 'SMA')
                                <button type="submit" name="kelas_tujuan" value="{{ $k['id'] }}" class="mb-5 btn btn-app btn-lg white bg-{{ $unit->catnya->name }}">
                                    <p class="@if(\App\Kelasnya::cjk($k->id) === 0) jk-bening @else jk-warna @endif">@include('user.form.cekjk',['cek' => $k->id])</p>
                                    <h4 style="margin: 15px 0 -15px 0">Kelas</h4><br><h3 style="margin-bottom: -15px"><b>{{ $k['name'] }}</b></h3><br>
                                </button>
                            @endif
                            @if($unit->catnya->name == 'SMA')
                                @if($k['jurusan'] == 'TIDAK' || $k['jurusan'] == 'MIPA')
                                    <button type="submit" name="kelas_tujuan" value="{{ $k['id'] }}-MIPA" class="mb-5 btn btn-app btn-lg white bg-{{ $unit->catnya->name }}">
                                        <p class="@if(\App\Kelasnya::cjk($k->id) === 0) jk-bening @else jk-warna @endif">@include('user.form.cekjk',['cek' => $k->id])</p>
                                        <h4 style="margin: 15px 0 -15px 0">Kelas</h4><br><h3 style="margin-bottom: -15px"><b>{{ $k['name'] }} - MIPA</b></h3><br>
                                    </button>
                                @endif
                                @if($k['jurusan'] == 'TIDAK' || $k['jurusan'] == 'IPS')
                                    <button type="submit" name="kelas_tujuan" value="{{ $k['id'] }}-IPS" class="mb-5 btn btn-app btn-lg white bg-{{ $unit->catnya->name }}">
                                        <p class="@if(\App\Kelasnya::cjk($k->id) === 0) jk-bening @else jk-warna @endif">@include('user.form.cekjk',['cek' => $k->id])</p>
                                        <h4 style="margin: 15px 0 -15px 0">Kelas</h4><br><h3 style="margin-bottom: -15px"><b>{{ $k['name'] }} - IPS</b></h3><br>
                                    </button>
                                @endif
                            @endif
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
