<div class="text-center">
    <h4 class="mb-3">Pilih Unit</h4>
    @if($calon->pindahan == false)
        <form role="form" method="POST" action="{{ route('add.calon') }}">
            @csrf
            <input type="hidden" name="step" value=2>
            @forelse ($units as $unit)
                @if($unit->catnya->name == 'TK')
                    <button type="button" class="btn btn-app btn-lg white {{ $unit->catnya->name }}"
                        data-toggle="modal" data-target="#modal{{ $unit->id }}"
                        data-backdrop="static" data-keyboard="false">
                        <i class="fas fa-address-card"></i>
                        {{ $unit->name }}
                    </button>
                @endif
                @if($unit->catnya->name == 'SD' || $unit->catnya->name == 'SMP')
                    <button type="submit" name="unit" value="{{ $unit->id }}" class="btn btn-app btn-lg white {{ $unit->catnya->name }}">
                        <i class="fas fa-address-card"></i>
                        {{ $unit->name }} <br>
                        @include('user.form.cekjk',['cek' => $unit->id])
                    </button>
                @endif
                @if($unit->catnya->name == 'SMA')
                    @if($csma == 'TIDAK' || $csma == 'MIPA')
                        <button type="submit" name="unit" value="{{ $unit->id }}-MIPA" class="btn btn-app btn-lg white {{ $unit->catnya->name }}">
                            <i class="fas fa-address-card"></i>
                            {{ $unit->name }} <br> <span class="bg-green" style="padding: 2px 32px">Jurusan MIPA</span>
                            @include('user.form.cekjk',['cek' => $unit->id])
                        </button>
                    @endif
                    @if($csma == 'TIDAK' || $csma == 'IPS')
                        <button type="submit" name="unit" value="{{ $unit->id }}-IPS" class="btn btn-app btn-lg white {{ $unit->catnya->name }}">
                            <i class="fas fa-address-card"></i>
                            {{ $unit->name }} <br> <span class="bg-blue" style="padding: 2px 32px">Jurusan IPS</span>
                            @include('user.form.cekjk',['cek' => $unit->id])
                        </button>
                    @endif
                @endif
            @empty
                <h2 class="bg-red" style="padding: 20px;">MAAF BELUM ADA KELAS YANG TERSEDIA</h2>
            @endforelse
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
                                <button type="submit" name="kelas_tujuan" value="{{ $k['id'] }}" class="btn btn-app btn-lg white bg-{{ $unit->catnya->name }}">
                                    <h3 style="margin-bottom: -15px">Kelas</h3><br><h2 style="margin-bottom: -15px"><b>{{ $k['name'] }}</b></h2><br>
                                    @include('user.form.cekjk',['cek' => $k['id']])
                                </button>
                            @endif
                            @if($unit->catnya->name == 'SMA')
                                @if($k['jurusan'] == 'TIDAK' || $k['jurusan'] == 'MIPA')
                                    <button type="submit" name="kelas_tujuan" value="{{ $k['id'] }}-MIPA" class="btn btn-app btn-lg white bg-{{ $unit->catnya->name }}">
                                        <h3 style="margin-bottom: -15px">Kelas</h3><br><h2 style="margin-bottom: -15px"><b>{{ $k['name'] }} - MIPA</b></h2><br>
                                        @include('user.form.cekjk',['cek' => $k['id']])
                                    </button>
                                @endif
                                @if($k['jurusan'] == 'TIDAK' || $k['jurusan'] == 'IPS')
                                    <button type="submit" name="kelas_tujuan" value="{{ $k['id'] }}-IPS" class="btn btn-app btn-lg white bg-{{ $unit->catnya->name }}">
                                        <h3 style="margin-bottom: -15px">Kelas</h3><br><h2 style="margin-bottom: -15px"><b>{{ $k['name'] }} - IPS</b></h2><br>
                                        @include('user.form.cekjk',['cek' => $k['id']])
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
