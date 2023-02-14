<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function laporanKeuangan(Request $request) {
        $file_path = 'https://dapurkoding.my.id/';
        $mulai = $request->mulai;
        $selesai = $request->selesai;
        $tahun = Carbon::createFromFormat('Y-m-d',$mulai)->format("Y");
        $tglMulai = Carbon::createFromFormat('Y-m-d',$mulai)->format("dM");
        $tglSelesai = Carbon::createFromFormat('Y-m-d',$selesai)->format("dM");      
    
        $namaFile = 'Laporan_keuangan_'.$tglMulai.'_'.$tglSelesai.'_'.$tahun.'.pdf';
        $items = DB::table("siswas")->take(10)->get();
        view()->share('items',$items);
        $pdf = PDF::loadView('pdfview');
        $pdf->save(public_path().'/simpanPDF/'.$namaFile);
        return response()->json([
            'url' => $file_path.'simpanPDF/'.$namaFile
        ],200);
      }
}
