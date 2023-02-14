<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $table = 'ujians';
    protected $guarded = [];



    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'Jadwal_id', 'id');
    }
    public function mata_pelajaran()
    {
        return $this->belongsTo(Mata_Pelajaran::class, 'mata_pelajaran_id', 'id');
    }
}
