<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'kelas';

    public function tahun_ajaran()
    {
        return $this->belongsTo(Tahun_ajaran::class, 'id_tahun_ajaran', 'id');
    }

    public function rincianSiswa()
    {
        return $this->hasMany(Siswa::class, 'kelas', 'id');
    }


    public function RincianJadwal()
    {
        return $this->hasMany(Jadwal::class, 'kelas_id', 'id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Master_Kelas::class, 'id_master_kelas', 'id');
    }

    public function invoice_kelas()
    {
        return $this->hasMany(Invoice_Tagihan::class, 'kelas_id', 'id');
    }
    public function tingkatan()
    {
        return $this->belongsTo(Tingkatan::class, 'tingkatan_id', 'id');
    }
}
