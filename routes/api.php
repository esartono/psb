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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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
    'calons' => 'API\CalonController',
    'agreements' => 'API\AgreementController',
    'beritas' => 'API\BeritaController',
    'jadwals' => 'API\JadwalController',
    'seragams' => 'API\SeragamController',
    //'telegrams' => 'API\TelegramController',
]);

Route::get('admins', 'API\UserController@admin');
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
Route::get('agama', 'API\AgamaController@dataAgama');
