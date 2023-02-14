<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerpustakaanMember extends Model
{
    use HasFactory;
	protected $table = 'perpustakaan_member';
	protected $guarded = [];

	public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
