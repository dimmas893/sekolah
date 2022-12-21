<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel_Guru extends Model
{
    use HasFactory;
	protected $table = 'mapel_gurus';
	protected $guarded = [];

	public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

	public function mapel()
    {
        return $this->belongsTo(Mata_Pelajaran::class, 'mata_pelajaran_id', 'id');
    }
}
