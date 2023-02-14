<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
 	public function view(): View
    {
		$siswa = Siswa::get();
        return view('siswa.export.index', compact('siswa'));
    }
}
