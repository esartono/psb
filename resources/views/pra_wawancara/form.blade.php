@extends('layouts.user')

@section('content')

@push('css_khusus')
<style>
    td {
        vertical-align: top;
        padding: 0 5px;
    }
    th {
        text-align: center;
    }
</style>
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-lg-10 col-md-10" style="margin-bottom: 75px;">
            <form method="POST" action="{{ route('praWawancara.store') }}">
            @csrf
            <input type="hidden" name="calon_id" value="{{ $calon->id }}">
            <input type="hidden" name="kategori" value="ortu">
            <div class="card card-primary card-outline" style="margin-bottom: 5rem !important">
                <div class="card-header bg-primary">
                    <h5 class="card-title text-white">
                        <i class="fas fa-upload"></i>
                        Form Kelengkapan Seleksi Wawancara Orang Tua
                        <a href="/ppdb/{{ $calon->id }}" type="button" class="btn bg-secondary btn-sm text-white float-end">
                            <i class="fas fa-times"></i>
                        </a>
                    </h5>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 20% !important">No. Pendaftaran</td>
                        <td>{{ $calon->uruts }}</td>
                    </tr>
                    <tr>
                        <td>Nama Calon Siswa</td>
                        <td>{{ $calon->name }}</td>
                    </tr>
                </table>
                <div class="card-body">
                    <div class="alert alert-info">
                        <p>Berikut adalah formulir kelengkapan seleksi. Mohon Bapak/Ibu mengisi dengan sebenarnya, sebagai bagian dari proses PPDB Nurul Fikri Islamic School.
                        Jawaban yang Bapak/Ibu berikan sangat bermakna bagi kami dalam proses PPDB ananda.</p>
                        <p>Pertanyaan dan jawaban ini bersifat rahasia, mohon tidak mengambil gambar (memfoto atau screenshot) dan membagikan dalam bentuk apa pun. Terimakasih atas kerjasama Bapak/Ibu.</p>
                    </div>
                    <hr>
                    <div class="alert">
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>1. </td>
                                    <td>Apa harapan Bapak/Ibu dalam menyekolahkan ananda di Nurul Fikri Islamic School?</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[1]" value="1">
                            <input type="hidden" name="no[1]" value="1">
                            <input type="hidden" name="pertanyaan[1]" value="Apa harapan Bapak/Ibu dalam menyekolahkan ananda di Nurul Fikri Islamic School?">
                            <input type="hidden" name="catatan[1]" value="">
                            <textarea class="form-control" name="jawaban[1]" required @isset($jawaban[1]) @if($jawaban[1]) readonly @endif @endisset> @isset($jawaban[1]) @if($jawaban[1]){{ $jawaban[1] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>2. </td>
                                    <td>Apa yang Bapak/Ibu lakukan jika ada harapan tersebut yang belum terpenuhi?</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[2]" value="2">
                            <input type="hidden" name="no[2]" value="2">
                            <input type="hidden" name="pertanyaan[2]" value="Apa yang Bapak/Ibu lakukan jika ada harapan tersebut yang belum terpenuhi?">
                            <input type="hidden" name="catatan[2]" value="">
                            <textarea class="form-control" name="jawaban[2]" required @isset($jawaban[2]) @if($jawaban[2]) readonly @endif @endisset> @isset($jawaban[2]) @if($jawaban[2]){{ $jawaban[2] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>3. </td>
                                    <td>Apakah Bapak/Ibu mendaftarkan ananda di sekolah lainnya? Berikan alasan</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[3]" value="3">
                            <input type="hidden" name="no[3]" value="3">
                            <input type="hidden" name="pertanyaan[3]" value="Apakah Bapak/Ibu mendaftarkan ananda di sekolah lainnya? Berikan alasan">
                            <input type="hidden" name="catatan[3]" value="">
                            <textarea class="form-control" name="jawaban[3]" required @isset($jawaban[3]) @if($jawaban[3]) readonly @endif @endisset> @isset($jawaban[3]) @if($jawaban[3]){{ $jawaban[3] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>4. </td>
                                    <td>Jika Bapak/Ibu mendaftarkan ananda di sekolah lain dan keduanya diterima, sekolah mana yang akan Bapak/Ibu pilih? Berikan alasannya</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[4]" value="4">
                            <input type="hidden" name="no[4]" value="4">
                            <input type="hidden" name="pertanyaan[4]" value="Jika Bapak/Ibu mendaftarkan ananda di sekolah lain dan keduanya diterima, sekolah mana yang akan Bapak/Ibu pilih? Berikan alasannya">
                            <input type="hidden" name="catatan[4]" value="">
                            <textarea class="form-control" name="jawaban[4]" required @isset($jawaban[4]) @if($jawaban[4]) readonly @endif @endisset> @isset($jawaban[4]) @if($jawaban[4]){{ $jawaban[4] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>5. </td>
                                    <td>Bagaimana peran Bapak/Ibu dalam mengontrol penegakkan ibadah shalat wajib ananda?</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[5]" value="5">
                            <input type="hidden" name="no[5]" value="5">
                            <input type="hidden" name="pertanyaan[5]" value="Bagaimana peran Bapak/Ibu dalam mengontrol penegakkan ibadah shalat wajib ananda?">
                            <input type="hidden" name="catatan[5]" value="">
                            <textarea class="form-control" name="jawaban[5]" required @isset($jawaban[5]) @if($jawaban[5]) readonly @endif @endisset> @isset($jawaban[5]) @if($jawaban[5]){{ $jawaban[5] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>6. </td>
                                    <td>Untuk meningkatkan kualitas Rohani siswa, sekolah NFIS mengadakan beberapa kegiatan keagamaan seperti di bawah ini, berikan persetujuan Anda terkait kegiatan tsb:</td>
                                    <input type="hidden" name="no_soal[6]" value="6">
                                    <input type="hidden" name="no[6]" value="6">
                                    <input type="hidden" name="pertanyaan[6]" value="Untuk meningkatkan kualitas Rohani siswa, sekolah NFIS mengadakan beberapa kegiatan keagamaan seperti di bawah ini, berikan persetujuan Anda terkait kegiatan tsb:">
                                    <input type="hidden" name="catatan[6]" value="">
                                    <input type="hidden" name="jawaban[6]" value="">
                                </tr></table>
                            </label>
                            <div class="mx-4">
                                <div class="mb-4">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="3%">No.</th>
                                            <th width="30%">Kegiatan</th>
                                            <th width="25%">Setuju/Tidak</th>
                                            <th width="42%">Alasan</th>
                                        </tr>
                                        <tr>
                                            <td>1. </td>
                                            <td>Zikir bersama secara rutin</td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jawaban[7]" id="inlineRadio1" value="1" required @isset($jawaban[7]) {{ ($jawaban[7] == "1") ? "checked" : "" }} @endisset>
                                                    <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jawaban[7]" id="inlineRadio2" value="0" @isset($jawaban[7]) {{ ($jawaban[7] == "0") ? "checked" : "" }} @endisset>
                                                    <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="hidden" name="no_soal[7]" value="6a">
                                                <input type="hidden" name="no[7]" value="7">
                                                <input type="hidden" name="pertanyaan[7]" value="Zikir bersama secara rutin">
                                                <textarea class="form-control" name="catatan[7]" required @isset($jawaban[7]) @if($catatan[7]) readonly @endif @endisset> @isset($jawaban[7]) @if($catatan[7]){{ $catatan[7] }}@endif @endisset</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2. </td>
                                            <td>Peringatan Maulid Nabi Muhammad SAW</td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jawaban[8]" id="inlineRadio3" value="1" required @isset($jawaban[8]) {{ ($jawaban[8] == "1") ? "checked" : "" }} @endisset>
                                                    <label class="form-check-label" for="inlineRadio3">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jawaban[8]" id="inlineRadio4" value="0" @isset($jawaban[8]) {{ ($jawaban[8] == "0") ? "checked" : "" }} @endisset>
                                                    <label class="form-check-label" for="inlineRadio4">Tidak Setuju</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="hidden" name="no_soal[8]" value="6b">
                                                <input type="hidden" name="no[8]" value="8">
                                                <input type="hidden" name="pertanyaan[8]" value="Peringatan Maulid Nabi Muhammad SAW">
                                                <textarea class="form-control" name="catatan[8]" required @isset($catatan[8]) @if($catatan[8]) readonly @endif @endisset> @isset($jawaban[8]) @if($catatan[8]){{ $catatan[8] }}@endif @endisset</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3. </td>
                                            <td>Lomba membaca Al Qur'an</td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jawaban[9]" id="inlineRadio5" value="1" required @isset($jawaban[9]) {{ ($jawaban[9] == "1") ? "checked" : "" }} @endisset>
                                                    <label class="form-check-label" for="inlineRadio5">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jawaban[9]" id="inlineRadio6" value="0" @isset($jawaban[9]) {{ ($jawaban[9] == "0") ? "checked" : "" }} @endisset>
                                                    <label class="form-check-label" for="inlineRadio6">Tidak Setuju</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="hidden" name="no_soal[9]" value="6c">
                                                <input type="hidden" name="no[9]" value="9">
                                                <input type="hidden" name="pertanyaan[9]" value="Lomba membaca Al Qur`an">
                                                <textarea class="form-control" name="catatan[9]" required @isset($catatan[9]) @if($catatan[9]) readonly @endif @endisset> @isset($jawaban[9]) @if($catatan[9]){{ $catatan[9] }}@endif @endisset</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4. </td>
                                            <td><i>Insight (Islamic Sharing and Gathering Time)- kegiatan pembinaan kepribadian Islam</i></td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jawaban[10]" id="inlineRadio7" value="1" required @isset($jawaban[10]) {{ ($jawaban[10] == "1") ? "checked" : "" }} @endisset>
                                                    <label class="form-check-label" for="inlineRadio7">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jawaban[10]" id="inlineRadio8" value="0" @isset($jawaban[10]) {{ ($jawaban[10] == "0") ? "checked" : "" }} @endisset>
                                                    <label class="form-check-label" for="inlineRadio8">Tidak Setuju</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="hidden" name="no_soal[10]" value="6d">
                                                <input type="hidden" name="no[10]" value="10">
                                                <input type="hidden" name="pertanyaan[10]" value="Insight (Islamic Sharing and Gathering Time)- kegiatan pembinaan kepribadian Islam">
                                                <textarea class="form-control" name="catatan[10]" required @isset($catatan[10]) @if($catatan[10]) readonly @endif @endisset> @isset($jawaban[10]) @if($catatan[10]){{ $catatan[10] }}@endif @endisset</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>7. </td>
                                    <td>Apakah Bapak dan Ibu sebagai orangtua memiliki aktivitas rutin untuk meningkatkan wawasan dan kualitas keislaman? Jika ada, dapat dijelaskan dalam bentuk kegiatannya seperti apa?</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[11]" value="7">
                            <input type="hidden" name="no[11]" value="11">
                            <input type="hidden" name="pertanyaan[11]" value="Apakah Bapak dan Ibu sebagai orangtua memiliki aktivitas rutin untuk meningkatkan wawasan dan kualitas keislaman? Jika ada, dapat dijelaskan dalam bentuk kegiatannya seperti apa?">
                            <input type="hidden" name="catatan[11]" value="">
                            <textarea class="form-control" name="jawaban[11]" required @isset($jawaban[11]) @if($jawaban[11]) readonly @endif @endisset> @isset($jawaban[11]) @if($jawaban[11]){{ $jawaban[11] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>8. </td>
                                    <td>Sekolah kami menggunakan teknologi informasi dan komunikasi dan seni untuk mendukung proses pembelajaran dengan tetap memperhatikan aspek-aspek keamanan dan Kesehatan. Bagaimana menurut pandangan Bapak/Ibu terhadap penggunaan beberapa hal berikut:</td>
                                    <input type="hidden" name="no_soal[12]" value="8">
                                    <input type="hidden" name="no[12]" value="12">
                                    <input type="hidden" name="pertanyaan[12]" value="Sekolah kami menggunakan teknologi informasi dan komunikasi dan seni untuk mendukung proses pembelajaran dengan tetap memperhatikan aspek-aspek keamanan dan Kesehatan. Bagaimana menurut pandangan Bapak/Ibu terhadap penggunaan beberapa hal berikut:">
                                    <input type="hidden" name="catatan[12]" value="">
                                    <input type="hidden" name="jawaban[12]" value="">
                                </tr></table>
                            </label>
                            <div class="mx-4">
                                <div class="mb-4">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="3%">No.</th>
                                            <th width="42%">Penggunaan Media</th>
                                            <th width="55%">Pandangan Bapak/Ibu</th>
                                        </tr>
                                        <tr>
                                            <td>1. </td>
                                            <td>Penggunaan gawai (device) penunjang pembelajaran (laptop/computer/chromebook)</td>
                                            <td>
                                                <input type="hidden" name="no_soal[13]" value="8a">
                                                <input type="hidden" name="no[13]" value="13">
                                                <input type="hidden" name="pertanyaan[13]" value="Penggunaan gawai (device) penunjang pembelajaran (laptop/computer/chromebook)">
                                                <input type="hidden" name="catatan[13]" value="">
                                                <textarea class="form-control" name="jawaban[13]" required @isset($jawaban[13]) @if($jawaban[13]) readonly @endif @endisset> @isset($jawaban[13]) @if($jawaban[13]){{ $jawaban[13] }}@endif @endisset</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2. </td>
                                            <td>Penggunaan Learning Management System (LMS) untuk mendukung pelaksanaan flipped classroom yang  memfasilitasi siswa mempelajari materi sebelum pembelajaran tatap muka dilaksanakan</td>
                                            <td>
                                                <input type="hidden" name="no_soal[14]" value="8b">
                                                <input type="hidden" name="no[14]" value="14">
                                                <input type="hidden" name="pertanyaan[14]" value="Penggunaan Learning Management System (LMS) untuk mendukung pelaksanaan flipped classroom yang  memfasilitasi siswa mempelajari materi sebelum pembelajaran tatap muka dilaksanakan">
                                                <input type="hidden" name="catatan[14]" value="">
                                                <textarea class="form-control" name="jawaban[14]" required @isset($jawaban[14]) @if($jawaban[14]) readonly @endif @endisset> @isset($jawaban[14]) @if($jawaban[14]){{ $jawaban[14] }}@endif @endisset</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3. </td>
                                            <td>Penggunaan audio dan video sebagai salah satu sumber belajar</td>
                                            <td>
                                                <input type="hidden" name="no_soal[15]" value="8c">
                                                <input type="hidden" name="no[15]" value="15">
                                                <input type="hidden" name="pertanyaan[15]" value="Penggunaan audio dan video sebagai salah satu sumber belajar">
                                                <input type="hidden" name="catatan[15]" value="">
                                                <textarea class="form-control" name="jawaban[15]" required @isset($jawaban[15]) @if($jawaban[15]) readonly @endif @endisset> @isset($jawaban[15]) @if($jawaban[15]){{ $jawaban[15] }}@endif @endisset</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4. </td>
                                            <td>Penggunaan alat musik, lagu, musik yang relevan untuk menunjang tercapainya tujuan pembelajaran dan prosesnya</td>
                                            <td>
                                                <input type="hidden" name="no_soal[16]" value="8d">
                                                <input type="hidden" name="no[16]" value="16">
                                                <input type="hidden" name="pertanyaan[16]" value="Penggunaan alat musik, lagu, musik yang relevan untuk menunjang tercapainya tujuan pembelajaran dan prosesnya">
                                                <input type="hidden" name="catatan[16]" value="">
                                                <textarea class="form-control" name="jawaban[16]" required @isset($jawaban[16]) @if($jawaban[16]) readonly @endif @endisset> @isset($jawaban[16]) @if($jawaban[16]){{ $jawaban[16] }}@endif @endisset</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5. </td>
                                            <td>Kegiatan pengembangan minat bakat seperti tari, paduan suara, menggambar, atau animasi</td>
                                            <td>
                                                <input type="hidden" name="no_soal[17]" value="8e">
                                                <input type="hidden" name="no[17]" value="17">
                                                <input type="hidden" name="pertanyaan[17]" value="Kegiatan pengembangan minat bakat seperti tari, paduan suara, menggambar, atau animasi">
                                                <input type="hidden" name="catatan[17]" value="">
                                                <textarea class="form-control" name="jawaban[17]" required @isset($jawaban[17]) @if($jawaban[17]) readonly @endif @endisset> @isset($jawaban[17]) @if($jawaban[17]){{ $jawaban[17] }}@endif @endisset</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>9. </td>
                                    <td>Bagaimana kebijakan Bapak/Ibu terkait penggunaan HP/gadget lainnya pada ananda?</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[18]" value="9">
                            <input type="hidden" name="no[18]" value="18">
                            <input type="hidden" name="pertanyaan[18]" value="Bagaimana kebijakan Bapak/Ibu terkait penggunaan HP/gadget lainnya pada ananda?">
                            <input type="hidden" name="catatan[18]" value="">
                            <textarea class="form-control" name="jawaban[18]" required @isset($jawaban[18]) @if($jawaban[18]) readonly @endif @endisset> @isset($jawaban[18]) @if($jawaban[18]){{ $jawaban[18] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>10. </td>
                                    <td>Anak & Remaja saat ini seringkali mengakses media sosial dan bermain games (baik online maupun offline). Bagaimana pandangan Bapak/Ibu terkait hal tersebut pada diri ananda? Apakah terdapat aturan bagi ananda dalam mengakses media sosial dan games?</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[19]" value="10">
                            <input type="hidden" name="no[19]" value="19">
                            <input type="hidden" name="pertanyaan[19]" value="Anak & Remaja saat ini seringkali mengakses media sosial dan bermain games (baik online maupun offline). Bagaimana pandangan Bapak/Ibu terkait hal tersebut pada diri ananda? Apakah terdapat aturan bagi ananda dalam mengakses media sosial dan games?">
                            <input type="hidden" name="catatan[19]" value="">
                            <textarea class="form-control" name="jawaban[19]" required @isset($jawaban[19]) @if($jawaban[19]) readonly @endif @endisset> @isset($jawaban[19]) @if($jawaban[19]){{ $jawaban[19] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>11. </td>
                                    <td>Jika Bapak/Ibu merencanakan agenda keluarga (seperti umroh, liburan dsb) dan ternyata bersamaan dengan agenda sekolah (seperti ulangan, pembelajaran reguler, program siswa lainnya) mana yang akan Bapak/Ibu utamakan? Dan bagaimana proses komunikasi yang akan dilakukan?</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[20]" value="11">
                            <input type="hidden" name="no[20]" value="20">
                            <input type="hidden" name="pertanyaan[20]" value="Jika Bapak/Ibu merencanakan agenda keluarga (seperti umroh, liburan dsb) dan ternyata bersamaan dengan agenda sekolah (seperti ulangan, pembelajaran reguler, program siswa lainnya) mana yang akan Bapak/Ibu utamakan? Dan bagaimana proses komunikasi yang akan dilakukan?">
                            <input type="hidden" name="catatan[20]" value="">
                            <textarea class="form-control" name="jawaban[20]" required @isset($jawaban[20]) @if($jawaban[20]) readonly @endif @endisset> @isset($jawaban[20]) @if($jawaban[20]){{ $jawaban[20] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>12. </td>
                                    <td>Berkaitan dengan relasi orangtua dan anak, ceritakan aktivitas rutin dan komunikasi yang dilakukan Bapak/Ibu bersama Ananda!</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[21]" value="12">
                            <input type="hidden" name="no[21]" value="21">
                            <input type="hidden" name="pertanyaan[21]" value="Berkaitan dengan relasi orangtua dan anak, ceritakan aktivitas rutin dan komunikasi yang dilakukan Bapak/Ibu bersama Ananda!">
                            <input type="hidden" name="catatan[21]" value="">
                            <textarea class="form-control" name="jawaban[21]" required @isset($jawaban[21]) @if($jawaban[21]) readonly @endif @endisset> @isset($jawaban[21]) @if($jawaban[21]){{ $jawaban[21] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>13. </td>
                                    <td>Apa tantangan yang Bapak/Ibu hadapi dalam proses perkembangan anak dan bagaimana bapak dan ibu mengatasi tantangan tersebut?</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[22]" value="13">
                            <input type="hidden" name="no[22]" value="22">
                            <input type="hidden" name="pertanyaan[22]" value="Apa tantangan yang Bapak/Ibu hadapi dalam proses perkembangan anak dan bagaimana bapak dan ibu mengatasi tantangan tersebut?">
                            <input type="hidden" name="catatan[22]" value="">
                            <textarea class="form-control" name="jawaban[22]" required @isset($jawaban[22]) @if($jawaban[22]) readonly @endif @endisset> @isset($jawaban[22]) @if($jawaban[22]){{ $jawaban[22] }}@endif @endisset</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                <table><tr>
                                    <td>14. </td>
                                    <td>Guru dan pihak sekolah berperan laksana orangtua kedua di sekolah dalam mendidik ananda. Bagaimana bentuk dukungan yang dapat Bapak/Ibu lakukan agar terjalinnya kerjasama yang positif antara orangtua dan pihak sekolah?</td>
                                </tr></table>
                            </label>
                            <input type="hidden" name="no_soal[23]" value="14">
                            <input type="hidden" name="no[23]" value="23">
                            <input type="hidden" name="pertanyaan[23]" value="Guru dan pihak sekolah berperan laksana orangtua kedua di sekolah dalam mendidik ananda. Bagaimana bentuk dukungan yang dapat Bapak/Ibu lakukan agar terjalinnya kerjasama yang positif antara orangtua dan pihak sekolah?">
                            <input type="hidden" name="catatan[23]" value="">
                            <textarea class="form-control" name="jawaban[23]" required @isset($jawaban[23]) @if($jawaban[23]) readonly @endif @endisset> @isset($jawaban[23]) @if($jawaban[23]){{ $jawaban[23] }}@endif @endisset</textarea>
                        </div>
                    </div>                    
                    <hr>
                    <div class="alert alert-info">
                        <p><b>Pernyataan :</b></p>
                        <div class="icheck-success">
                            @if($selesai == 0)
                                <input type="checkbox" id="setuju" name="agree" required>
                            @endif
                            <label>Seluruh data yang diisikan pada halaman ini adalah data yang benar</label>
                        </div> <br>
                        <p>Terima kasih Bapak/Ibu telah menjawab pertanyaan dengan tuntas dan sebenarnya. Semoga ananda mendapatkan pendidikan terbaik bersama kami di Nurul Fikri Islamic School menjadi pribadi yang Sholeh, Muslih, Cerdas, Mandiri dan Terampil.</p>
                    </div>
                    @if($selesai == 0)
                        <button class="btn btn-primary text-white" type="submit">
                            Simpan dan Lanjutkan &nbsp;
                            <i class="fas fa-arrow-circle-right"></i>
                        </button>
                    @endif
                    @if($selesai == 1)
                        <button class="btn btn-danger text-white" type="cancel">
                            Kembali &nbsp;
                            <i class="fas fa-arrow-circle-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>

@push('jawa')

@endpush
@endsection