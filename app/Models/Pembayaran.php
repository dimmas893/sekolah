<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';
    // protected $fillable = [
	// 	'id_pembayaran',
	// 	'tanggal_pembayaran',
	// 	'total_pembayaran',
	// 	'metode_pembayaran',
	// 	'status'
	// ];

    protected $guarded = [];

	public function rincianPembayaran()
    {
        return $this->hasMany(Rincian_Pembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }

	public function siswa()
    {
        return $this->hasMany(Siswa::class, 'siswa_id', 'id');
    }
}
