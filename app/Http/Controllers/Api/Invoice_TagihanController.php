<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice_Tagihan;
use App\Models\Siswa;
use App\Models\Tagihan_Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Invoice_TagihanController extends Controller
{
	public function callbck()
	{
		return response()->json(['status' => 200],200);
	}

	public function tagihan_siswa(Request $request)
	{
		$siswa = Siswa::where('id', $request->siswa_id)->first();
		$invoice_tagihan = Invoice_Tagihan::with('kategori_tagihan')->where('id_siswa', $siswa->id)->get();
		// dd($invoice_tagihan);
		$tagihan = [];
		foreach($invoice_tagihan as $p){
			$row['id'] = $p['id'];
			$row['tagihan'] = $p['kategori_tagihan']['nama_kategori'];
			$row['nominal'] = $p['kategori_tagihan']['nominal'];
			$row['jenis'] = 1;
			$row['avatar'] = '';
			array_push($tagihan, $row);
		}

        return response()->json([
			'data' => $tagihan
		]);
	}

    public function index()
	{
		// $format = \Carbon\Carbon::now('Asia/Jakarta')->format('d');
		$admin = Invoice_Tagihan::with('user', 'kategori_tagihan')->where('status', 'paid')->get();
		$tagihan = [];
		foreach($admin as $p){
			$registeredAt = $p->created_at->isoFormat('D MMMM Y');
			$row['id'] = $p['id'];
			$row['nominal'] = $p['nominal'];
			$row['status'] = $p['status'];
			$row['invoice'] = $p['id_invoice'];
			$row['tanggal'] = $this->tgl_indo($p['tanggal']);
			$row['nama_tagihan'] = $p['kategori_tagihan']['nama_kategori'];
			$row['check'] = false;
			array_push($tagihan, $row);
		}

        return response()->json(
			$tagihan
		);
	}

	// public function tagihan()
	// {
	// 	// $format = \Carbon\Carbon::now('Asia/Jakarta')->format('d');
	// 	$admin = Invoice_Tagihan::with('user', 'kategori_tagihan')->where('status', 'unpaid')->get();
	// 	$tagihan = [];
	// 	foreach($admin as $p){
	// 		$registeredAt = $p->created_at->isoFormat('D MMMM Y');
	// 		$row['id'] = $p['id'];
	// 		$row['nominal'] = $p['nominal'];
	// 		$row['status'] = $p['status'];
	// 		$row['invoice'] = $p['id_invoice'];
	// 		$row['tanggal'] = $this->tgl_indo($p['tanggal']);
	// 		$row['nama_tagihan'] = $p['kategori_tagihan']['nama_kategori'];
	// 		$row['check'] = false;
	// 		array_push($tagihan, $row);
	// 	}

    //     return response()->json(
	// 		$tagihan
	// 	);
	// }

	function tgl_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);

		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun

		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
}
