<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Jadwal;
use App\Models\Rincian_Siswa;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensController extends Controller
{
	public function store(Request $request)
	{

		$jadwal = $request['jadwal_id'];
		$status = $request['status'];
		$guru_id = $request['guru_id'];
		$semester = $request['semester'];
		$kelas_id = $request['kelas_id'];
		$tahun_ajaran = $request['tahun_ajaran'];
		// dd($absen);
			// dd($request->all());
			foreach($request->absen_banyak as $p => $value){
				$absen = Absen::where('semester', $request['semester'])->where('tahun_ajaran', $request['tahun_ajaran'])->where('siswa_id', $value['siswa_id'])->where('jadwal_id', $request['jadwal_id'])->count();
				$absen_tanggal = Absen::where('semester', $request['semester'])->where('tahun_ajaran', $request['tahun_ajaran'])->where('siswa_id', $value['siswa_id'])->where('jadwal_id', $request['jadwal_id'])->where('tanggal', Carbon::now()->addDays(3)->Format('Y-m-d'))->latest()->first();
				// dd($absen_tanggal->tanggal);

				// if(asset($absen_tanggal->tanggal) == 0 && $absen_tanggal->tanggal != Carbon::now()->addDays(3)->Format('Y-m-d')){

					if($absen_tanggal == null){
						if($absen == 0){
							$create = [
								'siswa_id' => $value['siswa_id'],
								'jadwal_id' => $jadwal,
								'tanggal' => Carbon::now()->addDays(3)->Format('Y-m-d'),
								'status' => $value['status'],
								'pertemuan' => 1,
								'guru_id' => $guru_id,
								'semester' => $semester,
								'kelas_id' => $kelas_id,
								'tahun_ajaran' => $tahun_ajaran
							];
							$absens = Absen::create($create);
						}
						if($absen > 0){
							// $absen = Absen::where('semester', $request->semester)->where('tahun_ajaran', $request->tahun_ajaran)->count();
								$create = [
								'siswa_id' => $value['siswa_id'],
								'jadwal_id' => $jadwal,
								'tanggal' => Carbon::now()->addDays(3)->Format('Y-m-d'),
								'status' => $value['status'],
								'pertemuan' => $absen + 1,
								'guru_id' => $guru_id,
								'semester' => $semester,
								'kelas_id' => $kelas_id,
								'tahun_ajaran' => $tahun_ajaran
										];
								$absens = Absen::create($create);
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

						// $absens = Absen::create($create);

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
					'status' => $request->status,
					'tanggal' => Carbon::now()->addDays(3)->Format('Y-m-d'),
					'pertemuan' => 1,
					'guru_id' => $request->guru_id,
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
					'status' => $request->status,
					'tanggal' => Carbon::now()->addDays(3)->Format('Y-m-d'),
					'pertemuan' => $absen + 1,
					'guru_id' => $request->guru_id,
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
					'status' => $request->status,
					'tanggal' => $tanggal_ini,
					'pertemuan' => 1,
					'guru_id' => $data_jadwal->guru_id,
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
					'status' => $request->status,
					'tanggal' => $tanggal_ini,
					'pertemuan' => $absen + 1,
					'guru_id' => $data_jadwal->guru_id,
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
