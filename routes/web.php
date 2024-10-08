<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use Telegram;
use Illuminate\Http\Request;

/* Tester untuk WebHook */

// Route::post('/webhook/notification/gitlab', function (Request $request) {
//     Telegram::sendMessage([
//         'chat_id' => '643982879',
//         'text' => 'KIRIM OKE',
//     ]);
// });

/* Sitemap for PPDB */

Route::get('/sitemap.xml', 'HomeController@sitemap');

/* Laman untuk tes PPDB */
Route::get('/tesPPDB', 'HomeController@tesPPDB')->name('tesPPDB');

/* Tester untuk Gdrive */
// Route::get('/coba', 'HomeController@coba')->name('coba');

/* Untuk mengganti Bahasanya */
Route::get('lang/{locale}', 'LocalizationController@index')->name('localization');

Route::get('/', 'HomeController@depan')->name('depan');
Route::get('/alur', 'HomeController@alur')->name('alur');
Route::get('/biaya', 'HomeController@biaya')->name('biaya');
Route::get('/edupay', 'HomeController@edupay')->name('edupay');
Route::get('/jadwal', 'HomeController@jadwal')->name('jadwal');
Route::get('/syarat', 'HomeController@syarat')->name('syarat');
Route::get('/tata_cara_bayar_spp', 'HomeController@daftarulang')->name('daftarulang');
Route::get('/tata_cara_bayar_pendaftaran', 'HomeController@tatacara')->name('tatacara');
Route::get('/qna', 'HomeController@faq')->name('qna');
Route::get('/jadwalkesehatan1', 'HomeController@jadwalkesehatan')->name('jadwalkesehatan');
Route::get('/download', 'HomeController@download')->name('download');
Route::get('/hasil', 'HomeController@hasil')->name('hasilTes');
Route::get('/ukuranseragam', 'HomeController@ukuranseragam')->name('ukuranseragam');
// Route::get('/waitinglist', 'HomeController@waitinglist')->name('wl');
// Route::post('/waitinglist', 'HomeController@simpanwaitinglist')->name('waitinglist');

Route::post('/gethasil', 'HomeController@gethasil')->name('gethasilTes');
// Route::get('api/waktu','DokuController@getWaktu');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('auth/google', 'SocialiteController@redirectToGoogle');
Route::get('auth/google/callback', 'SocialiteController@handleGoogleCallback');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::get('login/admin', 'HomeController@adminLogin');
Route::resource('waiting', 'WaitingController');
Route::resource('faqs', 'FaqController');

// Untuk Webhook Maja
Route::post('/webhook/maja', 'WebHookController@webhookHandler');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/biayatesPDF/{id}', 'CalonPDFController@biayates')->name('biayatesPDF');
    Route::get('/seleksiPDF/{id}', 'CalonPDFController@seleksi')->name('seleksiPDF');
    Route::get('/buktiBayarPPDB/{id}', 'CalonPDFController@bayarPPDB')->name('bayarPPDB');
    Route::get('/DaftarUlangPDF/{id}', 'CalonPDFController@daul')->name('DaftarUlangPDF');
    Route::get('/AmbilSeragamPDF/{id}', 'CalonPDFController@seragam')->name('AmbilSeragamPDF');
    Route::get('/AmbilBukuPDF/{id}', 'CalonPDFController@buku')->name('AmbilBukuPDF');
    Route::get('/SuratKeteranganDiterimaPDF/{id}', 'CalonPDFController@terima')->name('SuratKeteranganDiterimaPDF');
    Route::get('/dokumen/{id}', 'DokuController@calon')->name('dokumen');
    Route::get('/pilihJadwal/{id}', 'DokuController@pilihjadwal')->name('pilihjadwal');
    Route::resource('doku', 'DokuController');
    Route::get('uploaddokumen/{calon}/{code}', 'DokuController@upload')->name('doku.upload');
    Route::resource('uniform', 'UniformController');
    Route::resource('bayarSPP', 'BayarSppController');
    //Route::get('uniform/{calon}/{code?}', 'UniformController@upload')->name('uniform.isi');
    Route::post('updatejadwal', 'DokuController@updatejadwal')->name('doku.updatejadwal');

    //Tes Script
    Route::get('/cek', 'UjicobaController@cek3')->name('cek');
});

