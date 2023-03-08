<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali_Dan_Siswa;
use App\Models\Wali_Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;
use File;

class PendaftaranController extends Controller
{
    public function pendaftaran()
    {
        return view('siswa.register');
    }

    public function print()
    {
        return view('siswa.print');
    }

    public function print_view($id)
    {
        $pendaftaran = Pendaftaran::Find($id);
        $pdf = Pdf::loadView('siswa.print', compact('pendaftaran'));

        return $pdf->stream();
    }

    public function halaman_step_1(Request $request)
    {
        return view('siswa.halaman_pendaftaran');
    }

    public function step_1(Request $request)
    {
        if ($request->tingkat == 'sd') {
            return view('siswa.pendaftaran_sd');
        } elseif ($request->tingkat == 'smp') {
            return view('siswa.pendaftaran_smp');
        } elseif ($request->tingkat == 'sma') {
            return view('siswa.pendaftaran_sma');
        } elseif ($request->tingkat == null) {
            return back()->with('errorjenjang', 'p');
        }
    }

    public function all($id)
    {
        // <td><img src="/foto/' . $emp->foto . '" width="50" class="img-thumbnail rounded-circle"></td>
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        //   <a href="/pendaftaran/edit/' . $emp->id . '" class="text-success" /><i class="ion-edit h4"></i></a>
        $emps = Pendaftaran::where('jenjang', $id)->where('status', '==', '0')->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Detail</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nama_siswa . '</td>

				<td>
					<a href="/pendaftaran/detail/' . $emp->id . '" class="text-info" /><i class="ion-eye h4"></i></a>
				</td>
                <td>
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

    public function store_sd(Request $request)
    {

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/' . 'foto';
            $this->fileName = 'foto-' . $request->name . Str::random(5) . '.' . $file_extension;
            $request->file('foto')->move($lokasiFile, $this->fileName);
            $fileName = $this->fileName;
        } else {
            $fileName = null;
        }


        if ($request->hasFile('prestasi_1')) {
            $file = $request->file('prestasi_1');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/' . 'prestasi_1';
            $this->fileNamep = 'prestasi_1-' . $request->name . Str::random(5) . '.' . $file_extension;
            $request->file('prestasi_1')->move($lokasiFile, $this->fileNamep);
            $fileNamep = $this->fileNamep;
        } else {
            $fileNamep = null;
        }


        if ($request->hasFile('prestasi_2')) {
            $file = $request->file('prestasi_2');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/' . 'prestasi_2';
            $this->fileNamep2 = 'prestasi_2-' . $request->name . Str::random(5) . '.' . $file_extension;
            $request->file('prestasi_2')->move($lokasiFile, $this->fileNamep2);
            $fileNamep2 = $this->fileNamep2;
        } else {
            $fileNamep2 = null;
        }


        if ($request->hasFile('ijasah')) {
            $file = $request->file('ijasah');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/' . 'ijasah';
            $this->fileName_ijasah = 'ijasah-' . $request->name . Str::random(5) . '.' . $file_extension;
            $request->file('ijasah')->move($lokasiFile, $this->fileName_ijasah);
            $fileName_ijasah = $this->fileName_ijasah;
        } else {
            $fileName_ijasah = null;
        }


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


        if ($request->file('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '-foto-' . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto', $fileName);
        } else ($fileName = null
        );

        if ($request->file('prestasi_1')) {
            $file = $request->file('prestasi_1');
            $fileNamep = time() . '-prestasi_1-' . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/prestasi_1', $fileNamep);
        } else ($fileNamep = null
        );

        if ($request->file('prestasi_2')) {
            $file = $request->file('prestasi_2');
            $fileNamep2 = time() . '-prestasi_2-' . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/prestasi_2', $fileNamep2);
        } else ($fileNamep2 = null
        );

        if ($request->file('ijasah')) {
            $file = $request->file('ijasah');
            $fileName_ijasah = time() . '-ijasah-' . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/ijasah', $fileName_ijasah);
        } else ($fileName_ijasah = null
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
        // $asal = $request->asal_sekolah;
        // dd($request->all());

        if ($request->ceksekolah == '1') {
            if ($request->asal_sekolah != null) {
                $asal = $request->asal_sekolah;
            } else {
                $asal = 'TK Islam AL-Azhar BSD';
                $tingkat = 1;
            }
        }
        if ($request->ceksekolah == '2') {
            if ($request->asal_sekolah != null) {
                $asal = $request->asal_sekolah;
            } else {
                $asal = 'SD Islam AL-Azhar BSD';
                $tingkat = 7;
            }
        }
        if ($request->ceksekolah == '3') {
            if ($request->asal_sekolah != null) {
                $asal = $request->asal_sekolah;
            } else {
                $asal = 'SMP Islam AL-Azhar BSD';

                $tingkat = 10;
            }
        }
        if ($request->ceksekolah == '4') {
            $asal = $request->asal_sekolah;
        }

        if ($request->jurusan) {
            $jurusan = $request->jurusan;
        } else {
            $jurusan = null;
        }
        $tanggalini = Carbon::now()->Format('Y-m-d');
        if (Pendaftaran::where('tingkat', $tingkat)->where('asal_sekolah', $asal)->where('nama_siswa', $request->nama_siswa)->where('jenjang', $request->ceksekolah)->where('tempat_lahir', $request->tempat_lahir)->where('tgl_lahir', $request->tgl_lahir)->where('jenis_kelamin', $request->jenis_kelamin)->where('agama', $request->agama)->where('no_telp', $request->no_telp)->where('email', $request->email)->where('no_telp_bapak', $request->no_telp_bapak)->where('no_telp_ibu', $request->no_telp_ibu)->first() === null) {
            $create = [
                'nama_siswa' => $request->nama_siswa,
                'tingkat' => $tingkat,
                'jenjang' => $request->ceksekolah,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'asal_sekolah' => $asal,
                'alamat' => $request->alamat,
                'no_telp_bapak' => $request->no_telp_bapak,
                'no_telp_ibu' => $request->no_telp_ibu,
                'tgl_daftar' => $tanggalini,
                'status' => 0,
                'jurusan' => $jurusan
            ];
            $email = $request->email;
            $nama_siswa = $request->nama_siswa;

            $pendaftaran = Pendaftaran::create($create);
            // $p = dispatch(new \App\Jobs\SendNotifEmailRegister($email, $nama_siswa));
            $p = dispatch(new \App\Jobs\SendNotifEmailRegister($email));
            // dd($p);

            //  try {
            //     $mail = new PHPMailer(true);
            //     $mail->isSMTP();
            //     $mail->Host = 'mail.anandadimmas.my.id ';
            //     $mail->SMTPAuth = true;
            //     $mail->Username = 'anandadimmasbudiarto@anandadimmas.my.id';
            //     $mail->Password = '~z[uV+P*2S4I';
            //     $mail->SMTPSecure = 'tls';
            //     $mail->Port = 587;
            //     $mail->setFrom("anandadimmas@anandadimmas.my.id", "Pengumuman");
            //     $mail->addAddress($email);
            //     $mail->isHTML(true);
            //     $mail->Subject = 'Pengumuman';
            //     $mail->Body    = 'registrasi berhasil';
            //     $mail->send();
            // } catch (Exception $e) {
            //     echo 'Message could not be sent.';
            //     echo 'Mailer Error: ' . $mail->ErrorInfo;
            // }

            $sudah = 'belum';
            return view('siswa.print', compact('pendaftaran', 'sudah'));
        } else {
            $sudah = 'sudah';
            $pendaftaran = Pendaftaran::where('tingkat', $tingkat)->where('asal_sekolah', $asal)->where('nama_siswa', $request->nama_siswa)->where('jenjang', $request->ceksekolah)->where('tempat_lahir', $request->tempat_lahir)->where('tgl_lahir', $request->tgl_lahir)->where('jenis_kelamin', $request->jenis_kelamin)->where('agama', $request->agama)->where('no_telp', $request->no_telp)->where('email', $request->email)->where('no_telp_bapak', $request->no_telp_bapak)->where('no_telp_ibu', $request->no_telp_ibu)->first();
            return view('siswa.print', compact('pendaftaran', 'sudah'));
        }
    }

    public function tbl_pendaftaran(Request $request)
    {
        $jenjang = $request->jenjang_pendidikan_id;
        return view('siswa.table_pendaftaran', compact('jenjang'));
    }

    public function detail($id)
    {
        $pendaftaran = Pendaftaran::Find($id);
        return view('siswa.pendaftaran_detail', compact('pendaftaran'));
    }

    public function edit_edit($id)
    {
        $pendaftaran = Pendaftaran::Find($id);
        return view('siswa.pendaftaran_edit', compact('pendaftaran'));
    }


    public function siswa_lulus(Request $request)
    {

        // 		dd($request->all());
        $pendaftaran = Pendaftaran::where('id', $request->id)->first();
        $jenjang = $pendaftaran->jenjang;

        if ($request->cekstatus == "LULUS") {
            $cekuser = User::where('email', $pendaftaran->email)->first();
            if ($cekuser == null) {
                $user = [
                    'name' => $pendaftaran->nama_siswa,
                    'username' => $pendaftaran->nama_siswa,
                    'email' => $pendaftaran->email,
                    'role' => 5,
                    'password' => Hash::make('password')
                ];
                $us = User::create($user);


                $wali = [
                    'no_telp_bapak' => $pendaftaran->no_telp_bapak,
                    'no_telp_ibu' => $pendaftaran->no_telp_ibu
                ];

                $walidata = Wali_Siswa::create($wali);

                $create = [
                    'id_user' => $us->id,
                    'id_orang_tua' => $walidata->id,
                    'jurusan' => $pendaftaran->jurusan,
                    'nama_siswa' => $pendaftaran->nama_siswa,
                    'tingkat' => $pendaftaran->tingkat,
                    'tempat_lahir' => $pendaftaran->tempat_lahir,
                    'tgl_lahir' => $pendaftaran->tgl_lahir,
                    'jenis_kelamin' => $pendaftaran->jenis_kelamin,
                    'agama' => $pendaftaran->agama,
                    'telp' => $pendaftaran->no_telp,
                    'email' => $pendaftaran->email,
                    'asal_sekolah' => $pendaftaran->asal_sekolah,
                    'alamat' => $pendaftaran->alamat,
                    'jenjang_pendidikan_id' => $pendaftaran->jenjang,
                ];

                $siswaaaaaa = Siswa::create($create);
            }
            $email = $pendaftaran->email;
            $p = dispatch(new \App\Jobs\SendNotifEmailLulus($email));
            Pendaftaran::destroy($pendaftaran->id);


            // $wali = [
            // 	'name' => $request->nama_wali,
            // 	'alamat' => $request->alamat_wali,
            // 	'email' => $request->email_wali,
            // 	'password' => Hash::make('password'),
            // ];
            // $wali_siswa = Wali_Siswa::create($wali);



            // Wali_Dan_Siswa::create([
            // 	'siswa_id' => $siswaaaaaa->id,
            // 	'wali_siswa_id' => $wali_siswa->id
            // ]);
            // try {
            //     $mail = new PHPMailer(true);
            //     $mail->isSMTP();
            //     $mail->Host = 'mail.anandadimmas.my.id ';
            //     $mail->SMTPAuth = true;
            //     $mail->Username = 'anandadimmasbudiarto@anandadimmas.my.id';
            //     $mail->Password = '~z[uV+P*2S4I';
            //     $mail->SMTPSecure = 'tls';
            //     $mail->Port = 587;
            //     $mail->setFrom("anandadimmas@anandadimmas.my.id", "Data Pengajuan");
            //     $mail->addAddress($siswaaaaaa->email);
            //     $mail->isHTML(true);
            //     $mail->Subject = 'Surat Pemberitahuan';
            //     $mail->Body    = 'Anda Lulus';
            //     $mail->send();
            // } catch (Exception $e) {
            //     echo 'Message could not be sent.';
            //     echo 'Mailer Error: ' . $mail->ErrorInfo;
            // }

            // $temukan = Pendaftaran::where('id', $request->id_pendaftaran)->first();
            // Pendaftaran::where('id', $pendaftaran->id)->destroy();
            // Pendaftaran::destroy($pendaftaran->id);




            return view('siswa.table_pendaftaran', compact('jenjang'))->with('lulus', 'p');
        } elseif ($request->cekstatus == "tidaklulus") {
            // $temukan = Pendaftaran::where('id', $request->id_pendaftaran)->first();

            $email = $pendaftaran->email;
            $p = dispatch(new \App\Jobs\SendNotifEmailTidakLulus($email));
            // $pendaftaran = Pendaftaran::where('id', $request->id)->first();
            // Pendaftaran::where('id', $temukan->id)->update([
            // 	'status' => '1'
            // ]);
            // try {
            // 	$mail = new PHPMailer(true);
            // 	$mail->isSMTP();
            // 	$mail->Host = 'mail.anandadimmas.my.id ';
            // 	$mail->SMTPAuth = true;
            // 	$mail->Username = 'anandadimmasbudiarto@anandadimmas.my.id';
            // 	$mail->Password = '~z[uV+P*2S4I';
            // 	$mail->SMTPSecure = 'tls';
            // 	$mail->Port = 587;
            // 	$mail->setFrom("anandadimmas@anandadimmas.my.id", "Data Pengajuan");
            // 	$mail->addAddress($pendaftaran->email);
            // 	$mail->isHTML(true);
            // 	$mail->Subject = 'Surat Pemberitahuan';
            // 	$mail->Body    = 'Anda Lulus';
            // 	$mail->send();
            // } catch (Exception $e) {
            // 	echo 'Message could not be sent.';
            // 	echo 'Mailer Error: ' . $mail->ErrorInfo;
            // }

            Pendaftaran::destroy($pendaftaran->id);

            return view('siswa.table_pendaftaran', compact('jenjang'))->with('tidaklulus', 'p');
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        Pendaftaran::destroy($id);
        // $emp = Pendaftaran::find($id);
        // if (file::delete(public_path('/prestasi_1/' . $emp->prestasi_1)) && file::delete(public_path('/ijasah/' . $emp->ijasah)) && file::delete(public_path('/foto/' . $emp->foto)) && file::delete(public_path('/prestasi_2/' . $emp->prestasi_2))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/ijasah/' . $emp->ijasah)) && file::delete(public_path('/foto/' . $emp->foto)) && file::delete(public_path('/prestasi_2/' . $emp->prestasi_2))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/prestasi_1/' . $emp->prestasi_1)) && file::delete(public_path('/foto/' . $emp->foto)) && file::delete(public_path('/prestasi_2/' . $emp->prestasi_2))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/prestasi_1/' . $emp->prestasi_1)) && file::delete(public_path('/ijasah/' . $emp->ijasah)) && file::delete(public_path('/prestasi_2/' . $emp->prestasi_2))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/prestasi_1/' . $emp->prestasi_1)) && file::delete(public_path('/ijasah/' . $emp->ijasah)) && file::delete(public_path('/foto/' . $emp->foto))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/prestasi_1/' . $emp->prestasi_1)) && file::delete(public_path('/ijasah/' . $emp->ijasah))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/prestasi_1/' . $emp->prestasi_1)) && file::delete(public_path('/prestasi_2/' . $emp->prestasi_2))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/foto/' . $emp->foto)) && file::delete(public_path('/prestasi_2/' . $emp->prestasi_2))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/ijasah/' . $emp->ijasah)) && file::delete(public_path('/foto/' . $emp->foto))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/prestasi_1/' . $emp->prestasi_1)) &&  file::delete(public_path('/foto/' . $emp->foto))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/ijasah/' . $emp->ijasah)) && file::delete(public_path('/prestasi_2/' . $emp->prestasi_2))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/prestasi_1/' . $emp->prestasi_1))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/ijasah/' . $emp->ijasah))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/foto/' . $emp->foto))) {
        // 	Pendaftaran::destroy($id);
        // } elseif (file::delete(public_path('/prestasi_2/' . $emp->prestasi_2))) {
        // 	Pendaftaran::destroy($id);
        // } else {
        // 	Pendaftaran::destroy($id);
        // }

        // if(Storage::delete(public_path('/prestasi_2/'.$emp->prestasi_2)) && Storage::delete(public_path('/foto/'.$emp->foto)) && Storage::delete(public_path('/prestasi_2/'.$emp->prestasi_2))){
        //     Pendaftaran::destroy($id);
        // }elseif(Storage::delete(public_path('/foto/'.$emp->foto)) && Storage::delete(public_path('/prestasi_1/'.$emp->prestasi_1))  && Storage::delete(public_path('/ijasah/'.$emp->ijasah)) ){
        //     Pendaftaran::destroy($id);
        // }elseif(Storage::delete(public_path('/ijasah/'.$emp->ijasah)) && Storage::delete(public_path('/prestasi_1/'.$emp->prestasi_1)) && Storage::delete(public_path('/prestasi_2/'.$emp->prestasi_2))){
        //     Pendaftaran::destroy($id);
        // }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Pendaftaran::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update($id, Request $request)
    {

        // dd($request->all());
        $emp = Siswa::find($id);
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
        $create = [
            'nomor_induk_siswa' => $request->nomor_induk_siswa,
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            // 'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'telp' => $request->no_telp,
            'email' => $request->email,
            'asal_sekolah' => $request->asal_sekolah,
            'alamat' => $request->alamat,
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
            'avatar' => $fileName,
        ];

        $emp->update($create);
        return back();
    }
}
