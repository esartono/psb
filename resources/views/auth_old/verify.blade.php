@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header card-warning card-outline bg-red white">{{ __('Verifikasi Email Anda') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Link verifikasi yang baru telah dikirim ke email Anda') }}
                        </div>
                    @endif

                    {{ __('Sebelum melanjutkan, silahkan cek email Anda untuk melanjutkan') }}
                    {{-- {{ __('Jika anda belum menerima Email dari Kami') }}, <a href="{{ route('verification.resend') }}">{{ __('silahkan klik di sini') }}</a>. --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
