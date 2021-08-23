@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-md-10">
            <div class="card card-primary card-outline">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-upload"></i>
                        Form Pendaftaran
                    </h3>
                    <div class="card-tools">
                        <a href="/ppdb" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="vue-form-wizard xs">
                        <div class="wizard-navigation">
                            <div class="wizard-progress-with-circle">
                                <div class="wizard-progress-bar green bg-green" style="width: {{ ($step*12.50)-6.25 }}%;"></div>
                            </div>
                            <ul class="wizard-nav wizard-nav-pills">
                                <li>
                                    <a href="/tambahcalon/1">
                                        <div role="tab" class="wizard-icon-circle md bg-green">
                                            <div class="wizard-icon-container bg-green">
                                                <i class="wizard-icon fas fa-user"></i>
                                            </div>
                                        </div>
                                        <span class="stepTitle green">Baru/Pindahan</span>
                                    </a>
                                </li>
                                @foreach ($pilihan as $k => $p)
                                    <li>
                                        <a href="tambahcalon/{{ $step }}" class="{{ $step > $k+1 ? '' : 'disabled' }}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
