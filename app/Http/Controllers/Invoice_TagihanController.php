<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan_Siswa;
use App\Models\Invoice_Tagihan;
use App\Models\Siswa;
use App\Models\Wali_Siswa;

class Invoice_TagihanController extends Controller
{
	public function daftarSiswa($id)
	{
		$dataTagihan = Tagihan_Siswa::where('id', $id)->first();
		return view('tagihan_siswa.daftarSiswa', compact('dataTagihan'));
	}

	public function daftarSiswa_profile($id_tagihan, $id)
	{
		$simpan_id_tagihan = $id_tagihan;
		// $emps = Invoice_Tagihan::where('id_tagihan', $id)->first();
		$siswa = Siswa::Find($id);
		// dd($siswa);
		$wali = Wali_Siswa::Find($siswa->id_orang_tua);

		return view('tagihan_siswa.daftarSiswa_profile', compact('siswa', 'wali', 'simpan_id_tagihan'));
	}

	public function daftarSiswaIsi($id)
	{

		// <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
		$emps = Invoice_Tagihan::where('id_tagihan', $id)->get();
		$output = '';
		$p = 1;
		if ($emps->count() > 0) {
			$output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nominal</th>
                <th>Status Pembayaran</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
			    if($emp->dataSiswa->kelas_siswa){
			        $kelas = $emp->dataSiswa->kelas_siswa->kelas->name;
			    } else {
			        $kelas = 'Belum Memiliki Kelas';
			    }
				$output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->dataSiswa->nama_siswa . '</td>
                <td>' . $kelas . '</td>
                <td>' . $emp->nominal . '</td>
                <td>' . $emp->status . '</td>
                <td>
                  <a href="' . url('detail-tagihan-daftar-siswa/' . $id . '/' . $emp->id_siswa) . '" class="text-info mx-1 editIcon"><i class="ion-eye h4"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}
}
