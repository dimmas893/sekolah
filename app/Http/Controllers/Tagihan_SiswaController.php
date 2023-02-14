<?php

namespace App\Http\Controllers;

use App\Models\CekTotal;
use App\Models\Invoice_Tagihan;
use App\Models\Kategori_Tagihan;
use App\Models\Pembayaran;
use App\Models\Rincian_Pembayaran;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Tagihan_Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

set_time_limit(10800);

class Tagihan_SiswaController extends Controller
{

	public function tagihan_siswa_web()
	{
		$siswa = Siswa::where('id_user', Auth::user()->id)->first();
		if ($siswa) {
			return view('siswa.halaman_user.tagihan');
		} else {
			return back()->with('gagalmasuk', 'll');
		}
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

	public function viewtampil()
	{

		$emps = CekTotal::with('tagihan')->where('id_user', Auth::user()->id)->get();
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

	public function hapus(Request $request)
	{
		$id = $request->id;
		$cek = CekTotal::where('id', $id)->delete();
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
		$pembayaran_update = Pembayaran::where('id_pembayaran', $emp->id_pembayaran)->update($update);
		$cek = CekTotal::where('id_user', Auth::user()->id)->get();
		foreach ($cek as $p) {
			CekTotal::where('id', $p->id)->delete();
		}
		return back();
	}

	public function infotagihan($id)
	{
		$product = Kategori_Tagihan::findOrFail($id);
		return response()->json($product, 200);
	}

	// set index page view
	public function index()
	{
		$Kategori_tagihan  = Tagihan_Siswa::all();
		// $Kategori_tagihan = Kategori_Tagihan
		return view('tagihan_siswa.index', compact('Kategori_tagihan'));
	}

	public function create()
	{
		// $tagihan_siswa = Tagihan_Siswa::all();
		$Kategori_tagihan = Kategori_Tagihan::all();
		$date = Carbon::now();

		return view('tagihan_siswa.create', compact('Kategori_tagihan', 'date'));
	}

	// handle fetch all eamployees ajax request
	public function all()
	{

		// <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
		$emps = Tagihan_Siswa::with('kategori_tagihan')->get();
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
					<td>' . $emp->kategori_tagihan->nama_kategori . '</td>
                <td>' . $emp->deskripsi . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="' . url('detail-tagihan-daftar-siswa/' . $emp->id) . '" class="text-info mx-1"><i class="ion-eye"></i></a>
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
		// dd($request->all());
		$siswa = Siswa::where('kelas', '!=', null)->where('id', 1)->get();
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
				'tanggal' => $request->tanggal
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
				'tanggal' => $request->tanggal
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
