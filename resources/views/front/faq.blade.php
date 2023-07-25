@extends('front.template1')

@section('isi')
<style>
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
            <h4 class="mb-20 text-white">Frequently Asked Question (faq)</h4>
            <div class="progress-table-wrap">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">     
                            <span class="title"> Kapan proses pendaftaran untuk tahun ajaran baru dibuka </span>
                            <span class="accicon"><i class="fa fa-angle-down rotate-icon"></i></span>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                            <div class="card-body">
                                Proses pendaftaran untuk tahun ajaran baru dibuka sekitar bulan September awal. Lebih baik untuk menanyakan secara langsung untuk proses tahapan awal-akhir nya pada pihak admission sekolah melalui WhatsApp (0812-xxxx-xxxx) atau email yang sudah disediakan (psb@nurulfikri.sch.id).
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">     
                            <span class="title"> Kapan proses pendaftaran ditutup?</span>
                            <span class="accicon"><i class="fa fa-angle-down rotate-icon"></i></span>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                            <div class="card-body">
                                Proses pendaftaran akan ditutup apabila kuota kelas yang sudah ada terpenuhi. Apabila ada yang mendaftar ketika kuota kelas terpenuhi, maka akan dimasukan kedalam <i>waiting list</i>. Lebih baik untuk menanyakan secara langsung untuk proses tahapan awal-akhir nya pada pihak admission sekolah melalui WhatsApp (0812-xxxx-xxxx) atau email yang sudah disediakan (psb@nurulfikri.sch.id).
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false">
                            <span class="title">Apa saja dokumen yang dibutuhkan untuk proses pendaftaran? </span>
                            <span class="accicon"><i class="fa fa-angle-down rotate-icon"></i></span>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Jenjang SD :</p>
                                <ol class="biasa">
                                    <li>KTP Ayah</li>
                                    <li>KTP Ibu</li>
                                    <li>Akta Kelahiran</li>
                                    <li>Kartu Keluarga</li>
                                    <li>Ijazah TK (menyusul)</li>
                                    <li>Rapor TK (menyusul)</li>
                                </ol>
                                <p class="mt-30">Jenjang SMP & SMA :</p>
                                <ol class="biasa">
                                    <li>KTP Ayah</li>
                                    <li>KTP Ibu</li>
                                    <li>Akta Kelahiran</li>
                                    <li>Kartu Keluarga</li>
                                    <li>Surat Keterangan Kelakuan Baik dari sekolah asal</li>
                                    <li>Rapor SD/SMP (menyusul)</li>
                                    <li>Ijazah SD/SMP (menyusul)</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
