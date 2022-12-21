<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PembayaranExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

	    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
        // $this->tahun_ajaran = $tahun_ajaran;
    }
 	public function view(): View
    {
        $pembayaran = Pembayaran::with('siswa')->whereBetween('tanggal_pembayaran', [$this->awal, $this->akhir])->get();

        return view('pembayaran.export', compact('pembayaran'));
    }
}
