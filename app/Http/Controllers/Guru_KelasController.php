<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Guru_Kelas;
use App\Models\JenjangPendidikan;
use App\Models\Kelas;
use App\Models\Master_Kelas;
use App\Models\Mata_Pelajaran;
use App\Models\Setting;
use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;

class Guru_KelasController extends Controller
{
    // set index page view
    public function index()
    {
        $guru = Guru::all();
        $tahun_ajaran = Tahun_ajaran::all();
        $kelas = Master_Kelas::all();
        $jenjang_pendidikan = JenjangPendidikan::all();
        return view('guru_kelas.index', compact('guru', 'tahun_ajaran', 'kelas', 'jenjang_pendidikan'));
    }

    public function ajax(Request $request)
    {
        $setting = Setting::first();
        $id = $request->id;
        $emps = Master_Kelas::where('jenjang_pendidikan_id', $id)->get();

        $output = '';
        if ($emps->count() > 0) {
            $output .= '<label>Kelas</label>
            <select name="id_master_kelas" class="form-control">
						<option value="" selected disabled>---Pilih Kelas---</option>
			';
            foreach ($emps as $emp) {
                $output .= '<option value="' . $emp->id . '" >' . $emp->name . '</option>';
            }
            $output .= '</select>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">Kelas Sudah terisi!</h1>';
        }
    }

    public function all()
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Kelas::with('kelas', 'tahun_ajaran')->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Jenjang</th>
                <th>Wali Kelas</th>
                <th>Tahun Ajaran</th>
                <th>Detail Kelas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->kelas->name . '</td>
                <td>' . $emp->kelas->jenjang->nama . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->tahun_ajaran->tahun_ajaran . '</td>
                <td><a href="/kelas/detail/' . $emp->id . '" class="text-info mx-1"><i class="ion-eye h4"></i></a></td>
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
        // $tingkat = Kelas::where('id', $request->id_master_kelas)->first();
        $idmasterkelas = (int)$request->id_master_kelas;
        $masterkelas = Master_Kelas::where('id', $idmasterkelas)->first();
        // dd($request->all());
        $empData = [
            'id_guru' => $request->id_guru,
            'tingkatan_id' => $masterkelas->tingkatan_id,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_master_kelas' => $request->id_master_kelas,
        ];
        Kelas::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Kelas::where('id', $id)->first();
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Kelas::Find($request->id);

        $tingkat = Master_Kelas::where('id', $request->id_master_kelas)->first();
        $empData = [
            'id_guru' => $request->id_guru,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
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
        Kelas::destroy($id);
    }
}
