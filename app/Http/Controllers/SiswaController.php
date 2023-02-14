<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Invoice_Tagihan;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali_Siswa;
use Str;
use File;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function export()
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    public function importsiswa(Request $request)
    {
        $user = Excel::import(new SiswaImport, $request->file);
        // dd($user);
        return back();
    }

    // set index page view
    public function index()
    {
        $siswa = Siswa::all();
        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function edit_page($id)
    {
        $siswa = Siswa::Find($id);
        if ($siswa->id_orang_tua) {
            $wali = Wali_Siswa::Find($siswa->id_orang_tua);
            return view('siswa.edit', compact('siswa', 'wali'));
        } else {
            return view('siswa.edit', compact('siswa'));
        }
    }

    public function update_page($id, Request $request)
    {
        // dd($request->all());
        $emp = Siswa::Find($id);
        if ($request->hasFile('avatar')) {
            if ($emp->avatar) {
                File::delete(public_path('/avatar/' . $emp->avatar));
            }

            $file = $request->file('avatar');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/avatar';
            $this->fileName = 'avatar-' . $request->name . Str::random(5) . '.' . $file_extension;
            // $this->fileName = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
            $request->file('avatar')->move($lokasiFile, $this->fileName);
            $fileName = $this->fileName;
        } else {
            $fileName = $emp->avatar;
        }
        $wali_cek = Wali_Siswa::where('id', $emp->id_orang_tua)->first();
        if ($wali_cek) {
            $user = [
                'name' => $request->nama_bapak,
                'username' => $request->nama_bapak,
                'email' => $request->email_bapak,
                'role' => 4,
                'password' => Hash::make('password'),
            ];
            $org = [
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
            ];
            $wali = Wali_Siswa::where('id', $emp->id_orang_tua)->update($org);
            $id_user_org = User::where('id', $wali_cek->id_user)->update($user);
        } else {
            $user12 = [
                'name' => $request->nama_bapak,
                'username' => $request->nama_bapak,
                'email' => $request->email_bapak,
                'role' => 4,
                'password' => Hash::make('password'),
            ];
            $usernih = User::create($user12);
            $walidata = [
                'id_user' => $usernih->id,
                'nama_bapak' => $usernih->nama_bapak,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_bapak' => $request->pekerjaan_bapak,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'penghasilan_bapak' => $request->penghasilan_bapak,
                'penghasilan_ibu' => $request->penghasilan_ibu,
                'agama_bapak' => $request->agama_bapak,
                'agama_ibu' => $request->agama_ibu,
                'no_telp_bapak' => $request->no_telp_bapak,
                'no_telp_ibu' => $request->no_telp_ibu,
                'email_bapak' => $usernih->email_bapak,
                'email_ibu' => $request->email_ibu,
            ];
            $walinih = Wali_Siswa::create($walidata);
            $emp->update(['id_orang_tua' => $walinih->id]);
        }


        if ($emp) {
            $user2 = [
                'name' => $request->nama_siswa,
                'username' => $request->nama_siswa,
                'email' => $request->email,
                'role' => 5,
                'password' => Hash::make($request->password_siswa),
            ];
            $id_user_siswa = User::where('id', $emp->id_user)->update($user2);
            $create = [
                'nomor_induk_siswa' => $request->nomor_induk_siswa,
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'telp' => $request->no_telp,
                'email' => $request->email,
                'asal_sekolah' => $request->asal_sekolah,
                'alamat' => $request->alamat,
                'avatar' => $fileName,
            ];
            Siswa::where('id', $emp->id)->update($create);
        }
        return back();
    }


    public function edit_profile()
    {
        if (Auth::user()->role == 3) {
            $pendaftaran = Guru::where('id_user', Auth::user()->id)->first();
            return view('guru.halaman_user.edit_profile', compact('pendaftaran'));
        } elseif (Auth::user()->role == 5) {
            $siswa = Siswa::with('kelas_siswa')->where('id_user', Auth::user()->id)->first();
            if ($siswa) {
                $tagihan = Invoice_Tagihan::with('kategori_tagihan')->where('status', 'unpaid')->where('id_siswa', $siswa->id)->get();
                $wali = Wali_Siswa::Find($siswa->id_orang_tua);
                // dd($wali);
                return view('siswa.halaman_user.edit_profile_page', compact('siswa', 'wali', 'tagihan'));
            }

            $p = Siswa::with('kelas_siswa')->where('id_user', Auth::user()->id)->first();
            if ($p->id_orang_tua == null) {
                $tagihan = Invoice_Tagihan::with('kategori_tagihan')->where('status', 'unpaid')->where('id_siswa', $siswa->id)->get();
                $wali = 1;
                // dd($wali);
                return view('siswa.halaman_user.edit_profile_page', compact('siswa', 'wali', 'tagihan'));
            }
            // return view('siswa.halaman_user.edit_profile', compact('siswa'));
        } elseif (Auth::user()->role == 1) {
            $pendaftaran = Admin::where('id_user', Auth::user()->id)->first();
            return view('admin.halaman_user.edit_profile', compact('pendaftaran'));
        }
    }

    public function edit_profile_page()
    {
        if (Auth::user()->role == 3) {
            $pendaftaran = Guru::where('id_user', Auth::user()->id)->first();
            return view('guru.halaman_user.edit_profile', compact('pendaftaran'));
        } elseif (Auth::user()->role == 5) {
            $siswa = Siswa::with('kelas_siswa')->where('id_user', Auth::user()->id)->first();
            if ($siswa) {
                $tagihan = Invoice_Tagihan::with('kategori_tagihan')->where('status', 'unpaid')->where('id_siswa', $siswa->id)->get();
                $wali = Wali_Siswa::Find($siswa->id_orang_tua);
                // dd($wali);
                return view('siswa.halaman_user.edit_profile_page', compact('siswa', 'wali', 'tagihan'));
            }
            // return view('siswa.halaman_user.edit_profile', compact('siswa'));
        } elseif (Auth::user()->role == 1) {
            $pendaftaran = Admin::where('id_user', Auth::user()->id)->first();
            return view('admin.halaman_user.edit_profile', compact('pendaftaran'));
        }
    }
    // handle fetch all eamployees ajax request
    public function all()
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Siswa::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nomor_induk_siswa . '</td>
                <td>' . $emp->nama_siswa . '</td>
                <td>' . $emp->jenis_kelamin . '</td>
                <td>' . $emp->telp . '</td>
                <td>' . $emp->alamat . '</td>
                <td>' . $emp->email . '</td>
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
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/avatar';
            $this->fileName = 'avatar-' . $request->name . Str::random(5) . '.' . $file_extension;
            $request->file('avatar')->move($lokasiFile, $this->fileName);
            $fileName = $this->fileName;
        } else {
            $fileName = null;
        }
        $user = [
            'name' => $request->nama_bapak,
            'username' => $request->nama_bapak,
            'email' => $request->email_bapak,
            'role' => 4,
            'password' => Hash::make('password'),
        ];
        $id_user_org = User::create($user);
        $org = [
            'id_user' => $id_user_org->id,
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
        ];
        $wali = Wali_Siswa::create($org);

        $user = [
            'name' => $request->nama_siswa,
            'username' => $request->nama_siswa,
            'email' => $request->email,
            'role' => 5,
            'password' => Hash::make('password'),
        ];

        $id_user_siswa = User::create($user);

        $create = [
            'id_orang_tua' => $wali->id,
            'id_user' => $id_user_siswa->id,
            'nomor_induk_siswa' => $request->nomor_induk_siswa,
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'telp' => $request->no_telp,
            'email' => $request->email,
            'asal_sekolah' => $request->asal_sekolah,
            'alamat' => $request->alamat,
            'avatar' => $fileName,
        ];

        Siswa::create($create);
        return back();
        // return view('siswa.index');
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Siswa::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Siswa::Find($request->id);

        //  $emp = Siswa::find($id);
        if ($request->hasFile('avatar')) {
            if ($emp->avatar) {
                File::delete(public_path('/avatar/' . $emp->avatar));
            }

            $file = $request->file('avatar');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/avatar';
            $this->fileName = 'avatar-' . $request->name . Str::random(5) . '.' . $file_extension;
            // $this->fileName = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
            $request->file('avatar')->move($lokasiFile, $this->fileName);
            $fileName = $this->fileName;
        } else {
            // $this->fileName = $emp->fileName;
            $fileName = $emp->avatar;
        }

        $empData = [
            'nomor_induk_siswa' => $request->nomor_induk_siswa,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'alamat' => $fileName
        ];

        if ($request->password) {
            $update = [
                'password' => $request->password
            ];
            User::where('id', $emp->id_user)->update($update);
        }
        if ($request->email) {
            $update = [
                'email' => $request->email
            ];
            User::where('id', $emp->id_user)->update($update);
        }



        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Tu ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $siswa = Siswa::where('id', $id)->first();
        User::destroy($siswa->id_user);
        Siswa::destroy($id);
    }

    public function jadwal_siswa()
    {
        $siswa_id = Siswa::where('id_user', Auth::user()->id)->first();
        if ($siswa_id) {
            $kelasguru = Kelas::where('id', $siswa_id->kelas)->first();
            $jadwal = Jadwal::with('kelasget', 'mata_pelajaran', 'ruangan')->where('kelas_id', $kelasguru->id)->get();
            return view('siswa.halaman_user.pelajaran', compact('jadwal'));
        } else {
            return back()->with('guruerror', 'ds');
        }
    }
}
