<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\JenjangPendidikan;
use App\Models\Kelas;
use App\Models\Master_Kelas;
use App\Models\Mata_Pelajaran;
use App\Models\Rincian_Siswa;
use App\Models\Ruangan;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Tahun_ajaran;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jadwalController extends Controller
{
    public function jadwal_buat_guru()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if ($user->role == 3) {
            $guru = Guru::where('id_user', $user->id)->first();
            $jadwal = Jadwal::with('ruangan', 'kelasget', 'mata_pelajaran', 'guru', 'hari')->where('guru_id', $guru->id)->get();
            $mata_pelajaran = Mata_Pelajaran::select('id', 'name')->orderBy('id')->get();
            return view('guru.halaman_user.jadwal', compact('mata_pelajaran', 'jadwal'));
        } else {
            return back()->with('gagalmasuk', 'ds');
        }
    }

    public function pilihjenjang(Request $request)
    {
        $jenjangpenddian = JenjangPendidikan::all();
        return view('jadwal.pilihjenjang', compact('jenjangpenddian'));
    }

    public function pilihkelas(Request $request)
    {
        $kelasid = $request->kelas_id;
        $guru = Guru::all();
        $mata_pelajaran = Mata_Pelajaran::all();
        $hari = Hari::all();
        $ruangan = Ruangan::all();
        $jenjangpenddian = JenjangPendidikan::all();
        $kelas = Kelas::with('kelas')->where('id', $kelasid)->first();
        $tingkatan = Master_Kelas::where('id', $kelas->id_master_kelas)->first()->tingkatan_id;
        // dd($tingkatan);
        return view('jadwal.pilihkelas', compact('guru', 'mata_pelajaran', 'ruangan', 'hari', 'jenjangpenddian', 'kelas', 'tingkatan'));
    }


    public function DataKelasTable(Request $request)
    {
        $id = $request->id;
        $emps = Jadwal::with('guru', 'mata_pelajaran', 'kelasget')->where('kelas_id', $id)->get();
        // dd($emps);
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
				<td>

                  <a href="#" id="' . $emp->id . '" jenjang_id="' . $emp->kelasget->kelas->jenjang_pendidikan_id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
				</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">Jadwal belum di buat</h1>';
        }
    }

    public function jenjang($id)
    {
        $datanya = Master_Kelas::where('Jenjang_pendidikan_id', $id)->get();
        $items = [];

        foreach ($datanya as $data) {
            $row['id'] = $data->id;
            $row['name'] = $data->name;
            array_push($items, $row);
        }
        return response()->json($items, 200);
    }

    public function index()
    {
        $guru = Guru::all();
        $mata_pelajaran = Mata_Pelajaran::all();
        $kelas = kelas::with('kelas')->get();
        $hari = Hari::all();
        $ruangan = Ruangan::all();
        $jenjangpenddian = JenjangPendidikan::all();

        $setting = Setting::first();
        $tahun_ajaran = Tahun_ajaran::get();
        return view('jadwal.index', compact('tahun_ajaran', 'guru', 'mata_pelajaran', 'kelas', 'hari', 'ruangan', 'jenjangpenddian'));
    }

    public function kelas_edit(Request $request)
    {
        $setting = Setting::first();
        $id = $request->id;
        $emps = Kelas::where('id_tahun_ajaran', $setting->id_tahun_ajaran)->with(['kelas'])
            ->whereHas('kelas', function ($q) use ($id) {
                $q->where('jenjang_pendidikan_id', '=', $id);
            })
            ->get();

        $output = '';
        if ($emps->count() > 0) {
            $output .= '<select name="kelas_id" class="form-control">
						<option value="" selected disabled>---Pilih Kelas---</option>
			';
            foreach ($emps as $emp) {
                // $jadwal = Jadwal::where('kelas_id', $emp->id)->first();
                // if ($jadwal == null) {
                $output .= '<option value="' . $emp->id . '" >' . $emp->kelas->name . '</option>';
                // }
            }
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">Kelas Sudah terisi!</h1>';
        }
    }

    public function kelas(Request $request)
    {
        $setting = Setting::first();
        $id = $request->id;
        $emps = Kelas::where('id_tahun_ajaran', $setting->id_tahun_ajaran)->with(['kelas'])
            ->whereHas('kelas', function ($q) use ($id) {
                $q->where('jenjang_pendidikan_id', '=', $id); // '=' is optional
            })
            ->get();

        $output = '';
        if ($emps->count() > 0) {
            $output .= '<select name="kelas_id" class="form-control">
						<option value="" selected disabled>---Pilih Kelas---</option>
			';
            foreach ($emps as $emp) {
                $output .= '<option value="' . $emp->id . '" >' . $emp->kelas->name . '</option>';
            }
            $output .= '</select>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">Kelas Sudah terisi!</h1>';
        }
    }

    public function kelasEdit(Request $request)
    {
        $setting = Setting::first();
        $id = $request->id;
        $jadwal = Jadwal::with('guru', 'mata_pelajaran', 'kelasget')->where('id', $id)->first();
        $jadal_id = $jadwal->kelasget->kelas->jenjang_pendidikan_id;
        $emps = Kelas::with('kelas')->where('id_tahun_ajaran', $setting->id_tahun_ajaran)->with(['kelas'])
            ->whereHas('kelas', function ($q) use ($jadal_id) {
                $q->where('jenjang_pendidikan_id', '=', $jadal_id); // '=' is optional
            })
            ->get();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<select name="kelas_id" id="kelas_id" class="form-control">
			';
            if ($jadwal) {
                $output .= '<option value="" >' . $jadwal->kelasget->kelas->name . '</option>';
            }
            foreach ($emps as $emp) {
                if ($jadwal->kelas_id != $emp->id) {
                    $output .= '<option value="' . $emp->id . '" >' . $emp->kelas->name . '</option>';
                }
            }
            $output .= '</select>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">Kelas Sudah terisi!</h1>';
        }
    }

    public function backupsma()
    {
        $setting = Setting::first();
        $sma1 = 3;
        $emps = Kelas::where('id_tahun_ajaran', $setting->id_tahun_ajaran)->with(['kelas'])
            ->whereHas('kelas', function ($q) use ($sma1) {
                $q->where('jenjang_pendidikan_id', '=', $sma1); // '=' is optional
            })
            ->get();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<select name="kelas_id" class="form-control">
						<option value="" selected disabled>---Pilih Kelas---</option>
			';
            foreach ($emps as $emp) {
                $jadwal = Jadwal::where('kelas_id', $emp->id)->first();
                if ($jadwal == null) {
                    $output .= '<option value="' . $emp->id . '" >' . $emp->kelas->name . '</option>';
                }
            }
            $output .= '</select';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">Kelas Sudah terisi!</h1>';
        }
    }


    public function all()
    {

        // <td>

        // 	<a href="#" id="' . $emp->id . '" jenjang_id="' . $emp->kelasget->kelas->jenjang_pendidikan_id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
        // 	<a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
        // </td>
        $emps = Jadwal::with('guru', 'mata_pelajaran', 'kelasget')->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Lihat Siswa</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->kelasget->kelas->name . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
                <td>
				  <a href="/jadwal/semua_siswa/' . $emp->id . '" class="text-info" /><i class="ion-eye h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function jadwal_semua_siswa($id)
    {
        $jadwal = Jadwal::where('id', $id)->first();
        $rincian_siswa = Siswa::where('kelas', $jadwal->kelas_id)->get();
        $count = Siswa::where('kelas', $jadwal->kelas_id)->count();

        $setting = Setting::first();
        $cekabsen = Absen::where('jadwal_id', $jadwal->id)->where('tanggal', Carbon::now()->Format('Y-m-d'))->count();
        $cekabsen_get = Absen::where('jadwal_id', $jadwal->id)->where('tanggal', Carbon::now()->Format('Y-m-d'))->get();

        $tampung_absen = [];
        $laporan = [];
        $tampung_absen_2 = [];
        foreach ($rincian_siswa as $p) {
            $absen = Absen::with('jadwal', 'siswa')->where('siswa_id', $p->id)->where('jadwal_id', $jadwal->id)->where('semester', $setting->semester)->where('tahun_ajaran', $setting->id_tahun_ajaran)->orderBy('id', 'DESC')->first();
            array_push($tampung_absen, $absen);
        }
        // dd($tampung_absen);
        if ($rincian_siswa) {
            foreach ($tampung_absen as $pe) {
                if ($pe) {
                    $hadir = $pe->where('siswa_id', $pe->siswa_id)->where('jadwal_id', $pe->jadwal_id)->where('tipe_kehadiran', '0')->count();
                    $sakit = $pe->where('siswa_id', $pe->siswa_id)->where('jadwal_id', $pe->jadwal_id)->where('tipe_kehadiran', '1')->count();
                    $izin = $pe->where('siswa_id', $pe->siswa_id)->where('jadwal_id', $pe->jadwal_id)->where('tipe_kehadiran', '2')->count();
                    $alpha = $pe->where('siswa_id', $pe->siswa_id)->where('jadwal_id', $pe->jadwal_id)->where('tipe_kehadiran', '3')->count();
                    $terlambat = $pe->where('siswa_id', $pe->siswa_id)->where('jadwal_id', $pe->jadwal_id)->where('tipe_kehadiran', '4')->count();
                    // $nama_siswa = Rincian_Siswa::with('siswa')->where('jadwal_id', $pe->jadwal_id)->first();
                    $row['siswa'] = $pe['siswa']['nama_siswa'];
                    $row['jadwal'] = $pe['jadwal']['kelasget']['kelas']['name'] . ' / ' . $pe['jadwal']['ruangan']['name'] . ' / ' . $pe['jadwal']['mata_pelajaran']['name'];
                    $row['pertemuan'] = $pe['pertemuan'];
                    $row['hadir'] = $hadir;
                    $row['sakit'] = $sakit;
                    $row['izin'] = $izin;
                    $row['alpha'] = $alpha;
                    $row['terlambat'] = $terlambat;
                    array_push($laporan, $row);
                }
            }
        }
        return view('jadwal.semua_siswa', compact('rincian_siswa', 'jadwal', 'count', 'setting', 'cekabsen', 'cekabsen_get', 'laporan'));
    }

    // handle insert a new Tu ajax request
    public function store(Request $request)
    {
        // dd($request->all());
        $jadwal = Jadwal::whereBetween('jam_masuk', [$request->jam_masuk, $request->jam_keluar])->where('ruangan_id', $request->ruangan_id)->where('hari_id', $request->hari_id)->first();
        if ($jadwal == null) {
            $empData = [
                'kelas_id' => $request->kelas_id,
                'tingkatan_id' => $request->tingkatan,
                'ruangan_id' => $request->ruangan_id,
                'guru_id' => $request->guru_id,
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'hari_id' => $request->hari_id,
                'jam_masuk' => $request->jam_masuk,
                'jam_keluar' => $request->jam_keluar
            ];
            Jadwal::create($empData);
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 400,
            ]);
        }
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Jadwal::with('guru', 'mata_pelajaran', 'kelasget')->where('id', $id)->first();
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Jadwal::Find($request->id);
        $jadwal = Jadwal::whereBetween('jam_masuk', [$request->jam_masuk, $request->jam_keluar])->where('ruangan_id', $request->ruangan_id)->where('hari_id', $request->hari_id)->first();
        if ($jadwal == null) {
            $empData = [
                'ruangan_id' => $request->ruangan_id,
                'guru_id' => $request->guru_id,
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'hari_id' => $request->hari_id,
                'jam_masuk' => $request->jam_masuk,
                'jam_keluar' => $request->jam_keluar
            ];
            $emp->update($empData);
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 400,
            ]);
        }
    }

    // handle delete an Tu ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        Jadwal::destroy($id);
    }
}
