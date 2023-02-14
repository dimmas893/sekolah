<?php

namespace App\Imports;

use App\Models\Admin;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class AdminImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
	public function collection(Collection $rows)
		{
			foreach ($rows as $row)
			{
			$user = User::create([
						'name' => $row[2],
						'username' => $row[2],
						'password' =>  Hash::make('password'),
						'email'    => $row[3],
						'role'    => 1,
					]);
				Admin::create([
					'id_user'     => $user->id,
					'nomor_induk_pegawai' => $row[1],
					'nama_admin' => $row[2],
					'email' => $row[3]
				]);
			}
		}
}
