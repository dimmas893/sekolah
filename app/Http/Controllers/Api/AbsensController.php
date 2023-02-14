<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Rincian_Siswa;
use App\Models\Ruangan;
use App\Models\Tugas;
use App\Models\Siswa;
use App\Models\Guru;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class AbsensController extends Controller
{

	public function absensi_ulang(Request $request) // pendapatkan daftar siswa yang akan diabsen ulang
	{
	   // dd($request->all());
	    $file_path = 'https://dapurkoding.my.id/';
	    $siswaAbsenUlang = Absen::where('jadwal_id', $request['absen']['id_jadwal'])->where('tanggal', $request['absen']['tgl'])->where('tipe_kehadiran','!=',0)->get();
	   // dd($siswaAbsenUlang);
	    $arrayRincianSiswa = [];
		foreach($siswaAbsenUlang as $p){
			$row['id'] = (int) $p->siswa_id;
			$row['name'] = $p->siswa->nama_siswa;
    			if($p->siswa->avatar != 'avatar'){
    			    $row['avatar'] = $file_path.'avatar/'.$p->siswa->avatar;
    			}elseif($p->siswa->avatar == 'avatar'){
    			    $row['avatar'] = 'https://dapurkoding.my.id/assets/img/avatar/avatar-1.png';
    			}else{
    			    $row['avatar'] = 'https://dapurkoding.my.id/assets/img/avatar/avatar-1.png';
    			}
			$row['presensi'] = (int) $p->tipe_kehadiran;
			array_push($arrayRincianSiswa, $row);
		}
		return response()->json([
			'siswa' => $arrayRincianSiswa
		],200);
	}
	
	public function simpanAbsensiUlang(Request $request)
	{
	    // keterangan kehadiran
	    //0 = hadir
	    //1 = sakit
	    //2 = izin
	    //3 = alpha
	    //4 = terlambat
		
		foreach($request->siswa as $p => $value){
			Absen::where([
        			    ['siswa_id', '=', $value['id']],
        			    ['jadwal_id', '=', $request['absen']['id_jadwal']],
        			    ['tanggal', '=', $request['absen']['tgl']],
    			    ])->update([
        				'tipe_kehadiran' => $value['presensi'],
        			]);
		}
		
		return response()->json([
			'message' => 'Berhasil Absen ulang'
		]);		
	}
	
	public function absensi_list(Request $request)
	{
	    $file_path = 'https://dapurkoding.my.id/';
	    $cekAbsenTanggal = Absen::where('jadwal_id', $request->id_jadwal)->where('tanggal', $request->tgl)->first();
        //  dd($cekAbsenTanggal);
        if($cekAbsenTanggal != null){ // sudah absen pada jadwal itu dan tanggal itu
            $siswaAbsenUlang = Absen::where('jadwal_id', $request->id_jadwal)->where('tanggal', $request->tgl)->where('tipe_kehadiran','!=',0)->get();
    	    $arrayRincianSiswa = [];
    		foreach($siswaAbsenUlang as $p){
    			$row['id'] = (int) $p->siswa_id;
    			$row['name'] = $p->siswa->nama_siswa;
    			if($p->avatar){
    			    $row['avatar'] = $file_path.'avatar/'.$p->avatar;
    			}else{
    			    $row['avatar'] = 'https://dapurkoding.my.id/';
    			}
    			$row['presensi'] = (int) $p->tipe_kehadiran;
    			array_push($arrayRincianSiswa, $row);
    		}
        } else { // belum absen pada jadwal itu dan tanggal itu
            $jadwaldata = Jadwal::where('id', $request->id_jadwal)->first();
            $rincianSiswa = Siswa::where('kelas', $jadwaldata->kelas_id)->get();
            // $rincianSiswa = Rincian_Siswa::where('jadwal_id',$request->id_jadwal)->get();
    	    $arrayRincianSiswa = [];
    		foreach($rincianSiswa as $p){
    			$row['id'] = (int) $p->id;
    			$row['name'] = $p->nama_siswa;
    			if($p->avatar != 'avatar'){
    			    $row['avatar'] = $file_path.'avatar/'.$p->avatar;
    			}elseif($p->avatar == 'avatar'){
    			    $row['avatar'] = 'https://dapurkoding.my.id/assets/img/avatar/avatar-1.png';
    			}else{
    			    $row['avatar'] = 'https://dapurkoding.my.id/assets/img/avatar/avatar-1.png';
    			}
    			array_push($arrayRincianSiswa, $row);
    		}
    		
        }
        
        return response()->json([
    			'siswa' => $arrayRincianSiswa
		],200);
	}

	public function absensi(Request $request) //mendapatkan jadwal mengajar guru pada hari itu
	{
		$date = new DateTime($request->tgl);
    	$tanggalni = $date->format('l');
		$hari = Hari::where('name', $tanggalni)->first();
		$dataGuru = Guru::where('id_user', $request->id_user)->first();
		if($dataGuru != null){
		    $jadwalPelajaran = Jadwal::where('guru_id', $dataGuru->id)->where('hari_id', $hari->id)->get();
            $arrayJadwalPelajaran = [];
    		foreach($jadwalPelajaran as $p){
    		        $cekAbsenTanggal = Absen::where('jadwal_id', $p->id)->where('tanggal', $request->tgl)->first();
    		      //  dd($cekAbsenTanggal);
    		        if($cekAbsenTanggal != null){
    		            $statusAbsen = 1;
    		        } else {
    		            $statusAbsen = 0;
    		        }
    				$tugas = Tugas::where('jadwal_id', $p->id)->count();
		  //  dd($cekAbsenTanggal);
    				$row['id'] = $p['id'];
    				$row['nama'] = $p['mata_pelajaran']['name'];
    				$row['kelas'] = $p['kelasget']['kelas']['name'];
    				$row['jam'] = $p['jam_masuk']. ' - ' . $p['jam_keluar'];
    				$row['tugas'] = $tugas;
    				$row['quiz'] = 0;
    				$row['status_absensi'] = $statusAbsen;
    				array_push($arrayJadwalPelajaran, $row);
    			}
    		return response()->json([
    			'jampel' => $arrayJadwalPelajaran
    		],200);
		} else {
		    return response()->json([
    			'error' => ['Data tidak ditemukan']
    		],404);
		}
	}
	
	public function store(Request $request)
	{
	    // keterangan kehadiran
	    //0 = hadir
	    //1 = sakit
	    //2 = izin
	    //3 = alpha
	    //4 = terlambat
		$dataJadwal = Jadwal::where('id',$request['absen']['id_jadwal'])->first();
		
		$cekAbsenTanggal = Absen::where('jadwal_id', $request['absen']['id_jadwal'])->where('tanggal', $request['absen']['tgl'])->first();
		if ($cekAbsenTanggal === null) { // jika belum melakukan absensi
			$cekAbsensiPertemuanPertama = Absen::where('jadwal_id', $request->id_jadwal)->first();
			if ($cekAbsensiPertemuanPertama === null) { // jika ini adalah pertemuan pertama
				foreach($request->siswa as $p => $value){
					$create = [
						'siswa_id' => $value['id'],
						'jadwal_id' => 	$dataJadwal->id,
						'tanggal' => $request['absen']['tgl'],
						'tipe_kehadiran' => $value['presensi'],
						'pertemuan' => 1,
						'dibuat_oleh' => $dataJadwal->guru_id,
					];
					$absens = Absen::create($create);
				}
			} else { // jika ini adalah pertemuan selanjutnya
				$absen = Absen::where('jadwal_id', $request['jadwal_id'])->latest()->first();					
				foreach($request->siswa as $p => $value){
					$create = [
						'siswa_id' => $value['id'],
						'jadwal_id' => $dataJadwal->id,
						'tanggal' => $request['absen']['tgl'],
						'tipe_kehadiran' => $value['presensi'],
						'pertemuan' => $absen->pertemuan + 1,
						'dibuat_oleh' => $dataJadwal->guru_id
					];
					$absens = Absen::create($create);					
				}
			}

			return response()->json([
				'message' => 'Berhasil Absen'
			]);		
		} else {
			return response()->json([
				'error' => ['Siswa Sudah Absen']
			],403);
		}
	}

	//berhasil absensi satuan
	public function absen_satuan(Request $request)
	{
		// $absen = Absen::where('semester', $request->semester)->where('tahun_ajaran', $request->tahun_ajaran)->where('jadwal_id', $request->jadwal_id)->count();
		$absen = Absen::where('semester', $request->semester)->where('tahun_ajaran', $request->tahun_ajaran)->where('siswa_id', $request->siswa_id)->where('jadwal_id', $request->jadwal_id)->count();
		$absen_tanggal = Absen::where('semester', $request->semester)->where('tahun_ajaran', $request->tahun_ajaran)->where('siswa_id', $request->siswa_id)->where('jadwal_id', $request->jadwal_id)->where('tanggal', Carbon::now()->addDays(3)->Format('Y-m-d'))->latest()->first();

		if($absen_tanggal == null){
			if($absen == 0){
				$create = [
					'siswa_id' => $request->siswa_id,
					'jadwal_id' => $request->jadwal_id,
					'tipe_kehadiran' => $request->tipe_kehadiran,
					'tanggal' => Carbon::now()->addDays(3)->Format('Y-m-d'),
					'pertemuan' => 1,
					'dibuat_oleh' => $request->dibuat_oleh,
					'semester' => $request->semester,
					'kelas_id' => $request->kelas_id,
					'tahun_ajaran' => $request->tahun_ajaran
				];

				$absens = Absen::create($create);
				return response()->json($absens);
			}

			if($absen > 0){
				$absen = Absen::where('semester', $request->semester)->where('tahun_ajaran', $request->tahun_ajaran)->where('siswa_id', $request->siswa_id)->where('jadwal_id', $request->jadwal_id)->count();
				$create = [
					'siswa_id' => $request->siswa_id,
					'jadwal_id' => $request->jadwal_id,
					'tipe_kehadiran' => $request->tipe_kehadiran,
					'tanggal' => Carbon::now()->addDays(3)->Format('Y-m-d'),
					'pertemuan' => $absen + 1,
					'dibuat_oleh' => $request->dibuat_oleh,
					'semester' => $request->semester,
					'kelas_id' => $request->kelas_id,
					'tahun_ajaran' => $request->tahun_ajaran
				];

				$absens = Absen::create($create);
				return response()->json($absens);
			}
				return response()->json([
					'message' => 'Berhasil Absen'
				]);
		}
			if($absen_tanggal != null){
				if($absen_tanggal->tanggal == Carbon::now()->addDays(3)->Format('Y-m-d')){
					return response()->json([
						'message' => 'Siswa Sudah Absen'
					]);
				}
			}
	}


	public function absen_mandiri(Request $request)
	{
		// dd($request->all());
		$ruangan = Rincian_Siswa::where('siswa_id', $request->pin)->first();
		$data_jadwal = Jadwal::where('id',$ruangan->jadwal_id)->first();
		// dd($data_jadwal);
		$data_semester = $request->semester;
		$data_tahun_ajaran = $request->tahun_ajaran;
		$tanggal_ini = Carbon::now()->Format('Y-m-d');
		// $absen = Absen::where('semester', $request->semester)->where('tahun_ajaran', $request->tahun_ajaran)->where('jadwal_id', $request->jadwal_id)->count();
		$absen = Absen::where('semester', $data_semester)->where('tahun_ajaran', $data_tahun_ajaran)->where('siswa_id', $data_jadwal->siswa_id)->where('jadwal_id', $data_jadwal->id)->count();
		$absen_tanggal = Absen::where('semester', $data_semester)->where('tahun_ajaran', $data_tahun_ajaran)->where('siswa_id', $data_jadwal->siswa_id)->where('jadwal_id', $data_jadwal->id)->where('tanggal', $tanggal_ini)->latest()->first();

		if($absen_tanggal == null){
			if($absen == 0){
				$create = [
					'siswa_id' => $ruangan->siswa_id,
					'jadwal_id' => $data_jadwal->id,
					'tipe_kehadiran' => $request->tipe_kehadiran,
					'tanggal' => $tanggal_ini,
					'pertemuan' => 1,
					'dibuat_oleh' => $data_jadwal->dibuat_oleh,
					'semester' => $data_semester,
					'kelas_id' => $data_jadwal->kelas_id,
					'tahun_ajaran' => $data_tahun_ajaran
				];

				$absens = Absen::create($create);
				return response()->json($absens);
			}

			if($absen > 0){
				$absen = Absen::where('semester', $request->semester)->where('tahun_ajaran', $request->tahun_ajaran)->where('siswa_id', $request->siswa_id)->where('jadwal_id', $request->jadwal_id)->count();
				$create = [
					'siswa_id' => $data_jadwal->siswa_id,
					'jadwal_id' => $data_jadwal->id,
					'tipe_kehadiran' => $request->tipe_kehadiran,
					'tanggal' => $tanggal_ini,
					'pertemuan' => $absen + 1,
					'dibuat_oleh' => $data_jadwal->dibuat_oleh,
					'semester' => $data_semester,
					'kelas_id' => $data_jadwal->kelas_id,
					'tahun_ajaran' => $data_tahun_ajaran
				];

				$absens = Absen::create($create);
				return response()->json($absens);
			}
			return response()->json([
				'message' => 'Berhasil Absen'
			]);
		}

		if($absen_tanggal != null){
			if($absen_tanggal->tanggal == $tanggal_ini){
				return response()->json([
					'message' => 'Siswa Sudah Absen',
				],404);
			}
		}

	}


}
