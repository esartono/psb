<style>
    .datepicker tr td-:last-of-type {
        width: 20px !important;
    }
</style>

<div class="text-center">
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=6>
        <div class="card-group">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Data Ayah</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Nama Lengkap</label>
                        <div class="col-md-7">
                            <input type="text" name="ayah_nama" class="form-control" id="ayah_nama" placeholder="Nama Ayah" >
                            <has-error :form="form" field="ayah_nama"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Pendidikan</label>
                        <div class="col-md-7">
                            <select name="ayah_pendidikan" class="form-control" id="ayah_pendidikan">
                                <option selected="true" disabled="disabled">Pilih Pendidikan Ayah</option>
                                @foreach ($pendidikan as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}
                                @endforeach
                            </select>
                            <has-error :form="form" field="ayah_pendidikan"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Pekerjaan</label>
                        <div class="col-md-7">
                            <select name="ayah_pekerjaan" class="form-control" id="ayah_pekerjaan">
                                <option selected="true" disabled="disabled">Pilih Pekerjaan Ayah</option>
                                @foreach ($pekerjaan as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}
                                @endforeach
                            </select>
                            <has-error :form="form" field="ayah_pekerjaan"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Penghasilan</label>
                        <div class="col-md-7">
                            <input type="text" name="ayah_penghasilan" class="form-control" id="ayah_penghasilan" required
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            <has-error :form="form" field="ayah_penghasilan"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">No. Ponsel</label>
                        <div class="col-md-7">
                            <input type="text" name="ayah_hp" class="form-control" id="ayah_hp"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            <has-error :form="form" field="ayah_hp"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Alamat E-mail</label>
                        <div class="col-md-7">
                            <input type="email" name="ayah_email" class="form-control" id="ayah_email" >
                            <has-error :form="form" field="ayah_email"></has-error>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Data Ibu</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Nama Lengkap</label>
                        <div class="col-md-7">
                            <input type="text" name="ibu_nama" class="form-control" id="ibu_nama" placeholder="Nama Ibu" >
                            <has-error :form="form" field="ibu_nama"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Pendidikan</label>
                        <div class="col-md-7">
                            <select name="ibu_pendidikan" class="form-control" id="ibu_pendidikan">
                                <option selected="true" disabled="disabled">Pilih Pendidikan Ibu</option>
                                @foreach ($pendidikan as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}
                                @endforeach
                            </select>
                            <has-error :form="form" field="ibu_pendidikan"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Pekerjaan</label>
                        <div class="col-md-7">
                            <select name="ibu_pekerjaan" class="form-control" id="ibu_pekerjaan">
                                <option selected="true" disabled="disabled">Pilih Pekerjaan Ibu</option>
                                @foreach ($pekerjaan as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}
                                @endforeach
                            </select>
                            <has-error :form="form" field="ibu_pekerjaan"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Penghasilan</label>
                        <div class="col-md-7">
                            <input type="text" name="ibu_penghasilan" class="form-control" id="ibu_penghasilan" required
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            <has-error :form="form" field="ibu_penghasilan"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">No. Ponsel</label>
                        <div class="col-md-7">
                            <input type="text" name="ibu_hp" class="form-control" id="ibu_hp"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            <has-error :form="form" field="ibu_hp"></has-error>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-5 col-form-label">Alamat E-mail</label>
                        <div class="col-md-7">
                            <input type="email" name="ibu_email" class="form-control" id="ibu_email" >
                            <has-error :form="form" field="ibu_email"></has-error>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn bg-blue float-right">
            Selanjutnya
            <i class="fa fa-chevron-circle-right"></i>
        </button>
    </form>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<script type="application/javascript" src="/js/daerah.js"></script>
