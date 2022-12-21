<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
	protected $table = 'jadwals';
	protected $guarded = [];

	public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

	public function rincian_siswa()
    {
        return $this->belongsTo(Rincian_Siswa::class, 'siswa_id', 'siswa_id');
    }

	public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }

	public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

	public function mata_pelajaran()
    {
        return $this->belongsTo(Mata_Pelajaran::class, 'mata_pelajaran_id', 'id');
    }



	public function hari()
    {
        return $this->belongsTo(Hari::class, 'hari_id', 'id');
    }
}
