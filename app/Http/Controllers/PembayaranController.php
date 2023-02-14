<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use App\Models\Pembayaran;
use App\Models\Rincian_Pembayaran;
use App\Models\Semester;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Tahun_ajaran;
use App\Models\Wali_Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Redirect;
// use Xendit\Xendit;

use Maatwebsite\Excel\Facades\Excel;

class PembayaranController extends Controller
{
	private $searchParams = ['id_tahun_ajaran', 'semester'];
	public function PembayaranSiswa(Request $request)
	{

		$id_user = Auth::user()->id;
		$setting = Setting::first();
		$siswa = Siswa::where('id_user', $id_user)->first();
		// dd($siswa);
		$tahun_ajaran_master = Tahun_ajaran::all();
		// $semester = Semester::all();
		if ($siswa) {
			$cek = 5;

			$pembayaran = Pembayaran::where('siswa_id', $siswa->id)->orderBy('id');

			$semester = Pembayaran::select(DB::raw("semester as semester"))
				->where('siswa_id', $siswa->id)
				->orderBy('semester')
				->groupBy(DB::raw("semester"))
				->get();

			// dd($semester);

			$tahun_ajaran = Pembayaran::select(DB::raw("(DATE_FORMAT(tanggal_pembayaran, '%Y')) as year"))
				->where('siswa_id', $siswa->id)
				->orderBy('tanggal_pembayaran')
				->groupBy(DB::raw("DATE_FORMAT(tanggal_pembayaran, '%Y')"))
				->get();

			if ($request->id_tahun_ajaran) {
				$tahunsearch = Tahun_ajaran::where('tahun_ajaran', $request->id_tahun_ajaran)->first();
				if ($request->id_tahun_ajaran != null) {
					// $pembayaran->where('id_tahun_ajaran', $tahunsearch->id);
					$pembayaran->whereYear('tanggal_pembayaran', $request->id_tahun_ajaran);
				}
			}
			if ($request->semester) {
				if ($request->semester != null) {
					$pembayaran->where('semester', $request->semester);
				}
			}

			return view('pembayaran.user.pembayaran', compact('pembayaran', 'cek', 'tahun_ajaran', 'tahun_ajaran_master', 'semester'))->withPembayaran($pembayaran->get());
		} elseif ($siswa == null) {
			$orangtua = Wali_Siswa::where('id_user', $id_user)->first();
			$anakku = Siswa::where('id_orang_tua', $orangtua->id)->get();
			$tampungID = [];
			foreach ($anakku as $pe) {
				$id = $pe->id;
				array_push($tampungID, $id);
			}
			$cek = 4;
			$pembayaran = Pembayaran::whereIn('siswa_id', $tampungID)->orderBy('id');
			// dd($tampungID);

			$semester = Pembayaran::select(DB::raw("semester as semester"))
				->whereIn('siswa_id', $tampungID)
				->orderBy('semester')
				->groupBy(DB::raw("semester"))
				->get();


			$tahun_ajaran = Pembayaran::select(DB::raw("(DATE_FORMAT(tanggal_pembayaran, '%Y')) as year"))
				->whereIn('siswa_id', $tampungID)
				->orderBy('tanggal_pembayaran')
				->groupBy(DB::raw("DATE_FORMAT(tanggal_pembayaran, '%Y')"))
				->get();

			if ($request->id_tahun_ajaran) {
				$tahunsearch = Tahun_ajaran::where('tahun_ajaran', $request->id_tahun_ajaran)->first();
				if ($request->id_tahun_ajaran != null) {
					// $pembayaran->where('id_tahun_ajaran', $tahunsearch->id);
					$pembayaran->whereYear('tanggal_pembayaran', $request->id_tahun_ajaran);
				}
			}
			if ($request->semester) {
				if ($request->semester != null) {
					$pembayaran->where('semester', $request->semester);
				}
			}

			// dd($pembayaran->get());
			return view('pembayaran.user.pembayaran', compact('pembayaran', 'cek', 'tahun_ajaran', 'tahun_ajaran_master', 'semester'))->withPembayaran($pembayaran->get());
		} else {
			return back()->with('gagalpembayaran', 'd');
		}
	}
	// public function PembayaranSiswa(Request $request)
	// {
	// 	$id_user = Auth::user()->id;
	// 	$setting = Setting::first();
	// 	$siswa = Siswa::where('id_user', $id_user)->first();
	// 	$tahun_ajaran_master = Tahun_ajaran::all();
	// 	// $semester = Semester::all();
	// 	if ($siswa) {
	// 		$cek = 5;

