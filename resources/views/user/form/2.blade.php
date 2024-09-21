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
    <h5 class="mb-5">Pilih Unit yang akan di tuju </h5>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value="2">
        <div class="row justify-content-around">
            @foreach ($units as $unit)
            <div class="col-lg-3 col-md-6">
                <button type="submit" name="unit" value="{{ $unit->id }}" class="col-12 inbox-left-sd btn border-{{ $code_unit[$unit->cat_id] }} bg-{{ $code_unit[$unit->cat_id] }}" style="border-style: solid; border-width: 1px">
                    <div class="breadcomb-wp" style="padding: 0 !important; display: block !important">
                        <div class="breadcomb-ctn" style="margin: 0px !important">
                            <h4 class="text-white mt-2">{{ $unit->name }}</h4>
                        </div>
                    </div>
                </button>
            </div>
            @endforeach
        </div>
    </form>
</div>
@include('user.form.batal')