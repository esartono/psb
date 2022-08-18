<style>
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

    .step1 {
        text-indent: -20px;
        padding-left: 20px;
        margin: 0 0 0 -50px;
    }

    .step1 li {
        list-style: none;
    }

    .step2 {
        text-indent: -30px;
        padding-left: 20px;
        counter-reset: elementcounter;
    }

    .step2 li{
        list-style-type: none;
    }

    .step2>li:before {
        content: "(" counter(elementcounter) "). ";
        counter-increment: elementcounter;
    }

    .step3 {
        text-indent: 0px;
        padding-left: 0px;
    }
    .step3 li {
        list-style: lower-roman;
    }
    .jarak {
        margin-bottom: 10px;
    }
</style>
<section class="faculty-area">
    <div class="container">
        <div class="row justify-content-center d-flex align-items-center">
            <h3 class="mt-40">Ketentuan Biaya Pendidikan</h3>
            <div class="col-sm-12">
                @include('wawancara.'.substr($tp,0,4).'.ketentuan')
            </div>
        </div>
    </div>
</section>
