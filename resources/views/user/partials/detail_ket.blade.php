<div class="col-lg-4 col-md-4">
  <div class="nav flex-column nav-tabs h-100" aria-orientation="vertical" style="border-bottom: 0;">
    <p class="nav-link status active">
      1. Pendaftaran
      @if($calon->tahap >= 1)
        <i class="fa-solid fa-circle-check float-end text-success"></i>
      @else
        <i class="fa-solid fa-circle-xmark float-end text-danger"></i>
      @endif
    </p>
    <p class="nav-link status active">
      2. Lunas Biaya Pendaftaran
      @if($calon->tahap >= 2)
        <i class="fa-solid fa-circle-check float-end text-success"></i>
      @else
        <i class="fa-solid fa-circle-xmark float-end text-danger"></i>
      @endif
    </p>
    <p class="nav-link status active">
      3. Kelengkapan Data dan Berkas
      @if($calon->tahap >= 2)
        <i class="fa-solid fa-circle-check float-end text-success"></i>
      @else
        <i class="fa-solid fa-circle-xmark float-end text-danger"></i>
      @endif
    </p>
    <p class="nav-link status active">
      4. Seleksi
      @if($calon->tahap >= 3)
      <i class="fa-solid fa-circle-check float-end text-success"></i>
      @else
        <i class="fa-solid fa-circle-xmark float-end text-danger"></i>
      @endif
    </p>
    <p class="nav-link status active">
      5. Pengumuman
      @if($calon->tahap >= 4)
      <i class="fa-solid fa-circle-check float-end text-success"></i>
      @else
        <i class="fa-solid fa-circle-xmark float-end text-danger"></i>
      @endif
    </p>
    <p class="nav-link status active">
      6. Daftar Ulang
      @if($calon->tahap >= 5)
      <i class="fa-solid fa-circle-check float-end text-success"></i>
      @else
        <i class="fa-solid fa-circle-xmark float-end text-danger"></i>
      @endif
    </p>
    <p class="nav-link status active">
      7. Input Seragam
      @if($calon->tahap >= 6)
      <i class="fa-solid fa-circle-check float-end text-success"></i>
      @else
        <i class="fa-solid fa-circle-xmark float-end text-danger"></i>
      @endif
    </p>
    <p class="nav-link status active">
      8. Pengambilan Seragam
      @if($calon->tahap >= 7)
      <i class="fa-solid fa-circle-check float-end text-success"></i>
      @else
        <i class="fa-solid fa-circle-xmark float-end text-danger"></i>
      @endif
    </p>
    <p class="nav-link status active">
      9. Pengambilan Media Pembelajaran
      @if($calon->tahap >= 9)
      <i class="fa-solid fa-circle-check float-end text-success"></i>
      @else
        <i class="fa-solid fa-circle-xmark float-end text-danger"></i>
      @endif
    </p>
    <p class="nav-link status active">
      10. Masa Orientasi Siswa
      @if($calon->tahap >= 9)
      <i class="fa-solid fa-circle-check float-end text-success"></i>
      @else
        <i class="fa-solid fa-circle-xmark float-end text-danger"></i>
      @endif
    </p>
  </div>
</div>
<div class="col-lg-8 col-md-8">
  @if($calon->tahap == 8 || $calon->tahap == 8.5)
      @include('user.tahapan.8')
  @else
      @include('user.tahapan.'.$calon->tahap)
  @endif
</div>