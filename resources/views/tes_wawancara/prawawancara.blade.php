@extends('layouts.wawancara')

@push('css_khusus')
{{-- <link rel="stylesheet" href="//cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.css" />
<style>
    .isi {
        background-color: #FF8C00 !important;
        color: #fff !important;
    }
    .active.isi {
        background-color: #495057 !important;
        color: #fff !important;
    }
    .thead, .tbody, tr, th, td {
        border: 1px solid grey;
        padding: 0.5rem !important;
    }
    .nav-item {
        margin-right: -1.5px !important; 
    }
</style>
@endpush
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body p-4">
                <table id="listPrawawancara" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. Pendaftaran</th>
                            <th>Nama Calon Siswa</th>
                            <th>Unit</th>
                            <th>Ayah</th>
                            <th>Ibu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($lists)
                            @foreach ( $lists as $list)
                                <tr>
                                    <td></td>
                                    <td>{{ $list->uruts }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->unit }}</td>
                                    <td>{{ $list->ayah_nama }}</td>
                                    <td>{{ $list->ibu_nama }}</td>
                                    <td>{{ $list->id }}</td>
                                </tr>                                
                            @endforeach
                        @endisset
                        @empty($lists)
                        <tr>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                        </tr>
                        @endempty
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('jawa')
<script src="https://cdn.datatables.net/2.3.3/js/dataTables.js"></script>
<script>
    $(document).ready( function () {
    var table = $('#listPrawawancara').DataTable({
        destroy: true,
        deferRender: true,
        order: [[ 2, "asc" ]],
        columnDefs: [{ 
            targets: 6, //<-- index of column that should be rendered as link
            render : function(data, type, row, meta){
                if (type === 'display'){
                    return $('<a>')
                    .attr('href', '/praWawancara/'+data)
                    .attr('class', 'btn btn-info')
                    .text('Detail')
                    .wrap('<div></div>')
                    .parent()
                    .html();
                } else {
                    return data;
                }
            }
        },{
            targets: [0, 6], // Array of column indices (0-indexed) to disable sorting for
            orderable: false, // Disables sorting for the specified columns
            searchable: false
        },{ 
            targets: [0,1,6], className: 'dt-center'
        }]
    });
    // Update row numbers on order and search events
    table.on('order.dt search.dt', function () {
        table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
});
</script>
@endpush