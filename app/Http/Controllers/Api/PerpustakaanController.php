<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\PerpustakaanMember;
use App\Models\Perpustakaan_Pinjam;
use App\Models\Perpustakaan_Pinjam_Rincian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
	public function perpustakaan(Request $request)
	{
		$file_path = 'https://dapurkoding.my.id/';

		$yuhu = [];
		$tampung = [];
		$dataMember = PerpustakaanMember::where('user_id', $request->id_user)->first();
		if ($dataMember != null) {
			$perpustakaan_pinjam = Perpustakaan_Pinjam::where('member_id', $dataMember->id)->get();
			$id_perpustakaan_pinjam = Perpustakaan_Pinjam::where('member_id', $dataMember->id)->first();
			$rincian_buku = Perpustakaan_Pinjam_Rincian::where('perpustakaan_pinjam_id', $id_perpustakaan_pinjam->id)->first();

			foreach ($perpustakaan_pinjam as $pe) {
				$rincian_count = Perpustakaan_Pinjam_Rincian::where('perpustakaan_pinjam_id', $pe->id)->get();
				$raw['id'] = $pe->id;
				$raw['nama'] = $rincian_buku->relasiBuku->judul;
				$raw['jmlh_pinjam'] = count($rincian_count);
				$raw['avatar'] = $file_path . 'sampul/' . $rincian_buku->relasiBuku->sampul;
				$raw['tgl_kembali'] = $pe->batas_waktu;
				array_push($yuhu, $raw);
				array_push($tampung, count($rincian_count));
			}
			//dd($yuhu);
			$sum = array_sum($tampung);

			$buku = Buku::take(100)->get();
			$tampung_buku = [];
			foreach ($buku as $buk) {
				$bukuuu['id'] = $buk->id;
				$bukuuu['nama'] = $buk->judul;
				$bukuuu['penulis'] = $buk->penulis;
				$bukuuu['avatar'] = $file_path . 'sampul/' . $buk->sampul;
				array_push($tampung_buku, $bukuuu);
			}

			return response()->json([
				'info_pinjam' => [
					'pinjam' => $sum,
					'limit_pinjam' => 0,
				],
				"pinjam" => $yuhu,

				'daftar_buku' => $tampung_buku
			]);
		} else {
			return response()->json([
				'error' => [
					'Data Tidak Ditemukan',
				],
			], 404);
		}
	}

	public function detail(Request $request)
	{
		$file_path = 'https://dapurkoding.my.id/';
		$buku = Buku::with('buku_kategori')->where('id', $request->id_buku)->first();
		$bukuuu['id'] = $buku->id;
		$bukuuu['kategori'] = $buku->buku_kategori->nama_kategori;
		$bukuuu['judul'] = $buku->judul;
		$bukuuu['penulis'] = $buku->penulis;
		$bukuuu['sinopsis'] = $buku->sinopsis;
		$bukuuu['jml_hal'] = (int) $buku->jumlah_halaman;
		$bukuuu['bahasa'] = $buku->bahasa;
		$bukuuu['penerbit'] = $buku->penerbit;
		$bukuuu['isbn_no'] = $buku->isbn_no;
		$bukuuu['pinjam'] = false;
		$bukuuu['sampul'] = $file_path . 'sampul/' . $buku->sampul;

		return response()->json([
			'detail_buku' => $bukuuu
		]);
	}

	public function pinjam(Request $request)
	{
		$batasWaktu = Carbon::now('Asia/Jakarta')->addDays(7)->format('Y-m-d');
		$memberPerpus = PerpustakaanMember::where('user_id', $request->id_user)->first();
		$tes = [
			'tanggal_peminjaman' => Carbon::now()->Format('Y-m-d'),
			'member_id' => $memberPerpus->id,
			'batas_waktu' => $batasWaktu,
		];

		$pee = Perpustakaan_Pinjam::create($tes);
		// dd($pee);
		foreach ($request['id_buku'] as $value) {

			$create = [
				'buku_id' => $value,
				'perpustakaan_pinjam_id' => $pee->id,
			];

			$perpustakaan_rinci = Perpustakaan_Pinjam_Rincian::create($create);
		}

		return response()->json([
			'data' => [
				'id_pinjam' => $pee->id
			],
		], 201);
	}
}
