<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali_Dan_Siswa extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'wali_dan_siswas';

	public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

	public function wali_siswa()
    {
        return $this->belongsTo(Wali_Siswa::class, 'wali_siswa_id', 'id');
    }


}
