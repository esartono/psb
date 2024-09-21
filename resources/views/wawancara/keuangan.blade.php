@extends('layouts.keu')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-1 col-md-10 mt-3">
            <router-view></router-view>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</section>
@endsection
