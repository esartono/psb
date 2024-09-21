@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card border-info">
                <p class="text-center">Grafik Unit TK</p>
                <canvas id="grafikTK"></canvas>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card border-info">
                <p class="text-center">Grafik Unit SD</p>
                <canvas id="grafikSD"></canvas>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card border-info">
                <p class="text-center">Grafik Unit SMP</p>
                <canvas id="grafikSMP"></canvas>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="card border-info">
                <p class="text-center">Grafik Unit SMA</p>
                <canvas id="grafikSMA"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('jawa')
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script type="text/javascript">
    var tk = document.getElementById('grafikTK').getContext('2d');
    var sd = document.getElementById('grafikSD').getContext('2d');
    var smp = document.getElementById('grafikSMP').getContext('2d');
    var sma = document.getElementById('grafikSMA').getContext('2d');

    var options = {
        responsive: true,
        scales: {
            y: {
                type: 'linear',
                display: true,
                position: 'left',
            },
        },
        plugins: {
            datalabels: {
                backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                },
                borderRadius: 4,
                color: 'white',
                font: {
                    weight: 'bold'
                },
                formatter: Math.round,
                padding: 6
            },
            legend: {
                display: false
            }
        }
    }

    var grafikTK = new Chart(tk, {
        type: 'line',
        plugins: [ChartDataLabels],
        data: {
            labels: @json($label),
            datasets: [
                {
                    label: 'TK',
                    data: @json($tk['data']),
                    backgroundColor: 'orange',
                    borderColor: 'orange',
                },
                {
                    label: 'Target TK',
                    data: @json($tk['target']),
                    backgroundColor: 'orange',
                    datalabels: {
                        display: false
                    }
                }
            ]
        },
        datalabels: {
            align: 'end',
            anchor: 'end'
        },
        options: options
    });

    var grafikSD = new Chart(sd, {
        type: 'line',
        plugins: [ChartDataLabels],
        data: {
            labels: @json($label),
            datasets: [
                {
                    label: 'SD',
                    data: @json($sd['data']),
                    backgroundColor: 'green',
                    borderColor: 'green',
                },
                {
                    label: 'Target SD',
                    data: @json($sd['target']),
                    backgroundColor: 'green',
                    datalabels: {
                        display: false
                    }
                }
            ]
        },
        datalabels: {
            align: 'end',
            anchor: 'end'
        },
        options: options
    });

    var grafikSMP = new Chart(smp, {
        type: 'line',
        plugins: [ChartDataLabels],
        data: {
            labels: @json($label),
            datasets: [
                {
                    label: 'SMP',
                    data: @json($smp['data']),
                    backgroundColor: 'blue',
                    borderColor: 'blue',
                },
                {
                    label: 'Target SMP',
                    data: @json($smp['target']),
                    backgroundColor: 'blue',
                    datalabels: {
                        display: false
                    }
                }
            ]
        },
        datalabels: {
            align: 'end',
            anchor: 'end'
        },
        options: options
    });

    var grafikSMA = new Chart(sma, {
        type: 'line',
        plugins: [ChartDataLabels],
        data: {
            labels: @json($label),
            datasets: [
                {
                    label: 'SMA',
                    data: @json($sma['data']),
                    backgroundColor: 'brown',
                    borderColor: 'brown',
                },
                {
                    label: 'Target SMA',
                    data: @json($sma['target']),
                    backgroundColor: 'brown',
                    datalabels: {
                        display: false
                    }
                }
            ]
        },
        datalabels: {
            align: 'end',
            anchor: 'end'
        },
        options: options
    });
</script>
@endpush