<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    // set index page view
    public function index()
    {
        return view('pengaturan.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Pengaturan::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Ujian</th>
                <th>Waktu</th>
                <th>Nilai Minimal</th>
                <th>peraturan Ujian</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nama_ujian . '</td>
                <td>' . $emp->waktu . '</td>
                <td>' . $emp->nilai_min . '</td>
                <td>' . $emp->peraturan_ujian . '</td>
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

    // handle insert a new Tu ajax request
    public function store(Request $request)
    {
        $empData = [
            'nama_ujian' => $request->nama_ujian,
            'waktu' => $request->waktu,
            'nilai_min' => $request->nilai_min,
            'peraturan_ujian' => $request->peraturan_ujian,
        ];
        Pengaturan::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Pengaturan::find($id);
        return response()->json($emp);
    }

    public function update(Request $request)
    {
        $emp = Pengaturan::Find($request->id);
        $empData = [
            'nama_ujian' => $request->nama_ujian,
            'waktu' => $request->waktu,
            'nilai_min' => $request->nilai_min,
            'peraturan_ujian' => $request->peraturan_ujian,
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
        Pengaturan::destroy($id);
    }
}
