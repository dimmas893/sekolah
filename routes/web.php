<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

	//midleware auth
	Route::middleware(['auth'])->group(function () {
		//admin
		Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
		Route::post('/admin/store', [App\Http\Controllers\AdminController::class, 'store'])->name('admin-store');
		Route::get('/admin/all', [App\Http\Controllers\AdminController::class, 'all'])->name('admin-all');
		Route::get('/admin/edit', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin-edit');
		Route::post('/admin/update', [App\Http\Controllers\AdminController::class, 'update'])->name('admin-update');
		Route::delete('/admin/delete', [App\Http\Controllers\AdminController::class, 'delete'])->name('admin-delete');

		// guru
		Route::get('/guru', [App\Http\Controllers\GuruController::class, 'index'])->name('guru');
		Route::post('/guru/store', [App\Http\Controllers\GuruController::class, 'store'])->name('guru-store');
		Route::get('/guru/all', [App\Http\Controllers\GuruController::class, 'all'])->name('guru-all');
		Route::get('/guru/edit', [App\Http\Controllers\GuruController::class, 'edit'])->name('guru-edit');
		Route::post('/guru/update', [App\Http\Controllers\GuruController::class, 'update'])->name('guru-update');
		Route::delete('/guru/delete', [App\Http\Controllers\GuruController::class, 'delete'])->name('guru-delete');

		// kelas
		Route::get('/kelas', [App\Http\Controllers\KelasController::class, 'index'])->name('kelas');
		Route::post('/kelas/store', [App\Http\Controllers\KelasController::class, 'store'])->name('kelas-store');
		Route::get('/kelas/all', [App\Http\Controllers\KelasController::class, 'all'])->name('kelas-all');
		Route::get('/kelas/edit', [App\Http\Controllers\KelasController::class, 'edit'])->name('kelas-edit');
		Route::post('/kelas/update', [App\Http\Controllers\KelasController::class, 'update'])->name('kelas-update');
		Route::delete('/kelas/delete', [App\Http\Controllers\KelasController::class, 'delete'])->name('kelas-delete');

		// siswa
		Route::get('/siswa', [App\Http\Controllers\SiswaController::class, 'index'])->name('siswa');
		Route::post('/siswa/store', [App\Http\Controllers\SiswaController::class, 'store'])->name('siswa-store');
		Route::get('/siswa/all', [App\Http\Controllers\SiswaController::class, 'all'])->name('siswa-all');
		Route::get('/siswa/edit', [App\Http\Controllers\SiswaController::class, 'edit'])->name('siswa-edit');
		Route::post('/siswa/update', [App\Http\Controllers\SiswaController::class, 'update'])->name('siswa-update');
		Route::delete('/siswa/delete', [App\Http\Controllers\SiswaController::class, 'delete'])->name('siswa-delete');

		// rincian_siswa
		Route::get('/rincian_siswa', [App\Http\Controllers\RincianController::class, 'index'])->name('rincian_siswa');
		Route::post('/rincian_siswa/store', [App\Http\Controllers\RincianController::class, 'store'])->name('rincian_siswa-store');
		Route::get('/rincian_siswa/all', [App\Http\Controllers\RincianController::class, 'all'])->name('rincian_siswa-all');
		Route::get('/rincian_siswa/edit', [App\Http\Controllers\RincianController::class, 'edit'])->name('rincian_siswa-edit');
		Route::post('/rincian_siswa/update', [App\Http\Controllers\RincianController::class, 'update'])->name('rincian_siswa-update');
		Route::delete('/rincian_siswa/delete', [App\Http\Controllers\RincianController::class, 'delete'])->name('rincian_siswa-delete');

		// mata pelajaran
		Route::get('/mata_pelajaran', [App\Http\Controllers\Mata_PelajaranController::class, 'index'])->name('mata_pelajaran');
		Route::post('/mata_pelajaran/store', [App\Http\Controllers\Mata_PelajaranController::class, 'store'])->name('mata_pelajaran-store');
		Route::get('/mata_pelajaran/all', [App\Http\Controllers\Mata_PelajaranController::class, 'all'])->name('mata_pelajaran-all');
		Route::get('/mata_pelajaran/edit', [App\Http\Controllers\Mata_PelajaranController::class, 'edit'])->name('mata_pelajaran-edit');
		Route::post('/mata_pelajaran/update', [App\Http\Controllers\Mata_PelajaranController::class, 'update'])->name('mata_pelajaran-update');
		Route::delete('/mata_pelajaran/delete', [App\Http\Controllers\Mata_PelajaranController::class, 'delete'])->name('mata_pelajaran-delete');

		// ruangan
		Route::get('/ruangan', [App\Http\Controllers\RuanganController::class, 'index'])->name('ruangan');
		Route::post('/ruangan/store', [App\Http\Controllers\RuanganController::class, 'store'])->name('ruangan-store');
		Route::get('/ruangan/all', [App\Http\Controllers\RuanganController::class, 'all'])->name('ruangan-all');
		Route::get('/ruangan/edit', [App\Http\Controllers\RuanganController::class, 'edit'])->name('ruangan-edit');
		Route::post('/ruangan/update', [App\Http\Controllers\RuanganController::class, 'update'])->name('ruangan-update');
		Route::delete('/ruangan/delete', [App\Http\Controllers\RuanganController::class, 'delete'])->name('ruangan-delete');

		// wali kelas
		Route::get('/guru_kelas', [App\Http\Controllers\Guru_KelasController::class, 'index'])->name('guru_kelas');
		Route::post('/guru_kelas/store', [App\Http\Controllers\Guru_KelasController::class, 'store'])->name('guru_kelas-store');
		Route::get('/guru_kelas/all', [App\Http\Controllers\Guru_KelasController::class, 'all'])->name('guru_kelas-all');
		Route::get('/guru_kelas/edit', [App\Http\Controllers\Guru_KelasController::class, 'edit'])->name('guru_kelas-edit');
		Route::post('/guru_kelas/update', [App\Http\Controllers\Guru_KelasController::class, 'update'])->name('guru_kelas-update');
		Route::delete('/guru_kelas/delete', [App\Http\Controllers\Guru_KelasController::class, 'delete'])->name('guru_kelas-delete');

		// jadwal
		Route::get('/jadwal', [App\Http\Controllers\jadwalController::class, 'index'])->name('jadwal');
		Route::post('/jadwal/store', [App\Http\Controllers\jadwalController::class, 'store'])->name('jadwal-store');
		Route::get('/jadwal/all', [App\Http\Controllers\jadwalController::class, 'all'])->name('jadwal-all');
		Route::get('/jadwal/edit', [App\Http\Controllers\jadwalController::class, 'edit'])->name('jadwal-edit');
		Route::post('/jadwal/update', [App\Http\Controllers\jadwalController::class, 'update'])->name('jadwal-update');
		Route::delete('/jadwal/delete', [App\Http\Controllers\jadwalController::class, 'delete'])->name('jadwal-delete');


		Route::get('/jadwal/semua_siswa/{id}', [App\Http\Controllers\jadwalController::class, 'jadwal_semua_siswa'])->name('jadwal-semua-siswa');

		// kategori tagihan
		Route::get('/kategori/tagihan', [App\Http\Controllers\Kategori_TagihanController::class, 'index'])->name('kategori_tagihan');
		Route::post('/kategori/tagihan/store', [App\Http\Controllers\Kategori_TagihanController::class, 'store'])->name('kategori_tagihan-store');
		Route::get('/kategori/tagihan/all', [App\Http\Controllers\Kategori_TagihanController::class, 'all'])->name('kategori_tagihan-all');
		Route::get('/kategori/tagihan/edit', [App\Http\Controllers\Kategori_TagihanController::class, 'edit'])->name('kategori_tagihan-edit');
		Route::post('/kategori/tagihan/update', [App\Http\Controllers\Kategori_TagihanController::class, 'update'])->name('kategori_tagihan-update');
		Route::delete('/kategori/tagihan/delete', [App\Http\Controllers\Kategori_TagihanController::class, 'delete'])->name('kategori_tagihan-delete');

		//siswa tagihan
		Route::get('/siswa/tagihan', [App\Http\Controllers\Tagihan_SiswaController::class, 'index'])->name('siswa_tagihan');
		Route::get('/siswa/tagihan/create', [App\Http\Controllers\Tagihan_SiswaController::class, 'create'])->name('siswa_tagihan_create');
		Route::get('/infotagihan/{id}', [App\Http\Controllers\Tagihan_SiswaController::class, 'infotagihan']);
		Route::post('/siswa/tagihan/store', [App\Http\Controllers\Tagihan_SiswaController::class, 'store'])->name('siswa_tagihan-store');
		Route::get('/siswa/tagihan/all', [App\Http\Controllers\Tagihan_SiswaController::class, 'all'])->name('siswa_tagihan-all');
		Route::get('/siswa/tagihan/edit', [App\Http\Controllers\Tagihan_SiswaController::class, 'edit'])->name('siswa_tagihan-edit');
		Route::post('/siswa/tagihan/update', [App\Http\Controllers\Tagihan_SiswaController::class, 'update'])->name('siswa_tagihan-update');
		Route::delete('/siswa/tagihan/delete', [App\Http\Controllers\Tagihan_SiswaController::class, 'delete'])->name('siswa_tagihan-delete');


		Route::get('/pembayaran', [App\Http\Controllers\PembayaranController::class, 'index'])->name('pembayaran');
		Route::get('/pembayaran/export', [App\Http\Controllers\PembayaranController::class, 'export'])->name('pembayaran-export');
		Route::get('/pembayaran/all', [App\Http\Controllers\PembayaranController::class, 'all'])->name('pembayaran-all');
		Route::get('/pembayaran/detail/{id}', [App\Http\Controllers\PembayaranController::class, 'detail'])->name('pembayaran-detail');


		Route::get('/pendaftaran/siswa', [App\Http\Controllers\PendaftaranController::class, 'pendaftaran'])->name('pendaftaran');
		Route::get('/pendaftaran/siswa_sd', [App\Http\Controllers\PendaftaranController::class, 'pendaftaran_sd'])->name('pendaftaran_sd');
		Route::get('/pendaftaran/siswa_smp', [App\Http\Controllers\PendaftaranController::class, 'pendaftaran_smp'])->name('pendaftaran_smp');
		Route::get('/pendaftaran/halaman_step_1', [App\Http\Controllers\PendaftaranController::class, 'halaman_step_1'])->name('halaman_step_1');
		Route::get('/pendaftaran/step_1', [App\Http\Controllers\PendaftaranController::class, 'step_1'])->name('step_1');
		Route::get('/tbl_pendaftaran', [App\Http\Controllers\PendaftaranController::class, 'tbl_pendaftaran'])->name('tbl_pendaftaran');
		Route::post('/pendaftaran/siswa_lulus', [App\Http\Controllers\PendaftaranController::class, 'siswa_lulus'])->name('siswa_lulus');
		Route::post('/pendaftaran/store', [App\Http\Controllers\PendaftaranController::class, 'store'])->name('pendaftaran-store');
		Route::post('/pendaftaran/store_sd', [App\Http\Controllers\PendaftaranController::class, 'store_sd'])->name('pendaftaran-store_sd');
		Route::post('/pendaftaran/store_sd_smp', [App\Http\Controllers\PendaftaranController::class, 'store_smp'])->name('pendaftaran-store_smp');
		Route::get('/pendaftaran/detail/{id}', [App\Http\Controllers\PendaftaranController::class, 'detail'])->name('pendaftaran-detail');
		Route::get('/pendaftaran/all', [App\Http\Controllers\PendaftaranController::class, 'all'])->name('pendaftaran-all');
		// Route::get('/pendaftaran/detail/{id}', [App\Http\Controllers\PembayaranController::class, 'detail'])->name('pembayaran-detail');



		Route::get('/pendaftaran/halaman_step_1/portal', [App\Http\Controllers\PendaftaranController::class, 'halaman_step_1'])->name('halaman_step_1_portal');

	});
require __DIR__.'/auth.php';
