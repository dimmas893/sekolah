<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function collection(Collection $rows)
	{
		foreach ($rows as $row) {
			$user = User::create([
				'name' => $row[2],
				'username' => $row[2],
				'password' =>  Hash::make('password'),
				'email'    => $row[4],
				'role'    => 5,
			]);
			// dd($user);
			Siswa::create([
				'id_user' => $user->id,
				'nomor_induk_siswa' => $row[1],
				'nama_siswa' => $row[2],
				'jenis_kelamin' => $row[3],
				'email' => $row[4],
				'telp' => $row[5],
				'alamat' => $row[6],
				'tingkat' => $row[7],
			]);
		}
	}
}
