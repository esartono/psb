@extends('layouts.user')

@push('css_khusus')
<link rel="stylesheet" href="/multiStepForm/style.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<style type="text/css">
    @media only screen and (max-width: 450px) {
        .stepTitle {
            display: none;
        }
    }
    .required:after {
        content:"*";
        color: red;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-md-12">
            <div class="card text-dark bg-light mb-3" style="margin-bottom: 10rem !important">
                <div class="card-header bg-primary">
                    <h5 class="card-title text-white">
                        <i class="fas fa-upload"></i>
                        Form Pendaftaran
                        <a href="/ppdb" type="button" class="btn bg-secondary btn-sm text-white float-end">
                            <i class="fas fa-times"></i>
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="progresses">
                            <div class="steps active">
                                {{-- <a href="/tambahcalon/1"><span class="mdi mdi-clipboard-account {{ $step == 0 ? 'disabled' : ''}}"></span></a> --}}
                                <a><span class="mdi mdi-clipboard-account {{ $step == 0 ? 'disabled' : ''}}"></span></a>
                            </div>
                            @foreach ($pilihan as $k => $p)
                                <span class="line"></span>
                                <div class="steps {{ $step > $p['no'] ? 'active' : '' }}">
                                    @if( $step > $p['no'] )
                                        <a><span class="{{ $p['icon'] }}"></span></a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        @include('user.form.'.($step))
                    </div>

                    {{-- <div class="vue-form-wizard xs">
                        <div class="wizard-navigation">
                            <div class="wizard-progress-with-circle">
                                @if($step > 8)
                                    <div class="wizard-progress-bar green bg-green" style="width: {{ ($step*20)-10 }}%;"></div>
                                @else
                                    <div class="wizard-progress-bar green bg-green" style="width: 100%;"></div>
                                @endif
                            </div>
                            <ul class="wizard-nav wizard-nav-pills">
                                <li>
                                    <a href="/tambahcalon/1" class="{{ $step == 0 ? 'disabled' : ''}}">
                                        <div role="tab" class="wizard-icon-circle md {{ $step == 0 ? 'bg-grey' : 'bg-green'}}">
                                            <div class="wizard-icon-container {{ $step == 0 ? 'bg-grey' : 'bg-green'}}">
                                                <i class="wizard-icon fas fa-user"></i>
                                            </div>
                                        </div>
                                        <span class="stepTitle green">Baru/Pindahan</span>
                                    </a>
                                </li>
                                @foreach ($pilihan as $k => $p)
                                    <li>
                                        <a href="/tambahcalon/{{ $k+2 }}" class="{{ $step > $k+1 ? '' : 'disabled' }}">
                                            <div role="tab" class="wizard-icon-circle md {{ $step > $k+1 ? 'bg-green' : 'bg-grey' }}">
                                                <div class="wizard-icon-container {{ $step > $k+1 ? 'bg-green' : 'bg-grey' }}">
                                                    <i class="wizard-icon {{ $p['icon'] }}"></i>
                                                </div>
                                            </div>
                                            <span class="stepTitle green">{{ $p['name'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <hr>
                            <div>
                                @include('user.form.'.($step))
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<form id="batal" action="{{ route('bataldaftar') }}" method="POST" style="display: none;">
    @method('DELETE')
    @csrf
</form>

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
        setDate: new Date('{{ $age }}'),
        endDate: new Date('{{ $min_age }}')
    });
</script>
@endpush