	// 		if ($request->id_tahun_ajaran) {
	// 			// dd($request->all());
	// 			$pembayaran = Pembayaran::where('siswa_id', $siswa->id)->orderBy('id');
	// 			$tahunsearch = Tahun_ajaran::where('tahun_ajaran', $request->id_tahun_ajaran)->first();
	// 			if ($request->id_tahun_ajaran != null) {
	// 				$pembayaran->where('id_tahun_ajaran', $tahunsearch->id);
	// 			}

	// 			$semester = Pembayaran::select(DB::raw("semester as semester"))
	// 				->where('siswa_id', $siswa->id)
	// 				->orderBy('semester')
	// 				->groupBy(DB::raw("semester"))
	// 				->get();

	// 			// dd($semester);
	// 			$tahun_ajaran = Pembayaran::select(DB::raw("(DATE_FORMAT(tanggal_pembayaran, '%Y')) as year"))
	// 				->where('siswa_id', $siswa->id)->where('id_tahun_ajaran', $tahunsearch->id)
	// 				->orderBy('tanggal_pembayaran')
	// 				->groupBy(DB::raw("DATE_FORMAT(tanggal_pembayaran, '%Y')"))
	// 				->get();
	// 			// dd($pembayaran);
	// 			return view('pembayaran.user.pembayaran', compact('pembayaran', 'cek', 'tahun_ajaran', 'tahun_ajaran_master', 'semester'))->withPembayaran($pembayaran->get());
	// 		} elseif ($request->id_tahun_ajaran && $request->semester) {

	// 			$tahunsearch = Tahun_ajaran::where('tahun_ajaran', $request->id_tahun_ajaran)->first();
	// 			$semester = Pembayaran::select(DB::raw("semester as semester"))
	// 				->where('siswa_id', $siswa->id)
	// 				->orderBy('semester')
	// 				->groupBy(DB::raw("semester"))
	// 				->get();
	// 			$pembayaran = Pembayaran::where('siswa_id', $siswa->id)->where('id_tahun_ajaran', $tahunsearch->id)->where('semester', $request->semester)->get();
	// 			$tahun_ajaran = Pembayaran::select(DB::raw("(DATE_FORMAT(tanggal_pembayaran, '%Y')) as year"))
	// 				->where('siswa_id', $siswa->id)->where('id_tahun_ajaran', $tahunsearch->id)->where('semester', $request->semester)
	// 				->orderBy('tanggal_pembayaran')
	// 				->groupBy(DB::raw("DATE_FORMAT(tanggal_pembayaran, '%Y')"))
	// 				->get();
	// 			return view('pembayaran.user.pembayaran', compact('pembayaran', 'cek', 'tahun_ajaran', 'tahun_ajaran_master', 'semester'));
	// 		} elseif ($request->id_tahun_ajaran && $request->semester == null) {
	// 			$pembayaran = Pembayaran::where('siswa_id', $siswa->id)->orderBy('id');
	// 			$tahunsearch = Tahun_ajaran::where('tahun_ajaran', $request->id_tahun_ajaran)->first();
	// 			if ($request->id_tahun_ajaran != null) {
	// 				$pembayaran->where('id_tahun_ajaran', $tahunsearch->id);
	// 			}

	// 			$semester = Pembayaran::select(DB::raw("semester as semester"))
	// 				->where('siswa_id', $siswa->id)
	// 				->orderBy('semester')
	// 				->groupBy(DB::raw("semester"))
	// 				->get();

