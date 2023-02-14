<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\Kumpul_Tugas;
use App\Models\Rincian_Siswa;
use App\Models\Tugas;
use App\Models\Guru;
use App\Models\Kegiatan;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TugasController extends Controller
{
    public function daftar_tugas(Request $request)
	{
		if(isset($request->tgl) == true){
		    $siswa = Siswa::where('id_user', $request->id_user)->first();
			$Kumpul_tugas = Kumpul_Tugas::where('siswa_id', $siswa->id)->first();
			$tagihan = [];
			$tugas = Tugas::where('tanggal_tugas', $request->tgl)->get();
			// dd($tugas);
			foreach($tugas as $p){
					$jadwal = Jadwal::with('mata_pelajaran')->where('id', $p->jadwal_id)->first();
					// dd($jadwal);
					$row['id'] =(int) $p['tugas_id'];
					$row['mapel'] = $jadwal['mata_pelajaran']['name'];
					$row['nama'] = $p['nama'];
					$row['deskripsi'] = $p['deskripsi'];
					$row['tgl_tugas'] = $p['tanggal_tugas'];
					$row['tenggat_waktu'] = $p['tanggal_pengumpulan'];
					$row['status'] = (int) $p['status_pengumpulan'];
					array_push($tagihan, $row);
				}
				return response()->json([
					'data' => $tagihan
				]);
			}elseif(isset($request->tgl) != true){
			    
		    $siswa = Siswa::where('id_user', $request->id_user)->first();
		  //  dd($siswa);
			$Kumpul_tugas = Kumpul_Tugas::where('siswa_id', $siswa->id)->get();
				// $Kumpul_tugas = Kumpul_Tugas::where('siswa_id', $request->id_user)->get();
				$tagihan = [];
				foreach($Kumpul_tugas as $pe){
					$tugas = Tugas::where('id', $pe->tugas_id)->first();
					$jadwal = Jadwal::with('mata_pelajaran')->where('id', $tugas->jadwal_id)->first();
					// dd($jadwal);
					$row['id'] =(int) $tugas['id'];
					$row['mapel'] = $jadwal['mata_pelajaran']['name'];
					$row['nama'] = $tugas['nama'];
					$row['deskripsi'] = $tugas['deskripsi'];
					$row['tgl_tugas'] = $tugas['tanggal_tugas'];
					$row['tenggat_waktu'] = $tugas['tanggal_pengumpulan'];
					$row['read'] = 0;
					$row['status'] = (int) $pe['status_pengumpulan'];
					array_push($tagihan, $row);
				}
				return response()->json([
					'data' => $tagihan
				]);
			}
	}

    public function detail_tugas(Request $request)
	{
	    
		$siswa = Siswa::where('id_user', $request->id_user)->first();
		$Kumpul_tugas = Kumpul_Tugas::where('tugas_id', $request->id_tugas)->where('siswa_id', $siswa->id)->get();
		
		foreach($Kumpul_tugas as $p){
			if($p->status_pengumpulan == 0){
				$tugas = Tugas::where('id', $p->tugas_id)->first();
				$jadwal = Jadwal::with('mata_pelajaran')->where('id', $tugas->jadwal_id)->first();
				// dd($jadwal);
				$row['id'] = (int)$p['tugas_id'];
				$row['mapel'] = $jadwal['mata_pelajaran']['name'];
				$row['nama'] = $tugas['nama'];
				$row['deskripsi'] = $tugas['deskripsi'];
				$row['tgl_tugas'] = $tugas['tanggal_tugas'];
				$row['tenggat_waktu'] = $tugas['tanggal_pengumpulan'];
				$row['status'] = (int)$p['status_pengumpulan'];

				$lampiran['id'] = (int) $tugas['id'];
				$lampiran['nama'] = $tugas['nama'];
				$lampiran['link'] = $tugas['file_tugas'];
				return response()->json([
					'detail_tugas' => $row,
					'lampiran' => [$lampiran],
					'pekerjaan' => []
				]);
			}

			if($p->status_pengumpulan == 1){
				$tugas = Tugas::where('id', $p->tugas_id)->first();
				$jadwal = Jadwal::with('mata_pelajaran')->where('id', $tugas->jadwal_id)->first();
				// dd($jadwal);
				$row['id'] =(int) $p['tugas_id'];
				$row['mapel'] = $jadwal['mata_pelajaran']['name'];
				$row['nama'] = $tugas['nama'];
				$row['deskripsi'] = $tugas['deskripsi'];
				$row['tgl_tugas'] = $tugas['tanggal_tugas'];
				$row['tenggat_waktu'] = $tugas['tanggal_pengumpulan'];
				$row['status'] = (int) $p['status_pengumpulan'];

				$lampiran['id'] =(int) $tugas['id'];
				$lampiran['nama'] = $tugas['nama'];
				$lampiran['link'] = $tugas['file_tugas'];

				$pekerjaans['id'] = $p['id'];
				$pekerjaans['nama'] = $tugas['nama'];
				$pekerjaans['link'] = $p['file_upload'];
				$pekerjaans['tgl'] = $tugas['tanggal_evaluasi'];

				return response()->json([
					'detail_tugas' => $row,
					'lampiran' => [$lampiran],
					'pekerjaan' => [$pekerjaans]
				]);
			}

		}
	}

	public function jadwal_pelajaran(Request $request)
	{
        $file_path = 'https://dapurkoding.my.id/';
		$id_siswa = $request->id_user;
		$date = new DateTime($request->tgl);
		$tanggalni = $date->format('D');
		$pekerjaan = [];
		$tugass = [];
		
		$hari = Hari::where('nama', $tanggalni)->first();
		$dataSiswa = Siswa::where('id_user', $request->id_user)->first();
		$rincian_siswa = Jadwal::where('kelas_id', $dataSiswa->kelas)->get();
		$jadwallllllll = [];
		foreach($rincian_siswa as $p){
			$jadwal = Jadwal::with('mata_pelajaran')->where('hari_id', $hari->id)->where('id', $p->id)->first();
			if ($jadwal != null){
			    $tugas = Tugas::where('jadwal_id', $jadwal->id)->get();
				if(count($tugas) > 0){
				   $jumlahTugas = count($tugas); 
				} else {
				    $jumlahTugas = 0;
				}
				$pekerjaans['id'] = $jadwal['id'];
				$pekerjaans['nama'] = $jadwal['mata_pelajaran']['name'];
				$pekerjaans['jam'] = $jadwal['jam_masuk']. ' - ' . $jadwal['jam_keluar'];
				$pekerjaans['tugas'] =  $jumlahTugas;
				$pekerjaans['quiz'] = 0;
				array_push($pekerjaan, $pekerjaans);
				array_push($tugass, $tugas);
				array_push($jadwallllllll, $jadwal['id']);
			}
		}

		return response()->json([
			'pelajaran' => $pekerjaan,
		]);
	}
	
	public function jadwal(Request $request){
        $file_path = 'https://dapurkoding.my.id/';
		$id_siswa = $request->id_user;
		$date = new DateTime($request->tgl);
		$tanggalni = $date->format('D');
		$pekerjaan = [];
		$tugass = [];
		$hari = Hari::where('nama', $tanggalni)->first();
		$hariID = $hari->id;
		$dataSiswa = Siswa::where('id_user', $request->id_user)->first();
		
		$dataGuru = Guru::where('id_user', $request->id_user)->first();
	    
	    if($dataSiswa){
	    $dataKelas = $dataSiswa->kelas;
		$dataJadwal = Jadwal::where('kelas_id',$dataSiswa->kelas)->where('hari_id',$hariID)->get();
		$jadwallllllll = [];
		foreach($dataJadwal as $p){
			$tugas = Tugas::where('jadwal_id', $p->id)->get();
			$pekerjaans['id'] = $p['id'];
			$pekerjaans['nama'] = $p['mata_pelajaran']['name'];
			$pekerjaans['jam'] = $p['jam_masuk']. ' - ' . $p['jam_keluar'];
			$pekerjaans['tugas'] = count($tugas);
			$pekerjaans['quiz'] = 0;
			array_push($pekerjaan, $pekerjaans);
			array_push($tugass, $tugas);
			array_push($jadwallllllll, $p['id']);
		}
		
	
		$bacod = [];
		foreach($tugass as $p){
			foreach($p as $pu){
		  //  dd($pu);
				$jadwal_1 = Jadwal::with('mata_pelajaran')->where('id', $pu->jadwal_id)->first();
				$row['id'] = $pu['id'];
				$row['mapel'] = $jadwal_1['mata_pelajaran']['name'];
				$row['nama'] = $pu['nama'];
				$row['deskripsi'] = $pu['deskripsi'];
				$row['tanggal_tugas'] = $pu['tanggal_tugas'];
				$row['tenggat_waktu'] = $pu['tanggal_pengumpulan'];
				$row['status'] = (int)$pu['status_aktif'];
				array_push($bacod, $row);
			}
		}
		$dataKegiatan = [];
		$rincian_kegiatan = Kegiatan::where('siswa_id', null)->get();
        if($rincian_kegiatan){
            foreach($rincian_kegiatan as $ks){
    			$rowK['id'] = $ks->id;
    			$rowK['nama'] = $ks->nama_kegiatan;
    			$rowK['jam'] = $ks->jam;
    			$rowK['jenis'] = 1;
    			$rowK['avatar'] = $file_path.'kegiatan/'.$ks->foto;
    			array_push($dataKegiatan, $rowK);
    		}
        }

		return response()->json([
			'pelajaran' => $pekerjaan,
			'tugas' => $bacod,
			'kegiatan' => $dataKegiatan
		]);
	    }elseif($dataGuru){
	       // $dataKelas = $dataSiswa->kelas;
    		$dataJadwal = Jadwal::where('guru_id',$dataGuru->id)->where('hari_id',$hariID)->get();
    		$jadwallllllll = [];
    		foreach($dataJadwal as $p){
    			$tugas = Tugas::where('jadwal_id', $p->id)->get();
    			$pekerjaans['id'] = $p['id'];
    			$pekerjaans['nama'] = $p['mata_pelajaran']['name'];
    			$pekerjaans['jam'] = $p['jam_masuk']. ' - ' . $p['jam_keluar'];
    			$pekerjaans['tugas'] = count($tugas);
    			$pekerjaans['quiz'] = 0;
    			array_push($pekerjaan, $pekerjaans);
    			array_push($tugass, $tugas);
    			array_push($jadwallllllll, $p['id']);
    		}
    		
    // 		dd($tugass);
    	
    		$bacod = [];
    		foreach($tugass as $p){
    			foreach($p as $pu){
    		  //  dd($pu);
    				$jadwal_1 = Jadwal::with('mata_pelajaran')->where('id', $pu->jadwal_id)->first();
    				$row['id'] = $pu['id'];
    				$row['mapel'] = $jadwal_1['mata_pelajaran']['name'];
    				$row['nama'] = $pu['nama'];
    				$row['deskripsi'] = $pu['deskripsi'];
    				$row['tanggal_tugas'] = $pu['tanggal_tugas'];
    				$row['tenggat_waktu'] = $pu['tanggal_pengumpulan'];
    				$row['status'] = (int)$pu['status_aktif'];
    				array_push($bacod, $row);
    			}
    		}
    		$dataKegiatan = [];
    		$rincian_kegiatan = Kegiatan::where('siswa_id', null)->get();
            if($rincian_kegiatan){
                foreach($rincian_kegiatan as $ks){
        			$rowK['id'] = $ks->id;
        			$rowK['nama'] = $ks->nama_kegiatan;
        			$rowK['jam'] = $ks->jam;
        			$rowK['jenis'] = 1;
        			$rowK['avatar'] = $file_path.'kegiatan/'.$ks->foto;
        			array_push($dataKegiatan, $rowK);
        		}
            }
    
    		return response()->json([
    			'pelajaran' => $pekerjaan,
    			'tugas' => $bacod,
    			'kegiatan' => $dataKegiatan
    		]);
	    }else{
	        return response()->json('Data Tidak Ada');
	    }
	}
}
