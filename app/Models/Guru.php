<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
	protected $table = 'gurus';
	protected $guarded = [];

	public function mata_pelajarans()
    {
        return $this->hasMany(Mata_Pelajaran::class, 'id_pembayaran', 'id_pembayaran');
    }
}
