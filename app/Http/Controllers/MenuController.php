<?php

namespace App\Http\Controllers;

use App\Models\Invoice_Tagihan;
use App\Models\Jadwal;
use App\Models\JenjangPendidikan;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use App\Models\Setting;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function menu()
    {
        return view('menu.menu');
    }

    public function infosiswa()
    {
        return view('menu.admin.infosiswa.index');
    }
    public function manage()
    {
        return view('menu.admin.manage.index');
    }

    public function viewTagihanmenu()
    {
        return view('menu.admin.infosiswa.tagihan.index');
    }

    public function viewTagihansiswa()
    {
        return view('menu.admin.infosiswa.tagihan.LunasAtauBelum');
    }

    public function viewTagihansiswabelumdibayar()
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjangsd = 1;
        $sd = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjangsd) {
            $q->where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($qu) use ($jenjangsd) {
                $qu->where('jenjang_pendidikan_id', $jenjangsd);
            });
        })->select('kelas_id')->groupBy('kelas_id')->where('status', 'unpaid')->get();
        $jenjangsmp = 2;
        $smp = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjangsmp) {
            $q->where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($qu) use ($jenjangsmp) {
                $qu->where('jenjang_pendidikan_id', $jenjangsmp);
            });
        })->select('kelas_id')->groupBy('kelas_id')->where('status', 'unpaid')->get();
        $jenjangsmp = 3;
        $sma = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjangsmp) {
            $q->where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($qu) use ($jenjangsmp) {
                $qu->where('jenjang_pendidikan_id', $jenjangsmp);
            });
        })->select('kelas_id')->groupBy('kelas_id')->where('status', 'unpaid')->get();
        $jenjangtk = 4;
        $tk = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjangtk) {
            $q->where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($qu) use ($jenjangtk) {
                $qu->where('jenjang_pendidikan_id', $jenjangtk);
            });
        })->select('kelas_id')->groupBy('kelas_id')->where('status', 'unpaid')->get();
        // dd($sma);
        return view('menu.admin.infosiswa.tagihan.belumbayar.BelumBayar', compact('sd', 'smp', 'sma', 'tk'));
    }

    public function viewTagihansiswabelumdibayarPilihKelas(Request $request)
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang_pendidikan_id = (int)$request->jenjang_pendidikan_id;
        $jenjang = JenjangPendidikan::where('id', $jenjang_pendidikan_id)->first();

        $kelas = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjang_pendidikan_id) {
            $q->where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($qu) use ($jenjang_pendidikan_id) {
                $qu->where('jenjang_pendidikan_id', $jenjang_pendidikan_id);
            });
        })->select('kelas_id')->groupBy('kelas_id')->where('status', 'unpaid')->get();
        // $kelas = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjang_pendidikan_id) {
        //     $q->where('jenjang_pendidikan_id', $jenjang_pendidikan_id);
        // })->get();
        // dd($kelas);
        return view('menu.admin.infosiswa.tagihan.belumbayar.BelumBayarPilihKelas', compact('kelas', 'jenjang'));
    }

    public function viewTagihansiswabelumdibayarPilihtagihan(Request $request)
    {
        // dd($request->all());
        $tahun = Setting::first()->id_tahun_ajaran;
        $kelas = (int)$request->kelas_id;
        $jenjang_id = (int)$request->jenjang_pendidikan_id;
        $jenjang = JenjangPendidikan::where('id', $request->jenjang_pendidikan_id)->first();
        // $invoice = Invoice_Tagihan::where('kelas_id', $kelas)->where('status', 'unpaid')->get();
        $invoice = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjang_id) {
            $q->where('id_tahun_ajaran', $tahun)
                ->whereHas('kelas', function ($qu) use ($jenjang_id) {
                    $qu->where('jenjang_pendidikan_id', $jenjang_id);
                });
        })->where('status', 'unpaid')->select('id_siswa')->groupBy('id_siswa')->get();
        // dd($invoice);
        return view('menu.admin.infosiswa.tagihan.belumbayar.BelumBayarPilihtagihan', compact('kelas', 'jenjang', 'invoice'));
    }

    public function viewTagihansiswabelumdibayarsemuatagihan(Request $request)
    {
        // dd($request->all());
        $tahun = Setting::first()->id_tahun_ajaran;
        $kelas = (int)$request->kelas_id;
        $jenjang_id = (int)$request->jenjang_pendidikan_id;
        $siswa = (int)$request->id_siswa;
        $jenjang = JenjangPendidikan::where('id', $request->jenjang_pendidikan_id)->first();
        // $invoice = Invoice_Tagihan::where('kelas_id', $kelas)->where('status', 'unpaid')->get();
        $invoice = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjang_id) {
            $q->where('id_tahun_ajaran', $tahun)
                ->whereHas('kelas', function ($qu) use ($jenjang_id) {
                    $qu->where('jenjang_pendidikan_id', $jenjang_id);
                });
        })->where('status', 'unpaid')->where('id_siswa', (int)$request->id_siswa)->get();
        // dd($invoice);
        return view('menu.admin.infosiswa.tagihan.belumbayar.TagihanAll', compact('kelas', 'jenjang', 'invoice', 'siswa'));
    }


    public function viewTagihansiswasudahbayar()
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjangsd = 1;
        $sd = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjangsd) {
            $q->where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($qu) use ($jenjangsd) {
                $qu->where('jenjang_pendidikan_id', $jenjangsd);
            });
        })->select('kelas_id')->groupBy('kelas_id')->where('status', 'paid')->get();
        $jenjangsmp = 2;
        $smp = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjangsmp) {
            $q->where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($qu) use ($jenjangsmp) {
                $qu->where('jenjang_pendidikan_id', $jenjangsmp);
            });
        })->select('kelas_id')->groupBy('kelas_id')->where('status', 'paid')->get();
        $jenjangsmp = 3;
        $sma = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjangsmp) {
            $q->where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($qu) use ($jenjangsmp) {
                $qu->where('jenjang_pendidikan_id', $jenjangsmp);
            });
        })->select('kelas_id')->groupBy('kelas_id')->where('status', 'paid')->get();
        $jenjangtk = 4;
        $tk = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjangtk) {
            $q->where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($qu) use ($jenjangtk) {
                $qu->where('jenjang_pendidikan_id', $jenjangtk);
            });
        })->select('kelas_id')->groupBy('kelas_id')->where('status', 'paid')->get();
        // dd($sma);
        return view('menu.admin.infosiswa.tagihan.sudahbayar.SudahBayar', compact('sd', 'smp', 'sma', 'tk'));
    }

    public function viewTagihansiswasudahbayarPilihKelas(Request $request)
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang_pendidikan_id = (int)$request->jenjang_pendidikan_id;
        $jenjang = JenjangPendidikan::where('id', $jenjang_pendidikan_id)->first();

        $kelas = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjang_pendidikan_id) {
            $q->where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($qu) use ($jenjang_pendidikan_id) {
                $qu->where('jenjang_pendidikan_id', $jenjang_pendidikan_id);
            });
        })->select('kelas_id')->groupBy('kelas_id')->where('status', 'paid')->get();
        // $kelas = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjang_pendidikan_id) {
        //     $q->where('jenjang_pendidikan_id', $jenjang_pendidikan_id);
        // })->get();
        // dd($kelas);
        return view('menu.admin.infosiswa.tagihan.sudahbayar.SudahBayarPilihKelas', compact('kelas', 'jenjang'));
    }

    public function viewTagihansiswasudahbayarPilihtagihan(Request $request)
    {
        // dd($request->all());
        $tahun = Setting::first()->id_tahun_ajaran;
        $kelas = (int)$request->kelas_id;
        $jenjang_id = (int)$request->jenjang_pendidikan_id;
        $jenjang = JenjangPendidikan::where('id', $request->jenjang_pendidikan_id)->first();
        // $invoice = Invoice_Tagihan::where('kelas_id', $kelas)->where('status', 'paid')->get();
        $invoice = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjang_id) {
            $q->where('id_tahun_ajaran', $tahun)
                ->whereHas('kelas', function ($qu) use ($jenjang_id) {
                    $qu->where('jenjang_pendidikan_id', $jenjang_id);
                });
        })->where('status', 'paid')->select('id_siswa')->groupBy('id_siswa')->get();
        // dd($invoice);
        return view('menu.admin.infosiswa.tagihan.sudahbayar.SudahBayarPilihtagihan', compact('kelas', 'jenjang', 'invoice'));
    }

    public function viewTagihansiswasudahbayarsemuatagihan(Request $request)
    {
        // dd($request->all());
        $tahun = Setting::first()->id_tahun_ajaran;
        $kelas = (int)$request->kelas_id;
        $jenjang_id = (int)$request->jenjang_pendidikan_id;
        $siswa = (int)$request->id_siswa;
        $jenjang = JenjangPendidikan::where('id', $request->jenjang_pendidikan_id)->first();
        // $invoice = Invoice_Tagihan::where('kelas_id', $kelas)->where('status', 'paid')->get();
        $invoice = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjang_id) {
            $q->where('id_tahun_ajaran', $tahun)
                ->whereHas('kelas', function ($qu) use ($jenjang_id) {
                    $qu->where('jenjang_pendidikan_id', $jenjang_id);
                });
        })->where('status', 'paid')->where('id_siswa', (int)$request->id_siswa)->get();
        // dd($invoice);
        return view('menu.admin.infosiswa.tagihan.sudahbayar.TagihanAll', compact('kelas', 'jenjang', 'invoice', 'siswa'));
    }


    public function manageNilai()
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjangsd = 1;
        $sd = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsd) {
            $q->where('jenjang_pendidikan_id', $jenjangsd);
        })->get();
        $jenjangsmp = 2;
        $smp = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsmp) {
            $q->where('jenjang_pendidikan_id', $jenjangsmp);
        })->get();

        $jenjangsma = 3;
        $sma = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsma) {
            $q->where('jenjang_pendidikan_id', $jenjangsma);
        })->get();
        $jenjangtk = 4;
        $tk = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangtk) {
            $q->where('jenjang_pendidikan_id', $jenjangtk);
        })->get();
        return view('menu.admin.manage.nilai.index', compact('sd', 'smp', 'sma', 'tk'));
    }
    public function manageJadwal()
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjangsd = 1;
        $sd = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsd) {
            $q->where('jenjang_pendidikan_id', $jenjangsd);
        })->get();
        $jenjangsmp = 2;
        $smp = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsmp) {
            $q->where('jenjang_pendidikan_id', $jenjangsmp);
        })->get();

        $jenjangsma = 3;
        $sma = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsma) {
            $q->where('jenjang_pendidikan_id', $jenjangsma);
        })->get();
        $jenjangtk = 4;
        $tk = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangtk) {
            $q->where('jenjang_pendidikan_id', $jenjangtk);
        })->get();
        return view('menu.admin.manage.jadwal.index', compact('sd', 'smp', 'sma', 'tk'));
    }

    public function menukenaikankelas()
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjangsd = 1;
        $sd = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsd) {
            $q->where('jenjang_pendidikan_id', $jenjangsd);
        })->get();
        $jenjangsmp = 2;
        $smp = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsmp) {
            $q->where('jenjang_pendidikan_id', $jenjangsmp);
        })->get();

        $jenjangsma = 3;
        $sma = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsma) {
            $q->where('jenjang_pendidikan_id', $jenjangsma);
        })->get();
        $jenjangtk = 4;
        $tk = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangtk) {
            $q->where('jenjang_pendidikan_id', $jenjangtk);
        })->get();
        return view('menu.admin.manage.kenaikankelas.index', compact('sd', 'smp', 'sma', 'tk'));
    }

    public function menukenaikankelaspilihkelas(Request $request)
    {
        // dd($request->all());
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang = (int)$request->jenjang_pendidikan_id;
        $kelas = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjang) {
            $q->where('jenjang_pendidikan_id', $jenjang);
        })->select('id', 'id_master_kelas', 'id_guru')->groupBy('id', 'id_master_kelas', 'id_guru')->get();
        return view('menu.admin.manage.kenaikankelas.pilihkelas', compact('kelas', 'jenjang'));
    }

    public function menukenaikankelaspilihkelasakses(Request $request)
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $kelas = Kelas::where('id', $request->kelas_id)->first();
        $jenjang = (int)$request->jenjang_pendidikan_id;
        $siswa = Siswa::where('kelas', $kelas->id)->get();

        return view('menu.admin.manage.kenaikankelas.naikkelas', compact('siswa', 'jenjang', 'kelas'));
    }

    public function manageTugas(Request $request)
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjangsd = 1;
        $sd = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsd) {
            $q->where('jenjang_pendidikan_id', $jenjangsd);
        })->get();
        $jenjangsmp = 2;
        $smp = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsmp) {
            $q->where('jenjang_pendidikan_id', $jenjangsmp);
        })->get();

        $jenjangsma = 3;
        $sma = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangsma) {
            $q->where('jenjang_pendidikan_id', $jenjangsma);
        })->get();
        $jenjangtk = 4;
        $tk = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangtk) {
            $q->where('jenjang_pendidikan_id', $jenjangtk);
        })->get();
        return view('menu.admin.manage.tugas.index', compact('sd', 'smp', 'sma', 'tk'));
    }

    public function manageTugasMataPelajaran(Request $request)
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang_pendidikan_id = (int)$request->jenjang_pendidikan_id;
        $mata_pelajaran = Jadwal::where('jenjang_pendidikan_id', $jenjang_pendidikan_id)->whereHas('kelasget', function ($q) use ($tahun) {
            $q->where('id_tahun_ajaran', $tahun);
        })->select('mata_pelajaran_id')->groupBy('mata_pelajaran_id')->get();
        // dd($jenjang_pendidikan_id);
        return view('menu.admin.manage.tugas.mata_pelajaran', compact('mata_pelajaran', 'tahun', 'jenjang_pendidikan_id'));
    }

    public function manageTugasMataPelajaranguru(Request $request)
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang_pendidikan_id = (int)$request->jenjang_pendidikan_id;
        $mata_pelajaran_id = (int)$request->mata_pelajaran_id;
        $guru = Jadwal::where('jenjang_pendidikan_id', $jenjang_pendidikan_id)->where('mata_pelajaran_id', $mata_pelajaran_id)->whereHas('kelasget', function ($q) use ($tahun) {
            $q->where('id_tahun_ajaran', $tahun);
        })->select('guru_id')->groupBy('guru_id')->get();
        return view('menu.admin.manage.tugas.guru', compact('guru', 'tahun', 'jenjang_pendidikan_id', 'mata_pelajaran_id'));
    }


    public function manageTugasMataPelajarangurujadwal(Request $request)
    {
        // dd($request->all());
        $tahun = Setting::first()->id_tahun_ajaran;
        $jenjang_pendidikan_id = (int)$request->jenjang_pendidikan_id;
        $mata_pelajaran_id = (int)$request->mata_pelajaran_id;
        $guru_id = (int)$request->guru_id;
        $jadwal = Jadwal::where('jenjang_pendidikan_id', $jenjang_pendidikan_id)->where('guru_id', $guru_id)->where('mata_pelajaran_id', $mata_pelajaran_id)->whereHas('kelasget', function ($q) use ($tahun) {
            $q->where('id_tahun_ajaran', $tahun);
        })->select('kelas_id')->groupBy('kelas_id')->get();
        return view('menu.admin.manage.tugas.jadwal', compact('jadwal', 'tahun', 'jenjang_pendidikan_id', 'mata_pelajaran_id', 'guru_id'));
    }

    public function manageTugasMataPelajarangurujadwalbuattugas(Request $request)
    {
        $tahun = Setting::first()->id_tahun_ajaran;
        // $jadwal_id = (int)$request->jadwal_id;
        $kelasku = (int)$request->kelas_id;
        $jadwal = Jadwal::where('mata_pelajaran_id', $request->mata_pelajaran_id)->where('jenjang_pendidikan_id', $request->jenjang_pendidikan_id)->where('guru_id', $request->guru_id)->whereHas('kelasget', function ($q) use ($tahun, $kelasku) {
            $q->where('id_tahun_ajaran', $tahun)->where('kelas_id', $kelasku);
        })->first();
        // dd($jadwal);
        return view('menu.admin.manage.tugas.buat', compact('jadwal'));
    }

    public function penerimaansiswa()
    {
        $pendaftaran = Pendaftaran::select('jenjang')->groupBy('jenjang')->get();
        return view('menu.admin.penerimaansiswa.index', compact('pendaftaran'));
    }
}
