<?php

namespace App\Http\Controllers;

use App\Models\Mata_Pelajaran;
use App\Models\Tingkatan;
use Illuminate\Http\Request;

class Mata_PelajaranController extends Controller
{
    // set index page view
    public function index()
    {
        $tingkatan = Tingkatan::get();
        return view('mata_pelajaran.index', compact('tingkatan'));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Mata_Pelajaran::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->name . '</td>
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
        // dd($request->all());
        if ((int)$request->tingkatan < 7 && $request->tingkatan > 0) {
            $jenjang = 1;
        }
        if ((int)$request->tingkatan < 10 && $request->tingkatan > 6) {
            $jenjang = 2;
        }
        if (
            (int)$request->tingkatan < 13 && $request->tingkatan > 9
        ) {
            $jenjang = 3;
        }
        if (
            (int)$request->tingkatan === 4
        ) {
            $jenjang = 4;
        }

        if ($request->jurusan11 != null) {
            $empData = [
                'name' => $request->name,
                'tingkatan' => $request->tingkatan,
                'jurusan' => $request->jurusan11,
                'jenjang_pendidikan_id' => $jenjang,
            ];
        }
        if ($request->jurusan12 != null) {
            $empData = [
                'name' => $request->name,
                'tingkatan' => $request->tingkatan,
                'jurusan' => $request->jurusan12,
                'jenjang_pendidikan_id' => $jenjang,
            ];
        }
        if ($request->jurusan10 != null) {
            $empData = [
                'name' => $request->name,
                'tingkatan' => $request->tingkatan,
                'jurusan' => $request->jurusan10,
                'jenjang_pendidikan_id' => $jenjang,
            ];
        }
        if ($request->jurusan10 === null && $request->jurusan11 === null && $request->jurusan12 === null) {
            $empData = [
                'name' => $request->name,
                'tingkatan' => $request->tingkatan,
                'jurusan' => null,
                'jenjang_pendidikan_id' => $jenjang,
            ];
        }
        Mata_Pelajaran::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Mata_Pelajaran::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // $fileName = '';
        $emp = Mata_Pelajaran::Find($request->id);
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
            'name' => $request->name,
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
        Mata_Pelajaran::destroy($id);
    }
}
