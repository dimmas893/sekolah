<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\KelasGuru;
use App\Models\Kumpul_Tugas;
use App\Models\Rincian_Siswa;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{

	// set index page view
	public function index()
	{
		return view('tugas.index');
	}

	public function buat_tugas()
	{
		return view('tugas.buat_tugas');
	}

	// handle fetch all eamployees ajax request
	public function all()
	{

		// <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
		$emps = Tugas::all();
		$output = '';
		$p = 1;
		if ($emps->count() > 0) {
			$output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul Tugas</th>
                <th>Tanggal Pembuatan Tugas</th>
                <th>Tanggal Pengumpulan Tugas</th>
                <th>Tanggal Evaluasi Tugas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nama . '</td>
                <td>' . $emp->tanggal_tugas . '</td>
                <td>' . $emp->tanggal_pengumpulan . '</td>
                <td>' . $emp->tanggal_evaluasi . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}

	// handle insert a new Tu ajax request
	public function store(Request $request)
	{
		if ($request->hasFile('file_tugas')) {
			$file = $request->file('file_tugas');
			$file_extension = $file->getClientOriginalExtension();
			$lokasiFile = public_path() . '/file_tugas';

			$this->file_tugas = 'file_tugas-' . $request->name . Str::random(5) . '.' . $file_extension;
			$request->file('file_tugas')->move($lokasiFile, $this->file_tugas);
			$file_tugas = $this->file_tugas;
		} else {
			$file_tugas = null;
		}

		$empData = [
			'jadwal_id' => $request->jadwal_id,
			'nama' => $request->nama,
			'tanggal_tugas' => $request->tanggal_tugas,
			'tanggal_pengumpulan' => $request->tanggal_pengumpulan,
			'tanggal_evaluasi' => $request->tanggal_evaluasi,
			'evaluasi_oleh' => Auth::user()->id,
			'deskripsi' => $request->deskripsi,
			'status_aktif' => 0,
			'dibuat_oleh' => Auth::user()->id,
			'file_tugas' => $file_tugas
		];
		$tugas = Tugas::create($empData);
		$datajadwal = Jadwal::where('id', $tugas->jadwal_id)->first();
		$datasiswa = Kelas::where('id', $datajadwal->kelas_id)->first();
		// $rincian_siswa = Rincian_Siswa::where('jadwal_id', $tugas->jadwal_id)->get();
		$siswa = Siswa::where('kelas', $datasiswa->id)->get();
		foreach ($siswa as $p) {
			$kumpul_tugas = [
				'tugas_id' => $tugas->id,
				'siswa_id' => $p->id
			];
			$kumpul_tugass = Kumpul_Tugas::create($kumpul_tugas);
		}

		return response()->json([
			'status' => 200,
		]);
	}

	// handle insert a new Tu ajax request
	public function store_biasa(Request $request)
	{
		if ($request->hasFile('file_tugas')) {
			$file = $request->file('file_tugas');
			$file_extension = $file->getClientOriginalExtension();
			$lokasiFile = public_path() . '/file_tugas';

			$this->file_tugas = 'file_tugas-' . $request->name . Str::random(5) . '.' . $file_extension;
			$request->file('file_tugas')->move($lokasiFile, $this->file_tugas);
			$file_tugas = $this->file_tugas;
		} else {
			$file_tugas = null;
		}

		$empData = [
			'jadwal_id' => $request->jadwal_id,
			'nama' => $request->nama,
			'tanggal_tugas' => $request->tanggal_tugas,
			'tanggal_pengumpulan' => $request->tanggal_pengumpulan,
			'tanggal_evaluasi' => $request->tanggal_evaluasi,
			'evaluasi_oleh' => 14,
			'deskripsi' => $request->deskripsi,
			'status_aktif' => 0,
			'dibuat_oleh' => 14,
			'file_tugas' => $file_tugas
		];



		$tugas = Tugas::create($empData);
		$datajadwal = Jadwal::where('id', $tugas->jadwal_id)->first();
		$datasiswa = Kelas::where('id', $datajadwal->kelas_id)->first();
		// $rincian_siswa = Rincian_Siswa::where('jadwal_id', $tugas->jadwal_id)->get();
		$siswa = Siswa::where('kelas', $datasiswa->id)->get();
		foreach ($siswa as $p) {
			$kumpul_tugas = [
				'tugas_id' => $tugas->id,
				'siswa_id' => $p->id,
				'jadwal_id' => $tugas->jadwal_id,
				'tanggal_pengumpulan' => $tugas->tanggal_pengumpulan,
				'tanggal_evaluasi' => $tugas->tanggal_evaluasi
			];
			$kumpul_tugass = Kumpul_Tugas::create($kumpul_tugas);
		}

		return Back();
	}

	// handle edit an Tu ajax request
	public function edit(Request $request)
	{
		$id = $request->id;
		$emp = Tugas::find($id);
		return response()->json($emp);
	}

	// handle update an Tu ajax request
	public function update(Request $request)
	{
		$emp = Tugas::Find($request->id);

		if ($request->hasFile('file_tugas')) {
			if ($emp->file_tugas) {
				File::delete(public_path('/file_tugas/' . $emp->file_tugas));
			}
			$file = $request->file('file_tugas');
			$file_extension = $file->getClientOriginalExtension();
			$lokasiFile = public_path() . '/file_tugas';

			$this->file_tugas = 'file_tugas-' . $request->name . Str::random(5) . '.' . $file_extension;
			// $this->file_tugas = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
			$request->file('file_tugas')->move($lokasiFile, $this->file_tugas);
			$file_tugas = $this->file_tugas;
		} else {
			$this->file_tugas = $emp->file_tugas;
			$file_tugas = $this->file_tugas;
		}

		$empData = [
			'jadwal_id' => $request->jadwal_id,
			'nama' => $request->nama,
			'tanggal_tugas' => $request->tanggal_tugas,
			'tanggal_pengumpulan' => $request->tanggal_pengumpulan,
			'tanggal_evaluasi' => $request->tanggal_evaluasi,
			'deskripsi' => $request->deskripsi,
			'status_aktif' => 0,
			'evaluasi_oleh' => 14,
			'dibuat_oleh' => 14,
			'file_tugas' => $file_tugas
		];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle delete an Tu ajax request
	public function delete(Request $request)
	{
		$id = $request->id;
		$emp = Tugas::Find($id);
		if ($emp->file_tugas) {
			File::delete(public_path('/file_tugas/' . $emp->file_tugas));
		}
		$tugas = Tugas::destroy($id);
		$kumpul_tugas = Kumpul_Tugas::where('tugas_id', $id)->get();
		foreach ($kumpul_tugas as $p) {
			if ($p->upload_file) {
				File::delete(public_path('/upload_file/' . $emp->upload_file));
				Kumpul_Tugas::destroy($p->id);
			} else {
				Kumpul_Tugas::destroy($p->id);
			}
		}
	}
}