Route::middleware('auth', 'user')->group(function () {
    // Route::get('/psb', 'HomeController@dashboardUser')->name('psb');
    // Route::get('/psb', 'HomeController@psb_old')->name('psb');
    Route::get('/ppdb', 'HomeController@psb')->name('ppdb');
    Route::get('/baru', 'HomeController@baru')->name('baru');
    Route::get('/ppdb/{id}', 'HomeController@detailCalon')->name('ppdb_detail');
    // Route::get('/dokumen/{id}', 'HomeController@psb')->name('dokumen');
    Route::get('/password', 'HomeController@password')->name('password');
    Route::post('/password', 'HomeController@changePassword')->name('edit.password');
    Route::post('/tambahuser', 'HomeController@addUser')->name('add.user');
    // Route::get('/editcalon/{id}', 'HomeController@psb_old')->name('editcalon');
    Route::get('/tambahcalon', 'DraftCalonController@create')->name('tambahcalon');
    Route::post('/tambahcalon', 'DraftCalonController@store')->name('add.calon');
    Route::get('/tambahcalon/{step}', 'DraftCalonController@create')->name('tambahcalon');
    Route::get('/editcalon/{id}', 'DraftCalonController@edit')->name('editcalon');
    Route::get('/editcalon/{id}/{step}', 'DraftCalonController@edit')->name('editcalon');
    Route::put('/editcalon', 'DraftCalonController@update')->name('edit.calon');
    Route::post('/editjurusan', 'DraftCalonController@jurusan');
    Route::delete('/bataldaftar', 'DraftCalonController@destroy')->name('bataldaftar');
    Route::get('/printTagihanPPDB/{id}', 'WawancaraController@PDFKeuangan')->name('print.tagihan');
    Route::get('/photo/{id}', 'DraftCalonController@photo')->name('editpp');
    Route::post('/photo', 'DraftCalonController@photopp')->name('postpp');
});

Route::middleware('auth', 'psikotes')->group(function () {
    Route::get('/psikotes', 'HomeController@front')->name('psikotes');
    Route::get('/email', 'HomeController@front')->name('email');
});

