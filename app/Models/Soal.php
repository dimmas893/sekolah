<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
	use HasFactory;
	protected $table = 'soals';
	protected $guarded = [];
	public function ujian()
	{
		return $this->belongsTo(Ujian::class, 'Ujian_id', 'id');
	}
}
