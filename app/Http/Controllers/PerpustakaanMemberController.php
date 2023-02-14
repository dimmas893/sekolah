<?php

namespace App\Http\Controllers;

use App\Models\PerpustakaanMember;
use App\Models\User;
use Illuminate\Http\Request;

class PerpustakaanMemberController extends Controller
{
    // set index page view
    public function index()
    {
		$user = User::all();
        return view('perpustakaan_member.index', compact('user'));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = PerpustakaanMember::all();
        $output = '';
        $p = 1 ;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Status Aktif</th>
                <th>Tipe Member</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->user->name . '</td>
                <td>' . $emp->status_aktif . '</td>
                <td>' . $emp->tipe_member . '</td>
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
		$user = User::where('id', $request->user_id)->first();

		if($user){
			$empData = [
				'user_id' => $user->id,
				'status_aktif' => 1,
				'tipe_member' => $user->role,
			];
			PerpustakaanMember::create($empData);
			return response()->json([
				'status' => 200,
			]);
		}

    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = PerpustakaanMember::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = PerpustakaanMember::Find($request->id);
 		$user = User::where('id', $emp->user_id)->first();
        $empData = [
            'user_id' => $user->id,
            'status_aktif' => 1,
            'tipe_member' => $user->role,
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
            PerpustakaanMember::destroy($id);
    }
}
