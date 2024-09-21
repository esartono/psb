<style type="text/css">
    .jk-warna {
        color:white;
        position: relative;
        top: -30px;
        padding: 5px;
        background-color: red;
        margin-bottom: -35px;
    }
    .jk-bening {
        color:white;
        position: relative;
        top: -30px;
        padding: 5px;
        margin-bottom: -35px;
    }
</style>
<div class="text-center">
    @php
        $code_unit = ['', 'tk', 'sd', 'smp', 'sma']
    @endphp
    @isset($cekkelas)
        <h5 class="mb-5">Pilih Kelas yang akan di tuju </h5>
        <form role="form" method="POST" action="{{ route('add.calon') }}">
            @csrf
            <input type="hidden" name="step" value="3">
            <div class="row justify-content-around">
                @foreach ($cekkelas as $kelas)
                <div class="col-lg-3 col-md-6">
                    <button type="submit" name="kelas_tujuan" value="{{ $kelas->id }}" class="col-12 inbox-left-sd btn border-{{ $code_unit[$cekunit] }}" style="border-style: solid; border-width: 1px">
                        <div class="breadcomb-wp" style="padding: 0 !important; display: block !important">
                            <div class="breadcomb-ctn" style="margin: 0px !important">
                                <h4 class="color-{{ $code_unit[$cekunit] }} mt-2"> Kelas {{ $kelas->name }}</h4>
                                {{-- <p class="text-white" style="border-top: 1px solid white">siswa baru untuk tahun ajaran {{ taKemarin() }}</p> --}}
                            </div>
                        </div>
                    </button>
                </div>
                @endforeach
            </div>
        </form>    
    @endisset
</div>
@include('user.form.batal')