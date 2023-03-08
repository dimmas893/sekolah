<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mata_Pelajaran;
use App\Models\Siswa;
use App\Models\Penilaian;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function penilaian(Request $request)
    {
        // dd($request->all());
        $jenjang_pendidikan_id = (int)$request->jenjang_pendidikan_id;
        $setting = Setting::first();
        $file_path = 'https://dapurkoding.my.id/';
        if ($request->jadwal_id) {
            $jadwal = Jadwal::where('id', $request->jadwal_id)->first();
            $dataNilaiSiswa = Penilaian::where('jadwal_id', $jadwal->id)->where('guru_id', $jadwal->guru_id)->get();
        }

        if ($request->kelas_id && $request->mata_pelajaran_id && $request->guru_id) {
            $jadwal = Jadwal::where('kelas_id', $request->kelas_id)->where('mata_pelajaran_id', $request->mata_pelajaran_id)->where('guru_id', $request->guru_id)->first();
            $dataNilaiSiswa = Penilaian::where('jadwal_id', $jadwal->id)->where('guru_id', $jadwal->guru_id)->get();
            // dd($dataNilaiSiswa);
        }
        if ($jadwal) {
            $rincian_siswa = Siswa::where('kelas', $jadwal->kelas_id)->get();
            $count = $rincian_siswa->count();
        }
        $arrayNilaiSiswa = [];
        if ($request->cek) {
            $cek = 1;
        } else {
            $cek = 0;
        }
        if (count($dataNilaiSiswa) > 0) {
            foreach ($dataNilaiSiswa as $value) {
                if ($value->relasiSiswa->avatar != null) {
                    $foto = $file_path . 'avatar/' . $value->relasiSiswa->avatar;
                } else {
                    $foto = null;
                }

                if ($value->nilai_akhir > 90 && $value->nilai_akhir <= 100) {
                    $predikat = 'Amat Baik';
                } elseif ($value->nilai_akhir > 80 && $value->nilai_akhir <= 90) {
                    $predikat = 'Baik';
                } elseif ($value->nilai_akhir > 70 && $value->nilai_akhir <= 80) {
                    $predikat = 'Cukup';
                } elseif ($value->nilai_akhir > 60 && $value->nilai_akhir <= 70) {
                    $predikat = 'Sedang';
                } elseif ($value->nilai_akhir < 60) {
                    $predikat = 'Kurang';
                }

                $row['avatar'] = $foto;
                $row['nama_siswa'] = $value->relasiSiswa->nama_siswa;
                $row['siswa_id'] = $value->relasiSiswa->id;
                $row['nilai_kehadiran'] = $value->nilai_kehadiran;
                $row['nilai_sikap'] = $value->nilai_sikap;
                $row['nilai_tugas'] = $value->nilai_tugas;
                $row['nilai_uts'] = $value->nilai_uts;
                $row['nilai_uas'] = $value->nilai_uas;
                $row['nilai_akhir'] = $value->nilai_akhir;
                $row['predikat'] = $predikat;
                $row['status'] = $value->status;
                array_push($arrayNilaiSiswa, $row);
            }
        } else {
            if ($jadwal) {
                foreach ($rincian_siswa as $value) {
                    if ($value->avatar != null) {
                        $foto = $file_path . 'avatar/' . $value->avatar;
                    } else {
                        $foto = null;
                    }
                    $row['avatar'] = $foto;
                    $row['siswa_id'] = $value->id;
                    $row['nama_siswa'] = $value->nama_siswa;
                    $row['nilai_kehadiran'] = null;
                    $row['nilai_sikap'] = null;
                    $row['nilai_tugas'] = null;
                    $row['nilai_uts'] = null;
                    $row['nilai_uas'] = null;
                    $row['nilai_akhir'] = null;
                    $row['predikat'] = null;
                    $row['status'] = null;
                    array_push($arrayNilaiSiswa, $row);
                }
            }
        }
        if ($jadwal) {
            return view('nilai.penilaian.index', compact('setting', 'jadwal', 'count', 'arrayNilaiSiswa', 'cek', 'jenjang_pendidikan_id'));
        } else {
            return view('nilai.penilaian.index', compact('setting', 'arrayNilaiSiswa', 'cek'));
        }
    }

    public function simpanNilai(Request $request)
    {
        for ($ii = 0; $ii < count($request->siswa_id); $ii++) {
            Penilaian::updateOrCreate([
                'jadwal_id' => $request->jadwal_id,
                'siswa_id' => $request->siswa_id[$ii],
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'kelas_id' => $request->kelas_id,
            ], [
                'tahun_ajaran_id' => $request->tahun_ajaran,
                'jadwal_id' => $request->jadwal_id,
                'guru_id' => $request->guru_id,
                'siswa_id' => $request->siswa_id[$ii],
                'nilai_kehadiran' => (int) $request->nilai_kehadiran[$ii],
                'nilai_sikap' => (int) $request->nilai_sikap[$ii],
                'nilai_tugas' => (int) $request->nilai_tugas[$ii],
                'nilai_uts' => (int) $request->nilai_uts[$ii],
                'nilai_uas' => (int) $request->nilai_uas[$ii],
            ]);
        }

        return redirect()->back();
    }

    public function nilaitk(Request $request)
    {
        $setting = Setting::first();
        $tahun = $setting->id_tahun_ajaran;
        // $tk = Kelas::with('kelas')->whereIn('tingkatan_id', [14])->get();

        $jenjang_pendidikan_id = $request->jenjang_pendidikan_id;
        $mata_pelajaran = Jadwal::where('jenjang_pendidikan_id', 4)->whereHas('kelasget', function ($q) use ($tahun) {
            $q->where('id_tahun_ajaran', $tahun);
        })->select('mata_pelajaran_id')->groupBy('mata_pelajaran_id')->get();
        $tingkatan = 14;
        return view('admin.nilai.nilaitk', compact('mata_pelajaran', 'tahun', 'tingkatan', 'jenjang_pendidikan_id'));
    }
    public function nilaisd(Request $request)
    {
        $setting = Setting::first();
        $tahun = $setting->id_tahun_ajaran;
        $jenjang_pendidikan_id = $request->jenjang_pendidikan_id;
        // $tk = Kelas::with('kelas')->whereIn('tingkatan_id', [14])->get();

        $mata_pelajaran = Jadwal::where('jenjang_pendidikan_id', 1)->whereHas('kelasget', function ($q) use ($tahun) {
            $q->where('id_tahun_ajaran', $tahun);
        })->select('mata_pelajaran_id')->groupBy('mata_pelajaran_id')->get();
        $tingkatan = 14;
        return view('admin.nilai.nilaisd', compact('mata_pelajaran', 'tahun', 'tingkatan', 'jenjang_pendidikan_id'));
    }
    public function nilaismp(Request $request)
    {
        // dd($request->all());
        $setting = Setting::first();
        $tahun = $setting->id_tahun_ajaran;
        $jenjang_pendidikan_id = $request->jenjang_pendidikan_id;
        // $tk = Kelas::with('kelas')->whereIn('tingkatan_id', [14])->get();

        $mata_pelajaran = Jadwal::where('jenjang_pendidikan_id', 2)->whereHas('kelasget', function ($q) use ($tahun) {
            $q->where('id_tahun_ajaran', $tahun);
        })->select('mata_pelajaran_id')->groupBy('mata_pelajaran_id')->get();
        $tingkatan = 14;
        return view('admin.nilai.nilaismp', compact('mata_pelajaran', 'tahun', 'tingkatan', 'jenjang_pendidikan_id'));
    }
    public function nilaisma(Request $request)
    {
        $setting = Setting::first();
        $tahun = $setting->id_tahun_ajaran;
        $jenjang_pendidikan_id = $request->jenjang_pendidikan_id;
        // $tk = Kelas::with('kelas')->whereIn('tingkatan_id', [14])->get();

        $mata_pelajaran = Jadwal::where('jenjang_pendidikan_id', 3)->whereHas('kelasget', function ($q) use ($tahun) {
            $q->where('id_tahun_ajaran', $tahun);
        })->select('mata_pelajaran_id')->groupBy('mata_pelajaran_id')->get();
        // $tingkatan = 14;
        // dd($mata_pelajaran);
        return view('admin.nilai.nilaisma', compact('mata_pelajaran', 'tahun', 'jenjang_pendidikan_id'));
    }
    public function nilaitkajax(Request $request)
    {
        $mata_pelajaran_id = $request->mata_pelajaran_id;
        $mata_pelajaran = Jadwal::whereIn('tingkatan_id', [14])->select('kelas_id', 'mata_pelajaran_id')->get();
        $tk = Kelas::with('kelas')->whereIn('tingkatan_id', [14])->get();
        // $emps = Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')->where('kelas_id', $id)->get();/
        $p = 1;
        $output = '';
        if ($mata_pelajaran_id === null) {
            $output .= '<div class="row">
                            <div class="col-12">';
            foreach ($mata_pelajaran as $mata) {
                $output .= '<div class=""><div class="card-header bg-secondary">
                                ' . $mata->name . '
                            </div>
                        <div class="card">
                        <div class="row">';
                foreach ($tk as $t) {
                    $output .= '<div class="col-lg-3">
                                    <div class="card-body">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            ' . $t->kelas->name . '';
                    $output .= '<a href="/lihatnilai/' . $mata->id . '/' . $t->id . '" class="btn btn-success">Lihat</a>';
                    $output .= '</div>
                            </div>
                        </div>';
                }
                $output .= '</div></div>';
            }
            $output .= '
                 </div>
            </div> ';
            echo $output;
        }
        if ($mata_pelajaran_id) {
            $output .= '<div class="row">
                            <div class="col-12">';
            foreach ($mata_pelajaran->where('id', $mata_pelajaran_id) as $mata) {
                $output .= '<div class=""><div class="card-header bg-secondary">
                                ' . $mata->name . '
                            </div>
                        <div class="card">
                        <div class="row">';
                foreach ($tk as $t) {
                    $output .= '<div class="col-lg-3">
                                    <div class="card-body">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            ' . $t->kelas->name . '';
                    $output .= '<a href="/lihatnilai/' . $mata->id . '/' . $t->id . '" class="btn btn-success">Lihat</a>';
                    $output .= '</div>
                            </div>
                        </div>';
                }
                $output .= '</div></div>';
            }
            $output .= '
                 </div>
            </div> ';
            echo $output;
        }
    }

    public function lihatnilaiajax($mata_pelajaran, $kelas)
    {
        $siswa = Siswa::where('kelas', $kelas)->get();
        $p = 1;
        $output = '';
        $output .= '
                             ';

        $output .= ' <div class="row">
                                            <div class="col-12">
                                                <div class="card-body">
                                                    <div class="">
                                                        <div class="">
                                                            <table class="table table-bordered table-md display nowrap"
                                                                style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama Siswa</th>
                                                                        <th>Nilai kehadiran</th>
                                                                        <th>Nilai Sikap</th>
                                                                        <th>Nilai Tugas</th>
                                                                        <th>Nilai Uts</th>
                                                                        <th>Nilai Uas</th>
                                                                        <th>Nilai Akhir</th>
                                                                        <th>Nilai Predikat</th>
                                                                        <th>Nilai Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>';
        foreach ($siswa as $sis) {
            $cek = Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->first();
            if ($cek) {
                $output .= '        <tr>
                                        <td>' . $p++ . '</td>
                                        <td>' . $sis->nama_siswa . '</td>
                                        <td>' . @(Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->sum('nilai_kehadiran')  / Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->count('nilai_kehadiran')) . '
                                        </td>
                                        <td>' . @(Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->sum('nilai_sikap') / Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->count('nilai_sikap')) . '</td>
                                        <td>' . @(Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->sum('nilai_tugas') / Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->count('nilai_tugas')) . '</td>
                                        <td>' . @(Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->sum('nilai_uts')  / Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->count('nilai_uts')) . '</td>
                                        <td>' . @(Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->sum('nilai_uas')  / Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->count('nilai_uas')) . '</td>
                                        <td>' . Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->first()->nilai_akhir . '</td>
                                        <td>' . Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->first()->predikat . '</td>
                                        <td>' . Penilaian::where('siswa_id', $sis->id)->where('mata_pelajaran_id', $mata_pelajaran)->first()->status . '</td>
                                        <td><a>edit</a></td>
                                    </tr>';
            }
        }

        $output .= '</tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';

        $output .= '</div>';

        $output .= '</div></div></div> ';
        echo $output;
    }
    public function lihatnilai($mata_pelajaran, $kelas)
    {
        $mata_pelajaran_id = $mata_pelajaran;
        $kelas_id = $kelas;
        return view('admin.nilai.lihatnilai', compact('mata_pelajaran_id', 'kelas_id'));
    }

    public function editnilai($mata_pelajaran, $kelas)
    {
        $mata_pelajaran_id = $mata_pelajaran;
        $kelas_id = $kelas;
        $jadwal = Jadwal::where('mata_pelajaran_id', $mata_pelajaran_id)->where('kelas_id', $kelas_id)->get();
        return view('admin.nilai.daftarjadwal', compact('mata_pelajaran_id', 'kelas_id', 'jadwal'));
    }
}
