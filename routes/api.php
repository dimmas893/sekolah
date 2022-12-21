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

Route::get('/admin/all', [App\Http\Controllers\api\AdminController::class, 'all']);
Route::post('/admin/store', [App\Http\Controllers\api\AdminController::class, 'store']);
Route::get('/admin/edit', [App\Http\Controllers\api\AdminController::class, 'edit']);
Route::post('/admin/update', [App\Http\Controllers\api\AdminController::class, 'update']);
Route::delete('/admin/delete', [App\Http\Controllers\api\AdminController::class, 'delete']);


Route::post('/kategori/tagihan/store', [App\Http\Controllers\api\Kategory_tagihanController::class, 'store']);
Route::get('/kategori/tagihan/edit/{id}', [App\Http\Controllers\api\Kategory_tagihanController::class, 'edit']);
Route::post('/kategori/tagihan/update/{id}', [App\Http\Controllers\api\Kategory_tagihanController::class, 'update']);
Route::delete('/kategori/tagihan/delete/{id}', [App\Http\Controllers\api\Kategory_tagihanController::class, 'delete']);


Route::get('/pembayaran/all', [App\Http\Controllers\api\PembayaranController::class, 'all']);
Route::post('/pembayaran/pembayaran_detail', [App\Http\Controllers\api\PembayaranController::class, 'pembayaran_detail']);
Route::post('/pembayaran/pembayaran_detail_satuan', [App\Http\Controllers\api\PembayaranController::class, 'pembayaran_detail_satuan']);
Route::post('/pembayaran/store', [App\Http\Controllers\api\PembayaranController::class, 'store']);
Route::post('/pembayaran/checkout', [App\Http\Controllers\api\PembayaranController::class, 'checkout']);
// Route::get('/pembayaran/edit/{id}', [App\Http\Controllers\api\PembayaranController::class, 'edit']);
// Route::post('/pembayaran/update/{id}', [App\Http\Controllers\api\PembayaranController::class, 'update']);
// Route::delete('/pembayaran/delete/{id}', [App\Http\Controllers\api\PembayaranController::class, 'delete']);


Route::post('/v1/list-siswa', [App\Http\Controllers\api\SiswaController::class, 'all']);
Route::post('/v1/profil-siswa', [App\Http\Controllers\api\SiswaController::class, 'profil_siswa']);
Route::post('/v1/profil_wali_siswa', [App\Http\Controllers\api\SiswaController::class, 'profil_wali_siswa']);
Route::post('/v1/profil_guru', [App\Http\Controllers\api\SiswaController::class, 'profil_guru']);
Route::post('/v1/kurikulum_all', [App\Http\Controllers\api\SiswaController::class, 'kurikulum_all']);
// Route::post('/v1/list-siswa', [App\Http\Controllers\api\SiswaController::class, 'gel_all']);
Route::post('/siswa/store', [App\Http\Controllers\api\SiswaController::class, 'store']);
Route::get('/siswa/edit', [App\Http\Controllers\api\SiswaController::class, 'edit']);
Route::post('/siswa/update', [App\Http\Controllers\api\SiswaController::class, 'update']);
Route::delete('/siswa/delete', [App\Http\Controllers\api\SiswaController::class, 'delete']);


Route::get('/tagihan/siswa/all', [App\Http\Controllers\api\Tagihan_SiswaController::class, 'all']);
Route::post('/tagihan/siswa/store', [App\Http\Controllers\api\Tagihan_SiswaController::class, 'store']);
Route::get('/tagihan/siswa/edit/{id}', [App\Http\Controllers\api\Tagihan_SiswaController::class, 'edit']);
Route::post('/tagihan/siswa/update/{id}', [App\Http\Controllers\api\Tagihan_SiswaController::class, 'update']);
Route::delete('/tagihan/siswa/delete/{id}', [App\Http\Controllers\api\Tagihan_SiswaController::class, 'delete']);



// Route::get('/v1/kategori-keuangan', [App\Http\Controllers\api\Invoice_TagihanController::class, 'index']);

Route::get('/v1/kategori-keuangan', [App\Http\Controllers\api\Kategory_tagihanController::class, 'all']);
// Route::post('/tagihan/siswa', [App\Http\Controllers\api\Invoice_TagihanController::class, 'tagihan']);
Route::post('/tagihan/tagihan_siswa', [App\Http\Controllers\api\Invoice_TagihanController::class, 'tagihan_siswa']);


Route::get('/callback', [App\Http\Controllers\api\Invoice_TagihanController::class, 'callbck']);




Route::post('/absen/store', [App\Http\Controllers\api\AbsensController::class, 'store']);
Route::post('/absen/absen_satuan', [App\Http\Controllers\api\AbsensController::class, 'absen_satuan']);
Route::post('/absen/absen_mandiri', [App\Http\Controllers\api\AbsensController::class, 'absen_mandiri']);


Route::get('/jadwal', [App\Http\Controllers\api\JadwalsController::class, 'index']);
Route::get('/jadwal/get_siswa_jadwal', [App\Http\Controllers\api\JadwalsController::class, 'get_siswa_jadwal']);
Route::get('/jadwal/ambil_semua_jadwal', [App\Http\Controllers\api\JadwalsController::class, 'ambil_semua_jadwal']);
