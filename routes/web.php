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

Route::get('/', 'HomeController@depan')->name('depan');
Route::get('/biaya', 'HomeController@biaya')->name('biaya');
Route::get('/edupay', 'HomeController@edupay')->name('edupay');
Route::get('/jadwal1', 'HomeController@jadwal')->name('jadwal');
Route::get('/jadwalkesehatan1', 'HomeController@jadwalkesehatan')->name('jadwalkesehatan');
Route::get('/download', 'HomeController@download')->name('download');
Route::get('/hasil', 'HomeController@hasil')->name('hasilTes');
Route::get('/uji', 'UjicobaController@cek')->name('uji');
Route::get('/uji1', 'UjicobaController@cek1')->name('uji1');
// Route::get('/uji2', 'UjicobaController@cek2')->name('uji2');
// Route::get('/uji3', 'UjicobaController@cek3')->name('uji3');
//Route::get('/uji4', 'UjicobaController@cek4')->name('uji4');
Route::get('/uji5', 'UjicobaController@cek5')->name('uji5');
Route::post('/gethasil', 'HomeController@gethasil')->name('gethasilTes');
// Route::get('api/waktu','DokuController@getWaktu');

Auth::routes(['verify' => true]);
Route::get('logout', 'Auth\LoginController@logout');

Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/biayatesPDF/{id}', 'CalonPDFController@biayates')->name('biayatesPDF');
    Route::get('/seleksiPDF/{id}', 'CalonPDFController@seleksi')->name('seleksiPDF');
    Route::get('/DaftarUlangPDF/{id}', 'CalonPDFController@daul')->name('DaftarUlangPDF');
    Route::get('/AmbilSeragamPDF/{id}', 'CalonPDFController@seragam')->name('AmbilSeragamPDF');
    Route::get('/dokumen/{id}', 'DokuController@calon')->name('dokumen');
    Route::get('/pilihJadwal/{id}', 'DokuController@pilihjadwal')->name('pilihjadwal');
    Route::resource('doku', 'DokuController');
    Route::get('uploaddokumen/{calon}/{code?}', 'DokuController@upload')->name('doku.upload');
    Route::post('updatejadwal', 'DokuController@updatejadwal')->name('doku.updatejadwal');
});

Route::middleware('auth', 'user')->group(function(){
    // Route::get('/psb', 'HomeController@dashboardUser')->name('psb');
    Route::get('/psb', 'HomeController@psb')->name('psb');
    // Route::get('/dokumen/{id}', 'HomeController@psb')->name('dokumen');
    Route::get('/tambahcalon', 'HomeController@psb')->name('tambahcalon');
    Route::get('/editcalon/{id}', 'HomeController@psb')->name('editcalon');
});

Route::middleware('auth', 'psikotes')->group(function(){
    Route::get('/psikotes', 'HomeController@front')->name('psikotes');
    Route::get('/email', 'HomeController@front')->name('email');
});

Route::middleware('auth', 'admin')->group(function(){
    Route::get('/login_as', 'HomeController@loginJadiUser')->name('login_as');
    Route::post('/login_as', 'HomeController@login_as')->name('login_as');
    Route::get('/dashboard', 'HomeController@front')->name('dashboard');
    Route::get('/profile', 'HomeController@front');
    Route::get('/siswa', 'HomeController@front');
    Route::get('/statistik/{id}', 'CalonHasilController@statistik');

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
    Route::get('/config/agreement', 'HomeController@front');
    Route::get('/config/berita', 'HomeController@front');

    //Route untuk eksport Data
    Route::get('/EksportUser', 'API\UserController@export');
    Route::get('/EksportSiswaBaru', 'API\CalonController@exportsiswabaru');
    Route::get('/EksportCpdBaru', 'API\CalonController@exportbaru');
    Route::get('/EksportCpdAktif', 'API\CalonController@exportaktif');
    Route::get('/EksportCpd/{id}', 'API\CalonJadwalController@exportTes');
    Route::get('/EksportPsikotes/{id}', 'API\CalonJadwalController@exportPsikoTes');
    Route::get('/EksportVABank/{id}', 'API\CalonController@exportBank');

    //Route untuk data siswa n Pegawai
    Route::get('/datasiswanf', 'HomeController@front');
    Route::get('/datapegawai', 'HomeController@front');

    //Route untuk Data Calon Peserta Didik
    Route::get('/cpdAll', 'HomeController@front');
    Route::get('/cpd/{id}', 'HomeController@front');
    //Route::get('/cpdBaru', 'HomeController@front');
    //Route::get('/cpdAktif', 'HomeController@front');
    Route::get('/cpdHasil/{id}', 'HomeController@front');

    //Route untuk Jadwal Tes
    //Route::get('/tes', 'HomeController@tes');
    Route::get('/tagihan', 'HomeController@front');
    Route::get('/suratseragam', 'HomeController@front');
    Route::get('/tes', 'HomeController@front');
    Route::get('/wawancara-keu', 'WawancaraController@wawancaraKeuangan');
    Route::get('/keuangan/{id}', 'WawancaraController@getCalon')->name('getCalon');
    Route::get('/PDFkeuangan/{id}', 'WawancaraController@PDFKeuangan')->name('PDFkeuangan');

    //Route::resource('calontagihans', 'CalonTagihanController');

    //Route untuk Edit Data Calon Peserta Didik
    Route::get('/editcalons/{id}', 'HomeController@front')->name('editcalons');
});
