<?php

namespace App\Http\Controllers;

use App\Models\CekTotal;
use App\Models\Invoice_Tagihan;
use App\Models\JenjangPendidikan;
use App\Models\Kategori_Tagihan;
use App\Models\Kelas;
use App\Models\Master_Kelas;
use App\Models\Pembayaran;
use App\Models\Rincian_Pembayaran;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Tagihan_Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Xendit\Invoice;

set_time_limit(10800);

class Tagihan_SiswaController extends Controller
{

    public function tagihan_siswa_web(Request $request)
    {
        $siswa = Siswa::where('id_user', Auth::user()->id)->first();
        if ($siswa) {
            return view('siswa.halaman_user.tagihan');
        } else {
            return back()->with('gagalmasuk', 'll');
        }
    }

    public function ajax(Request $request)
    {
        $setting = Setting::first()->id_tahun_ajaran;
        $id = $request->id;
        // $emps = Master_Kelas::where('jenjang_pendidikan_id', $id)->get();
        $emps = Kelas::where('id_tahun_ajaran', $setting)->whereHas('kelas', function ($q) use ($id) {
            $q->where('jenjang_pendidikan_id', $id);
        })->get();


        $output = '';
        $output .= '<script>
                        $(document).ready(function() {
                            $(".select2").select2();
                        });
                    </script>';
        if ($emps->count() > 0) {
            $output = '<div class="iskelas my-2">';
            $output .= '<label>Kelas</label>
            <select class="form-control" id="kelas">
						<option value="" selected disabled>---Pilih Kelas---</option>
			';
            foreach ($emps as $emp) {
                $output .= '<option value="' . $emp->id . '" >' . $emp->kelas->name . '</option>';
            }
            $output .= '</select>';

            $output .= '</div>';
            echo $output;
        } else {
            echo '<label for="name">Kelas</label><select class="form-control"><option disabled selected>---kelas tidak ada---</option></select>';
        }
    }

    public function ajaxgetsiswa(Request $request)
    {
        $output = '';
        $id = $request->id;
        if ($id) {
            $siswa = Siswa::where('kelas', '!=', null)->where('kelas', $id)->select("id", "nama_siswa", "kelas")->get();
            if ($siswa->count() > 0) {
                $output .= '<script>
                        $(document).ready(function() {
                            $(".select2").select2();
                        });
                    </script>';
                $output = '<div class="istagihan my-2">';
                $output .= '<label>Siswa</label>';
                $output .= '<select class="form-control select2" id="tagihan">';
                $output .= '<option value="" selected disabled>---Pilih Siswa---</option>';
                foreach ($siswa as $sis) {
                    $output .= '<option value="' . $sis->id . '" > ' . $sis->nama_siswa .  ' - ' . $sis->kelas_siswa->kelas->name . ' </option>';
                }
                $output .= '</select>';
                $output .= '</div>';
                echo $output;
            } else {
                $output .= '<label>Siswa</label>';
                $output .= '<select class="form-control select2">';
                $output .= '<option value="" selected disabled>---siswa tidak ada---</option>';
                $output .= '</select>';
                echo $output;
            }
        }
        if ($id === 0) {
            echo $output;
        }

        // echo $movies;
    }



    public function ajaxgettagihan(Request $request)
    {
        $id = $request->id;
        // dd($request->all());

        $output = '';
        if ($id === 0) {
            echo $output;
        }
        if ($id) {
            $user = Siswa::where('id', $id)->first();
            $emps = CekTotal::with('tagihan')->where('id_user', $user->id)->get();
            $in = Invoice_Tagihan::where('id_siswa', $user->id)->where('status', 'unpaid')->get();

            if ($in->count() > 0) {
                $output .= '<div class="card shadow-primary card-primary">
                <div class="card-header"><h4>Tagihan Siswa</h4></div><div class="card-body">
                                <div class="row">';
                foreach ($in as $p) {
                    $output .= '<input type="hidden" name="nama" value="Fee Transaksi">
                <input type="hidden" name="id_siswa" value="' . $id . '">
								<div class="form-group col-md-3 col-12">
									<div class="card shadow-success card-success">
										<div class="card-header">';
                    if ($halo = CekTotal::with('tagihan')->where('id_invoice', $p->id_invoice)->first()) {
                        $output .= '<input id="' . $halo->id . '" name="item_bayar" class="deleteIcon" id_siswa="' . $id . '" type="checkbox" checked> <div>
								<label class="form-check-label">
									<h4>' . $p->id_invoice . '
									</h4>
								</label>
							</div>';
                    } else {
                        $output .= '<div><input name="item_bayar" class=""
									type="checkbox"  value="' . $p->id_invoice . '">
								<label class="form-check-label">
									<h4>' . $p->id_invoice . '
									</h4>
								</label>
							</div>';
                    }
                    $output .= '</div>
								<div class="card-body">
                                <div>' . $p->kategori_tagihan->kategori_tagihan->nama_kategori . ' - ' . $p->dataSiswa->nama_siswa . '</div>
									<p>Rp
										' . number_format($p->kategori_tagihan->kategori_tagihan->nominal, 2, ',', '.') . '
									</p>';
                    if ($p->status === 'paid') {
                        $output .= '<p class="text-success">' . $p->status . '</p>';
                    } else {
                        $output .= '<p  class="text-danger">' . $p->status . '</p>';
                    }

                    $output .= '</div>
							</div>
						</div>';
                }
                $output .=  '</div>
                            </div>
                            </div>
                   ';
                echo $output;
            }
        }
        // dd($invoice);
    }
    // public function ajaxgettagihan(Request $request)
    // {
    //     $output = '';
    //     $id = $request->id;
    //     $invoice = Invoice_Tagihan::where('id_siswa', $id)->get();
    //     if ($invoice->count() > 0) {
    //         $output .= '<div class="row">';
    //         foreach ($invoice as $p) {
    //             $output .= '<div class="col-12">';
    //             $output .= '<div class="card my-2 mt-3">';

