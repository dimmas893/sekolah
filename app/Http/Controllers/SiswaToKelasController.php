<?php

namespace App\Http\Controllers;

use App\Models\JenjangPendidikan;
use App\Models\Kelas;
use App\Models\Master_Kelas;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Tingkatan;
use Illuminate\Http\Request;

class SiswaToKelasController extends Controller
{
    public function siswatokelas()
    {
        $tingkatan = Tingkatan::get();
        return view('siswatokelas.pilihjenjang', compact('tingkatan'));
    }

    public function siswatokelas_get(Request $request)
    {
        $setting = Setting::first();
        $siswa = Siswa::where('tingkat', $request->tingkatan_id)->where('kelas', null)->get();
        $master_kelas = Master_Kelas::where('tingkatan_id', $request->tingkatan_id)->get();
        $tampungsisa = [];
        foreach ($master_kelas as $p) {
            $kelas = Kelas::where('id_tahun_ajaran', $setting->id_tahun_ajaran)->where('id_master_kelas', $p->id)->first();
            if ($kelas != null) {
                $hitung = Siswa::where('kelas', $kelas->id)->first();
                $itungsiswa = $p->max - Siswa::where('kelas', $kelas->id)->count();
            } else {
                $itungsiswa = $p->max;
            }
            $row['name'] = $p['name'];
            $row['sisa'] = $itungsiswa;
            array_push($tampungsisa, $row);
        }
        // dd($tampungsisa);

        return view('siswatokelas.bagikelas', compact('siswa', 'tampungsisa'));
    }


    public function SimpanBagiKelas(Request $request)
    {
        // dd($request->all());
        $setting = Setting::first();
        $tingkatan = $request->tingkatan_id;

        // dd($tingkatan);
        $tampungdata = [];
        if ($request['siswa_id']) {
            foreach ($request['siswa_id'] as $key => $value) {
                $this->SimpanMasukKelas($value, $setting->id_tahun_ajaran, $tingkatan);
            }

            // return back()->with('kelastidakada', 'l');
            return back();
        } else {
            return back()->with('siswatidakada', 'l');
        }
    }

    public function SimpanMasukKelas($idSiswa, $tahunAjaran, $tingkatan)
    {
        $tingkatan = $tingkatan;
        $dataKelas = Kelas::where('id_tahun_ajaran', $tahunAjaran)->with(['kelas'])
            ->whereHas('kelas', function ($q) use ($tingkatan) {
                $q->where('tingkatan_id', '=', $tingkatan);
            })
            ->get();
        if ($dataKelas) {
            foreach ($dataKelas as $isi) {
                if ($isi->rincianSiswa) {
                    if ($isi->kelas->max > $isi->rincianSiswa->count()) {
                        # code...
                        Siswa::where('id', $idSiswa)->update(['kelas' => $isi->id]);
                        return $isi->id;
                    }
                } else {
                    Siswa::where('id', $idSiswa)->update(['kelas' => $isi->id]);
                    return $isi->id;
                }
            }
        } else {
            return back()->with('kelastidakada', 'l');
        }
    }
}
