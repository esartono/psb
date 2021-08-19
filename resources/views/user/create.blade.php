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
                        <a href="ppdb" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="vue-form-wizard xs">
                        <div class="wizard-header">
                            <h4 class="wizard-title"></h4>
                            <p class="category"></p>
                        </div>
                        <div class="wizard-navigation">
                            <div class="wizard-progress-with-circle">
                                <div class="wizard-progress-bar green bg-green" style="width: 6.25%;">
                                </div>
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
                                <li>
                                    <a href="tambahcalon/{{ $step }}" class="{{ $step > 1 ? '' : 'disabled' }}">
                                        <div role="tab" class="wizard-icon-circle md {{ $step > 1 ? 'bg-green' : 'bg-grey' }}">
                                            <div class="wizard-icon-container {{ $step > 1 ? 'bg-green' : 'bg-grey' }}">
                                                <i class="wizard-icon fas fa-school"></i>
                                            </div>
                                        </div>
                                        <span class="stepTitle green">Pilih Unit</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="wizard-tab-content">
                                @include('user.form.'.($step))
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
