@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-user-edit"></i>
                        Kirim Bukti Bayar SPP
                    </h3>
                    <div class="card-tools">
                        <a href="/ppdb" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>No. Pendaftaran</td>
                            <td style="width: 300px !important">{{ $calon->uruts }}</td>
                        </tr>
                        <tr>
                            <td>Nama Calon Siswa</td>
                            <td>{{ $calon->name }}</td>
                        </tr>
                    </table>
                    <hr>
                    <div class="alert alert-danger">
                        File yang diupload hanya file dokumen dalam bentuk <strong>Gambar</strong>.
                    </div>
                    <form role="form" method="POST" action="{{ route('bayarSPP.update', $calon) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Tanggal Bayar</label>
                                <div class="col-sm-8">
                                    <input name="calon_id" type="hidden" class="form-control" value="{{ $calon->id }}" required readonly>
                                    {{-- <input name="tanggal_bayar" type="text" class="form-control" id="datepicker" required readonly> --}}
                                    <input name="tanggal_bayar" type="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Jumlah Bayar</label>
                                <div class="col-sm-8">
                                    <input name="jumlahbayar" type="=text" class="form-control" required
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="16">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="file" class="col-sm-4 col-form-label">Upload Dokumen</label>
                                <div class="col-sm-8">
                                    <input name="file" type="file" class="form-control" required accept="image/*">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="file" class="col-sm-4 col-form-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea name="keterangan" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                                    <button type="submit" class="col btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $.fn.datepicker.dates['id'] = {
        days: ["Ahad", "Senin", "Selasa", "Rabu", "Kamis", "Jum`at", "Sabtu"],
        daysShort: ["Ahd", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        daysMin: ["Ah", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"],
        months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
        today: "Hari Ini",
        clear: "Clear",
        format: "dd MM yyyy",
        titleFormat: "MM yyyy",
        weekStart: 0
    };

    $('#datepicker').datepicker({
        autoclose: true,
        disableTouchKeyboard: false,
        language: 'id',
    });
</script>
@endpush
