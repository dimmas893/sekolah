<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasGuru extends Model
{
	use HasFactory;
	protected $table = 'kelas';
	protected $guarded = [];

	public function tahun_ajaran()
	{
		return $this->belongsTo(Tahun_ajaran::class, 'id_tahun_ajaran', 'id');
	}

	public function guru()
	{
		return $this->belongsTo(Guru::class, 'id_guru', 'id');
	}

	public function kelas()
	{
		return $this->belongsTo(Kelas::class, 'id_master_kelas', 'id');
	}

	public function jenjang()
	{
		return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_id', 'id');
	}
}
