<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Guru_Kelas;
use App\Models\Kelas;
use App\Models\Mata_Pelajaran;
use Illuminate\Http\Request;

class Guru_KelasController extends Controller
{
    // set index page view
    public function index()
    {
		$guru = Guru::all();
		$mata_pelajaran = Mata_Pelajaran::all();
		$kelas = Kelas::all();
        return view('guru_kelas.index', compact('guru', 'mata_pelajaran', 'kelas'));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Guru_Kelas::with('guru', 'mata_pelajaran', 'kelas')->get();
        $output = '';
        $p = 1 ;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Guru</th>
                <th>Wali Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->kelas->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
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
        // $file = $request->file('image');
        // $fileName = time() . '.' . $file->getClientOriginalExtension();
        // $file->storeAs('public/images', $fileName);

		if($request->guru_id != null || $request->kelas_id != null || $request->mata_pelajaran_id != null){
			$empData = [
				'guru_id' => $request->guru_id,
				'mata_pelajaran_id' => $request->mata_pelajaran_id,
				'kelas_id' => $request->kelas_id,
       		 ];
			Guru_Kelas::create($empData);
			return response()->json([
				'status' => 200,
			]);
		}
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Guru_Kelas::with('guru', 'mata_pelajaran', 'kelas')->where('id', $id)->first();
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // $fileName = '';
        $emp = Guru_Kelas::Find($request->id);
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $fileName = time() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/images', $fileName);
        //     if ($emp->image) {
        //         Storage::delete('public/images/' . $emp->image);
        //     }
        // } else {
        //     $fileName = $request->emp_image;
        // }
        $empData = [
            'guru_id' => $request->guru_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id' => $request->kelas_id,
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
            Guru_Kelas::destroy($id);
    }
}
