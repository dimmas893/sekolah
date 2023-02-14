<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    function sendUploadDocument(Request $request)  {
        $file_path = 'https://dapurkoding.my.id/';
        $dokumenFile = null;            
        if($request->hasFile('dokumen')){
            $file = $request->file('dokumen');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path().'/DokumenUpload/';            
            $this->dokumenFile = 'dokumen-'.$request->nama_file.'.'.$file_extension;            
            $request->file('dokumen')->move($lokasiFile,$this->dokumenFile);
            $dokumenFile = $this->dokumenFile;
        }
        
        $output=array( "code" => "200",
         "nama_file" => $request->nama_file,
         "url" => $file_path.'DokumenUpload/'.$dokumenFile,
        );
        echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }

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
