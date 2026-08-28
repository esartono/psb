@extends('layouts.list')

@push('css_khusus')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css">

@endpush
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
    <div class="breadcomb-list">
        <div class="row">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body p-4">
                        <table class="table align-middle table-bordered">
                            <thead class="align-middle text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>Id.</th>
                                    <th>No. Pendaftaran</th>
                                    <th>Nama Calon Siswa</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            @php $no=1; @endphp
                            <tbody>
                                @isset($calons)
                                    @foreach ($calons as $w)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">{{ $w->id }}</td>
                                        <td class="text-center">{{ $w->uruts }}</td>
                                        <td>{{ $w->name }}</td>
                                        <td>{{ $w->jadwal }}</td>
                                    </tr>
                                    @endforeach                    
                                @endisset
                                @empty($calons)
                                    <tr>
                                        <td colspan="3" class="text-center p-3"><h4> --- Belum ada Data --- </h4></td>
                                    </tr>
                                @endempty
                            </tbody>
                        </table>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('jawa')
<script src="//cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
@endpush