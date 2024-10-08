@extends('front.template1')

@section('isi')
<style type="text/css">

    body {
        color: black
    }
    .biaya_pisah {
        margin-top: -20px;
    }
    .jarak {
        margin-bottom: 10px;
    }
    table, th, td {
        border: 1px solid black !important;
    }
    td { line-height: 2; }
    th {
        background-color: aquamarine;
        font-weight: 800;
        color: black;
    }
    .roman li {
        list-style: upper-roman;
        display: list-item;
        font-weight: 800;
        color: #000;
        margin-bottom: 20px;
    }

    .biasa li {
        list-style: decimal;
        font-weight: 400;
        text-transform: none;
        padding: 0 0 0 10px;
        margin: 0 0 0 20px;
    }

    .step1 li {
        list-style: lower-latin;
        font-weight: 400;
        text-transform: none;
    }

</style>
<section class="banner-area relative">
    <div class="container">
        <div class="section-top-border justify-content-center">
            <div class="section-top-border justify-content-center">
                <div class="progress-table" style="padding: 25px 50px">
                    @include('wawancara.tatacara')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection