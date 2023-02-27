<?php

namespace App\Http\Controllers;

use App\Models\Tingkatan;
use Illuminate\Http\Request;

class TingkatanController extends Controller
{
    public function index()
    {
        return view('tingkatan.index');
    }
    public function all()
    {
        $emps = Tingkatan::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tahun Ajaran</th>
                <th>Semester</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->tingkat . '</td>
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
        $empData = [
            'tingkat' => $request->tingkat,
            'name' => $request->name,
        ];
        Tingkatan::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Tingkatan::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Tingkatan::Find($request->id);
        $empData = [
            'tingkat' => $request->tingkat,
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
        Tingkatan::destroy($id);
    }

    public function tingkatanajax(Request $request)
    {

        // dd($request->tingkatan_id);
        $id = (int)$request->tingkatan_id;
        $output = '';
        if ($id === 1) {
            $output .= '<label for="name">Kelas</label>
                        <select name="tingkatan_id" class="form-control">
						<option value="" selected disabled>---Pilih Tingkatan---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
			';
            $output .= '</select>';
            echo $output;
        } elseif ($id === 2) {
            $output .= '<label for="name">Kelas</label>
                        <select name="tingkatan_id" class="form-control">
						<option value="" selected disabled>---Pilih Tingkatan---</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
			';
            $output .= '</select>';
            echo $output;
        } elseif ($id === 3) {
            $output .= '<label for="name">Kelas</label>
                        <select name="tingkatan_id" class="form-control">
						<option value="" selected disabled>---Pilih Tingkatan---</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
			';
            $output .= '</select>';
            echo $output;
        } elseif ($id === 4) {
            $output .= '<input type="hidden" name="tingkatan_id" value="14">';
            echo $output;
        }
    }
}
