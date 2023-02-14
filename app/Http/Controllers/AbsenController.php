<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Rincian_Siswa;
use App\Models\Setting;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
	public function laporan_absen_admin_view()
	{

		$setting = Setting::first();
		$kelas = Kelas::where('id_tahun_ajaran', $setting->id_tahun_ajaran)->get();
		// dd($kelas);
		return view('admin.halaman_user.laporan_absen', compact('kelas'));
	}

	public function laporan_absen_admin(Request $request)
	{
		$setting = Setting::first();
		$tampung_absen_2 = [];

		$kelas = Kelas::where('id', $request->kelas_id)->first();
		$absen = Absen::with('jadwal', 'siswa')->where('kelas_id', $kelas->id)->where('semester', $setting->semester)->where('tahun_ajaran', $setting->id_tahun_ajaran)->orderBy('jadwal_id')->get()->groupBy(function ($data) {
			return $data->jadwal->mata_pelajaran->name . ' / ' . $data->jadwal->ruangan->name . ' / ' . $data->jadwal->kelasget->tahun_ajaran->tahun_ajaran;
		});

		$absen1 = Absen::select('jadwal_id')->groupBy('jadwal_id')->get();
		return view('admin.halaman_user.laporan_absen_tampil', compact('absen', 'absen1', 'kelas'));
	}
	public function laporan_absen(Request $request)
	{
		$siswa = Siswa::where('id_user', Auth::user()->id)->first();
		if ($siswa) {
			$rincian_siswa = Kelas::where('id', $siswa->kelas)->first();
			$tampung_absen = [];
			$laporan = [];
			$jadwal = Jadwal::where('kelas_id', $rincian_siswa->id)->get();
			foreach ($jadwal as $pe) {
				$hadir = Absen::where('jadwal_id', $pe->id)->where('siswa_id', $siswa->id)->where('tipe_kehadiran', '0')->count();
				$sakit = Absen::where('jadwal_id', $pe->id)->where('siswa_id', $siswa->id)->where('tipe_kehadiran', '1')->count();
				$izin = Absen::where('jadwal_id', $pe->id)->where('siswa_id', $siswa->id)->where('tipe_kehadiran', '2')->count();
				$alpha = Absen::where('jadwal_id', $pe->id)->where('siswa_id', $siswa->id)->where('tipe_kehadiran', '3')->count();
				$terlambat = Absen::where('jadwal_id', $pe->id)->where('siswa_id', $siswa->id)->where('tipe_kehadiran', '4')->count();
				$row['jadwal'] = $pe['kelasget']['kelas']['name'] . ' / ' . $pe['ruangan']['name'] . ' / ' . $pe['mata_pelajaran']['name'];
				// dd($jadwal);
				$row['pertemuan'] = $hadir + $sakit + $izin + $alpha + $terlambat;
				$row['hadir'] = $hadir;
				$row['sakit'] = $sakit;
				$row['izin'] = $izin;
				$row['alpha'] = $alpha;
				$row['terlambat'] = $terlambat;
				array_push($laporan, $row);
			}
			return view('absen.laporan', compact('laporan'));
		} else {
			return back()->with('gagalmasuk', 'h');
		}
	}


	public function laporan_filter_absensi_siswa(Request $request)
	{
		// $setting = Setting::first();
		// $laporan = [];
		// $tampung_absen_2 = [];

		// $kelas = Kelas::where('id', $request->kelas_id)->first();
		// $cek_absennih = Absen::where('tanggal', $request->akhir)->first();
		// if ($cek_absennih) {
		// 	$absen = Absen::with('jadwal', 'siswa')->whereBetween('tanggal', [$request->awal, $request->akhir])->where('kelas_id', $kelas->id)->where('semester', $setting->semester)->where('tahun_ajaran', $setting->id_tahun_ajaran)->orderBy('id', 'DESC')->get();
		// 	foreach ($absen as $pe) {
		// 		if ($pe) {
		// 			$hadir = $pe->where('siswa_id', $pe->siswa_id)->where('jadwal_id', $pe->jadwal_id)->where('tipe_kehadiran', '0')->count();
		// 			$sakit = $pe->where('siswa_id', $pe->siswa_id)->where('jadwal_id', $pe->jadwal_id)->where('tipe_kehadiran', '1')->count();
		// 			$izin = $pe->where('siswa_id', $pe->siswa_id)->where('jadwal_id', $pe->jadwal_id)->where('tipe_kehadiran', '2')->count();
		// 			$alpha = $pe->where('siswa_id', $pe->siswa_id)->where('jadwal_id', $pe->jadwal_id)->where('tipe_kehadiran', '3')->count();
		// 			$terlambat = $pe->where('siswa_id', $pe->siswa_id)->where('jadwal_id', $pe->jadwal_id)->where('tipe_kehadiran', '4')->count();
		// 			$row['siswa'] = $pe['siswa']['nama_siswa'];
		// 			$row['jadwal'] = $pe['jadwal']['kelasget']['kelas']['name'] . ' / ' . $pe['jadwal']['ruangan']['name'] . ' / ' . $pe['jadwal']['mata_pelajaran']['name'];
		// 			$row['pertemuan'] = $hadir + $sakit + $izin + $alpha + $terlambat;
		// 			$row['hadir'] = $hadir;
		// 			$row['sakit'] = $sakit;
		// 			$row['izin'] = $izin;
		// 			$row['alpha'] = $alpha;
		// 			$row['terlambat'] = $terlambat;
		// 			array_push($laporan, $row);
		// 		}
		// 	}
		// } else {
		// 	return back()->with('datatidakada', 'l');
		// }

		$siswa = Siswa::where('id_user', Auth::user()->id)->first();
		if ($siswa) {
			$rincian_siswa = Kelas::where('id', $siswa->kelas)->first();
			$tampung_absen = [];
			$laporan = [];
			$jadwal = Jadwal::where('kelas_id', $rincian_siswa->id)->get();
			foreach ($jadwal as $pe) {
				$hadir = Absen::where('jadwal_id', $pe->id)->whereBetween('tanggal', [$request->awal, $request->akhir])->where('siswa_id', $siswa->id)->where('tipe_kehadiran', '0')->count();
				$sakit = Absen::where('jadwal_id', $pe->id)->whereBetween('tanggal', [$request->awal, $request->akhir])->where('siswa_id', $siswa->id)->where('tipe_kehadiran', '1')->count();
				$izin = Absen::where('jadwal_id', $pe->id)->whereBetween('tanggal', [$request->awal, $request->akhir])->where('siswa_id', $siswa->id)->where('tipe_kehadiran', '2')->count();
				$alpha = Absen::where('jadwal_id', $pe->id)->whereBetween('tanggal', [$request->awal, $request->akhir])->where('siswa_id', $siswa->id)->where('tipe_kehadiran', '3')->count();
				$terlambat = Absen::where('jadwal_id', $pe->id)->whereBetween('tanggal', [$request->awal, $request->akhir])->where('siswa_id', $siswa->id)->where('tipe_kehadiran', '4')->count();
				$row['jadwal'] = $pe['kelasget']['kelas']['name'] . ' / ' . $pe['ruangan']['name'] . ' / ' . $pe['mata_pelajaran']['name'];
				// dd($jadwal);
				$row['pertemuan'] = $hadir + $sakit + $izin + $alpha + $terlambat;
				$row['hadir'] = $hadir;
				$row['sakit'] = $sakit;
				$row['izin'] = $izin;
				$row['alpha'] = $alpha;
				$row['terlambat'] = $terlambat;
				array_push($laporan, $row);
			}
			return view('absen.filter_laporan', compact('laporan'));
		} else {
			return back()->with('gagalmasuk', 'h');
		}
	}
	public function absen_satuan(Request $request)
	{
		// dd($request->all());
		$absen = Absen::where('siswa_id', $request->siswa_id)->where('jadwal_id', $request->jadwal_id)->where('tanggal', Carbon::now()->Format('Y-m-d'))->first();
		// dd(Carbon::now()->Format('Y-m-d'));
		$update = [
			'tipe_kehadiran' => $request->tipe_kehadiran
		];
		$absen->update($update);
		return back();
	}

	public function absen_masal(Request $request)
	{
		$jadwal = $request->jadwal_id;
		$dibuat_oleh = $request->dibuat_oleh;
		$semester = $request->semester;
		$kelas_id = $request->kelas_id;
		$tahun_ajaran = $request->tahun_ajaran;
		// dd(count($request->absen_banyak));
		// $rincian_siswa = Rincian_Siswa::where('jadwal_id', $jadwal)->count();
		$puuu = [];
		foreach ($request['siswa_id'] as $pu) {
			$aku = $pu;
			array_push($puuu, $aku);
		}
		// dd($request['siswa_id']);

		$tanggalhariini = Carbon::now()->Format('Y-m-d');
		// $tanggalhariini = "2023-01-09";

		$cek_jadwal = Absen::where('jadwal_id', $jadwal)->where('tanggal', $tanggalhariini)->first();

		if ($cek_jadwal === null) {
			foreach ($request['group'] as $p => $value) {
				$absenaaaaaa_CEK = Absen::where('jadwal_id', $jadwal)->where('siswa_id', $puuu[$p])->count();
				// $absenaaaaaa = Absen::where('jadwal_id', $jadwal)->where('siswa_id', $puuu[$p])->where('tanggal', $tanggalhariini)->count();
				// dd($tanggalhariini);
				if ($absenaaaaaa_CEK === 0) {
					$create = [
						'siswa_id' => $puuu[$p],
						'jadwal_id' => $jadwal,
						'tanggal' => $tanggalhariini,
						'tipe_kehadiran' => $value,
						'pertemuan' => $absenaaaaaa_CEK + 1,
						'dibuat_oleh' => $dibuat_oleh,
						'semester' => $semester,
						'kelas_id' => $kelas_id,
						'tahun_ajaran' => $tahun_ajaran
					];
					$absens = Absen::create($create);
				} else {
					$create = [
						'siswa_id' => $puuu[$p],
						'jadwal_id' => $jadwal,
						'tanggal' => $tanggalhariini,
						'tipe_kehadiran' => $value,
						'pertemuan' => $absenaaaaaa_CEK + 1,
						'dibuat_oleh' => $dibuat_oleh,
						'semester' => $semester,
						'kelas_id' => $kelas_id,
						'tahun_ajaran' => $tahun_ajaran
					];
					$absens = Absen::create($create);
				}
			}
		}

		// return response()->json([
		// 	'message' => 'Siswa Sudah Absen'
		// ]);



		// dd($puuu);
		// $tanggalhariini = Carbon::now()->Format('Y-m-d');
		// foreach($request['group'] as $p => $value){

		// 		$absen = Absen::where('siswa_id', $puuu[$p])->where('tahun_ajaran', $request['tahun_ajaran'])->where('jadwal_id', $request['jadwal_id'])->where('tanggal', $tanggalhariini)->count();
		// 		$absen_tanggal = Absen::where('siswa_id', $puuu[$p])->where('tahun_ajaran', $request['tahun_ajaran'])->where('jadwal_id', $request['jadwal_id'])->where('tanggal', $tanggalhariini)->latest()->first();

		// }
		if ($cek_jadwal != null) {
			if ($cek_jadwal->tanggal === $tanggalhariini) {
				return back()->with('sudahabsen', 'd');
			}
		} else {
			return back()->with('berhasilabsen', 'd');
		}
	}
}
