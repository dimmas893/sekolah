<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	use HasFactory;
	protected $guarded = [];
	protected $table = 'settings';

	public function tahun_ajaran()
	{
		return $this->belongsTo(Tahun_ajaran::class, 'id_tahun_ajaran', 'id');
	}
	public function semester()
	{
		return $this->belongsTo(Semester::class, 'semester', 'id');
	}
}
