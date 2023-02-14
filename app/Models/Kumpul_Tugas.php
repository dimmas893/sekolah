<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kumpul_Tugas extends Model
{
	use HasFactory;
	protected $guarded = [];
	protected $table = 'tugas_kumpul';

	public function tugas()
	{
		return $this->belongsTo(Tugas::class, 'tugas_id', 'id');
	}

	public function jadwal()
	{
		return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
	}
}
