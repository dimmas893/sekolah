<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_Kelas extends Model
{
	use HasFactory;
	protected $guarded = [];
	protected $table = 'master_kelas';

	public function jenjang()
	{
		return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_id', 'id');
	}
		public function tingkat()
	{
		return $this->hasMany(Tingkatan::class, 'id', 'tingkatan_id');
		// return $this->belongsTo(Tingkatan::class, 'tingkatan_id', 'id');
	}
}
