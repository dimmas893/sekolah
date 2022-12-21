<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function all()
    {
        $admin = Admin::all();
        return response()->json([
            'data' => $admin,
            'status' =>200
        ]);
    }
    public function store(Request $request)
    {

        $empData = [
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
            'nama_admin' => $request->nama_admin,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $emp = Admin::create($empData);
        return response()->json([
            'data' => $emp,
            'status' => 200
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
		$id = $request->id;
        $emp = Admin::Find($id);
        return response()->json([
            'data' =>$emp,
            'status' => 200
        ]);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
		$id = $request->id;
        $emp = Admin::Find($id);

        $empData = [
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
            'nama_admin' => $request->nama_admin,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $emp->update($empData);
        return response()->json([
            'data' => $emp,
            'status' => 200
        ]);
    }

    // handle delete an Tu ajax request
    public function delete(Request $request)
    {
		$id = $request->id;
            Admin::destroy($id);

            return response()->json([
                'message' => 'Berhasil Mengghapus'
            ], 200);
    }
}
