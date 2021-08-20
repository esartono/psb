<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResources([
    'users' => 'API\UserController',
    'units' => 'API\UnitController',
    'kelasnyas' => 'API\KelasnyaController',
    'schoolcategories' => 'API\SchoolCategoryController',
    'tps' => 'API\TahunPelajaranController',
    'gelombangs' => 'API\GelombangController',
    'biayatess' => 'API\BiayaTesController',
    'siswanfs' => 'API\SiswaNFController',
    'pegawais' => 'API\PegawaiController',
    'cks' => 'API\CalonKategoriController',
    'jdokus' => 'API\JDokuController',
    'calons' => 'API\CalonController',
    'agreements' => 'API\AgreementController',
    'beritas' => 'API\BeritaController',
    'jadwals' => 'API\JadwalController',
    'seragams' => 'API\SeragamController',
    'calonseragams' => 'API\CalonSeragamController',
    'calonbiayates' => 'API\CalonBiayaTesController',
    'calonjadwals' => 'API\CalonJadwalController',
    'calonhasils' => 'API\CalonHasilController',
    'calontagihans' => 'API\CalonTagihanController',
    'suratseragam' => 'API\SuratSeragamController',
    'tagihanpsbs' => 'API\TagihanPSBController',
    'calontagihanpsbs' => 'API\CalonTagihanPSBController',
    'bayartagihans' => 'API\BayarTagihanController',
    //'telegrams' => 'API\TelegramController',
]);

Route::middleware('auth:api')->get('/berkas', 'DokuController@index');
Route::middleware('auth:api')->get('/berkas/{id}', 'DokuController@detail');
Route::middleware('auth:api')->get('indexadmin/{id}', 'API\CalonController@indexAdmin');
Route::middleware('auth:api')->get('admins', 'API\UserController@admin');

Route::post('mundur', 'API\CalonHasilController@mundur');
Route::post('rpass/{id}', 'API\UserController@resetPassword');
Route::post('gpass/{id}', 'API\UserController@gantiPassword');
Route::get('kelasnya/{unit}', 'API\KelasnyaController@dataKelas');
Route::get('provinsi', 'API\ProvinsiController@index');
Route::get('seragam/{pr}', 'API\SeragamController@dataSeragam');
Route::get('kota/{prov}', 'API\KotaController@dataKota');
Route::get('kecamatan/{kota}', 'API\KecamatanController@dataKecamatan');
Route::get('kelurahan/{camat}', 'API\KelurahanController@dataKelurahan');
Route::get('pekerjaan', 'API\PekerjaanController@index');
Route::get('pendidikan', 'API\PendidikanController@index');
Route::get('penghasilan', 'API\PenghasilanController@index');
Route::get('sumberinfo', 'API\SumberInfoController@index');
Route::get('kategoris', 'API\CalonKategoriController@data');
Route::get('agama', 'API\AgamaController@dataAgama');
Route::get('tas', 'API\TahunPelajaranController@ta');
Route::post('cekJurusan', 'API\CalonController@updateJurusan');
Route::post('cekCalon', 'API\CalonController@cekCalon');
Route::get('/937a8ddfc66c29ec39ad5f75cdd44b8e/{id}', 'HomeController@apiCalon');
