<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Master_Kelas;
use App\Models\Mata_Pelajaran;
use App\Models\Ruangan;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Tingkatan;
use Illuminate\Http\Request;

class AdminNaikKelasController extends Controller
{
    public function Ajaxtk(Request $request)
    {
        $setting = Setting::first()->id_tahun_ajaran;
        $id = $request->id;
        $emps = Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')->where('kelas_id', $id)->whereHas('kelasget', function ($q) use ($setting) {
            $q->where('id_tahun_ajaran', $setting);
        })->get();
        $p = 1;
        $output = '';
        $kelas = Kelas::with('kelas')->where('id', $id)->first();
        if ($kelas) {
            $output .= '<div class="card shadow card-primary">';
            $output .= ' <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h3 class="text-light">' . Master_Kelas::where('id', $kelas->id_master_kelas)->first()->name . '</h3>
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $kelas->id . '" />
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="' . $kelas->kelas->jenjang_pendidikan_id . '" />
                                                    <input type="submit" class="btn btn-light" value="Masuk">
                                                </form>
                                            </div>';
        }
        if ($id && $emps->count() > 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
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
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($id && $emps->count() === 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
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
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($emps->count() === 0 && $id === null) {
            $jenjang = 4;
            $smp = Kelas::with('kelas')->where('id_tahun_ajaran', $setting)->whereHas('kelas', function ($q) use ($jenjang) {
                $q->where('jenjang_pendidikan_id', $jenjang);
            })->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
            $p = 1;
            $output = '';
            foreach ($smp as $item) {
                $output .= '<div class="card shadow card-primary">';
                $output .= ' <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h3 class="text-light">' . Master_Kelas::where('id', $item->id_master_kelas)->first()->name . '</h3>
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $item->id . '" />
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="' . $item->kelas->jenjang_pendidikan_id . '" />
                                                    <input type="submit" class="btn btn-light" value="Masuk">
                                                </form>
                                            </div>';
                $jadwal = \App\Models\Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')
                    ->where('kelas_id', $item->id)
                    ->get();
                $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($jadwal as $emp) {
                    $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
              </tr>';
                }
                $output .= '</tbody></table></div></div>';
            }
            echo $output;
        }
    }
    public function AjaxSd(Request $request)
    {
        $setting = Setting::first()->id_tahun_ajaran;
        $id = $request->id;
        $emps = Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')->where('kelas_id', $id)->whereHas('kelasget', function ($q) use ($setting) {
            $q->where('id_tahun_ajaran', $setting);
        })->get();
        $p = 1;
        $output = '';
        $kelas = Kelas::with('kelas')->where('id', $id)->first();
        if ($kelas) {
            $output .= '<div class="card shadow card-primary">';
            $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $kelas->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $kelas->id . '" />
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="' . $kelas->kelas->jenjang_pendidikan_id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Masuk">
                                                </form>
                                            </div>';
        }
        if ($id && $emps->count() > 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
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
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($id && $emps->count() === 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
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
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($emps->count() === 0 && $id === null) {
            $jenjang = 1;
            $smp = Kelas::with('kelas')->where('id_tahun_ajaran', $setting)->whereHas('kelas', function ($q) use ($jenjang) {
                $q->where('jenjang_pendidikan_id', $jenjang);
            })->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
            $p = 1;
            $output = '';
            foreach ($smp as $item) {
                $output .= '<div class="card shadow card-primary">';
                $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $item->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="' . $item->kelas->jenjang_pendidikan_id . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $item->id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Masuk">
                                                </form>
                                            </div>';
                $jadwal = \App\Models\Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')
                    ->where('kelas_id', $item->id)
                    ->get();
                $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($jadwal as $emp) {
                    $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
              </tr>';
                }
                $output .= '</tbody></table></div></div>';
            }
            echo $output;
        }
    }
    public function AjaxSmp(Request $request)
    {
        $setting = Setting::first()->id_tahun_ajaran;
        $id = $request->id;
        $emps = Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')->where('kelas_id', $id)->whereHas('kelasget', function ($q) use ($setting) {
            $q->where('id_tahun_ajaran', $setting);
        })->get();
        $p = 1;
        $output = '';
        $kelas = Kelas::with('kelas')->where('id', $id)->first();
        if ($kelas) {
            $output .= '<div class="card shadow card-primary">';
            $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $kelas->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $kelas->id . '" />
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="' . $kelas->kelas->jenjang_pendidikan_id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Masuk">
                                                </form>
                                            </div>';
        }
        if ($id && $emps->count() > 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
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
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($id && $emps->count() === 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
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
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($emps->count() === 0 && $id === null) {
            $jenjang = 2;
            $smp = Kelas::with('kelas')->where('id_tahun_ajaran', $setting)->whereHas('kelas', function ($q) use ($jenjang) {
                $q->where('jenjang_pendidikan_id', $jenjang);
            })->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
            $p = 1;
            $output = '';
            foreach ($smp as $item) {
                $output .= '<div class="card shadow card-primary">';
                $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $item->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $item->id . '" />
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="' . $item->kelas->jenjang_pendidikan_id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Masuk">
                                                </form>
                                            </div>';
                $jadwal = \App\Models\Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')
                    ->where('kelas_id', $item->id)
                    ->get();
                $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($jadwal as $emp) {
                    $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
              </tr>';
                }
                $output .= '</tbody></table></div></div>';
            }
            echo $output;
        }
    }

    public function AjaxSma(Request $request)
    {
        $setting = Setting::first()->id_tahun_ajaran;
        $id = $request->id;
        $emps = Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')->where('kelas_id', $id)->whereHas('kelasget', function ($q) use ($setting) {
            $q->where('id_tahun_ajaran', $setting);
        })->get();
        $p = 1;
        $output = '';
        $kelas = Kelas::with('kelas')->where('id', $id)->first();
        // dd($kelas->kelas->je njang_pendidikan_id);
        if ($kelas) {
            $output .= '<div class="card shadow card-primary">';
            $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . $kelas->kelas->name . ' - ' . $kelas->jurusan . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $kelas->id . '" />
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="' . $kelas->kelas->jenjang_pendidikan_id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Masuk">
                                                </form>
                                            </div>';
        }
        if ($id && $emps->count() > 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
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
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($id && $emps->count() === 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
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
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($emps->count() === 0 && $id === null) {
            $jenjang = 3;
            $smp = Kelas::with('kelas')->where('id_tahun_ajaran', $setting)->whereHas('kelas', function ($q) use ($jenjang) {
                $q->where('jenjang_pendidikan_id', $jenjang);
            })->get();
            // dd($smp);
            $p = 1;
            $output = '';
            foreach ($smp as $item) {
                $output .= '<div class="card shadow card-primary">';
                $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . $item->kelas->name . ' - ' . $item->jurusan . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $item->id . '" />
                                                    <input type="hidden" name="jenjang_pendidikan_id" value="' . $item->kelas->jenjang_pendidikan_id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Masuk">
                                                </form>
                                            </div>';
                $jadwal = \App\Models\Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')
                    ->where('kelas_id', $item->id)
                    ->get();
                $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($jadwal as $emp) {
                    $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
              </tr>';
                }
                $output .= '</tbody></table></div></div>';
            }
            echo $output;
        }
    }
    // public function tk()
    // {
    //     $tahun = Setting::first()->id_tahun_ajaran;
    //     $jenjang = 4;
    //     $tk = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjang) {
    //         $q->where('jenjang_pendidikan_id', $jenjang);
    //     })->select('id')->groupBy('id')->get();
    //     $ampungkelas = [];

    //     $cek = [];
    //     foreach ($tk as $index => $value) {
    //         $rincianSiswa = Siswa::where('kelas', $value->id)->select('nama_siswa as alias')->get();
    //         array_push($ampungkelas, $rincianSiswa);
    //     }
    //     foreach ($tk as $index => $p) {
    //         $pentol['kelas'] = $p->id;
    //         $pentol['siswa'] = $ampungkelas[$index];
    //         array_push($cek, $pentol);
    //     }
    //     return response()->json(['data' => $cek]);
    // }
    public function tk()
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang = 4;
        $tk = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjang) {
            $q->where('jenjang_pendidikan_id', $jenjang);
        })->select('id_master_kelas', 'id')->groupBy('id_master_kelas', 'id')->get();
        return view('admin.naikkelas.tk', compact('tk'));
    }
    public function sd()
    {
        // $sd = Kelas::with('kelas')->whereIn('tingkatan_id', [1, 2, 3, 4, 5, 6])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang = 1;
        $sd = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjang) {
            $q->where('jenjang_pendidikan_id', $jenjang);
        })->select('id_master_kelas', 'id')->groupBy('id_master_kelas', 'id')->get();
        return view('admin.naikkelas.sd', compact('sd'));
    }
    public function smp()
    {
        // $smp = Kelas::with('kelas')->whereIn('tingkatan_id', [7, 8, 9])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang = 2;
        $smp = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjang) {
            $q->where('jenjang_pendidikan_id', $jenjang);
        })->select('id_master_kelas', 'id')->groupBy('id_master_kelas', 'id')->get();
        // dd($smp);
        return view('admin.naikkelas.smp', compact('smp'));
    }
    public function sma()
    {
        // $sma = Kelas::with('kelas')->whereIn('tingkatan_id', [10, 11, 12])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang = 3;
        $sma = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjang) {
            $q->where('jenjang_pendidikan_id', $jenjang);
        })->get();

        return view('admin.naikkelas.sma', compact('sma'));
    }

    public function semuakelas()
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjangsd = 1;
        $sd = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsd) {
            $q->where('jenjang_pendidikan_id', $jenjangsd);
        })->get();
        $jenjangsmp = 2;
        $smp = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsmp) {
            $q->where('jenjang_pendidikan_id', $jenjangsmp);
        })->get();

        $jenjangsma = 3;
        $sma = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsma) {
            $q->where('jenjang_pendidikan_id', $jenjangsma);
        })->get();
        $jenjangtk = 4;
        $tk = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangtk) {
            $q->where('jenjang_pendidikan_id', $jenjangtk);
        })->get();
        return view('admin.naikkelas.index', compact('sd', 'smp', 'sma', 'tk'));
    }

    public function datakelasadmin(Request $request, $id)
    {
        $siswa = Siswa::where('kelas', $id)->get();
        $kelas = Kelas::with('kelas')->where('id', $id)->first();
        // $id = $id;
        // $guru = ;
        // dd($kelas->id_guru);
        return view('admin.naikkelas.datakelas', compact('siswa', 'kelas'));
    }

    public function datakelasadminstore(Request $request)
    {
    }
}
