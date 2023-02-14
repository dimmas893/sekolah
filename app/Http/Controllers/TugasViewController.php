<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kumpul_Tugas;
use App\Models\Siswa;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasViewController extends Controller
{
	public function SiswaTampilTugas()
	{
		$tanggal = Carbon::now()->add(1, 'day')->format('Y-m-d');
		$tanggalhariini = Carbon::now()->format('Y-m-d');
		$Siswa = Siswa::where('id_user', Auth::user()->id)->first();
		$jadwal = Jadwal::where('kelas_id', $Siswa->kelas)->get();
		$dedline = [];
		$tampungtugas = [];
		$batastampung = [];
		$sudahdikumpulkan = [];
		foreach ($jadwal as $pe) {
			$mendekati['mendekati'] = Kumpul_Tugas::with('tugas', 'jadwal')->whereIn('tanggal_pengumpulan', [$tanggalhariini, $tanggal])->where('jadwal_id', $pe->id)->where(
				'file_upload',
				null
			)->where('siswa_id', $Siswa->id)->get();
			$mendekati['jadwal'] = $pe['kelasget']['kelas']['name'] . ' / ' . $pe['ruangan']['name'] . ' / ' . $pe['mata_pelajaran']['name'];


			$batas['batas'] = Kumpul_Tugas::with('tugas', 'jadwal')->where('tanggal_pengumpulan', '<', $tanggalhariini)->where('jadwal_id', $pe->id)->where(
				'file_upload',
				null
			)->where('siswa_id', $Siswa->id)->get();
			$batas['jadwal'] = $pe['kelasget']['kelas']['name'] . ' / ' . $pe['ruangan']['name'] . ' / ' . $pe['mata_pelajaran']['name'];

			$tugasBelum['tugas'] = Kumpul_Tugas::with('tugas', 'jadwal')->where('tanggal_pengumpulan', '>', $tanggal)->where('jadwal_id', $pe->id)->where(
				'file_upload',
				null
			)->where('siswa_id', $Siswa->id)->get();
			$tugasBelum['jadwal'] = $pe['kelasget']['kelas']['name'] . ' / ' . $pe['ruangan']['name'] . ' / ' . $pe['mata_pelajaran']['name'];

			$sudah['sudah'] = Kumpul_Tugas::with('tugas', 'jadwal')->where('jadwal_id', $pe->id)->where(
				'file_upload',
				'!=',
				null
			)->where('siswa_id', $Siswa->id)->get();
			$sudah['jadwal'] = $pe['kelasget']['kelas']['name'] . ' / ' . $pe['ruangan']['name'] . ' / ' . $pe['mata_pelajaran']['name'];
			array_push($dedline, $mendekati);
			array_push($tampungtugas, $tugasBelum);
			array_push($batastampung, $batas);
			array_push($sudahdikumpulkan, $sudah);
		}
		// dd($tampungtugas);
		return view('tugas.view.SiswaTugasTampil', compact('dedline', 'tampungtugas', 'batastampung', 'sudahdikumpulkan'));
	}
}
