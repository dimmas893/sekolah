<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kurikulum;
use App\Models\Mapel_Guru;
use App\Models\Rincian_Siswa;
use App\Models\Siswa;
use App\Models\Wali_Dan_Siswa;
use App\Models\Wali_Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
	// public function get_all()
	// {}

	public function profil_siswa(Request $request)
	{
		$siswa = Siswa::with('kelas_siswa')->where('id', $request->siswa_id)->first();
		// dd($siswa);
		// $rincian_siswa = Rincian_Siswa::with('jadwal')->where('siswa_id', $siswa->id)->latest()->first();
		$tagihan = [];
		// foreach($siswa as $p){
			$row['id'] = $siswa['id'];
			$row['nis'] = $siswa['nomor_induk_siswa'];
			$row['nama'] = $siswa['nama_siswa'];
			$row['tempat_lahir'] = $siswa['tempat_lahir'];
			$row['tanggal_lahir'] = $siswa['tgl_lahir'];
			$row['jk'] = $siswa['jenis_kelamin'];
			$row['alamat'] = $siswa['alamat'];
			$row['kelas'] = $siswa['kelas_siswa']['name'];
			// $row['ruangan'] = $rincian_siswa['jadwal']['ruangan']['name'];
			$row['email'] = $siswa['email'];
			$row['hp'] = $siswa['telp'];
			// array_push($tagihan, $row);
		// }
		return response()->json(
			['data' => $row]
		);
	}

		public function profil_wali_siswa(Request $request)
	{
		$siswa = Wali_Siswa::where('id', $request->wali_siswa_id)->first();
		$rincian_siswa = Wali_Dan_Siswa::with('siswa', 'wali_siswa')->where('wali_siswa_id', $siswa->id)->get();
		// dd(count($rincian_siswa));
		$tagihan = [];
		foreach($rincian_siswa as $p){
			$row['id'] = $p['id'];
			$row['nama'] = $p['siswa']['nama_siswa'];
			$row['avatar'] = $p['siswa']['avatar'];
			array_push($tagihan, $row);

		}
		// dd($tagihan);
		return response()->json([
			'data' => [
				"id" => $siswa->id,
				"nama" => $siswa->name,
				"alamat" => $siswa->alamat,
				"email" => $siswa->email,
				"telepon" => $siswa->telepon,
			],
			'data_anak' => $tagihan
			]);

	}




	public function profil_guru(Request $request)
	{
		$siswa = Guru::where('id', $request->guru_id)->first();
		$mapel = Mapel_Guru::with('mapel')->where('guru_id', $siswa->id)->get();
		// dd($mapel);
		$tagihan = [];

		foreach($mapel as $p){
				if($p){
				$row['id'] = $siswa['id'];
				$row['nama'] = $siswa['name'];
				$row['tempat_lahir'] = $siswa['tempat_lahir'];
				$row['tgl_lahir'] = $siswa['tgl_lahir'];
				$row['jk'] = $siswa['jenis_kelamin'];
				$row['alamat'] = $siswa['alamat'];
				$row['email'] = $siswa['email'];
				$row['hp'] = $siswa['telp'];
				$row['mapel'][] = $p['mapel']['name'];
				array_push($tagihan, $row);
			}
			}
		return response()->json([
			'data' => $row
		]);
	}


    public function all()
    {
        $admin = Siswa::all();
		$tagihan = [];
		foreach($admin as $p){
			$row['id'] = $p['nomor_induk_siswa'];
			$row['name'] = $p['nama_siswa'];
			$row['avatar'] = $p['avatar'];
			array_push($tagihan, $row);
		}

        return response()->json(
			['data' => $tagihan]
		);
    }

	public function kurikulum_all()
    {
        $admin = Kurikulum::all();
		$tagihan = [];
		foreach($admin as $p){
			$row['id'] = $p['id'];
			$row['link'] = $p['link'];
			$row['update_terakhir'] = $p['tanggal'];
			array_push($tagihan, $row);
		}

        return response()->json(
			['data' => $tagihan]
		);
    }
    public function store(Request $request)
    {

        $empData = [
            'nomor_induk_siswa' => $request->nomor_induk_siswa,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telp' => $request->telp,
            'alamat' => $request->alamat
        ];
        $emp = Siswa::create($empData);
        return response()->json([
            'data' => $emp,
            'status' => 200
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
		$id = $request->id;
        $emp = Siswa::Find($id);
        return response()->json([
            'data' =>$emp,
            'status' => 200
        ]);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {

		$id = $request->id;
        $emp = Siswa::Find($id);

        $empData = [
            'nomor_induk_siswa' => $request->nomor_induk_siswa,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telp' => $request->telp,
            'alamat' => $request->alamat
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
        Siswa::destroy($id);

            return response()->json([
                'message' => 'Berhasil Mengghapus'
            ],200);
    }
}
