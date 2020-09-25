@extends('layouts.keu')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- <div class="offset-md-1 col-md-4 mt-3">
            <div class="callout callout-info">
              <form method="POST" action="{ route('getCalon') }">
                <div class="input-group mt-3 mb-3">
                  @csrf
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-info"></i> &nbsp; No. Pendaftaran :
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
              @if (\Session::has('error'))
                <div class="alert alert-danger">
                  <h4>{!! \Session::get('error') !!}</h4>
                </div>
              @endif
            </div> -->
          <!-- </div>/.col -->
          <div class="offset-md-2 col-md-8 mt-3">
            <router-view></router-view>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection
