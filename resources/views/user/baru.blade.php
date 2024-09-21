@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-6 p-1 mt-4 mb-4">
        <form role="form" method="POST" action="{{ route('add.user') }}">
            <div class="card-header bg-warning">
                Untuk melanjutkan proses pendaftaran Akun, silahkan masukan nomor WhatsApp anda.<br>
                {{-- Nomor tersebut akan digunakan sebagai notifikasi proses PPDB (Pendaftaran Peserta Didik Baru)
                SIT Nurul Fikri. --}}
            </div>
            <div class="card-body">
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-md-5 col-form-label">Nama Lengkap</label>
                    <div class="col-md-7">
                        <input type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->name }}" required/>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-md-5 col-form-label">Email</label>
                    <div class="col-md-7">
                        <input type="email" name="email" class="form-control" id="name" value="{{ Auth::user()->email }}" readonly/>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-md-5 col-form-label">No. Whatsapp</label>
                    <div class="col-md-7">
                        <input type="text" name="phone" class="form-control" id="phone"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                        maxlength="15" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-4">
                    <button type="submit" class="btn btn-info float-right">
                        Selanjutnya
                        <i class="fa fa-chevron-circle-right"></i>
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
