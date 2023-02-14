<?php

namespace App\Http\Controllers;

use App\Models\JenjangPendidikan;
use Illuminate\Http\Request;

class JenjangpendidikanController extends Controller
{
	// set index page view
	public function index()
	{
		return view('jenjang.index');
	}

	// handle fetch all eamployees ajax request
	public function all()
	{

		// <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
		$emps = JenjangPendidikan::all();
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
                <td>' . $emp->nama . '</td>
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
			'nama' => $request->nama,
		];
		JenjangPendidikan::create($empData);
		return response()->json([
			'status' => 200,
		]);
	}

	public function edit(Request $request)
	{
		$id = $request->id;
		$emp = JenjangPendidikan::find($id);
		return response()->json($emp);
	}

	public function update(Request $request)
	{
		$emp = JenjangPendidikan::Find($request->id);

		$empData = [
			'nama' => $request->nama,
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
		JenjangPendidikan::destroy($id);
	}
}