	// 			// dd($semester);
	// 			$tahun_ajaran = Pembayaran::select(DB::raw("(DATE_FORMAT(tanggal_pembayaran, '%Y')) as year"))
	// 				->where('siswa_id', $siswa->id)->where('id_tahun_ajaran', $tahunsearch->id)
	// 				->orderBy('tanggal_pembayaran')
	// 				->groupBy(DB::raw("DATE_FORMAT(tanggal_pembayaran, '%Y')"))
	// 				->get();
	// 			// dd($pembayaran);
	// 			return view('pembayaran.user.pembayaran', compact('pembayaran', 'cek', 'tahun_ajaran', 'tahun_ajaran_master', 'semester'))->withPembayaran($pembayaran);
	// 		} elseif ($request->id_tahun_ajaran == null && $request->semester) {
	// 			$pembayaran = Pembayaran::where('siswa_id', $siswa->id)->where('semester', $request->semester)->get();
	// 			$tahun_ajaran = Pembayaran::select(DB::raw("(DATE_FORMAT(tanggal_pembayaran, '%Y')) as year"))
	// 				->where('siswa_id', $siswa->id)->where('semester', $request->semester)
	// 				->orderBy('tanggal_pembayaran')
	// 				->groupBy(DB::raw("DATE_FORMAT(tanggal_pembayaran, '%Y')"))
	// 				->get();
	// 			$semester = Pembayaran::select(DB::raw("semester as semester"))
	// 				->where('siswa_id', $siswa->id)
	// 				->orderBy('semester')
	// 				->groupBy(DB::raw("semester"))
	// 				->get();
	// 			return view('pembayaran.user.pembayaran', compact('pembayaran', 'cek', 'tahun_ajaran', 'tahun_ajaran_master', 'semester'));
	// 		} else {
	// 			$semester = Pembayaran::select(DB::raw("semester as semester"))
	// 				->where('siswa_id', $siswa->id)
	// 				->orderBy('semester')
	// 				->groupBy(DB::raw("semester"))
	// 				->get();
	// 			// dd($semester);
	// 			$tahun_ajaran = Pembayaran::select(DB::raw("(DATE_FORMAT(tanggal_pembayaran, '%Y')) as year"))
	// 				->where('siswa_id', $siswa->id)
	// 				->orderBy('tanggal_pembayaran')
	// 				->groupBy(DB::raw("DATE_FORMAT(tanggal_pembayaran, '%Y')"))
	// 				->get();
	// 			// dd($tahun_ajaran);
	// 			$pembayaran = Pembayaran::where('siswa_id', $siswa->id)->get();
	// 			return view('pembayaran.user.pembayaran', compact('pembayaran', 'cek', 'tahun_ajaran', 'tahun_ajaran_master', 'semester'));
	// 		}
	// 	} elseif ($siswa == null) {
	// 		$orangtua = Wali_Siswa::where('id_user', $id_user)->first();
	// 		$anakku = Siswa::where('id_orang_tua', $orangtua->id)->get();
	// 		$tampungID = [];
	// 		foreach ($anakku as $pe) {
	// 			$id = $pe->id;
	// 			array_push($tampungID, $id);
	// 		}
	// 		$cek = 4;
	// 		if ($request->id_tahun_ajaran && $request->semester) {
	// 			$pembayaran = Pembayaran::whereIn('siswa_id', $tampungID)->where('id_tahun_ajaran', $request->id_tahun_ajaran)->where('semester', $request->semester)->get();
	// 			return view('pembayaran.user.pembayaran', compact('pembayaran', 'cek', 'tahun_ajaran', 'semester'));
	// 		} else {
	// 			$pembayaran = Pembayaran::whereIn('siswa_id', $tampungID)->where('id_tahun_ajaran', $setting->id_tahun_ajaran)->where('semester', $setting->semester)->get();
	// 			return view('pembayaran.user.pembayaran', compact('pembayaran', 'cek', 'tahun_ajaran', 'semester'));
	// 		}
	// 	} else {
	// 		return back()->with('gagalpembayaran', 'd');
	// 	}
	// }

	public function postPembayaranSiswa(Request $request)
	{
		// dd($request->all());
		$params = array_filter($request->only($this->searchParams));
		return redirect()->route('PembayaranSiswa', $params);
	}

