<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruMapelController extends Controller
{
    public function nilai()
    {
        $setting = Setting::first();
        $tahun = $setting->id_tahun_ajaran;
        // $tk = Kelas::with('kelas')->whereIn('tingkatan_id', [14])->get();
        $guru = Guru::where('id_user', Auth::user()->id)->first();
        $mata_pelajaran = Jadwal::where('guru_id', $guru->id)->whereHas('kelasget', function ($q) use ($tahun) {
            $q->where('id_tahun_ajaran', $tahun);
        })->select('mata_pelajaran_id')->groupBy('mata_pelajaran_id')->get();
        // dd($mata_pelajaran);

        return view('guru.mapel.index', compact('mata_pelajaran', 'tahun', 'guru'));
    }
}
