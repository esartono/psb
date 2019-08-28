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

Auth::routes(['verify' => true]);


Route::middleware('auth', 'user')->group(function(){
    Route::get('/psb', 'HomeController@psb')->name('psb');
    Route::get('/tambahcalon', 'HomeController@psb')->name('psb');
    Route::get('/editcalon/{id}', 'HomeController@psb')->name('psb');
});

Route::middleware('auth', 'admin')->group(function(){

    //Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home', function () {return view('front');});
    Route::get('/profile', function () {return view('front');});

    //Route untuk folder Master
    Route::get('/master/admin', function () {return view('front');});
    Route::get('/master/user', function () {return view('front');});
    Route::get('/master/unit', function () {return view('front');});
    Route::get('/master/kelas', function () {return view('front');});

    //Route untuk folder config
    Route::get('/config/tp', function () {return view('front');});
    Route::get('/config/gelombang', function () {return view('front');});
    Route::get('/config/biayates', function () {return view('front');});
    Route::get('/config/agreement', function () {return view('front');});
    Route::get('/config/berita', function () {return view('front');});

    //Route untuk eksport Data
    Route::get('EksportUser', 'API\UserController@export');

    //Route untuk data siswa n Pegawai
    Route::get('/datasiswanf', function () {return view('front');});
    Route::get('/pegawai', function () {return view('front');});

    //Route untuk Data Calon Peserta Didik
    Route::get('/cpd/{id}', function () {return view('front');});
});
