<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use App\Models\Mata_Pelajaran;
use App\Models\Tingkatan;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    // set index page view
    public function index()
    {
        $tingkatan = Tingkatan::all();
        $mata_pelajaran = Mata_Pelajaran::all();
        return view('kurikulum.index', compact('tingkatan', 'mata_pelajaran'));
    }

    public function all()
    {
        $emps = Kurikulum::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tingkatanth>
                <th>Mata Pelajaran</th>
                <th>name</th>
                <th>Link</th>
                <th>Tanggal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->tingkatan->tingkat . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->link . '</td>
                <td>' . $emp->tanggal . '</td>
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
            'tingkatan_id' => $request->tingkatan_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'name' => $request->name,
            'link' => $request->link,
            'tanggal' => $request->tanggal,
        ];
        Kurikulum::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Kurikulum::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // $fileName = '';
        $emp = Kurikulum::Find($request->id);

        $empData = [
            'tingkatan_id' => $request->tingkatan_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'name' => $request->name,
            'link' => $request->link,
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
        Kurikulum::destroy($id);
    }
}
