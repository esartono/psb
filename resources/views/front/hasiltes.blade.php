<div class="col-6 offset-3 mt-3">
	<div class="card border-secondary">
		<div class="card-header">
			<h4>{{ $calon->name }}</h4>
		</div>
		<div class="card-body bg-secondary">
			@if($hasils->lulus == 0)
				<h2 class="mt-3 text-white">Belum Ada Pengumuman</h2>
			@endif
			@if($hasils->lulus > 0)
				Berdasarkan keputusan panitia PPDB SIT Nurul Fikri dinyatakan:
				<h2 class="mt-3 text-white"> {{ $arrayhasil[$hasils->lulus] }} </h2>
				<hr>
				<p>{{ $hasils->catatan }}</p>
				<hr>
				<a href="ppdb" class="btn btn-danger"> Login </a>
			@endif
		</div>
	</div>
</div>
