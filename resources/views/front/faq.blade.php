@extends('front.template1')

@section('isi')

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="section-title position-relative mb-4 pb-4">
                    <h2 class="mb-2">Questions and Answers</h2>
                </div>
                <div class="accordion" id="accordionExample">
                    @foreach ($faq as $k=>$f )
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $k }}" aria-expanded="true" aria-controls="collapse{{ $k }}">
                                {!! $f->tanya !!}
                            </button>
                        </h2>
                        <div id="collapse{{ $k }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
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
<!-- About End -->
@endsection