    //             $output .= '<div class="card-header">';
    //             $output .= '<div>' . $p->id_invoice . '</div>';
    //             $output .= '</div>';

    //             $output .= '<div class="card-body">';
    //             $output .= '<div>' . $p->dataSiswa->nama_siswa . '</div>';
    //             $output .= '<div>' . $p->kategori_tagihan->kategori_tagihan->nama_kategori . ' - Rp' . $p->nominal . '</div>';
    //             $output .= '</div>';

    //             $output .= '</div>';
    //             $output .= '</div>';
    //         }
    //         $output .= '</div>';
    //         echo $output;
    //     }
    //     // dd($invoice);
    // }
    public function viewtampil()
    {

        $user = Siswa::where('id_user', Auth::user()->id)->first();
        $in = Invoice_Tagihan::where('id_siswa', $user->id)->where('status', 'unpaid')->get();

        $output = '';
        $output .= '<div class="card-body">
                                <div class="row">';
        foreach ($in as $p) {
            $output .= '<input type="hidden" name="nama" value="Fee Transaksi">
								<div class="form-group col-md-3 col-12">
									<div class="card">
										<div class="card-header">';




            if ($halo = CekTotal::with('tagihan')->where('id_invoice', $p->id_invoice)->first()) {
                $output .= '
					<input id="' . $halo->id . '" name="item_bayar" class="deleteIcon" type="checkbox" checked> <div>
								<label class="form-check-label">
									<h4>' . $p->kategori_tagihan->kategori_tagihan->nama_kategori . '
									</h4>
								</label>
							</div>';
            } else {
                $output .= '<div><input name="item_bayar" class=""
									type="checkbox"  value="' . $p->id_invoice . '">
								<label class="form-check-label">
									<h4>' . $p->kategori_tagihan->kategori_tagihan->nama_kategori . '
									</h4>
								</label>
							</div>';
            }
            $output .= '</div>
								<div class="card-body">
									<p>Rp
										' . number_format($p->kategori_tagihan->kategori_tagihan->nominal, 2, ',', '.') . '
									</p>';
            if ($p->status === 'paid') {
                $output .= '<p class="text-success">' . $p->status . '</p>';
            } else {
                $output .= '<p  class="text-danger">' . $p->status . '</p>';
            }

            $output .= '</div>
							</div>
						</div>';
        }
        $output .=  '</div>
                            </div>
                   ';
        echo $output;
    }

    public function ajaxgettagihanview(Request $request)
    {
        $id = $request->id;
        $in = Invoice_Tagihan::where('id_siswa', $id)->where('status', 'unpaid')->get();

        $output = '';
        $output .= '<div class="card-body">
                                <div class="row">';
        foreach ($in as $p) {
            $output .= '<input type="hidden" name="nama" value="Fee Transaksi">
								<div class="form-group col-md-3 col-12">
									<div class="card">
										<div class="card-header">';




            if ($halo = CekTotal::with('tagihan')->where('id_invoice', $p->id_invoice)->first()) {
                $output .= 'ceklis
					<input id="' . $halo->id . '" name="item_bayar" class="deleteIcon" id_siswa="' . $id . '" type="checkbox" checked> <div>
								<label class="form-check-label">
									<h4>' . $p->kategori_tagihan->kategori_tagihan->nama_kategori . '
									</h4>
								</label>
							</div>';
            } else {
                $output .= 'belum<div><input name="item_bayar" class=""
									type="checkbox"  value="' . $p->id . '">
								<label class="form-check-label">
									<h4>' . $p->kategori_tagihan->kategori_tagihan->nama_kategori . '
									</h4>
								</label>
							</div>';
            }
            $output .= '</div>
								<div class="card-body">
									<p>Rp
										' . number_format($p->kategori_tagihan->kategori_tagihan->nominal, 2, ',', '.') . '
									</p>';
            if ($p->status === 'paid') {
                $output .= '<p class="text-success">' . $p->status . '</p>';
            } else {
                $output .= '<p  class="text-danger">' . $p->status . '</p>';
            }

            $output .= '</div>
							</div>
						</div>';
        }
        $output .=  '</div>
                            </div>
                   ';
        echo 'fdf';
    }

