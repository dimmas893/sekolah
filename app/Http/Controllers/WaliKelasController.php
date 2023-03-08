<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Setting;
use App\Models\Master_Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali_Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class WaliKelasController extends Controller
{
    public function profilsiwaget($id)
    {
        $emps = Siswa::with('kelas_siswa')->find($id);
        $wali = Wali_Siswa::where('id', $emps->id_orang_tua)->first();
        $output = '';
        if ($emps->count() > 0) {
            $output .= ' <div class="">
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="profile-widget">
                                <div class="profile-widget-header">';
            if ($emps->avatar) {
                $output .= '<img alt="image" src="/avatar/' . $emps->avatar . '" class="img-fluid">';
            } else {
                $output .= '<img alt="image" src="/defaut2.png" class="img-fluid">';
            }


            $output .= '<div class="profile-widget-items">
                                        <div class="profile-widget-item">
                                            <div class="profile-widget-item-label">kelas</div>
                                            <div class="profile-widget-item-value">' . $emps->kelas_siswa->kelas->name . '</div></div>
                                        <div class="profile-widget-item">
                                            <div class="profile-widget-item-label">Nama</div>
                                            <div class="profile-widget-item-value">' . $emps->nama_siswa . '</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
											    <div class="col-12 col-md-12 col-lg-8">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2"
                                                role="tab" aria-controls="home" aria-selected="true">Profil</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2"
                                                role="tab" aria-controls="profile" aria-selected="false">Orang
                                                Tua</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-bordered" id="myTab3Content">
                                        <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                            aria-labelledby="home-tab2">

                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p class="profile-widget-item-value">Nis :
                                                        <b>' . $emps->nomor_induk_siswa . '</b>
                                                    </p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Nisn : <b>' . $emps->nisn . '</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Nama Siswa : <b>' . $emps->nama_siswa . '</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Tempat Lahir : <b>' . $emps->tempat_lahir . '</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Tanggal Lahir : <b>' . $emps->tgl_lahir . '</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Jenis Kelamin : <b>' . $emps->jenis_kelamin . '</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Agama : <b>' . $emps->agama . '</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Email : <b>' . $emps->email . '</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <p>No Telepon : <b>' . $emps->telp . '</b></p>
                                                    <hr>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <p>Asal Sekolah : <b>' . $emps->asal_sekolah . '</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-12">
                                                    <p>Alamat : <b>' . $emps->alamat . '</b></p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile2" role="tabpanel"
                                            aria-labelledby="profile-tab2">';
            if ($wali) {
                $output .= ' <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Nama Bapak : <b>' . $wali->nama_bapak . '</b></p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Pekerjaan Bapak : <b>' . $wali->pekerjaan_bapak . '</b></p>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Penghasilan Bapak /bulan :
                                                            <b>' . $wali->penghasilan_bapak . '</b>
                                                            <hr>
                                                        </p>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Agama : <b>' . $wali->agama_bapak . '</b></p>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>No Telepon : <b>' . $wali->no_telp_bapak . '</b></p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Email : <b>' . $wali->email_bapak . '</b></p>
                                                        <hr>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Nama Ibu : <b>' . $wali->nama_ibu . '</b></p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Pekerjaan Ibu : <b>' . $wali->pekerjaan_ibu . '</b></p>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Penghasilan Ibu /bulan :
                                                            <b>' . $wali->penghasilan_ibu . '</b>
                                                        </p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Agama : <b>' . $wali->agama_ibu . '</b></p>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>No Telepon : <b>' . $wali->no_telp_ibu . '</b></p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>email : <b>' . $wali->email_ibu . '</b></p>
                                                        <hr>
                                                    </div>
                                                </div>';
            } else {
                $output .= ' <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Nama Bapak : <b></b></p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Pekerjaan Bapak : <b></b></p>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Penghasilan Bapak /bulan :
                                                            <b></b>
                                                            <hr>
                                                        </p>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Agama : <b></b></p>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>No Telepon : <b></b></p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Email : <b></b></p>
                                                        <hr>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Nama Ibu : <b></b></p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Pekerjaan Ibu : <b></b></p>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Penghasilan Ibu /bulan :
                                                            <b></b>
                                                        </p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>Agama : <b></b></p>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>No Telepon : <b></b></p>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <p>email : <b></b></p>
                                                        <hr>
                                                    </div>
                                                </div>';
            }
            $output .=  '</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>';
            echo $output;
        } else {
            echo 'Data tidak ada';
        }
    }

    public function profilsiwa($id)
    {
        $id = $id;
        return view('walikelas.profilsiswa', compact('id'));
    }
    public function WaliKelas()
    {
        $guru = Guru::where('id_user', Auth::user()->id)->first();
        $kelas = Kelas::where('id_guru', $guru->id)->first();
        return view('walikelas.siswa', compact('kelas'));
    }
    public function siswadidikajax($id)
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Siswa::where('kelas', $id)->get();
        $output = '';
        $csrf = csrf_token();
        $p = 0;
        $a = 1000;
        if ($emps->count() > 0) {
            $output .= ' <form name="form1" action="/naik-kelas" method="post">';
            $output .= '<input type="hidden" name="_token" value="' . $csrf . '" />';
            $output .= '<div class="card">
                            <div class="row mt-3 ml-3 mr-3">';
            foreach ($emps as $p => $emp) {
                $output .= '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <i class="ion-android-person h3"></i> ' . $emp->nama_siswa . '  </div>
                                        <div class="text-right"></div>
                                    </div>
                                    <div class="card-body">

                                          <div class="card-body">
                                                    <input type="radio" name="group[]' . $p . '"
                                                        value="' . $emp->id . '" checked="checked">Meneruskan<br />
                                                    <input type="radio" name="group[]' . $p . '"
                                                        value="-' . $emp->id . '">Tidak Meneruskan
                                                </div>

                                    </div>
                                </div>
                            </div>';
            }
            $output .= '</div>
                    <div class="row mb-3 ml-3 mr-3">
                        <div class="col-2">
                            <div class="my-2">
                                <input type="submit" class="btn btn-primary" value="submit">
                            </div>
                        </div>
                    </div>
                </div>
            </form>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    public function NaikKelas(Request $request)
    {
        $setting = Setting::first();
        if ($request['group']) {
            foreach ($request['group'] as $pu) {
                $ceklagi = Siswa::where('id', $pu)->first();
                if ($ceklagi) {
                    $wali = Wali_Siswa::where('id', $ceklagi->id_orang_tua)->first();
                } else {
                    $ceklagi = Siswa::where('id', preg_replace("/[^0-9]/", "", $pu))->first();
                    $wali = Wali_Siswa::where('id', $ceklagi->id_orang_tua)->first();
                }
                $cek_ke_2 = Siswa::where('id_orang_tua', $wali->id)->count();
                if ($cek_ke_2 > 1) {
                    if (Siswa::where('id', $pu)->first()) {
                        $siswadatakud = Siswa::where('id', $pu)->first();
                        // dd($siswadatakud->tingkat,'2');
                        if ((int)$siswadatakud->tingkat === 12) {
                            // if ($siswadatakud->avatar != null) {
                            //     if (asset('avatar/' . $siswadatakud->avatar)) {
                            //         rename('avatar/' . $siswadatakud->avatar, 'alumni/' . $siswadatakud->avatar);
                            //         $siswadatakud->update(['avatar' => null]);
                            //     }
                            // }
                            $cre = [
                                'nomor_induk_siswa' => $siswadatakud->nomor_induk_siswa,
                                'nisn' => $siswadatakud->nisn,
                                'nama_siswa' => $siswadatakud->nama_siswa,
                                'tempat_lahir' => $siswadatakud->tempat_lahir,
                                'tgl_lahir' => $siswadatakud->tgl_lahir,
                                'jenis_kelamin' => $siswadatakud->jenis_kelamin,
                                'agama' => $siswadatakud->agama,
                                'telp' => $siswadatakud->no_telp,
                                'id_orang_tua' => $siswadatakud->id_orang_tua,
                                'alamat' => $siswadatakud->alamat,
                                'tingkat' => $siswadatakud->tingkat,
                                'id_user' => $siswadatakud->id_user,
                            ];
                            $alumni = Alumni::create($cre);

                            Siswa::where('id', $siswadatakud->id)->update(
                                [
                                    'kelas' => null,
                                    'tingkat' => 13,
                                ]
                            );
                            User::where('id', $siswadatakud->id_user)->update(['status' => null]);
                        } else {
                            Siswa::where('id', $siswadatakud->id)->update(
                                [
                                    'kelas' => null,
                                    'tingkat' => $siswadatakud->tingkat + 1,
                                ]
                            );
                        }
                    } else {
                        // dd(preg_replace("/[^0-9]/", "", $pu));
                        $siswatidakmeneruskan = Siswa::where('id', preg_replace("/[^0-9]/", "", $pu))->first();
                        //  dd($siswatidakmeneruskan->tingkat);
                        if ((int)$siswatidakmeneruskan->tingkat === 12) {
                            if ($siswatidakmeneruskan->avatar != null) {
                                if (asset('avatar/' . $siswatidakmeneruskan->avatar)) {
                                    rename('avatar/' . $siswatidakmeneruskan->avatar, 'alumni/' . $siswatidakmeneruskan->avatar);
                                    $siswatidakmeneruskan->update(['avatar' => null]);
                                }
                            }
                            $cre = [
                                'nomor_induk_siswa' => $siswatidakmeneruskan->nomor_induk_siswa,
                                'nisn' => $siswatidakmeneruskan->nisn,
                                'nama_siswa' => $siswatidakmeneruskan->nama_siswa,
                                'tempat_lahir' => $siswatidakmeneruskan->tempat_lahir,
                                'tgl_lahir' => $siswatidakmeneruskan->tgl_lahir,
                                'jenis_kelamin' => $siswatidakmeneruskan->jenis_kelamin,
                                'agama' => $siswatidakmeneruskan->agama,
                                'telp' => $siswatidakmeneruskan->no_telp,
                                'id_orang_tua' => $siswatidakmeneruskan->id_orang_tua,
                                'alamat' => $siswatidakmeneruskan->alamat,
                                'tingkat' => $siswatidakmeneruskan->tingkat,
                                'id_user' => $siswatidakmeneruskan->id_user,
                            ];
                            $alumni = Alumni::create($cre);

                            Siswa::where('id', $siswatidakmeneruskan->id)->update(
                                [
                                    'kelas' => null,
                                    'tingkat' => 13,
                                ]
                            );
                            User::where('id', $siswatidakmeneruskan->id_user)->update(['status' => null]);
                        } else {
                            Siswa::where('id', $siswatidakmeneruskan->id)->update(
                                [
                                    'kelas' => null,
                                    'tingkat' => 13,
                                ]
                            );
                            User::where('id', $siswatidakmeneruskan->id_user)->update(['status' => null]);

                            // $lah = Wali_Siswa::where('id', $siswatidakmeneruskan->id_orang_tua)->first();
                            // User::where('id', $lah->id_user)->update(['status' => null]);
                        }
                    }
                }

                if ($cek_ke_2 === 1) {
                    if (Siswa::where('id', $pu)->first()) {
                        $siswadatakud = Siswa::where('id', $pu)->first();
                        if ((int)$siswadatakud->tingkat === 12) {
                            // if ($siswadatakud->avatar != null) {
                            //     if (asset('avatar/' . $siswadatakud->avatar)) {
                            //         rename('avatar/' . $siswadatakud->avatar, 'alumni/' . $siswadatakud->avatar);
                            //         $siswadatakud->update(['avatar' => null]);
                            //     }
                            // }
                            $cre = [
                                'nomor_induk_siswa' => $siswadatakud->nomor_induk_siswa,
                                'nisn' => $siswadatakud->nisn,
                                'nama_siswa' => $siswadatakud->nama_siswa,
                                'tempat_lahir' => $siswadatakud->tempat_lahir,
                                'tgl_lahir' => $siswadatakud->tgl_lahir,
                                'jenis_kelamin' => $siswadatakud->jenis_kelamin,
                                'agama' => $siswadatakud->agama,
                                'telp' => $siswadatakud->no_telp,
                                'id_orang_tua' => $siswadatakud->id_orang_tua,
                                'alamat' => $siswadatakud->alamat,
                                'tingkat' => $siswadatakud->tingkat,
                                'id_user' => $siswadatakud->id_user,
                            ];
                            $alumni = Alumni::create($cre);

                            Siswa::where('id', $siswadatakud->id)->update(
                                [
                                    'kelas' => null,
                                    'tingkat' => $siswadatakud->tingkat + 1,
                                ]
                            );
                            User::where('id', $siswadatakud->id_user)->update(['status' => null]);
                            $lah = Wali_Siswa::where('id', $siswadatakud->id_orang_tua)->first();
                            User::where('id', $lah->id_user)->update(['status' => null]);
                        } else {
                            Siswa::where('id', $siswadatakud->id)->update(
                                [
                                    'kelas' => null,
                                    'tingkat' => $siswadatakud->tingkat + 1,
                                ]
                            );
                        }
                    } else {
                        // dd(preg_replace("/[^0-9]/", "", $pu));
                        $siswatidakmeneruskan = Siswa::where('id', preg_replace("/[^0-9]/", "", $pu))->first();
                        if ($siswatidakmeneruskan->tingkat === 12) {
                            if ($siswatidakmeneruskan->avatar != null) {
                                if (asset('avatar/' . $siswatidakmeneruskan->avatar)) {
                                    rename('avatar/' . $siswatidakmeneruskan->avatar, 'alumni/' . $siswatidakmeneruskan->avatar);
                                    $siswatidakmeneruskan->update(['avatar' => null]);
                                }
                            }
                            $cre = [
                                'nomor_induk_siswa' => $siswatidakmeneruskan->nomor_induk_siswa,
                                'nisn' => $siswatidakmeneruskan->nisn,
                                'nama_siswa' => $siswatidakmeneruskan->nama_siswa,
                                'tempat_lahir' => $siswatidakmeneruskan->tempat_lahir,
                                'tgl_lahir' => $siswatidakmeneruskan->tgl_lahir,
                                'jenis_kelamin' => $siswatidakmeneruskan->jenis_kelamin,
                                'agama' => $siswatidakmeneruskan->agama,
                                'telp' => $siswatidakmeneruskan->no_telp,
                                'id_orang_tua' => $siswatidakmeneruskan->id_orang_tua,
                                'alamat' => $siswatidakmeneruskan->alamat,
                                'tingkat' => $siswatidakmeneruskan->tingkat,
                                'id_user' => $siswatidakmeneruskan->id_user,
                            ];
                            $alumni = Alumni::create($cre);

                            Siswa::where('id', $siswatidakmeneruskan->id)->update(
                                [
                                    'kelas' => null,
                                    'tingkat' => 13,
                                ]
                            );
                            User::where('id', $siswatidakmeneruskan->id_user)->update(['status' => null]);
                            $lah = Wali_Siswa::where('id', $siswatidakmeneruskan->id_orang_tua)->first();
                            User::where('id', $lah->id_user)->update(['status' => null]);
                        } else {
                            Siswa::where('id', $siswatidakmeneruskan->id)->update(
                                [
                                    'kelas' => null,
                                    'tingkat' => 13,
                                ]
                            );
                            User::where('id', $siswatidakmeneruskan->id_user)->update(['status' => null]);
                            $lah = Wali_Siswa::where('id', $siswatidakmeneruskan->id_orang_tua)->first();
                            User::where('id', $lah->id_user)->update(['status' => null]);
                        }
                    }
                }
            }
        } else {
            $guru = Guru::where('id_user', $request->id)->first();
            $kelas = Kelas::where('id_guru', $guru->id)->first();
            $kelasid = $kelas->id;
            $tahun = $setting->id_tahun_ajaran;
            $siswa = Siswa::whereHas('kelas_siswa', function ($q) use ($kelasid, $tahun) {
                $q->where('id', $kelasid)->where('id_tahun_ajaran', $tahun);
            })->get();
            // dd($siswa);
            $tingkat = Master_Kelas::where('id', $kelas->id_master_kelas)->first()->tingkatan_id;

            // dd($p->tingkat);
            foreach ($siswa as $p) {
                // dd($siswa);
                $wali = Wali_Siswa::where('id', $p->id_orang_tua)->first();
                $cek_ke_2 = Siswa::where('id_orang_tua', $wali->id)->count();
                if ((int)$p->tingkat === 12) {
                    if ($cek_ke_2 > 1) {
                        // dd($p->avatar);
                        // if ($p->avatar != null) {
                        //         rename('avatar/'.$p->avatar, 'alumni/'.$p->avatar);
                        //         $p->update(['avatar' => null]);

                        // }
                        $cre = [
                            'nomor_induk_siswa' => $p->nomor_induk_siswa,
                            'nisn' => $p->nisn,
                            'nama_siswa' => $p->nama_siswa,
                            'tempat_lahir' => $p->tempat_lahir,
                            'tgl_lahir' => $p->tgl_lahir,
                            'jenis_kelamin' => $p->jenis_kelamin,
                            'agama' => $p->agama,
                            'telp' => $p->no_telp,
                            'id_orang_tua' => $p->id_orang_tua,
                            'alamat' => $p->alamat,
                            'tingkat' => $p->tingkat,
                            'id_user' => $p->id_user,
                        ];
                        $alumni = Alumni::create($cre);

                        Siswa::where('id', $p->id)->update(
                            [
                                'kelas' => null,
                                'tingkat' => $p->tingkat + 1,
                            ]
                        );
                        User::where('id', $p->id_user)->update(['status' => null]);
                    }
                    if ($cek_ke_2 === 1) {

                        // dd($cek_ke_2);
                        // if ($p->avatar != null) {
                        //     if (asset('avatar/' . $p->avatar)) {
                        //         rename('avatar/' . $p->avatar, 'alumni/' . $p->avatar);
                        //         $p->update(['avatar' => null]);
                        //     }
                        // }
                        $cre = [
                            'nomor_induk_siswa' => $p->nomor_induk_siswa,
                            'nisn' => $p->nisn,
                            'nama_siswa' => $p->nama_siswa,
                            'tempat_lahir' => $p->tempat_lahir,
                            'tgl_lahir' => $p->tgl_lahir,
                            'jenis_kelamin' => $p->jenis_kelamin,
                            'agama' => $p->agama,
                            'telp' => $p->no_telp,
                            'id_orang_tua' => $p->id_orang_tua,
                            'alamat' => $p->alamat,
                            'tingkat' => $p->tingkat,
                            'id_user' => $p->id_user,
                        ];
                        $alumni = Alumni::create($cre);

                        Siswa::where('id', $p->id)->update(
                            [
                                'kelas' => null,
                                'tingkat' => $p->tingkat + 1,
                            ]
                        );
                        User::where('id', $p->id_user)->update(['status' => null]);
                        $lah = Wali_Siswa::where('id', $p->id_orang_tua)->first();
                        User::where('id', $lah->id_user)->update(['status' => null]);
                    }
                } else {
                    Siswa::where('id', $p->id)->update(
                        [
                            'kelas' => null,
                            'tingkat' => $p->tingkat + 1,
                        ]
                    );
                }
            }
        }
        return back();
    }

    public function WaliKelasGet($id)
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Siswa::where('kelas', $id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Profil</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nama_siswa . '</td>
                <td>
                  <a href="/profil/siswa/' . $emp->id . '" class="text-info mx-1"><i class="ion-eye h4" ></i></a>
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
