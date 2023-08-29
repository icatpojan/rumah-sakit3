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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::middleware('auth:api')->group(function () {
    // Route lain yang memerlukan otentikasi
    Route::post('logout', 'AuthController@logout');
    // route user
    Route::get('users', 'UserController@index');
    Route::post('user-delete/{user_id}', 'UserController@destroy');
    // route pasien
    Route::get('pasien', 'PasienController@index');
    Route::post('pasien', 'PasienController@create');
    Route::post('pasien/{pasien_id}', 'PasienController@update');
    // route pegawai
    Route::get('pegawai', 'PegawaiController@index');
    Route::post('pegawai', 'PegawaiController@create');
    Route::post('pegawai/{pegawai_id}', 'PegawaiController@update');
    // route dokter
    Route::get('dokter', 'DokterController@index');
    Route::post('dokter', 'DokterController@create');
    Route::post('dokter/{dokter_id}', 'DokterController@update');
    // route barang
    Route::get('barang', 'BarangController@index');
    Route::post('barang', 'BarangController@create');
    Route::post('barang/{barang_id}', 'BarangController@update');
    // route role
    // ->middleware('permission:menambah-user')
    Route::get('role', 'RoleController@index');
    Route::post('role/{role_id}', 'RoleController@update');
    // route perbaikan
    Route::get('perbaikan', 'PerbaikanController@index');
    Route::post('perbaikan', 'PerbaikanController@create');
    Route::post('perbaikan/{perbaikan_id}', 'PerbaikanController@update');
    // route departemen
    Route::get('departemen', 'DepartemenController@index');
    Route::post('departemen', 'DepartemenController@create');
    Route::post('departemen/{departemen_id}', 'DepartemenController@update');
    // route obat
    Route::get('obat', 'ObatController@index');
    Route::post('obat', 'ObatController@create');
    Route::post('obat/{obat_id}', 'ObatController@update');
    // route poliklinik
    Route::get('poliklinik', 'PoliklinikController@index');
    Route::post('poliklinik', 'PoliklinikController@create');
    Route::post('poliklinik/{poliklinik_id}', 'PoliklinikController@update');
    // route perawatan
    Route::get('perawatan', 'PerawatanController@index');
    Route::post('perawatan', 'PerawatanController@create');
    Route::post('perawatan/{perawatan_id}', 'PerawatanController@update');
    // route shift
    Route::get('shift', 'ShiftController@index');
    Route::post('shift', 'ShiftController@create');
    Route::post('shift/{shift_id}', 'ShiftController@update');
    // route jadwal
    Route::get('jadwal', 'JadwalController@index');
    Route::post('jadwal', 'JadwalController@create');
    Route::post('jadwal/{jadwal_id}', 'JadwalController@update');
    // route jadwal
    Route::post('presensi', 'PresensiController@index');
    // route regristasi
    Route::get('ralan', 'RalanController@index');
    Route::post('ralan', 'RalanController@create');
    Route::post('ralan/{ralan_id}', 'RalanController@update');
    // route soap
    Route::get('soap', 'SoapController@index');
    Route::post('soap', 'SoapController@create');
    Route::post('soap/{soap_id}', 'SoapController@update');
    // route detail
    Route::get('detail', 'DetailController@indexDetail');
    Route::post('detail', 'DetailController@createDetail');
    Route::post('detail/{detail_id}', 'DetailController@updateDetail');
    // route detail-obat
    Route::get('detail-obat', 'DetailController@indexDetailObat');
    Route::post('detail-obat', 'DetailController@createDetailObat');
    Route::post('detail-obat/{detail_obat_id}', 'DetailController@updateDetailObat');
    // route detail-tambahan
    Route::get('detail-tambahan', 'DetailController@indexDetailTambahan');
    Route::post('detail-tambahan', 'DetailController@createDetailTambahan');
    Route::post('detail-tambahan/{detail_tambahan_id}', 'DetailController@updateDetailTambahan');
});
