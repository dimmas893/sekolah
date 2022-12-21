<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\Wali_Dan_Siswa;
use App\Models\Wali_Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PendaftaranController extends Controller
{
	public function pendaftaran()
    {
        return view('siswa.register');
    }

	public function halaman_step_1(Request $request)
	{
		return view('siswa.halaman_pendaftaran');
	}

	public function step_1(Request $request)
	{
		if($request->tingkat == 'sd'){
        	return view('siswa.pendaftaran_sd');
		}elseif($request->tingkat == 'smp'){
        	return view('siswa.pendaftaran_smp');
		}elseif($request->tingkat == 'sma'){
        	return view('siswa.pendaftaran_sma');
		}elseif($request->tingkat == null){
			return back()->with('errorjenjang', 'p');
		}
	}

	public function all()
	{
		// <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Pendaftaran::where('status' , '==' , '0')->get();
        $output = '';
        $p = 1 ;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>NIS</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nisn . '</td>
                <td>' . $emp->nis . '</td>

                <td><img src="/storage/prestasi_1/' . $emp->prestasi_1 . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>
				  <a href="/pendaftaran/detail/' . $emp->id . '" class="text-info" /><i class="ion-eye h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

	public function store_sd(Request $request)
	{


	if($request->file('foto')){
		$file = $request->file('foto');
	     $fileName = time() . '-foto-'.'.' . $file->getClientOriginalExtension();
        $file->storeAs('public/foto', $fileName);
	}else(
		 $fileName = null
	);

	if($request->file('prestasi_1')){
		$file = $request->file('prestasi_1');
		$fileNamep = time() . '-prestasi_1-'. '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/prestasi_1', $fileNamep);
	}else(

		 $fileNamep = null
	);

	if($request->file('prestasi_2')){
		$file = $request->file('prestasi_2');
		$fileNamep2 = time() .'-prestasi_2-' . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/prestasi_2', $fileNamep2);
	}else(

		 $fileNamep2 = null
	);

	if($request->file('ijasah')){
		$file = $request->file('ijasah');
		$fileName_ijasah = time() . '-ijasah-' . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/ijasah', $fileName_ijasah);
	}else(

		 $fileName_ijasah = null
	);



	$tanggalini = Carbon::now()->Format('Y-m-d');
	// dd($tanggalini);

		$create = [
			'nis' => $request->nis,
			'nisn' => $request->nisn,
			'nama_siswa' => $request->nama_siswa,
			'tempat_lahir' => $request->tempat_lahir,
			'tgl_lahir' => $request->tgl_lahir,
			'jenis_kelamin' => $request->jenis_kelamin,
			'agama' => $request->agama,
			'no_telp' => $request->no_telp,
			'email' => $request->email,
			'asal_sekolah' => $request->asal_sekolah,
			'alamat' => $request->alamat,
			'no_telp' => $request->no_telp,
			'nama_bapak' => $request->nama_bapak,
			'nama_ibu' => $request->nama_ibu,
			'pekerjaan_bapak' => $request->pekerjaan_bapak,
			'pekerjaan_ibu' => $request->pekerjaan_ibu,
			'penghasilan_bapak' => $request->penghasilan_bapak,
			'penghasilan_ibu' => $request->penghasilan_ibu,
			'agama_bapak' => $request->agama_bapak,
			'agama_ibu' => $request->agama_ibu,
			'no_telp_bapak' => $request->no_telp_bapak,
			'no_telp_ibu' => $request->no_telp_ibu,
			'email_bapak' => $request->email_bapak,
			'email_ibu' => $request->email_ibu,
			'prestasi_1' => $fileNamep,
			'prestasi_2' => $fileNamep2,
			'foto' => $fileName,
			'ijasah' => $fileName_ijasah,
			'tgl_daftar' => $tanggalini,
			'tingkat' => 'SD',
			'status' => '0',
		];

		// dd($create);

		$pendaftaran = Pendaftaran::create($create);
	}

	public function store_smp(Request $request)
	{


	if($request->file('foto')){
		$file = $request->file('foto');
	     $fileName = time() . '-foto-'.'.' . $file->getClientOriginalExtension();
        $file->storeAs('public/foto', $fileName);
	}else(
		 $fileName = null
	);

	if($request->file('prestasi_1')){
		$file = $request->file('prestasi_1');
		$fileNamep = time() . '-prestasi_1-'. '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/prestasi_1', $fileNamep);
	}else(

		 $fileNamep = null
	);

	if($request->file('prestasi_2')){
		$file = $request->file('prestasi_2');
		$fileNamep2 = time() .'-prestasi_2-' . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/prestasi_2', $fileNamep2);
	}else(

		 $fileNamep2 = null
	);

	if($request->file('ijasah')){
		$file = $request->file('ijasah');
		$fileName_ijasah = time() . '-ijasah-' . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/ijasah', $fileName_ijasah);
	}else(

		 $fileName_ijasah = null
	);



	$tanggalini = Carbon::now()->Format('Y-m-d');
	// dd($tanggalini);

		$create = [
			'nis' => $request->nis,
			'nisn' => $request->nisn,
			'nama_siswa' => $request->nama_siswa,
			'tempat_lahir' => $request->tempat_lahir,
			'tgl_lahir' => $request->tgl_lahir,
			'jenis_kelamin' => $request->jenis_kelamin,
			'agama' => $request->agama,
			'no_telp' => $request->no_telp,
			'email' => $request->email,
			'asal_sekolah' => $request->asal_sekolah,
			'alamat' => $request->alamat,
			'no_telp' => $request->no_telp,
			'nama_bapak' => $request->nama_bapak,
			'nama_ibu' => $request->nama_ibu,
			'pekerjaan_bapak' => $request->pekerjaan_bapak,
			'pekerjaan_ibu' => $request->pekerjaan_ibu,
			'penghasilan_bapak' => $request->penghasilan_bapak,
			'penghasilan_ibu' => $request->penghasilan_ibu,
			'agama_bapak' => $request->agama_bapak,
			'agama_ibu' => $request->agama_ibu,
			'no_telp_bapak' => $request->no_telp_bapak,
			'no_telp_ibu' => $request->no_telp_ibu,
			'email_bapak' => $request->email_bapak,
			'email_ibu' => $request->email_ibu,
			'prestasi_1' => $fileNamep,
			'prestasi_2' => $fileNamep2,
			'foto' => $fileName,
			'ijasah' => $fileName_ijasah,
			'tgl_daftar' => $tanggalini,
			'tingkat' => 'SMP',
			'status' => '0',
		];

		// dd($create);

		$pendaftaran = Pendaftaran::create($create);
	}

	public function store(Request $request)
	{


	if($request->file('foto')){
		$file = $request->file('foto');
	     $fileName = time() . '-foto-'.'.' . $file->getClientOriginalExtension();
        $file->storeAs('public/foto', $fileName);
	}else(
		 $fileName = null
	);

	if($request->file('prestasi_1')){
		$file = $request->file('prestasi_1');
		$fileNamep = time() . '-prestasi_1-'. '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/prestasi_1', $fileNamep);
	}else(

		 $fileNamep = null
	);

	if($request->file('prestasi_2')){
		$file = $request->file('prestasi_2');
		$fileNamep2 = time() .'-prestasi_2-' . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/prestasi_2', $fileNamep2);
	}else(

		 $fileNamep2 = null
	);

	if($request->file('ijasah')){
		$file = $request->file('ijasah');
		$fileName_ijasah = time() . '-ijasah-' . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/ijasah', $fileName_ijasah);
	}else(

		 $fileName_ijasah = null
	);



	$tanggalini = Carbon::now()->Format('Y-m-d');
	// dd($tanggalini);

		$create = [
			'nis' => $request->nis,
			'nisn' => $request->nisn,
			'nama_siswa' => $request->nama_siswa,
			'tempat_lahir' => $request->tempat_lahir,
			'tgl_lahir' => $request->tgl_lahir,
			'jenis_kelamin' => $request->jenis_kelamin,
			'agama' => $request->agama,
			'no_telp' => $request->no_telp,
			'email' => $request->email,
			'asal_sekolah' => $request->asal_sekolah,
			'alamat' => $request->alamat,
			'no_telp' => $request->no_telp,
			'nama_bapak' => $request->nama_bapak,
			'nama_ibu' => $request->nama_ibu,
			'pekerjaan_bapak' => $request->pekerjaan_bapak,
			'pekerjaan_ibu' => $request->pekerjaan_ibu,
			'penghasilan_bapak' => $request->penghasilan_bapak,
			'penghasilan_ibu' => $request->penghasilan_ibu,
			'agama_bapak' => $request->agama_bapak,
			'agama_ibu' => $request->agama_ibu,
			'no_telp_bapak' => $request->no_telp_bapak,
			'no_telp_ibu' => $request->no_telp_ibu,
			'jurusan_1' => $request->jurusan_1,
			'jurusan_2' => $request->jurusan_2,
			'email_bapak' => $request->email_bapak,
			'email_ibu' => $request->email_ibu,
			'prestasi_1' => $fileNamep,
			'prestasi_2' => $fileNamep2,
			'foto' => $fileName,
			'ijasah' => $fileName_ijasah,
			'tgl_daftar' => $tanggalini,
			'tingkat' => 'SMA',
			'status' => '0',
		];

		// dd($create);

		$pendaftaran = Pendaftaran::create($create);
	}

	public function tbl_pendaftaran()
	{
		return view('siswa.table_pendaftaran');
	}

	public function detail($id)
	{
		$pendaftaran = Pendaftaran::Find($id);
		return view('siswa.pendaftaran_detail', compact('pendaftaran'));
	}

	public function siswa_lulus(Request $request)
	{
		// dd($request->all());
		if($request->cekstatus == "LULUS"){
				$siswa = [
				'nomor_induk_siswa' => $request->nomor_induk_siswa,
				'nisn' => $request->nisn,
				'nama_siswa' => $request->nama_siswa,
				'jenis_kelamin' => $request->jenis_kelamin,
				'email' => $request->email,
				'password' => Hash::make('password'),
				'telp' => $request->telp,
				'alamat' => $request->alamat
			];

		$siswaaaaaa = Siswa::create($siswa);

		$wali = [
			'name' => $request->nama_wali,
			'alamat' => $request->alamat_wali,
			'email' => $request->email_wali,
			'password' => Hash::make('password'),
		];
		$wali_siswa = Wali_Siswa::create($wali);



		Wali_Dan_Siswa::create([
			'siswa_id' => $siswaaaaaa->id,
			'wali_siswa_id' => $wali_siswa->id
		]);

		$temukan = Pendaftaran::where('id', $request->id_pendaftaran)->first();
			Pendaftaran::where('id', $temukan->id)->update([
				'status' => '2'
			]);

		return back()->with('lulus', 'p');

		}elseif($request->cekstatus == "tidaklulus")
		{
			$temukan = Pendaftaran::where('id', $request->id_pendaftaran)->first();
			Pendaftaran::where('id', $temukan->id)->update([
				'status' => '1'
			]);

			return back()->with('tidaklulus', 'p');
		}

	}
}
