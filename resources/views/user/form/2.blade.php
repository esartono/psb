<style type="text/css">
    .jk-warna {
        color:white;
        position: relative;
        top: -15px;
        right: -50px;
        padding: 10px 0px;
        background-color: red;
        margin-bottom: -35px;
        border-radius: 10px;
        font-size: 80%;
        rotate: -15deg;
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
        $code_unit = ['kb', 'tk', 'sd', 'smp', 'sma']
    @endphp
    <h5 class="mb-5">Pilih Unit yang akan di tuju </h5>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value="2">
        <div class="row justify-content-around">
            @foreach ($units as $unit)
            <div class="col-lg-2 col-md-4">
                <button type="submit" name="unit" value="{{ $unit->id }}" class="col-12 inbox-left-sd btn border-{{ $code_unit[$unit->cat_id] }} bg-{{ $code_unit[$unit->cat_id] }}" style="border-style: solid; border-width: 1px">
                    <div class="breadcomb-wp" style="padding: 0 !important; display: block !important">
                        <div class="breadcomb-ctn" style="margin: 0px !important">
                            <p class="text-white mt-2" style="font-size: 1rem; font-weight: bold">{{ $unit->name }}</p>
                        </div>
                    </div>
                </button>
                @if($jk[$unit->id] > 0)
                    <div class="jk-warna">* hanya kelas {{ ($jk[$unit->id] == 1 ? 'PUTRA' : 'PUTRI') }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </form>
</div>
@include('user.form.batal')