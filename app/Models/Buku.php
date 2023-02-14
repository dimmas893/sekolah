<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
	protected $table = 'buku';
	protected $guarded = [];

	public function buku_kategori()
    {
        return $this->belongsTo(Buku_Kategori::class, 'kategori_id', 'id');
    }
}
