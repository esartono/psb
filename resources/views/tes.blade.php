@extends('front.template1')

@section('isi')
	<section class="banner-area relative">
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center text-center">
				<div class="col-lg-4">
					<img style="width: 50%" src="/img/logo.png" alt="Logo">
				</div>
				<div class="about-content col-lg-8">
					<h4 class="mb-2">Link Tes PPDB SIT Nurul Fikri</h4>
					<p class="mb-5">Silahkan klik untuk melakukan tes :</p>
						<a href="https://testppdb.nurulfikri.sch.id/"
							class="btn btn-outline-success btn-lg col-6 mb-4 text-start disabled"
							tabindex="-1" role="button" aria-disabled="true">
							<i class="fas fa-keyboard"></i> &nbsp; &nbsp;
							Tes Akademik
						</a>
						{{-- <a href="https://bit.ly/asesmen14sep" class="btn btn-outline-info btn-lg">
							<i class="fas fa-chalkboard-teacher"></i> &nbsp; &nbsp;
							Tes Psikologi : 14 September 2024
						</a> --}}
						{{-- <a href="https://bit.ly/asesmen15sep" class="btn btn-outline-info btn-lg">
							<i class="fas fa-chalkboard-teacher"></i> &nbsp; &nbsp;
							Tes Psikologi : 15 September 2024
						</a> --}}
						<a href="https://bit.ly/asesmen21sep" class="btn btn-outline-info btn-lg col-6 text-start">
							<i class="fas fa-chalkboard-teacher"></i> &nbsp; &nbsp;
							Tes Psikologi : 21 September 2024
						</a>
				</div>
			</div>
		</div>
	</section>
@endsection
