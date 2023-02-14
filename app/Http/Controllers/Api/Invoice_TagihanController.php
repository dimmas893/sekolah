<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice_Tagihan;
use App\Models\Siswa;
use App\Models\Tagihan_Siswa;
use App\Models\Kategori_Tagihan;
use App\Models\Pembayaran;
use App\Models\Wali_Siswa;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class Invoice_TagihanController extends Controller
{
	public function callbck(){
		return response()->json(['status' => 200],200);
	}

	public function tagihan_siswa(Request $request)	{
	    $file_path = 'https://dapurkoding.my.id/';
		$siswa = Siswa::where('id_user', $request->id_user)->first();
		$invoice_tagihan = Invoice_Tagihan::with('kategori_tagihan')->where('id_siswa', $siswa->id)->where('status', 'unpaid')->get();
		//dd($invoice_tagihan);
		$tagihan = [];
		foreach($invoice_tagihan as $p){
		    if ($p->kategori_tagihan->avatar != null) {
				$ava = $file_path.'folder_tagihan/'.$p->kategori_tagihan->avatar;
			} else {
				$ava = $file_path.'folder_tagihan/invoice-icon.png';
			}
			
		    if ($p->kategori_tagihan->minimum_bayar != null) {
				$minimumBayar = $p->kategori_tagihan->minimum_bayar;
			} else {
				$minimumBayar = (int) $p['nominal'];
			}
			
			$row['id'] = $p['id_invoice'];
			$row['nama'] = $p->kategori_tagihan->kategori_tagihan->deskripsi;
			$row['nominal'] = (int) $p['nominal'];
			$row['cicil'] = (int) $p->kategori_tagihan->kategori_cicilan;
			$row['minimum_bayar'] = $minimumBayar;
			$row['batas_bayar'] = $p->kategori_tagihan->batas_bayar;
			$row['avatar'] = $ava;
			array_push($tagihan, $row);
		}

        return response()->json([
			'data' => $tagihan,
			'biaya_lain' =>  [
				["idnya" => 1,
				"nama" => "Fee Transaksi",
				"nominal"=> 5000]
			]
		], 200);

        // 		return response()->json([
        // 			'data' =>	'Data Tidak Tersedia'
        // 		], 404);
	}
	
	
	public function list_laporan_keuangan(Request $request)	{
	    $file_path = 'https://dapurkoding.my.id/';
		$daftarKategori = Kategori_Tagihan::get();
		$siswa = Siswa::where('id_user', $request->id_user)->first();
		if ($siswa != null) {
		    $daftarSiswa = Siswa::where('id','=',$siswa->id)->get();
		} else {
		    $waliSiswa = Wali_Siswa::where('id_user', $request->id_user)->first();
		    $daftarSiswa = Siswa::where('id_orang_tua','=',$waliSiswa->id)->get();
		}
	
        $daftarKategori = Kategori_Tagihan::get();
		$dataKategori = [];
		foreach($daftarKategori as $kat){
		    $rowKat['id'] = $kat['id'];
			$rowKat['name'] = $kat->nama_kategori;
			array_push($dataKategori, $rowKat);
		}
		$dataSiswa = [];
		$dataIDSiswa = [];
		foreach($daftarSiswa as $sis){
		    $row['id'] = $sis->nisn;
			$row['name'] = $sis->nama_siswa;
			$row['avatar'] = $file_path.'avatar/'.$sis->avatar;
			array_push($dataSiswa, $row);
			
			$rowIDsiswa = $sis->id;
			array_push($dataIDSiswa, $rowIDsiswa);
		}
		$setting = Setting::first();
		 $pembayaran = DB::table("pembayarans")->select(DB::raw('YEAR(tanggal_pembayaran) year, MONTH(tanggal_pembayaran) month'))
        ->whereIn('siswa_id', $dataIDSiswa)
        ->where('id_tahun_ajaran', $setting->id_tahun_ajaran)
        ->groupby('year','month')
        ->get();
        
        // dd($dataIDSiswa);
		  
		 $dataPeriode = [];
	     foreach($pembayaran as $pem){
	        $month = $pem->year.'-'.$pem->month;
            $start = Carbon::parse($month)->startOfMonth();
            $end = Carbon::parse($month)->endOfMonth();
            
		    $rowPer['bulan'] = $this->getBulan($pem->month).' '.$pem->year;
			$rowPer['tgl_mulai'] = $start->format('Y-m-d');
			$rowPer['tgl_akhir'] = $end->format('Y-m-d');
		    array_push($dataPeriode, $rowPer);
		}

        return response()->json([
			'kategori' => $dataKategori,
			'siswa' => $dataSiswa,
			'periode' => $dataPeriode,
		], 200);
	}
	
	function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
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
