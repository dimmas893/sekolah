<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Rincian_Siswa;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalsController extends Controller
{
    public function index()
	{
		$hariini = Carbon::now()->isoFormat('dddd');

		$data_hari = Hari::where('name', $hariini)->first();
		// dd($hariini);
		$admin = Jadwal::where('guru_id', 3)->where('hari_id',$data_hari->id)->get();
		$tagihan = [];
		foreach($admin as $p){
			$row['kelas'] = $p['kelasget']['kelas']['name'];
			// $row['siswa'] = $p['siswa']['nama_siswa'];
			$row['ruangan'] = $p['ruangan']['name'];
			$row['guru'] = $p['guru']['name'];
			$row['mata_pelajaran_id'] = $p['mata_pelajaran']['name'];
			$row['hari'] = $p['hari']['name'];
			$row['jam_masuk'] = $p['jam_masuk'];
			$row['jam_keluar'] = $p['jam_keluar'];
			array_push($tagihan, $row);
		}

        return response()->json(
			$tagihan
		);
	}
	
    public function jadwal_pelajaran()
	{
		$hariini = Carbon::now()->isoFormat('dddd');

		$data_hari = Hari::where('name', $hariini)->first();
		// dd($hariini);
		$admin = Jadwal::with('kelas',	'ruangan', 'guru', 'hari', 'mata_pelajaran')->where('guru_id', 2)->where('hari_id',$data_hari->id)->get();
		$tagihan = [];
		foreach($admin as $p){
			$row['kelas'] = $p['kelas']['name'];
			// $row['siswa'] = $p['siswa']['nama_siswa'];
			$row['ruangan'] = $p['ruangan']['name'];
			$row['guru'] = $p['guru']['name'];
			$row['mata_pelajaran_id'] = $p['mata_pelajaran']['name'];
			$row['hari'] = $p['hari']['name'];
			$row['jam_masuk'] = $p['jam_masuk'];
			$row['jam_keluar'] = $p['jam_keluar'];
			array_push($tagihan, $row);
		}

        return response()->json(
			$tagihan
		);
	}

	public function get_siswa_jadwal(Request $request)
	{
		$data_jadwal = Jadwal::with('kelas','ruangan', 'guru', 'hari', 'mata_pelajaran')->where('id', $request->jadwal_id)->first();

		$kelas = $data_jadwal->kelas->name;
		$guru = $data_jadwal->guru->name;
		$mata_pelajaran = $data_jadwal->mata_pelajaran->name;
		$hari = $data_jadwal->hari->name;
		$jam_masuk = $data_jadwal->jam_masuk;
		$jam_keluar = $data_jadwal->jam_keluar;
		// dd($kelas);

		$rincian_siswa = Rincian_Siswa::with('siswa')->where('jadwal_id', $data_jadwal->id)->get();
		$siswa = [];
		foreach($rincian_siswa as $p){
			$row['id'] = $p['siswa']['id'];
			$row['nomor_induk_siswa'] = $p['siswa']['nomor_induk_siswa'];
			$row['jenis_kelamin'] = $p['siswa']['jenis_kelamin'];
			$row['nama'] = $p['siswa']['nama_siswa'];
			array_push($siswa, $row);
		}
        return response()->json([
			'jadwal' => [
				'jadwal_id' => $data_jadwal->id,
				'kelas' => $data_jadwal->kelas->name,
				'kelas_id' => $data_jadwal->kelas_id,
				'guru' => $data_jadwal->guru->name,
				'guru_id' => $data_jadwal->guru_id,
				'mata_pelajaran' => $data_jadwal->mata_pelajaran->name,
				'mata_pelajaran_id' => $data_jadwal->mata_pelajaran_id,
				'hari' => $data_jadwal->hari->name,
				'jam_masuk' => $data_jadwal->jam_masuk,
				'jam_keluar' => $data_jadwal->jam_keluar
			],
			'siswa' => $siswa
		]);
	}

	public function ambil_semua_jadwal(Request $request)
	{
		$siswa_id = Siswa::where('id', $request->id)->first();
		$rincian_siswa = Rincian_Siswa::where('siswa_id', $siswa_id->id)->get();
		$siswa = [];
		$hari = [];
		foreach($rincian_siswa as $p){
			$data_jadwal = Jadwal::with('kelas','ruangan', 'guru', 'hari', 'mata_pelajaran')->where('id', $p->jadwal_id)->first();
			// dd($data_jadwal);
			$row['jadwal_id'] = $data_jadwal->id;
			$row['jam'] = $data_jadwal->jam_masuk . ' '. '-'.' ' . $data_jadwal->jam_keluar;
			$row['mata_pelajaran'] = $data_jadwal->mata_pelajaran->name;
			$row['hari'] = $data_jadwal->hari->name;
			array_push($siswa, $row);
			// array_push($hari, $raw);
		}

		return response()->json([
			// 'siswa' => $siswa_id->,
			'semua_jadwal' => $siswa
		]);
	}
}
