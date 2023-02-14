<?php

namespace App\Http\Controllers;

use App\Imports\AdminImport;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Excel;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function importadmin(Request $request)
    {
        $user = Excel::import(new AdminImport, $request->file);
        return back();
    }

    public function index()
    {
        return view('admin.index');
    }

    public function edit_profile(Request $request, $id)
    {
        $emp = Admin::Find($id);
        $empData = [
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
            'nama_admin' =>  $request->name,
        ];
        $user = User::Find(Auth::user()->id);
        $create = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user->update($create);
        $emp->update($empData);
        return back();
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Admin::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Admin</th>
                <th>E-mail</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nomor_induk_pegawai . '</td>
                <td>' . $emp->nama_admin . '</td>
                <td>' . $emp->email . '</td>
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

        $empData = [
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
            'nama_admin' => $request->nama_admin,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        Admin::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Admin::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Admin::Find($request->id);

        $empData = [
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
            'nama_admin' => $request->nama_admin,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
        $emp = Admin::find($id);
        Admin::destroy($id);
    }
}
