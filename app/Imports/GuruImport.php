<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GuruImport implements ToCollection
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
				'name' => $row[1],
				'username' => $row[1],
				'password' =>  Hash::make('password'),
				'email'    => $row[2],
				'role'    => 3,
			]);

			Guru::create([
				'id_user'     => $user->id,
				'name'    => $user->name,
				'email'    => $user->email,
				'alamat'    => $row[3],
				'jenis_kelamin'    => $row[4],
				'tempat_lahir'    => $row[5],
				'tgl_lahir'    => $row[6],
				'telp'    => $row[7],
			]);
		}
	}
}
