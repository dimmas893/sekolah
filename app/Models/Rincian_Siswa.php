<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rincian_Siswa extends Model
{
    use HasFactory;
	protected $table = 'rincian_siswas';
	protected $guarded = [];

	public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

	public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }
}
