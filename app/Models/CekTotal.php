<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekTotal extends Model
{
    use HasFactory;
    protected $table = 'cek_totals';
    protected $guarded = [];

    public function tagihan()
    {
        return $this->belongsTo(Invoice_Tagihan::class, 'id_invoice', 'id_invoice');
    }
}
