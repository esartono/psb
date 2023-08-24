@extends('front.template1')

@section('isi')

<style type="text/css">

    body {
        color: black
    }
    .jarak {
        margin-bottom: 10px;
    }
    table, th, td {
        border: 1px solid black !important;
    }
    th {
        background-color: aquamarine;
        font-weight: 800;
        color: black;
        text-align: center;
    }
    .roman li {
        list-style: upper-roman;
        display: list-item;
        font-weight: 800;
        margin: 4px 0 8px 0;
        color: #000;
    }

    .biasa li {
        list-style: decimal;
        display: list-item;
        font-weight: 400;
        text-transform: none;
        color: #000;
        margin: 0 0 0 30px;
        padding: 0;
    }

    .step1 li {
        list-style: lower-latin;
        font-weight: 400;
        text-transform: none;
    }

    .step2 li {
        list-style-type: square;
        font-weight: 400;
        text-transform: none;
    }
    .khusus {
        border: 0px !important;
    }
    .khusus th, .khusus td {
        padding: 3px !important;
        border: 0px !important;
    }
    .card-header .title {
        font-size: 17px;
        color: #000;
    }
    .card-header .accicon {
    float: right;
    font-size: 20px;  
    width: 1.2em;
    }
    .card-header{
    cursor: pointer;
    border-bottom: none;
    }
    .card{
    border: 1px solid #ddd;
    }
    .card-body{
    border-top: 1px solid #ddd;
    }
    .card-header:not(.collapsed) .rotate-icon {
    transform: rotate(180deg);
    }

</style>
<section class="banner-area relative">
    <div class="container">
        <div class="section-top-border justify-content-center">
            <h3 class="mt-60 mb-2 text-white"></h3>
            <h4 class="mb-20 text-white">Questions and Answers (Q&A)</h4>
            <div class="progress-table-wrap">
                <div class="accordion" id="accordionExample">
                    @foreach ($faq as $k=>$f )
                    <div class="card">
                        <div class="card-header" data-toggle="collapse" data-target="#collapse{{ $k }}" aria-expanded="true">     
                            <span class="title">{!! $f->tanya !!}</span>
                            <span class="accicon"><i class="fa fa-angle-down rotate-icon"></i></span>
                        </div>
                        <div id="collapse{{ $k }}" class="collapse" data-parent="#accordionExample">
                            <div class="card-body">
                                {!! $f->jawab !!}
                            </div>
                        </div>
                    </div>                        
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
