<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rincian_Pembayaran extends Model
{
	use HasFactory;
	protected $table = 'rincian_pembayarans';

	protected $guarded = [];
	public function pembayaran()
	{
		return $this->belongsTo(Pembayaran::class, 'id_pembayaran', 'id_pembayaran');
	}

	public function invoice()
	{
		return $this->belongsTo(Invoice_Tagihan::class, 'id_invoice', 'id_invoice');
	}
}
