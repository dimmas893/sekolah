<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Tagihan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'invoice_tagihans';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function kategori_tagihan()
    {
        return $this->belongsTo(Tagihan_Siswa::class, 'id_tagihan', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
    public function dataSiswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
}
