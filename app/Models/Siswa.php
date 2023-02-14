<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
	use HasFactory;
	protected $guarded = [];
	protected $table = 'siswas';


	public function kelas_siswa()
	{
		return $this->belongsTo(Kelas::class, 'kelas', 'id');
	}

	public function wali_siswa()
	{
		return $this->belongsTo(Wali_Siswa::class, 'id_orang_tua', 'id');
	}
}
