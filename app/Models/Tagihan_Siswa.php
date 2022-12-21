<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan_Siswa extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tagihan_siswas';

	public function kategori_tagihan()
    {
        return $this->belongsTo(Kategori_Tagihan::class, 'id_kategori_tagihan', 'id');
    }

	public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
