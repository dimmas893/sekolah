<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\notifikasi;
use App\Models\Jadwal;
use App\Models\Hari;
use App\Models\Siswa;
use App\Models\Invoice_Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function notifikasi(Request $request)
    {
		$myDate = Carbon::today()->format('Y-m-d');
        // $namaHari = Carbon::createFromFormat('Y-m-d', $myDate)->format('l');
        $namaHari = Carbon::today()->format('l');
		// dd($namaHari);
        $hariJadwal = Hari::where('name', $namaHari)->first();
		$dataNotifikasi = [];
		$idUser = $request->id_user;
		$siswa = Siswa::where('id_user', $idUser)->first();
        $idSiswa = $siswa->id;
        
// 		$jadwalSiswa = Jadwal::where('hari_id',$hariJadwal->id)->with('relasi_rincian_siswa')
// 						->whereHas('relasi_rincian_siswa', function($q) use ($idSiswa){
// 							$q->where('siswa_id',$idSiswa);
// 						})->get();
		$dataSiswa = Siswa::where('id_user', $request->id_user)->first();
		$jadwalSiswa = Jadwal::where('kelas_id',$dataSiswa->kelas)->where('hari_id',$hariJadwal->id)->get();

		foreach ($jadwalSiswa as $value) {
			$row['id'] = $value->id;
			$row['nama'] = $value->mata_pelajaran->name;
			$row['subnama'] = 'pelajaran';
			$row['deskripsi'] = 'ini adalah jadwal pelajaran';
			$row['tgl_notifikasi'] = $myDate;
			$row['tenggat_waktu'] = null;
			$row['read'] = 0;
			array_push($dataNotifikasi, $row);
		}
		$tagihanSiswa = Invoice_Tagihan::where('id_siswa', $idSiswa)->where('status', 'unpaid')->get();
		
		foreach ($tagihanSiswa as $tagihan) {
			$row['id'] = $tagihan->id;
			$row['nama'] = $tagihan->kategori_tagihan->deskripsi;
			$row['subnama'] = 'tagihan';
			$row['deskripsi'] = 'ini adalah tagihan siswa';
			$row['tgl_notifikasi'] = $myDate;
			$row['tenggat_waktu'] = null;
			$row['read'] = 0;
			array_push($dataNotifikasi, $row);
		}

		if (count($dataNotifikasi) > 0) {
			return response()->json([
				'notifikasi' => $dataNotifikasi
			]);
		} else {
			return response()->json([
				'notifikasi' => 'Data Tidak Tersedia'
			]);
		}       
    }
}
