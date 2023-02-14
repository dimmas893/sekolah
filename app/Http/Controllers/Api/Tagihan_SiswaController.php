<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice_Tagihan;
use App\Models\Tagihan_Siswa;
use Illuminate\Http\Request;

class Tagihan_SiswaController extends Controller
{


    public function all()
    {
        $admin = Invoice_Tagihan::with('user')->get();

		$tagihan = [];
		foreach($admin as $p){
			$row['id'] = $p['id'];
			array_push($tagihan, $row);
		}

        return response()->json(
			$tagihan
		);
    }
    public function store(Request $request)
    {

        $empData = [
            'id_tagihan' => $request->id_tagihan,
            'id_kategori_tagihan' => $request->id_kategori_tagihan,
            'id_siswa' => $request->id_siswa,
            'nominal' => $request->nominal,
            'deskripsi' => $request->deskripsi
        ];
        $emp = Tagihan_Siswa::create($empData);
        return response()->json([
            'data' => $emp,
            'status' => 200
        ]);
    }

    // handle edit an Tu ajax request
    public function edit($id)
    {
        $emp = Tagihan_Siswa::Find($id);
        return response()->json([
            'data' =>$emp,
            'status' => 200
        ]);
    }

    // handle update an Tu ajax request
    public function update(Request $request, $id)
    {
        $emp = Tagihan_Siswa::Find($id);

        $empData = [
            'id_tagihan' => $request->id_tagihan,
            'id_kategori_tagihan' => $request->id_kategori_tagihan,
            'id_siswa' => $request->id_siswa,
            'nominal' => $request->nominal,
            'deskripsi' => $request->deskripsi
        ];

        $emp->update($empData);
        return response()->json([
            'data' => $emp,
            'status' => 200
        ]);
    }

    // handle delete an Tu ajax request
    public function delete($id)
    {
        Tagihan_Siswa::destroy($id);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Mengghapus'
            ]);
    }
}
