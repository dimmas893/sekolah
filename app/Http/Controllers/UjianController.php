<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mata_Pelajaran;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Pengaturan;
use App\Models\Nilai;
use App\Models\Setting;
use App\Models\Ujian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    public function tabelujian(Request $request, $id, $tingkatan_id, $jenjang_pendidikan_id)
    {
        // dd($request->all());
        $mata_pelajaran = $id;
        $jenjang_pendidikan_id = $jenjang_pendidikan_id;
        $tingkatan_id = $tingkatan_id;
        // $jenjang_pendidikan_id = $request->jenjang_pendidikan_id;
        return view('ujian.tabel', compact('mata_pelajaran', 'jenjang_pendidikan_id', 'tingkatan_id', 'jenjang_pendidikan_id'));
    }

    public function pilihjenjangujian(Request $request)
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
        return view('ujian.pilihjenjang', compact('sd', 'smp', 'sma', 'tk'));
    }


    public function pilihtingkatanujian(Request $request)
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang_pendidikan_id = (int)$request->jenjang_pendidikan_id;
        $tingkatan = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjang_pendidikan_id) {
            $q->where('jenjang_pendidikan_id', $jenjang_pendidikan_id);
        })->select('id_master_kelas')->groupBy('id_master_kelas')->get();
        // dd($tingkatan);
        return view('ujian.pilihtingkatan', compact('tingkatan', 'tahun', 'jenjang_pendidikan_id'));
    }

    public function pilihmatapelajaranujian(Request $request)
    {
        // dd($request->all());
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang_pendidikan_id = (int)$request->jenjang_pendidikan_id;
        $tingkatan_id = (int)$request->tingkatan_id;
        $mata_pelajaran = Mata_Pelajaran::where('tingkatan', $tingkatan_id)->where('jenjang_pendidikan_id', $jenjang_pendidikan_id)->get();
        return view('ujian.pilihmatapelajaran', compact('mata_pelajaran', 'tahun', 'jenjang_pendidikan_id', 'tingkatan_id'));
    }

    public function lembarSoal()
    {
        $soal = Soal::get();
        $dataWaktu = Pengaturan::pluck('waktu')->first();
        $dataPeraturan = Pengaturan::first();
        return view('ujian.lembarSoal', compact('soal', 'dataPeraturan', 'dataWaktu'));
    }

    public function simpanJawaban(Request $request)
    {
        DB::beginTransaction();
        try {
            $pilihan     = $request->pilihan;
            $id_soal     = $request->id;
            $jumlah      = $request->jumlah;
            $score = 0;
            $benar = 0;
            $salah = 0;
            $kosong = 0;
            for ($i = 0; $i < $jumlah; $i++) {
                //id nomor soal
                $nomor = $id_soal[$i];

                //jika user tidak memilih jawaban
                if (empty($pilihan[$nomor])) {
                    $kosong++;
                } else {
                    //jawaban dari user
                    $jawaban = $pilihan[$nomor];
                    //cocokan jawaban user dengan jawaban di database
                    $query = DB::table('soals')
                        ->where('id', '=', $nomor)
                        ->where('knc_jawaban', '=', $jawaban)
                        ->count();
                    if ($query) {
                        //jika jawaban cocok (benar)
                        $benar++;
                    } else {
                        //jika salah
                        $salah++;
                    }
                }
                $jumlah_soal = DB::table('soals')->count();
                $score = 100 / $jumlah_soal * $benar;
                $hasil = number_format($score, 1);
            }
            $qry = Pengaturan::select('nilai_min')->first();
            $ceknilai = $qry->nilai_min;
            if ($hasil > $ceknilai) {
                Nilai::create([
                    'id_user' => Auth::user()->id,
                    'benar' => $benar,
                    'salah' => $salah,
                    'kosong' => $kosong,
                    'score' => $hasil,
                    'keterangan' => 'LULUS'
                ]);
            } else {
                Nilai::create([
                    'id_user' => Auth::user()->id,
                    'benar' => $benar,
                    'salah' => $salah,
                    'kosong' => $kosong,
                    'score' => $hasil,
                    'keterangan' => 'TIDAK LULUS'
                ]);
            }
            DB::commit();
            return redirect('lembar-soal2')->with('success', "Anda Telah Berhasil Mengisi Soal");
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
    public function all($id, $tingkatan_id, $jenjang_pendidikan_id)
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang_pendidikan = $jenjang_pendidikan_id;
        $emps = Ujian::whereHas('mata_pelajaran', function ($q) use ($id, $tingkatan_id) {
            $q->where('id', $id)->where('tingkatan', $tingkatan_id);
        })->where('tahun_ajaran_id', $tahun)->get();
        // dd($emps);
        $output = '';
        $p = 1;
        $csrf = csrf_token();
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Ujian</th>
                <th>Tanggal</th>
                <th>Jumlah Soal</th>
                <th>Lihat Soal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td><div class="badge badge-success"> ' . $emp->jenis_ujian . '</div> </td>
                <td>' . $emp->tanggal . ' </td>
                <td>' . Soal::where('ujian_id', $emp->id)->count() . ' </td>
                <td>
				<form action="/ujian/soal/' . $emp->id . '" method="get">
				<input type="hidden" name="_token" value="' . $csrf . '" />
				<input type="hidden" name="mata_pelajaran_id" value="' . $emp->mata_pelajaran->id . '" />
				<input type="hidden" name="jenjang_pendidikan_id" value="' . $jenjang_pendidikan . '" />
				<input type="hidden" name="tingkatan_id" value="' . $emp->mata_pelajaran->tingkatan . '" />
				';
                $output .= '<input type="submit" class="text-info mx-1" value="Soal"/>
				</form>
				</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">Data ujian tidak ada</h1>';
        }
    }

    public function store(Request $request)
    {

        $tahun = Setting::first()->id_tahun_ajaran;
        $mata_pelajaran = Mata_Pelajaran::where('id', (int)$request->mata_pelajaran_id)->where('tingkatan', (int)$request->tingkatan)->first();
        // dd($mata_pelajaran);
        $empData = [
            'tahun_ajaran_id' => $tahun,
            'mata_pelajaran_id' => $mata_pelajaran->id,
            'jenis_ujian' => $request->jenis_ujian,
            'tanggal' => $request->tanggal,
        ];
        $ujian = Ujian::create($empData);
        $soal = Soal::with('ujian')->where('ujian_id', $ujian->id)->get();

        $id = $ujian->id;
        $mata_pelajaran = $id;
        $tingkatan_id = $request->tingkatan;
        $mata_pelajaran = $request->mata_pelajaran_id;
        $jenjang_pendidikan_id = $request->jenjang_pendidikan_id;
        return view('soal.create', compact('soal', 'id', 'tingkatan_id', 'mata_pelajaran', 'jenjang_pendidikan_id'));
    }

    public function soal(Request $request, $id)
    {
        // dd($request->all());

        $id = $id;
        // $ujian = Ujian::where('id', $id)->first();
        $soal = Soal::with('ujian')->where('ujian_id', $id)->get();
        // dd($soal);
        $mata_pelajaran = $request->mata_pelajaran_id;
        $tingkatan_id = $request->tingkatan_id;
        $jenjang_pendidikan_id = $request->jenjang_pendidikan_id;
        return view('soal.create', compact('soal', 'id', 'tingkatan_id', 'mata_pelajaran', 'jenjang_pendidikan_id'));

        // $ids = $id;
        // $soal = Soal::with('ujian')->where('ujian_id', $ids)->get();
        // $jadwal_id = $request->jadwal_id;
        // return view('soal.create', compact('soal', 'id', 'jadwal_id'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Ujian::find($id);
        return response()->json($emp);
    }

    public function update(Request $request)
    {
        $emp = Ujian::Find($request->id);
        $empData = [
            'jenis_ujian' => $request->jenis_ujian,
            'tanggal' => $request->tanggal,
        ];


        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Tu ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        Ujian::destroy($id);
        $soal = Soal::where('ujian_id', $id)->get();
        foreach ($soal as $p) {
            Soal::where('id', $p->id)->delete();
        }
    }



    public function SoalForm(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $form = $request->form;

        $tingkatan_id = $request->tingkatan_id;
        $mata_pelajaran = $request->mata_pelajaran_id;
        $jenjang_pendidikan_id = $request->jenjang_pendidikan_id;
        $soal = Soal::with('ujian')->where('ujian_id', $id)->get();

        return view('soal.createForm', compact('soal', 'id', 'form', 'tingkatan_id', 'mata_pelajaran', 'jenjang_pendidikan_id'));
    }
}