Route::middleware('auth', 'pengadaan')->group(function () {
    Route::get('/seragam', 'HomeController@front')->name('seragam');
    Route::get('/EksportSeragam', 'API\CalonController@exportSeragam');
});

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/login_as', 'HomeController@loginJadiUser')->name('login_as');
    Route::post('/login_as', 'HomeController@login_as')->name('login_as');
    Route::get('/dashboard', 'HomeController@front')->name('dashboard');
    Route::get('/profile', 'HomeController@front');
    Route::get('/siswa', 'HomeController@front');
    Route::get('/statistik/{id}', 'CalonHasilController@statistik');

    Route::get('/graph', 'GraphController@harian')->name('grafik');

    //Route untuk folder Master
    Route::get('/master/admin', 'HomeController@front');
    Route::get('/master/user', 'HomeController@front');
    Route::get('/master/unit', 'HomeController@front');
    Route::get('/master/kelas', 'HomeController@front');
    Route::get('/master/seragam', 'HomeController@front');

    //Route untuk folder config
    Route::get('/config/tp', 'HomeController@front');
    Route::get('/config/jdokus', 'HomeController@front');
    Route::get('/config/kategori', 'HomeController@front');
    Route::get('/config/gelombang', 'HomeController@front');
    Route::get('/config/jadwal', 'HomeController@front');
    Route::get('/config/biayates', 'HomeController@front');
    Route::get('/config/tagihanPSB', 'HomeController@front');
    Route::get('/config/biayaSPP', 'HomeController@front');
    Route::get('/config/Immersion', 'HomeController@front');
    Route::get('/config/agreement', 'HomeController@front');
    Route::get('/config/berita', 'HomeController@front');
    Route::get('/config/faq', 'HomeController@front');

    //Route untuk eksport Data
    Route::get('/EksportUser', 'API\UserController@export');
    Route::get('/EksportSiswaBaru', 'API\CalonController@exportsiswabaru');
    Route::get('/EksportCpdBaru', 'API\CalonController@exportbaru');
    Route::get('/EksportCpdAktif', 'API\CalonController@exportaktif');
    Route::get('/EksportCpd/{id}', 'API\CalonJadwalController@exportTes');
    Route::get('/EksportPsikotes/{id}', 'API\CalonJadwalController@exportPsikoTes');
    Route::get('/EksportVABank/{id}', 'API\CalonController@exportBank');
    Route::get('/EksportBayar', 'API\BayarTagihanController@export');

    //Route untuk data siswa n Pegawai
    Route::get('/datasiswanf', 'HomeController@front');
    Route::get('/datapegawai', 'HomeController@front');

    //Route untuk Data Calon Peserta Didik
    Route::get('/cpdAll', 'HomeController@front');
    Route::get('/cpd/{id}', 'HomeController@front');
    //Route::get('/cpdBaru', 'HomeController@front');
    //Route::get('/cpdAktif', 'HomeController@front');
    Route::get('/cpdHasil/{id}', 'HomeController@front');
    Route::get('/waitingList', 'HomeController@front');

    //Route untuk Jadwal Tes
    //Route::get('/tes', 'HomeController@tes');
    Route::get('/tagihan', 'HomeController@front');
    Route::get('/suratseragam', 'HomeController@front');
    Route::get('/suratbuku', 'HomeController@front');
    Route::get('/tes', 'HomeController@front');
    Route::get('/non-tes', 'HomeController@front');
    Route::get('/berkas', 'HomeController@front');

    Route::get('/PrintKartuTes/{id}', 'CalonPDFController@PrintKartuTes')->name('PrintKartuTes');

    //Route untuk Wawancara Keuangan
    Route::get('/wawancara-keu', 'WawancaraController@wawancaraKeuangan')->name('wawancara-keu');
    Route::get('/keuangan/{id}', 'WawancaraController@getCalon')->name('getCalon');
    Route::get('/PDFkeuangan/{id}', 'WawancaraController@PDFKeuangan')->name('PDFkeuangan');
    Route::get('/bayartagihan', 'HomeController@front');
    Route::get('/bayarspps', 'HomeController@front');
    Route::get('/impruf', 'HomeController@front');
    Route::get('/sdmsmart', 'SdmsmartController@datapegawai');

    //Route untuk Tes Wawancara
    Route::get('/wawancara/pewawancara', 'HomeController@front');
    Route::get('/wawancara/instrumen-wawancara', 'HomeController@front');
    Route::get('/wawancara/rubrik-wawancara', 'HomeController@front');
    Route::get('/wawancara/rekap', 'HomeController@front');
    // Route::get('/wawancara', 'TesWawancaraController@index');
    Route::get('/wawancara', 'TesWawancaraController@wawancara')->name('tesWawancara');
    // Route::get('/formWawancara', 'TesWawancaraController@formWawancara')->name('formWawancara');
    Route::post('/simpanJawaban', 'TesWawancaraController@store')->name('simpanJawaban');

    //Route::resource('calontagihans', 'CalonTagihanController');

    //Route untuk Edit Data Calon Peserta Didik
    Route::get('/editcalons/{id}', 'HomeController@front')->name('editcalons');
    Route::get('/editbio/{id}', 'WawancaraController@editbio')->name('editbio');
    Route::get('/editKeuangan/{id}', 'WawancaraController@editkeu')->name('editkeu');
    Route::post('/updatebio', 'WawancaraController@updatebio')->name('updatebio');
    Route::post('/updatekeu', 'WawancaraController@updatekeu')->name('updatekeu');

    //Route untuk Download file
    Route::get('file/{id}', 'DokuController@download')->name('downloadfile');

    //Route untuk lihat file SPP
    Route::get('lihatspp/{uruts}', 'FileController@lihatSpp')->name('lihatspp');

    //Untuk Cek PHP INFO
    Route::get('phpmyinfo', function () {
        phpinfo();
    })->name('phpmyinfo');
});
