<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perpustakaan_Pinjam_Rincian extends Model
{
    use HasFactory;
	protected $table = 'perpustakaan_pinjam_rincian';
	protected $guarded = [];


	public function relasiBuku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }

}