	public function PembayaranSiswaDetail($id)
	{
		$PembayaranDetail = Rincian_Pembayaran::with('invoice')->where('id_pembayaran', $id)->get();
		$cek = Rincian_Pembayaran::where('id_pembayaran', $id)->first();
		if ($cek) {
			return view('pembayaran.user.detailpembayaran', compact('PembayaranDetail', 'cek'));
		}
		if ($cek === null) {
			return back()->with('gagalpembayaran', 'd');
		}
	}

	public function xendits1(Request $request)
	{

		// pembayaran melalui xendit start----------------------------------------
		$result = DB::transaction(function () use ($request) {

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
				'id_pembayaran' => $number,
				'tanggal_pembayaran' => $tanggalini,
				'metode_pembayaran' => 'metode_pembayaran',
				'status' => 'unpaid'
			];
			$emp = Pembayaran::create($empData);

			$invoice = $number;

			$dataSiswa = Siswa::where('id_user', $request->id_user)->first();
			$customer = [
				'given_names' => $dataSiswa->nama_siswa,
				'surname' => $dataSiswa->nama_siswa,
				'email' => $dataSiswa->email,
				'mobile_number' => $dataSiswa->telp,
				'address' => [
					[
						'city' => '-',
						'country' => 'Indonesia',
						'postal_code' => '-',
						'state' => '-',
						'street_line1' => $dataSiswa->alamat,
					]
				]
			];

			$successUrl = url('xendit/success-payment/' . $invoice); //kalau berhasil
			$failurUrl = url('xendit/failure-payment/' . $invoice);

			$data = array();

			$tampung_total_tagihan = array();
			foreach ($request->item_bayar as $key => $value) {
				$invoice = Invoice_Tagihan::where('id_invoice', $value)->first();
				$tagihan_siswa = Tagihan_Siswa::where('id', $invoice->id_tagihan)->first();
				$kategori_tagihan = Kategori_Tagihan::where('id', $tagihan_siswa->id_kategori_tagihan)->first();
				$data[] = array(
					'name' => $tagihan_siswa->deskripsi,
					'quantity' => 1,
					'price' => $invoice->nominal,
				);
				array_push($tampung_total_tagihan, $invoice->nominal);
				$rincianPembayaranTagihan = [
					'id_pembayaran' => $emp->id_pembayaran,
					'id_invoice' => $value['id'],
					'tanggal_pembayaran' => $emp->tanggal_pembayaran,
					'nominal_pembayaran' => $value['nominal'],
					'metode_pembayaran' => $value['nama'],
				];

				Rincian_Pembayaran::create($rincianPembayaranTagihan);
			}

			$tampung_total_biayaLainnya = array();
			foreach ($request->biaya_lain as $p => $value) {
				$rincianPembayaranLainnya = [
					'id_pembayaran' => $emp->id_pembayaran,
					'id_invoice' => $value['id'],
					'tanggal_pembayaran' => $emp->tanggal_pembayaran,
					'nominal_pembayaran' => $value['nominal'],
					'metode_pembayaran' => $value['nama'],
				];
				Rincian_Pembayaran::create($rincianPembayaranLainnya);

				$data[] = array(
					'name' => 'Admin Fee',
					'quantity' => 1,
					'price' => $value['nominal'],
				);

				array_push($tampung_total_biayaLainnya, $value['nominal']);
			}

			$item = $data;

			$gtotal = array_sum($tampung_total_tagihan) + array_sum($tampung_total_biayaLainnya);
			$trans = [
				'invoice' => $invoice,
				'amount' => $gtotal,
				'description' => 'Pembayaran Tagihan Siswa ',
				'duration' => 172800, //2 hari
			];

			// simpan transaksi start----------------------------------------------------------------------

			$update = [
				'total_pembayaran' => $total,
				'siswa_id' => $dataSiswa->id_siswa,
				'status' => 'UNPAID',
			];

			// dd($aduh);
			$pembayaran_update = Pembayaran::where('id_pembayaran', $emp->id_pembayaran)->update($update);
			// simpan transaksi end----------------------------------------------------------------------

			// 	$xendit = new XenditController();
			$proses = $this->createInvoice($trans, $customer, $item, $successUrl, $failurUrl);
			// dd($proses);
			if ($proses['status'] == 'PENDING') {
				return $proses['invoice_url'];
			} else {
				return false;
			}
		});

