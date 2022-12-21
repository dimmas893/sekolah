<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru_Kelas extends Model
{
    use HasFactory;
	protected $table = 'guru_kelas';
	protected $guarded = [];

	public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

	public function mata_pelajaran()
    {
        return $this->belongsTo(Mata_Pelajaran::class, 'mata_pelajaran_id', 'id');
    }

	public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