    public function searchNamaSiswa()
    {
        $jenjang_pendidikan = JenjangPendidikan::get();
        return view('menu.admin.infosiswa.tagihan.bayartagihan.namasiswa', compact('jenjang_pendidikan'));
    }

    public function search(Request $request)
    {

        return view('menu.admin.infosiswa.tagihan.bayartagihan.search');
    }

    public function bayartagihan(Request $request)
    {
        // dd($request->all());
        if ($request->id_invoice) {
            $invoice = Invoice_Tagihan::where('id_invoice', $request->id_invoice)->first();

            $siswa = Siswa::get();
            // dd($invoice);
            return view('menu.admin.infosiswa.tagihan.bayartagihan.index', compact('invoice', 'siswa'));
        } else {
            $invoice = 0;
            return view('menu.admin.infosiswa.tagihan.bayartagihan.index', compact('invoice'));
        }
    }

    public function PilihJenjang(Request $request)
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
        return view('menu.admin.infosiswa.tagihan.buattagihan.pilihjenjang', compact('sd', 'smp', 'sma', 'tk'));
    }


    // public function pembayaran(Request $request)
    // {
    // 	// dd($request->all());

    // 	$pembayaran_last = Pembayaran::latest('created_at')->first();
    // 	if ($pembayaran_last != null) {
    // 		$nopo = substr($pembayaran_last, 4, 5);
    // 		$no_po = intval($nopo);
    // 		do {
    // 			$number = 'PEM-' . str_pad(($no_po++ + 1), 5, "0", STR_PAD_LEFT) . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
    // 		} while ($pembayaran_last->where('id_pembayaran', $number)->exists());
    // 	} else {
    // 		$number = 'PEM-00001' . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
    // 	}
    // 	$tanggalini = Carbon::now()->Format('Y-m-d');
    // 	$empData = [
    // 		'id_pembayaran' => $number,
    // 		'tanggal_pembayaran' => $tanggalini,
    // 		'metode_pembayaran' => 'metode_pembayaran',
    // 		'status' => 'paid'
    // 	];
    // 	$emp = Pembayaran::create($empData);


    // 	$tampung_total = [];
    // 	$tampung_rincian = [];
    // 	$invoice = Invoice_Tagihan::where('id_invoice', $request->id_invoice)->first();
    // 	if ($invoice->status == 'unpaid') {
    // 		$tagihan_siswa = Tagihan_Siswa::where('id', $invoice->id_tagihan)->first();
    // 		$kategori_tagihan = Kategori_Tagihan::where('id', $tagihan_siswa->id_kategori_tagihan)->first();
    // 		// dd($kategori_tagihan);
    // 		$rinciancreate = [
    // 			'id_pembayaran' => $emp->id_pembayaran,
    // 			'id_invoice' => $request->id_invoice,
    // 			'tanggal_pembayaran' => $emp->tanggal_pembayaran,
    // 			'nominal_pembayaran' => $kategori_tagihan->nominal,
    // 			'metode_pembayaran' => $emp->metode_pembayaran,
    // 		];
    // 		// dd($rinciancreate);
    // 		$rincian = Rincian_Pembayaran::create($rinciancreate);


    // 		$get_siswa_id = Invoice_Tagihan::where('id_invoice', $request->id_invoice)->first();
    // 		array_push($tampung_total, $rincian->nominal_pembayaran);
    // 		array_push($tampung_rincian, $rincian);

    // 		$data = [];
    // 		foreach ($tampung_rincian as $p) {
    // 			$tampung_semua = Rincian_Pembayaran::where('id', $p->id)->first();
    // 			$invoice = Invoice_Tagihan::where('id_invoice', $p['id_invoice'])->first();
    // 			$tagihan_siswa = Tagihan_Siswa::where('id', $invoice->id_tagihan)->first();
    // 			$kategori_tagihan = Kategori_Tagihan::where('id', $tagihan_siswa['id_kategori_tagihan'])->first();
    // 			// $registeredAt = $p->created_at->isoFormat('D MMMM Y');
    // 			$row['id'] = $p->id_invoice;
    // 			$row['nama'] = $kategori_tagihan->nama_kategori;
    // 			$row['nominal'] = $kategori_tagihan->nominal;
    // 			array_push($data, $row);
    // 		}
    // 		$dimmasoke = [];
    // 		$rinciancreate = [
    // 			'id_pembayaran' => $emp->id_pembayaran,
    // 			'id_invoice' => 1,
    // 			'tanggal_pembayaran' => $emp->tanggal_pembayaran,
    // 			'nominal_pembayaran' => $request->nominal,
    // 			'metode_pembayaran' => $request->nama,
    // 		];

    // 		$aduh = Rincian_Pembayaran::create($rinciancreate);
    // 		array_push($tampung_total, $request->nominal);
    // 		array_push($dimmasoke, $rinciancreate);

    // 		$total = array_sum($tampung_total);
    // 		$update = [
    // 			'total_pembayaran' => $total,
    // 			'siswa_id' => $get_siswa_id->id_siswa,
    // 			'status' => 'paid',
    // 		];
    // 		$pembayaran_update = Pembayaran::where('id_pembayaran', $emp->id_pembayaran)->update($update);
    // 		$invoice->update(['status' => 'paid']);
    // 	} else {
    // 		return response()->json('sudah dibayar sebelumnya');
    // 	}
    // 	return back();
    // }

    public function CekTotal(Request $request)
    {
        $invoice = Invoice_Tagihan::where('id_invoice', $request->item_bayar)->first();
        $cek = CekTotal::where('id_invoice', $request->item_bayar)->first();
        CekTotal::create([
            'id_invoice' => $invoice->id_invoice,
            'nominal' => $invoice->nominal,
            'id_user' => Auth::user()->id

        ]);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function CekTotaladmin(Request $request)
    {
        $invoice = Invoice_Tagihan::where('id_invoice', $request->item_bayar)->first();
        $cek = CekTotal::where('id_invoice', $invoice->item_bayar)->first();

        if ($cek == null) {
            $cek = CekTotal::create([
                'id_invoice' => $invoice->id_invoice,
                'nominal' => $invoice->nominal,
                'id_user' => $invoice->id_siswa,

            ]);
            return response()->json([
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 400,
            ]);
        }
    }



    public function hapus(Request $request)
    {
        $id = $request->id;
        $cek = CekTotal::where('id', $id)->delete();
        // return back();
    }
    public function hapusadmin(Request $request)
    {
        $id = $request->id;
        $cek = CekTotal::where('id', $id)->delete();
        // dd($cek);
        // return back();
    }

    public function cek()
    {
        $emps = CekTotal::with('tagihan')->where('id_user', Auth::user()->id)->get();
        $user = Siswa::where('id_user', Auth::user()->id)->first();
        $in = Invoice_Tagihan::where('id_siswa', $user->id)->get();
        $fee = Setting::first();
        $token = csrf_token();
        $output = '';
        $p = 1;
        if ($emps->count() === 0) {
            echo $output;
        } elseif ($emps->count() > 0) {

            $output .= '<div class="">
							<div class="">
								<div class="card">
									<div class="card-header"> <h4>Detail Pembayaran </h4>
                        </div>';
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
						<thead>
						<tr>
							<th>Invoice</th>
							<th>Nama Tagihan</th>
							<th>Nominal</th>
						</tr>
						</thead>
						<tbody>';
            foreach ($emps as $emp) {
                $output .= '
						<input type="hidden" name="nama" value="Fee Transaksi">
						<input type="hidden" name="item_bayar[]" value="' . $emp->id_invoice . '">
					';
                $output .= '<tr>
								<td>' . $emp->id_invoice . '</td>
								<td>' . $emp->tagihan->kategori_tagihan->kategori_tagihan->nama_kategori . '</td>
								<td> Rp ' . number_format($emp->nominal, 2, ',', '.') . '</td>
							</tr>';
            }
            $output .= '</tbody></table>';
            $output .= '<div class="col-12">Tagihan :  <b> Rp ' . number_format($emps->sum('nominal'), 2, ',', '.') . ' </b>
			<br>Fee :<b> Rp ' . number_format($fee->fee, 2, ',', '.') . '</b>
			</div>';

            $output .= '<div class="card-header">Total Tagihan :  <b> Rp ' . number_format($emps->sum('nominal') + $fee->fee, 2, ',', '.') . ' </b></div>

			<a href="/tagihan/Pembayaran" class="btn btn-primary ml-3 mb-2 mr-3 mx-1">Bayar</a>

			<a href="#" class="btn btn-danger ml-3 mb-2 mr-3 mx-1 deleteaku">Hapus ceklis</a>
					<div>
				</div>
			</div>
			';
            // <a href="/tagihan/siswa/CekTotalViewDelete" class="btn btn-info ml-3 mb-2">hapus ceklis</a>
            // $output .= '</form>';
            echo $output;
        }
    }

    public function cekadmin(Request $request)
    {
        $id = $request->id;
        // $siswa = Siswa::where('id', $id)->first();
        $emps = CekTotal::with('tagihan')->where('id_user', $id)->get();
        // dd($id);
        $fee = Setting::first();
        $token = csrf_token();
        $output = '';
        if ($id === 0) {
            echo $output;
        }
        if ($emps->count() === 0) {
            echo $output;
        } elseif ($emps->count() > 0) {

            $output .= '<div class="card shadow-primary card-primary">
									<div class="card-header"> <h4>Detail Pembayaran </h4>
                        </div>';
            $output .= '<div class="card-body"><div class="card shadow-success card-success">
            <table class="table table-bordered table-md display nowrap" style="width:100%">
						<thead>
						<tr>
							<th>Invoice</th>
							<th>Nama Tagihan</th>
							<th>Nominal</th>
						</tr>
						</thead>
						<tbody>';
            foreach ($emps as $emp) {
                $output .= '
						<input type="hidden" name="nama" value="Fee Transaksi">
						<input type="hidden" name="item_bayar[]" value="' . $emp->id_invoice . '">
					';
                $output .= '<tr>
								<td>' . $emp->id_invoice . ' - ' . $emp->tagihan->dataSiswa->nama_siswa . '</td>
								<td>' . $emp->tagihan->kategori_tagihan->kategori_tagihan->nama_kategori . '</td>
								<td> Rp ' . number_format($emp->nominal, 2, ',', '.') . '</td>
							</tr>';
            }
            $output .= '</tbody></table>';
            $output .= '<div class="col-12">Tagihan :  <b> Rp ' . number_format($emps->sum('nominal'), 2, ',', '.') . ' </b>
			<br>Fee :<b> Rp ' . number_format($fee->fee, 2, ',', '.') . '</b>
			</div>';
            $output .= '<div class="col-12">Total Tagihan :  <b> Rp ' . number_format($emps->sum('nominal') + $fee->fee, 2, ',', '.') . ' </b></div>';

            // $output .= '<form method="post" action="/tagihan/Pembayaran/admin-massal">';
            // $output .= '<input type="hidden" name="_token" value="' . $token . '" />';
            // $output .= '<input type="hidden" name="id_user" value="' . $id . '">';
            // $output .= '<input type="submit" class="btn btn-primary" value="Bayar coy">';
            // $output .= '</form>';
            $output .= '<div class="mt-3"><a href="/tagihan/Pembayaran/admin-massal/' . $id . '" class="btn btn-primary ml-3 mb-2 mr-3 mx-1">Bayar tagihan</a>';
            $output .= '<a href="#" cektotal="' . $id . '" class="btn btn-danger ml-3 mb-2 mr-3 mx-1 deleteadmin">Hapus ceklis</a> </div>';
            // <a href="/tagihan/siswa/CekTotalViewDelete" class="btn btn-info ml-3 mb-2">hapus ceklis</a>
            // $output .= '</form>';
            $output .= ' </div><div></div>';
            echo $output;
        }
    }

    // public function CekTotalView(Request $request)
    // {
    // 	$cektotal = CekTotal::where('id_user', Auth::user()->id)->count();
    // 	if ($cektotal > 0) {
    // 		$cektotalget = CekTotal::where('id_user', Auth::user()->id)->get();
    // 		$total = [];
    // 		foreach ($cektotalget as $p) {
    // 			array_push($total, $p->nominal);
    // 		}
    // 		$total_nominal = array_sum($total);
    // 		return response()->json([
    // 			'status' => 200,
    // 			'total' => $total_nominal
    // 		]);
    // 	}
    // }

    public function CekTotalViewDelete(Request $request)
    {
        $cek = CekTotal::where('id_user', Auth::user()->id)->get();
        foreach ($cek as $p) {
            CekTotal::where('id', $p->id)->delete();
        }
        // return back();
    }

    public function CekTotalViewDeleteadmin(Request $request)
    {
        $id = $request->id;
        $cek = CekTotal::where('id_user', $id)->get();
        // dd($cek);
        foreach ($cek as $p) {
            CekTotal::where('id', $p->id)->delete();
        }
        // return back();
    }

    public function pembayaran(Request $request)
    {
        // dd($request->all());
        $tes = [];

        $fee = Setting::first();
        $cektotal = CekTotal::where('id_user', Auth::user()->id)->get();
        foreach ($cektotal as $key => $value) {
            $url['id_invoice'] = $value->id_invoice;
            array_push($tes, $url);
        }
        $pembayaran_last = Pembayaran::latest('created_at')->first();
        if ($pembayaran_last != null) {
            $nopo = substr($pembayaran_last, 4, 5);
            $no_po = intval($nopo);
            do {
                $number = 'PEM-' . str_pad(($no_po++ + 1), 5, "0", STR_PAD_LEFT) . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
            } while ($pembayaran_last->where('id_pembayaran', $number)->exists());
        } else {
            $number = 'PEM-00001' . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
        }
        $tanggalini = Carbon::now()->Format('Y-m-d');
        $empData = [
            'id_tahun_ajaran' => $fee->id_tahun_ajaran,
            'semester' => $fee->semester,
            'id_pembayaran' => $number,
            'tanggal_pembayaran' => $tanggalini,
            'metode_pembayaran' => 'metode_pembayaran',
            'status' => 'paid'
        ];
        $emp = Pembayaran::create($empData);


        $tampung_total = [];
        $tampung_rincian = [];
        foreach ($cektotal as $key => $value) {
            $invoice = Invoice_Tagihan::where('id_invoice', $value->id_invoice)->first();
            $invoice->update(['status' => 'paid']);
            $tagihan_siswa = Tagihan_Siswa::where('id', $invoice->id_tagihan)->first();
            $kategori_tagihan = Kategori_Tagihan::where('id', $tagihan_siswa->id_kategori_tagihan)->first();
            $rinciancreate = [
                'id_pembayaran' => $emp->id_pembayaran,
                'id_invoice' => $value->id_invoice,
                'tanggal_pembayaran' => $emp->tanggal_pembayaran,
                'nominal_pembayaran' => $kategori_tagihan->nominal,
                'metode_pembayaran' => $emp->metode_pembayaran,
            ];
            $rincian = Rincian_Pembayaran::create($rinciancreate);


            $get_siswa_id = Invoice_Tagihan::where('id_invoice', $value->id_invoice)->first();

            array_push($tampung_total, $rincian->nominal_pembayaran);
            array_push($tampung_rincian, $rincian);
        }

        $data = [];
        foreach ($tampung_rincian as $p) {
            $invoice_2 = Invoice_Tagihan::where('id_invoice', $p['id_invoice'])->first();
            $tagihan_siswa = Tagihan_Siswa::where('id', $invoice_2->id_tagihan)->first();
            $kategori_tagihan = Kategori_Tagihan::where('id', $tagihan_siswa['id_kategori_tagihan'])->first();
            $row['id'] = $p->id_invoice;
            $row['nama'] = $kategori_tagihan->nama_kategori;
            $row['nominal'] = $kategori_tagihan->nominal;
            array_push($data, $row);
        }
        $dimmasoke = [];
        // foreach ($request->biaya_lain as $p => $value) {
        $rinciancreate = [
            'id_pembayaran' => $emp->id_pembayaran,
            'id_invoice' => 1,
            'tanggal_pembayaran' => $emp->tanggal_pembayaran,
            'nominal_pembayaran' => $fee->fee,
            'metode_pembayaran' => 'Fee Transaksi',
        ];

        $aduh = Rincian_Pembayaran::create($rinciancreate);
        array_push($tampung_total, $aduh->nominal_pembayaran);
        array_push($dimmasoke, $rinciancreate);
        // }
        $total = array_sum($tampung_total);

        $update = [
            'total_pembayaran' => $total,
            'siswa_id' => $get_siswa_id->id_siswa,
            'status' => 'paid',
        ];
        // $id_invoice->update(['status' => 'paid']);
        $pembayaran_update = Pembayaran::where('id_pembayaran', $emp->id_pembayaran)->update($update);
        $cek = CekTotal::where('id_user', Auth::user()->id)->get();
        foreach ($cek as $p) {
            CekTotal::where('id', $p->id)->delete();
        }
        return back();
    }

    public function pembayaranadmin(Request $request)
    {
        // dd($request->all());
        $fee = Setting::first();
        $id_invoice = Invoice_Tagihan::where('id_invoice', $request->id_invoice)->first();
        if ($id_invoice->status === 'unpaid') {
            $pembayaran_last = Pembayaran::latest('created_at')->first();
            if ($pembayaran_last != null) {
                $nopo = substr($pembayaran_last, 4, 5);
                $no_po = intval($nopo);
                do {
                    $number = 'PEM-' . str_pad(($no_po++ + 1), 5, "0", STR_PAD_LEFT) . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
                } while ($pembayaran_last->where('id_pembayaran', $number)->exists());
            } else {
                $number = 'PEM-00001' . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
            }

            $tanggalini = Carbon::now()->Format('Y-m-d');
            $empData = [
                'id_tahun_ajaran' => $fee->id_tahun_ajaran,
                'semester' => $fee->semester,
                'id_pembayaran' => $number,
                'tanggal_pembayaran' => $tanggalini,
                'metode_pembayaran' => 'metode_pembayaran',
                'status' => 'paid'
            ];
            $emp = Pembayaran::create($empData);

            $rinciancreate = [
                'id_pembayaran' => $emp->id_pembayaran,
                'id_invoice' => $id_invoice->id_invoice,
                'tanggal_pembayaran' => $emp->tanggal_pembayaran,
                'nominal_pembayaran' => $id_invoice->nominal,
                'metode_pembayaran' => $emp->metode_pembayaran,
            ];
            $rincian = Rincian_Pembayaran::create($rinciancreate);
            $rinciancreate = [
                'id_pembayaran' => $emp->id_pembayaran,
                'id_invoice' => 1,
                'tanggal_pembayaran' => $emp->tanggal_pembayaran,
                'nominal_pembayaran' => $fee->fee,
                'metode_pembayaran' => 'Fee Transaksi',
            ];

            $aduh = Rincian_Pembayaran::create($rinciancreate);
            $total = $rincian->nominal_pembayaran + $aduh->nominal_pembayaran;
            $update = [
                'total_pembayaran' => $total,
                'siswa_id' => $id_invoice->id_siswa,
                'status' => 'paid',
            ];
            $id_invoice->update(['status' => 'paid']);
            $pembayaran_update = Pembayaran::where('id_pembayaran', $emp->id_pembayaran)->update($update);
            return back()->with('pembayaranberhasiladmin', 'd');
        } else {
            return back()->with('pembayarangagaladmin', 'd');
        }
    }

    public function pembayaranadminmassal(Request $request, $id)
    {
        // dd($id);
        $tes = [];
        $fee = Setting::first();
        $cektotal = CekTotal::where('id_user', $id)->get();
        foreach ($cektotal as $key => $value) {
            $url['id_invoice'] = $value->id_invoice;
            array_push($tes, $url);
        }
        $pembayaran_last = Pembayaran::latest('created_at')->first();
        if ($pembayaran_last != null) {
            $nopo = substr($pembayaran_last, 4, 5);
            $no_po = intval($nopo);
            do {
                $number = 'PEM-' . str_pad(($no_po++ + 1), 5, "0", STR_PAD_LEFT) . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
            } while ($pembayaran_last->where('id_pembayaran', $number)->exists());
        } else {
            $number = 'PEM-00001' . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
        }
        $tanggalini = Carbon::now()->Format('Y-m-d');
        $empData = [
            'id_tahun_ajaran' => $fee->id_tahun_ajaran,
            'semester' => $fee->semester,
            'id_pembayaran' => $number,
            'tanggal_pembayaran' => $tanggalini,
            'metode_pembayaran' => 'metode_pembayaran',
            'status' => 'paid'
        ];
        $emp = Pembayaran::create($empData);


        $tampung_total = [];
        $tampung_rincian = [];
        foreach ($cektotal as $key => $value) {
            $invoice = Invoice_Tagihan::where('id_invoice', $value->id_invoice)->first();
            $invoice->update(['status' => 'paid']);
            $tagihan_siswa = Tagihan_Siswa::where('id', $invoice->id_tagihan)->first();
            $kategori_tagihan = Kategori_Tagihan::where('id', $tagihan_siswa->id_kategori_tagihan)->first();
            $rinciancreate = [
                'id_pembayaran' => $emp->id_pembayaran,
                'id_invoice' => $value->id_invoice,
                'tanggal_pembayaran' => $emp->tanggal_pembayaran,
                'nominal_pembayaran' => $kategori_tagihan->nominal,
                'metode_pembayaran' => $emp->metode_pembayaran,
            ];
            $rincian = Rincian_Pembayaran::create($rinciancreate);


            $get_siswa_id = Invoice_Tagihan::where('id_invoice', $value->id_invoice)->first();

            array_push($tampung_total, $rincian->nominal_pembayaran);
            array_push($tampung_rincian, $rincian);
        }

        $data = [];
        foreach ($tampung_rincian as $p) {
            $invoice_2 = Invoice_Tagihan::where('id_invoice', $p['id_invoice'])->first();
            $tagihan_siswa = Tagihan_Siswa::where('id', $invoice_2->id_tagihan)->first();
            $kategori_tagihan = Kategori_Tagihan::where('id', $tagihan_siswa['id_kategori_tagihan'])->first();
            $row['id'] = $p->id_invoice;
            $row['nama'] = $kategori_tagihan->nama_kategori;
            $row['nominal'] = $kategori_tagihan->nominal;
            array_push($data, $row);
        }
        $dimmasoke = [];
        // foreach ($request->biaya_lain as $p => $value) {
        $rinciancreate = [
            'id_pembayaran' => $emp->id_pembayaran,
            'id_invoice' => 1,
            'tanggal_pembayaran' => $emp->tanggal_pembayaran,
            'nominal_pembayaran' => $fee->fee,
            'metode_pembayaran' => 'Fee Transaksi',
        ];

        $aduh = Rincian_Pembayaran::create($rinciancreate);
        array_push($tampung_total, $aduh->nominal_pembayaran);
        array_push($dimmasoke, $rinciancreate);
        // }
        $total = array_sum($tampung_total);

        $update = [
            'total_pembayaran' => $total,
            'siswa_id' => $get_siswa_id->id_siswa,
            'status' => 'paid',
        ];
        // $id_invoice->update(['status' => 'paid']);
        $pembayaran_update = Pembayaran::where('id_pembayaran', $emp->id_pembayaran)->update($update);
        $cek = CekTotal::where('id_user', $id)->get();
        foreach ($cek as $p) {
            CekTotal::where('id', $p->id)->delete();
        }
        return back()->with('pembayaranberhasiladmin', 'd');
    }

    public function infotagihan($id)
    {
        $product = Kategori_Tagihan::findOrFail($id);
        return response()->json($product, 200);
    }

    // set index page view
    public function index(Request $request)
    {
        // dd($jenjang);
        $jenjang = (int)$request->jenjang_pendidikan_id;
        $tahun = Setting::first()->id_tahun_ajaran;
        $kelas = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjang) {
            $q->where('jenjang_pendidikan_id', $jenjang);
        })->get();
        $Kategori_tagihan  = Tagihan_Siswa::all();
        return view('tagihan_siswa.index', compact('Kategori_tagihan', 'jenjang', 'kelas'));
    }

    public function create(Request $request)
    {
        // $tagihan_siswa = Tagihan_Siswa::all();
        $jenjang = (int)$request->jenjang_pendidikan_id;
        // dd($jenjang);
        $Kategori_tagihan = Kategori_Tagihan::all();
        $date = Carbon::now();

        return view('tagihan_siswa.create', compact('Kategori_tagihan', 'date', 'jenjang'));
    }

    // handle fetch all eamployees ajax request
    public function all($jenjang_id)
    {
        // $emps = Tagihan_Siswa::with('kategori_tagihan')->get();
        // $invoice = Invoice_Tagihan::where('kelas_id', $kelas)->where('status', 'unpaid')->get();
        $tahun = Setting::first()->id_tahun_ajaran;
        $emps = Invoice_Tagihan::whereHas('kelas', function ($q) use ($tahun, $jenjang_id) {
            $q->where('id_tahun_ajaran', $tahun)
                ->whereHas('kelas', function ($qu) use ($jenjang_id) {
                    $qu->where('jenjang_pendidikan_id', $jenjang_id);
                });
        })->where('status', 'unpaid')->get();

        // $emps = Invoice_Tagihan::with('kategori_tagihan')->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Kategori Tagihan</th>
                <th>Deskripsi</th>
                <th>tanggal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
								<td>' . $emp->id . '</td>
					<td>' . $emp->kategori_tagihan->kategori_tagihan->nama_kategori . '</td>
                <td>' . $emp->kategori_tagihan->deskripsi . '</td>
                <td>' . $emp->kategori_tagihan->tanggal . '</td>
                <td>
                  <a href="#" id="' . $emp->kategori_tagihan->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="' . url('detail-tagihan-daftar-siswa/' . $emp->kategori_tagihan->id) . '" class="text-info mx-1"><i class="ion-eye"></i></a>
                  <a href="#" id="' . $emp->kategori_tagihan->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
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
        // dd($request->all());
        $jenjangpendidikanid = (int)$request->jenjang_pendidikan_id;
        $tahun = Setting::first()->id_tahun_ajaran;
        $kelas = Kelas::where('id_tahun_ajaran', $tahun)->whereHas('kelas', function ($q) use ($jenjangpendidikanid) {
            $q->where('jenjang_pendidikan_id', $jenjangpendidikanid);
        })->select('id')->groupBy('id')->get();
        // $siswa = Siswa::where('kelas', 1)->get();
        $DataSiswa = [];
        foreach ($kelas as $kel) {
            $siswa = Siswa::where('kelas', $kel->id)->get();
            array_push($DataSiswa, $siswa);
        }
        // dd($DataSiswa);
        foreach ($DataSiswa as $data) {
            foreach ($data as $pe) {
                $pembayaran_last = Invoice_Tagihan::latest('created_at')->first();
                if ($pembayaran_last != null) {
                    $nopo = substr($pembayaran_last, 4, 5);
                    $no_po = intval($nopo);
                    do {
                        $number = 'INV-' . str_pad(($no_po++ + 1), 5, "0", STR_PAD_LEFT) . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
                    } while ($pembayaran_last->where('id_invoice', $number)->exists());
                } else {
                    $number = 'INV-00001' . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
                }

                $empData = [
                    'id_kategori_tagihan' => $request->id_kategori_tagihan,
                    'deskripsi' => $request->deskripsi,
                    'tanggal' => $request->tanggal,
                    'batas_bayar' => $request->batas_bayar,
                    'kategori_cicilan' => $request->kategori_cicilan,
                    'minimum_bayar' => $request->minimum_bayar
                ];
                $emp = Tagihan_Siswa::create($empData);
                $invoice = [
                    'id_tagihan' => $emp->id,
                    'id_invoice' => $number,
                    'id_siswa' => $pe->id,
                    'nominal' => $request->nominal,
                    'kelas_id' => $pe->kelas,
                    'status' => "unpaid"
                ];
                Invoice_Tagihan::create($invoice);
            }
        }
        // foreach ($siswa as $p) {

        // }
        return back()->with('success');
    }

    public function TestingApi(Request $request)
    {
        // dd($request->all());
        $siswa = Siswa::where('kelas', '!=', null)->get();
        foreach ($siswa as $p) {
            $pembayaran_last = Invoice_Tagihan::latest('created_at')->first();
            if ($pembayaran_last != null) {
                $nopo = substr($pembayaran_last, 4, 5);
                $no_po = intval($nopo);
                do {
                    $number = 'INV-' . str_pad(($no_po++ + 1), 5, "0", STR_PAD_LEFT) . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
                } while ($pembayaran_last->where('id_invoice', $number)->exists());
            } else {
                $number = 'INV-00001' . '-' . $this->getRomawi(date('n')) . '-' . date('Y');
            }

            $empData = [
                'id_kategori_tagihan' => $request->id_kategori_tagihan,
                'deskripsi' => $request->deskripsi,
                'tanggal' => $request->tanggal,
                'batas_bayar' => $request->batas_bayar,
                'kategori_cicilan' => $request->kategori_cicilan,
                'minimum_bayar' => $request->minimum_bayar
            ];
            $emp = Tagihan_Siswa::create($empData);
            $invoice = [
                'id_tagihan' => $emp->id,
                'id_invoice' => $number,
                'id_siswa' => $p->id,
                'nominal' => $request->nominal,
                'status' => "unpaid"
            ];
            Invoice_Tagihan::create($invoice);
        }
        return response()->json([
            'status' => 'success'
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Tagihan_Siswa::with('kategori_tagihan')->find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Tagihan_Siswa::Find($request->id);

        $empData = [
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal
        ];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Tagihan_Siswa::find($id);
        Invoice_Tagihan::where('id_tagihan', $emp->id)->delete();
        Tagihan_Siswa::destroy($emp->id);
    }



    function getRomawi($bln)
    {
        switch ($bln) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }
}
