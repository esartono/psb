@extends('front.template1')

@section('isi')
	<section class="banner-area relative">
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h2 class="text-white">Hasil Tes Seleksi</h2>
					@if($calons)
						@foreach ($calons as $calon)
							@include('front.hasiltes')
						@endforeach
					@else
						<form action="/gethasil" class="mt-3" method="POST">
						{{ csrf_field() }} 
							<div class="mt-10">
								<input style="width: 30%; padding: 10px" type="text" name="id" placeholder="No. Pendaftaran" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukan No. Pendaftaran'" required>
							</div>
						</form>
					@endif
				</div>
			</div>
		</div>
	</section>
@endsection
