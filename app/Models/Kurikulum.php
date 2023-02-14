<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;
    protected $table = 'kurikulums';
    protected $guarded = [];

    public function mata_pelajaran()
    {
        return $this->belongsTo(Mata_Pelajaran::class, 'mata_pelajaran_id', 'id');
    }
    public function tingkatan()
    {
        return $this->belongsTo(Tingkatan::class, 'tingkatan_id', 'id');
    }
}
