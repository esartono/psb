@extends('layouts.app')

@section('content')
<style>
    .status_title {
        font-weight: 800;
        font-size: 130%;
        text-align: center;
        border: 1px solid red;
        margin-top: -1.25rem;
        margin-left: -20px;
        background-color: red
    }
    .status {
        margin-left: -20px;
    }
</style>
<div class="container-xl">
    <div class="row justify-content-center">
        <div class="card col-md-3 p-1 mt-4 mb-4">
            <a href="/tambahcalon" class="btn btn-success btn-lg"><i class="fas fa-user-plus"> </i><b> Tambah Calon Siswa </b></a>
        </div>
    </div>
    @foreach($calons as $calon)
    <div style="border-bottom: 2px solid grey" class="row justify-content-center mb-4">
        <div class="col-md-5 mb-3">
            <div class="card h-100">
                <div class="card-header white bg-{{ $calon->gelnya->unitnya->catnya->name }} card-{{ $calon->gelnya->unitnya->catnya->name }}-outline">
                    <h5>Data Calon Peserta - {{ $calon->gelnya->unitnya->name }}</h5>
                    {{-- <div class="card-tools" style="position: absolute; right: 1rem; top: 0.5rem">
                        <a href="/editcalon/{{ $calon->id }}" class="btn btn-sm btn-warning"><i class="fas fa-user-edit"> </i><b> Edit </b></a>
                    </div> --}}
                </div>
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center text-uppercase">{{ $calon->name }}</h3>
                    <h4 class="text-muted text-center">{{ $calon->uruts }}</h4>
                    <ul class="list-group list-group-unbordered mb-2">
                        <li class="list-group-item">
                            <b>Tempat, Tanggal lahir</b> <a class="float-right">{{ $calon->tempat_lahir }}, {{ $calon->tgl_lahir->isoFormat('D MMMM Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Jenis Kelamin</b> <a class="float-right">{{ $calon->kelamin }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Kelas Tujuan</b> <a class="float-right">Kelas {{ $calon->kelasnya->name }}
                                @if($calon->gelnya->unitnya->catnya->name === 'SMA')
                                    ( Jurusan
                                    @if($calon->jurusan === '-')
                                        <button class="btn btn-danger btn-sm" onclick="jurusan()">Pilih Jurusan</button>
                                    @else
                                        {{ $calon->jurusan }}
                                    @endif
                                    )
                                @endif
                                </a>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Daftar</b> <a class="float-right">{{ $calon->tgl_daftar->isoFormat('D MMMM Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>User Email</b> <a class="float-right">{{ Auth()->user()->email }}</a>
                        </li>
                    </ul>
                    <a href="/editcalon/{{ $calon->id }}" class="btn btn-info"><i class="fas fa-user-edit"> </i><b> Edit Data Calon Siswa</b></a>
                    <a href='/dokumen/{{ $calon->id }}' class="btn btn-danger"><i class="fa fa-book"> </i> &nbsp;Upload Dokumen</a>
                    {{-- @if($calon->tahap == 4)<a href='/uniform/{{ $calon->id }}' class="btn btn-primary"><i class="fas fa-tshirt"> </i> &nbsp;Pilih Ukuran Seragam</a>@endif --}}
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-3">
            <div class="card h-100">
                <div class="card-header white bg-{{ $calon->gelnya->unitnya->catnya->name }} card-{{ $calon->gelnya->unitnya->catnya->name }}-outline">
                    <h5>Status : {{ $calon->status == 0 ? 'Tidak Aktif' : 'Aktif' }}</h5>
                </div>
                <div class="card-body box-profile">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-tabs h-100" aria-orientation="vertical">
                                <p class="nav-link status {{ $calon->tahap >= 1 ? 'active' : '' }}">1. Pendaftaran @if($calon->tahap >= 1) <i class="fas fa-check-circle float-right"></i>@endif</p>
                                <p class="nav-link status {{ $calon->tahap >= 2 ? 'active' : '' }}">2. Biaya Pendaftaran @if($calon->tahap >= 2) <i class="fas fa-check-circle float-right"></i>@endif</p>
                                <p class="nav-link status {{ $calon->tahap >= 2 ? 'active' : '' }}">3. Seleksi @if($calon->tahap >= 2) <i class="fas fa-check-circle float-right"></i>@endif</p>
                                <p class="nav-link status {{ $calon->tahap == 3 ? 'active' : '' }}">4. Pengumuman @if($calon->tahap == 3) <i class="fas fa-check-circle float-right"></i>@endif</p>
                                <p class="nav-link status {{ $calon->tahap == 5 ? 'active' : '' }}">5. Daftar Ulang @if($calon->tahap == 5) <i class="fas fa-check-circle float-right"></i>@endif</p>
                                <p class="nav-link status {{ $calon->tahap == 6 ? 'active' : '' }}">6. Seragam dan Pengambilan Buku @if($calon->tahap == 6) <i class="fas fa-check-circle float-right"></i>@endif</p>
                                <p class="nav-link status {{ $calon->tahap == 7 ? 'active' : '' }}">7. Masa Orientasi Siswa @if($calon->tahap == 7) <i class="fas fa-check-circle float-right"></i>@endif</p>
                            </div>
                        </div>
                        <div class="col-9">
                            @include('user.tahapan.'.$calon->tahap)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // jurusan()
    })

    function jurusan() {
        var id = "{{$calon->id}}"
        var unit = "{{$calon->gelnya->unitnya->catnya->name}}"
        var jurusan = "{{$calon->jurusan}}"
        if (unit == 'SMA' && jurusan == '-'){
            (async function(){
                const { value: jur } = await Swal.fire({
                    title: 'Pilih Jurusan',
                    input: 'select',
                    inputOptions: {
                        'MIPA': 'MIPA',
                        'IPS': 'IPS'
                    },
                    inputPlaceholder: 'Pilih Jurusan',
                    showCancelButton: false,
                })
                if (jur) {
                    axios({
                        method: "post",
                        url: "/editjurusan",
                        data: {
                            id: id,
                            jurusan: jur
                        }
                    }).then(function (response) {
                        if (response.data == 'OKE') {
                            location.reload(true);
                        }
                    }).catch(function (response) {
                        alert(response);
                    });
                }
            })()
        }
    }
</script>
@endpush