		if ($result == false) {
			return redirect('xendit/failure-payment/' . $dataEvent->id . '/' . $invoice);
		} else {
			return redirect($result);
		}
		// pembayaran melalui xendit end----------------------------------------
	}

	public function createInvoice($trans, $customer, $item, $successUrl, $failurUrl)
	{
		Xendit::setApiKey('xnd_development_fw0zlBcZGyjwpZ3djCQj7MVV03XjSw98aVufisV1fexGHWIHhSLM8SbzgqdQmuh'); //staging

		$params = [
			'external_id' => $trans['invoice'],
			'amount' => $trans['amount'],
			'description' => $trans['description'],
			'invoice_duration' => $trans['duration'],
			'customer' => $customer,
			'customer_notification_preference' => [
				'invoice_created' => [
					'whatsapp',
					'sms',
					'email'
				],
				'invoice_reminder' => [
					'whatsapp',
					'sms',
					'email'
				],
				'invoice_paid' => [
					'whatsapp',
					'sms',
					'email'
				],
				'invoice_expired' => [
					'whatsapp',
					'sms',
					'email'
				]
			],
			'success_redirect_url' => $successUrl,
			'failure_redirect_url' => $failurUrl,
			'currency' => 'IDR',
			'items' => $item,
			'fees' => []
		];

		$createInvoice = \Xendit\Invoice::create($params);
		return $createInvoice;
	}

	public function xenditSuccessPayment($idInvoice)
	{
		$dataTransaksi = Pembayaran::where('id_pembayaran', $idInvoice)->first();
		$dataTransaksi->update([
			'metode_pembayaran' => 'xendit',
			'status' => 'PAID',
		]);
		return Redirect::to('https://simulasipg.netlify.app/sukses');
		// 			return redirect('https://simulasipg.netlify.app/sukses');
		//  return view('frontend.registrasi.register5c',compact('dataEvent','dataTransaksi'));
	}

	public function xenditFailurePayment($idInvoice)
	{
		$dataTransaksi = Pembayaran::where('id_pembayaran', $idInvoice)->first();
		$dataTransaksi->update([
			'metode_pembayaran' => 'xendit',
			'status_pembayaran' => 'EXPIRED',
		]);
		$nomorInvoice = $idInvoice;
		return redirect('https://simulasipg.netlify.app/gagal');

		// return view('frontend.registrasi.register5',compact('dataEvent','nomorInvoice'));
	}

	private $token = 'xnd_development_fw0zlBcZGyjwpZ3djCQj7MVV03XjSw98aVufisV1fexGHWIHhSLM8SbzgqdQmuh';


	public function xendit33(Request $request)
	{
		$external_id = 'va-' . time();
		Xendit::setApiKey($this->token);
		$params = [
			'external_id' => 'demo_1475801962607',
			'amount' => 50000,
			'description' => 'Invoice Demo #123',
			'invoice_duration' => 86400,
			'customer' => [
				'given_names' => 'John',
				'surname' => 'Doe',
				'email' => 'johndoe@example.com',
				'mobile_number' => '+6287774441111',
				'addresses' => [
					[
						'city' => 'Jakarta Selatan',
						'country' => 'Indonesia',
						'postal_code' => '12345',
						'state' => 'Daerah Khusus Ibukota Jakarta',
						'street_line1' => 'Jalan Makan',
						'street_line2' => 'Kecamatan Kebayoran Baru'
					]
				]
			],
			'customer_notification_preference' => [
				'invoice_created' => [
					'whatsapp',
					'sms',
					'email'
				],
				'invoice_reminder' => [
					'whatsapp',
					'sms',
					'email'
				],
				'invoice_paid' => [
					'whatsapp',
					'sms',
					'email'
				],
				'invoice_expired' => [
					'whatsapp',
					'sms',
					'email'
				]
			],
			'success_redirect_url' => 'https://dapurkoding.my.id/',
			'failure_redirect_url' => 'https://dapurkoding.my.id/',
			'currency' => 'IDR',
			'items' => [
				[
					'name' => 'Air Conditioner',
					'quantity' => 1,
					'price' => 100000,
					'category' => 'Electronic',
					'url' => 'https=>//yourcompany.com/example_item'
				]
			],
			'fees' => [
				[
					'type' => 'ADMIN',
					'value' => 5000
				]
			]
		];

		$createInvoice = \Xendit\Invoice::create($params);
		Pembayaran::create([
			'id_pembayaran' => $external_id,
			'tanggal_pembayaran' => '2023-04-12',
			'total_pembayaran' => $createInvoice['amount'],
			'metode_pembayaran' => 'bca',
			'status' => $createInvoice['status'],
		]);
		// $bayar = Payment::all();
		return redirect($createInvoice['invoice_url']);
	}
	// set index page view
	public function index()
	{
		return view('pembayaran.index');
	}

	public function export(Request $request)
	{
		$awal = $request->awal;
		$akhir = $request->akhir;
		return Excel::download(new PembayaranExport($awal, $akhir), 'laporan pembayaran tanggal ' . $awal . ' sampai tanggal ' . $akhir .   '.xlsx');
	}

	// handle fetch all eamployees ajax request
	public function all()
	{

		// <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
		$emps = Pembayaran::with('siswa')->get();
		$output = '';
		$p = 1;
		if ($emps->count() > 0) {
			$output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Nomor Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Tanggal Pembayaran</th>
                <th>Total Pembayaran</th>
                <th>status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->siswa->nama_siswa . '</td>
                <td>' . $emp->id_pembayaran . '</td>
                <td>' . $emp->metode_pembayaran . '</td>
                <td>' . $emp->tanggal_pembayaran . '</td>
                <td>' . $emp->total_pembayaran . '</td>
                <td>' . $emp->status . '</td>
                <td>
                  <a href="/pembayaran/detail/' . $emp->id . '" class="text-info"><i class="ion-ios-eye h3"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}

	public function detail($id)
	{
		$pembayaran = Pembayaran::Find($id);
		$rincian_pembayaran = Rincian_Pembayaran::where('id_pembayaran', $pembayaran->id_pembayaran)->get();
		return view('pembayaran.detail', compact('pembayaran', 'rincian_pembayaran'));
	}



	// handle insert a new Tu ajax request
	// public function store(Request $request)
	// {
	//     // $file = $request->file('image');
	//     // $fileName = time() . '.' . $file->getClientOriginalExtension();
	//     // $file->storeAs('public/images', $fileName);

	//     $empData = [
	//         'name' => $request->name,
	//     ];
	//     Pembayaran::create($empData);
	//     return response()->json([
	//         'status' => 200,
	//     ]);
	// }

	// handle edit an Tu ajax request
	// public function edit(Request $request)
	// {
	//     $id = $request->id;
	//     $emp = Pembayaran::find($id);
	//     return response()->json($emp);
	// }

	// // handle update an Tu ajax request
	// public function update(Request $request)
	// {
	//     // $fileName = '';
	//     $emp = Pembayaran::Find($request->id);
	//     // if ($request->hasFile('image')) {
	//     //     $file = $request->file('image');
	//     //     $fileName = time() . '.' . $file->getClientOriginalExtension();
	//     //     $file->storeAs('public/images', $fileName);
	//     //     if ($emp->image) {
	//     //         Storage::delete('public/images/' . $emp->image);
	//     //     }
	//     // } else {
	//     //     $fileName = $request->emp_image;
	//     // }

	//     $empData = [
	//         'name' => $request->name,
	//     ];


	//     $emp->update($empData);
	//     return response()->json([
	//         'status' => 200,
	//     ]);
	// }

	// handle delete an Tu ajax request
	// public function delete(Request $request)
	// {
	//     $id = $request->id;
	//         Pembayaran::destroy($id);
	// }
}
