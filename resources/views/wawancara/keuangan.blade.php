@extends('layouts.app')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 mt-3">
            <div class="callout callout-info">
              <form method="POST" action="{{ route('getCalon') }}">
                <div class="col-md-6 offset-md-3 input-group mt-3 mb-3">
                  @csrf
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-info"></i> &nbsp; &nbsp;Masukan No. Pendaftaran :
                    </span>
                  </div>
                  <input type="text" name="id"
                    class="form-control" placeholder="No. Pendaftaran"
                    minlength="9" maxlength="9">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-danger">Cari</button>
                  </div>
                </div>
              </form>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection
