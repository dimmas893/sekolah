<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mata_Pelajaran;
use App\Models\Ruangan;
use App\Models\Setting;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;

class JadwalAdminController extends Controller
{
    public function index(Request $request)
    {
        // $request->kelas_id;
        $kelas = Kelas::where('id', $request->kelas_id)->first();
        $guru = Guru::all();
        $mata_pelajaran = Mata_Pelajaran::all();
        $hari = Hari::all();
        $ruangan = Ruangan::all();
        $setting = Setting::first();
        $tahun_ajaran = Tahun_ajaran::get();
        return view('admin.naikkelas.jadwal', compact('tahun_ajaran', 'guru', 'mata_pelajaran', 'hari', 'ruangan', 'kelas'));
    }

    public function all($id)
    {
        $emps = Jadwal::with('guru', 'mata_pelajaran')->where('kelas_id', $id)->get();
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

                    <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                    <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $jadwal = Jadwal::whereBetween('jam_masuk', [$request->jam_masuk, $request->jam_keluar])->where('ruangan_id', $request->ruangan_id)->where('hari_id', $request->hari_id)->first();
        if ($jadwal == null) {
            $empData = [
                'kelas_id' => $request->kelas_id,
                'tingkatan_id' => $request->tingkatan_id,
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
        $emp = Jadwal::with('guru', 'mata_pelajaran')->where('id', $id)->first();
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
