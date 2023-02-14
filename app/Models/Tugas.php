<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
	use HasFactory;
	protected $table = 'tugas';
	protected $guarded = [];
	public function jadwal()
	{
		return $this->belongsTo(Jadwal::class, 'Jadwal_id', 'id');
	}
}
