<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice_Tagihan;
use App\Models\Kategori_Tagihan;
use App\Models\Tagihan_Siswa;
use App\Models\Pembayaran;
use App\Models\Rincian_Pembayaran;
use App\Models\Siswa;
use Xendit\Xendit;
use Carbon\Carbon;
use DB;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PembayaranController extends Controller
{

	public function check(Request $request)
	{
		$pembayaran = Pembayaran::where('id_pembayaran' , $request->id_pembayaran)->first();
		return response()->json([
			'data' => [
				'id' => $pembayaran->id,
				'status' => $pembayaran->status,
				'total_bayar' => $pembayaran->total_pembayaran,
				'metode_pembayaran' => $pembayaran->metode_pembayaran
			],
		]);
	}
    public function all()
    {
        $admin = Rincian_Pembayaran::with('pembayaran')->get();
            return response()->json([
				'data' => $admin,
				'status' =>200
        ]);
    }

	public function checkout(Request $request)
	{
		    $data = 200;
    		$response = $data;


		if($response == 200){
			$pembayaran = Pembayaran::where('id_pembayaran', $request->id_invoice)->first();
			$yoho = Pembayaran::where('id_pembayaran', $pembayaran->id_invoice)->update([
							'status' => 'paid',
						]);
			// dd($pembayaran);

			if($pembayaran){

				foreach($pembayaran->rincianPembayaran as $p =>$value){

					$invoice = Invoice_Tagihan::where('id_invoice', $value->id_invoice)->first();


					$rincian_pembayaran = Rincian_Pembayaran::where('id_invoice', $value->id_invoice)->first();

					if($rincian_pembayaran){

						$invoice = Invoice_Tagihan::where('id_invoice', $value->id_invoice)->update( [
							'status' => 'paid',
						]);
					}
					// $pembayaran_update = Pembayaran::where('id_pembayaran', $rincian_pembayaran->id_pembayaran)->update($update);



					return response()->json([
						'data' => [
						'id_pembayaran'	=> $rincian_pembayaran->id_pembayaran
						]
					]);
				}
			}

		}else{

				return response()->json([
					'message' => 'gagal'
				]);
				}
		}


    public function xenditAdi(Request $request)
	{

		// pembayaran melalui xendit start----------------------------------------
			$result = DB::transaction(function () use ($request) {
				
				$pembayaran_last = Pembayaran::latest('created_at')->first();
				if ($pembayaran_last != null) {
					$nopo = substr($pembayaran_last, 4,5);
					$no_po = intval($nopo);
					do {
						$number = 'PEM-'. str_pad(($no_po++ + 1), 5, "0", STR_PAD_LEFT). '-'.$this->getRomawi(date('n')).'-'.date('Y');
					}
					while($pembayaran_last->where('id_pembayaran', $number)->exists());
				}  else{
					$number = 'PEM-00001'. '-'.$this->getRomawi(date('n')).'-'.date('Y');
				}

				$tanggalini = Carbon::now()->Format('Y-m-d');
				$empData = [
					'id_pembayaran' => $number,
					'tanggal_pembayaran' => $tanggalini,
					'metode_pembayaran' => 'metode_pembayaran',
					'status' => 'unpaid'
				];
				$emp = Pembayaran::create($empData);

				$invoiceNo = $number;     

				$dataSiswa = Siswa::where('id_user',$request->id_user)->first();
				$customer = [
					'given_names' => 'adi',
					'surname' => 'dian',
					'email' => 'dians92.work@gmail.com',
					'mobile_number' => '08567636129',
					'address' => [
						[
							'city' => '-',
							'country' => 'Indonesia',
							'postal_code' => '-',
							'state' => '-',
							'street_line1' => 'jakarta',
						]
					]
				];    
			
				$successUrl = url('xendit/success-payment/'.$invoiceNo); //kalau berhasil
				$failurUrl = url('xendit/failure-payment/'.$invoiceNo);    

				$data = array();
			
				$tampung_total_tagihan = array();
				foreach($request->item_bayar as $key => $value){
					$invoice = Invoice_Tagihan::where('id_invoice', $value)->first();
					$tagihan_siswa = Tagihan_Siswa::where('id', $invoice->id_tagihan)->first();
					$kategori_tagihan = Kategori_Tagihan::where('id', $tagihan_siswa->id_kategori_tagihan)->first();
					$data[] = array(
						'name' => '$tagihan_siswa->deskripsi',
						'quantity' => 1,
						'price' => $invoice->nominal,
					);
					array_push($tampung_total_tagihan, $invoice->nominal);
					$rincianPembayaranTagihan = [
						'id_pembayaran' => $emp->id_pembayaran,
						'id_invoice' => $value,
						'tanggal_pembayaran' => $emp->tanggal_pembayaran,
						'nominal_pembayaran' => $invoice->nominal,
						'metode_pembayaran' => 'xendit',
					];

					Rincian_Pembayaran::create($rincianPembayaranTagihan);
				}

				$tampung_total_biayaLainnya = array();
				foreach($request->biaya_lain as $p =>$value){
					$rincianPembayaranLainnya = [
						'id_pembayaran' => $emp->id_pembayaran,
						'id_invoice' => $value['idnya'],
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
					'invoice' => $invoiceNo,
					'amount' => $gtotal,
					'description' => 'Pembayaran Tagihan Siswa ',
					'duration' => 172800, //2 hari
				];
			
				// simpan transaksi start----------------------------------------------------------------------

				$update = [
					'total_pembayaran' => $gtotal,
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
					return redirect('xendit/failure-payment/'.$dataEvent->id.'/'.$invoice);
				} else {
				    return response()->json([
                        // 'id_pembayaran' => $emp->id_pembayaran,
                        'data' => [
        				    'url' =>$result,
        				]
                        
                    ],200);
				// 	return redirect($result);
				}
				// pembayaran melalui xendit end----------------------------------------    
		}
		
		public function createInvoice($trans, $customer, $item, $successUrl, $failurUrl)  {
            Xendit::setApiKey('xnd_development_fw0zlBcZGyjwpZ3djCQj7MVV03XjSw98aVufisV1fexGHWIHhSLM8SbzgqdQmuh'); //staging

            $params = [
                'external_id' => $trans['invoice'],
                'amount' => $trans['amount'],
                'description' => $trans['description'],
                'invoice_duration' => $trans['duration'],
                'customer' => $customer,
                'customer_notification_preference' => [
                    'invoice_created' => [
                        // 'whatsapp',
                        'sms',
                        'email'
                    ],
                    'invoice_reminder' => [
                        // 'whatsapp',
                        'sms',
                        'email'
                    ],
                    'invoice_paid' => [
                        // 'whatsapp',
                        'sms',
                        'email'
                    ],
                    'invoice_expired' => [
                        // 'whatsapp',
                        'sms',
                        'email'
                    ]
                ],
                'success_redirect_url' => $successUrl,
                'failure_redirect_url' => $failurUrl,
                'currency' => 'IDR',
                'items' => $item,
                'fees' => [
                    
                ]
            ];
    
            $createInvoice = \Xendit\Invoice::create($params);
            return $createInvoice;
        }

		public function xenditSuccessPayment($idInvoice) {
			$dataTransaksi = Pembayaran::where('id_pembayaran',$idInvoice)->first();        
			$dataTransaksi->update([
				'metode_pembayaran' => 'xendit',
				'status' => 'PAID',
			]);  
			return Redirect::to('https://simulasipg.netlify.app/sukses');
// 			return redirect('https://simulasipg.netlify.app/sukses');
            //  return view('frontend.registrasi.register5c',compact('dataEvent','dataTransaksi'));      
		}   

		public function xenditFailurePayment($idInvoice) {
			$dataTransaksi = Pembayaran::where('id_pembayaran',$idInvoice)->first();
			$dataTransaksi->update([
				'metode_pembayaran' => 'xendit',
				'status_pembayaran' => 'EXPIRED',
			]);
			$nomorInvoice = $idInvoice;
			return redirect('https://simulasipg.netlify.app/gagal');

            // return view('frontend.registrasi.register5',compact('dataEvent','nomorInvoice'));
		} 


    public function store(Request $request)
    {
		// dd($request->all());
		$tes = [];
		// $daftarTag = explode(',', $request->id_tagihan);
		foreach ( $request->item_bayar as $key => $value) {
			$url['id_invoice'] = $value;
			array_push($tes , $url);
		}



			$pembayaran_last = Pembayaran::latest('created_at')->first();
			if ($pembayaran_last != null) {
			$nopo = substr($pembayaran_last, 4,5);
			$no_po = intval($nopo);
				do {
				$number = 'PEM-'. str_pad(($no_po++ + 1), 5, "0", STR_PAD_LEFT). '-'.$this->getRomawi(date('n')).'-'.date('Y');
				}
				while($pembayaran_last->where('id_pembayaran', $number)->exists());
			}  else{
				$number = 'PEM-00001'. '-'.$this->getRomawi(date('n')).'-'.date('Y');
			}
			$tanggalini = Carbon::now()->Format('Y-m-d');
			$empData = [
				'id_pembayaran' => $number,
				'tanggal_pembayaran' => $tanggalini,
				'metode_pembayaran' => 'metode_pembayaran',
				'status' => 'unpaid'
			];
			$emp = Pembayaran::create($empData);


			$tampung_total = [];
			$tampung_rincian = [];
			foreach($request->item_bayar as $key => $value){
				$invoice = Invoice_Tagihan::where('id_invoice', $value)->first();
				$tagihan_siswa = Tagihan_Siswa::where('id', $invoice->id_tagihan)->first();
				$kategori_tagihan = Kategori_Tagihan::where('id', $tagihan_siswa->id_kategori_tagihan)->first();
				// dd($kategori_tagihan);
					$rinciancreate = [
					'id_pembayaran' => $emp->id_pembayaran,
					'id_invoice' => $value,
					'tanggal_pembayaran' => $emp->tanggal_pembayaran,
					'nominal_pembayaran' => $kategori_tagihan->nominal,
					'metode_pembayaran' => $emp->metode_pembayaran,
				];
				// dd($rinciancreate);
				$rincian = Rincian_Pembayaran::create($rinciancreate);


					$get_siswa_id = Invoice_Tagihan::where('id_invoice', $value)->first();
					array_push($tampung_total, $rincian->nominal_pembayaran);
					array_push($tampung_rincian, $rincian);

					}

		$data = [];
		// $biaya_lainnya_cuy = [];
		foreach($tampung_rincian as $p){
			// dd($tampung_rincian);

			$tampung_semua = Rincian_Pembayaran::where('id',$p->id)->first();
			$invoice = Invoice_Tagihan::where('id_invoice', $p['id_invoice'])->first();
			$tagihan_siswa = Tagihan_Siswa::where('id', $invoice->id_tagihan)->first();
			$kategori_tagihan = Kategori_Tagihan::where('id', $tagihan_siswa['id_kategori_tagihan'])->first();
			// $registeredAt = $p->created_at->isoFormat('D MMMM Y');
			$row['id'] = $p->id_invoice;
			$row['nama'] = $kategori_tagihan->nama_kategori;
			$row['nominal'] = $kategori_tagihan->nominal;
			array_push($data, $row);
			// array_push($biaya_lainnya_cuy, $tampung_semua->biaya_lainnya);
		}
		// $lainlain = array_sum($biaya_lainnya_cuy);
		$dimmasoke = [];
			foreach($request->biaya_lain as $p =>$value){
						$rinciancreate = [
							'id_pembayaran' => $emp->id_pembayaran,
							'id_invoice' => $value['id'],
							'tanggal_pembayaran' => $emp->tanggal_pembayaran,
							'nominal_pembayaran' => $value['nominal'],
							'metode_pembayaran' => $value['nama'],
						];

						$aduh = Rincian_Pembayaran::create($rinciancreate);
						array_push($tampung_total, $value['nominal']);
						array_push($dimmasoke, $rinciancreate);
						// array_push($dimmasoke, $aduh);

					}
					// dd($dimmasoke);


		$total = array_sum($tampung_total);

		$update = [
			'total_pembayaran' => $total,
			'siswa_id' => $get_siswa_id->id_siswa,
			'status' => 'unpaid',
		];

		// dd($aduh);
		$pembayaran_update = Pembayaran::where('id_pembayaran', $emp->id_pembayaran)->update($update);

		// dd($total);

			// dd($emp);
			// return response()->json([
			// 	'data' => [
			// 		'id' => $emp->id,
			// 		'tanggal' => $emp->tanggal_pembayaran,
			// 		'total_tagihan' => $total
			// 	],
			// 	'item_bayar' => $data,
			// 	'biaya_lain' => [
			// 		'id' => $aduh->id_invoice,
			// 		'nama' => $aduh->metode_pembayaran,
			// 		'nominal' => $aduh->nominal_pembayaran,
			// 	],
			// ],201);
			return response()->json([
				'data' => [
					'id_pembayaran' =>  $emp->id_pembayaran
				]
			],201);
    }

	public function pembayaran_detail_satuan(Request $request)
	{
		$dataSiswa = Siswa::where('id_user', $request->id_user)->first();
			$pembayaran = Pembayaran::where('siswa_id', $dataSiswa->id)->get();
// 			dd($pembayaran);
			$data = [];
			foreach($pembayaran as $p){
				$rincian_pembayaran = Rincian_Pembayaran::where('id_pembayaran', $p->id_pembayaran)->where('id_invoice','!=',1)->first();
				$jumlah_tagihan = Rincian_Pembayaran::where('id_pembayaran', $p->id_pembayaran)->count();
				//dd($p->id_pembayaran);
				$invoice = Invoice_Tagihan::where('id_invoice', $rincian_pembayaran->id_invoice)->first();
				// dd($invoice);
				$dataTagihan = Tagihan_Siswa::where('id',$invoice->id_tagihan)->first();
				// dd($dataTagihan);
				// $kategori_tagihan = Kategori_Tagihan::where('id', $dataTagihan->id_kategori_tagihan)->first();
				if ($p->status === 'unpaid') {
					$dataStatus = 0;
				} elseif ($p->status === 'paid') {
					$dataStatus = 1;
				}
				
				$row['id'] = $p->id_pembayaran;
				$row['nama_tagihan'] = $dataTagihan->kategori_tagihan->nama_kategori;
				$row['tanggal'] = $p->tanggal_pembayaran;
				$row['jumlah_tagihan'] = $jumlah_tagihan;
				$row['total_bayar'] = (int) $p->total_pembayaran;
				$row['status'] = $dataStatus;
				array_push($data, $row);
			}

		return response()->json([
            'data' =>$data
        ],200);
	}


	public function pembayaran_detail(Request $request)	{
		$pembayaran = Pembayaran::where('id_pembayaran', $request->id_pembayaran)->first();

		if(isset($pembayaran) == 0){
			return response()->json([
				'error' => [
					"ID pembayaran tidak tersedia"
				]
			]);
		}

		$rincian_pembayaran = Rincian_Pembayaran::where('id_pembayaran', $pembayaran->id_pembayaran)->get();
// 		dd($rincian_pembayaran);
		$data = [];
		$null = [];
		foreach($rincian_pembayaran as $p){
		    //dd($p->id_invoice);
		    $invoice = Invoice_Tagihan::where('id_invoice', $p->id_invoice)->first();
			if($invoice != null){
				
				// dd($invoice->id_tagihan);
				$dataTagihan = Tagihan_Siswa::where('id',$invoice->id_tagihan)->first();
				// dd($dataTagihan);
				$kategori_tagihan = Kategori_Tagihan::where('id', $dataTagihan->id_kategori_tagihan)->first();
				// dd($kategori_tagihan);
				// $registeredAt = $p->created_at->isoFormat('D MMMM Y');
				$row['id'] = $p->id_invoice;
				$row['nama'] = $kategori_tagihan->nama_kategori;
				$row['nominal'] = (int) $kategori_tagihan->nominal;
				array_push($data, $row);
			}else{
				$row['id'] = $p->id;
				$row['nama'] = "Fee Transaksi";
				$row['nominal'] = (int) $p->nominal_pembayaran;
				array_push($null, $row);
			}
		}
		// dd($data);

		// $biaya = [
		// 		["id" => "001",
		// 		"nama" => "Fee Transaksi",
		// 		"nominal"=> 5000],
		// 		["id" => "002",
		// 		"nama" => "Fee Lainnya",
		// 		"nominal"=> 1000],
		// 	];
		
		if($pembayaran->status === 'paid'){
		    $stat = 1;
		}elseif($pembayaran->status === 'unpaid') {
		    $stat = 0;
		}

		return response()->json([
				'data' => [
					'id' => $pembayaran->id_pembayaran,
					'tanggal' => $pembayaran->tanggal_pembayaran,
					'status' => $stat,
					'metode_bayar' => $pembayaran->metode_pembayaran,
					'total_bayar' => (int) $pembayaran->total_pembayaran
				],
				'item_bayar' => $data,
				"biaya_lain"=>$null,

			],200);

	}

    // handle edit an Tu ajax request
    public function edit($id)
    {
            $emp = Pembayaran::Find($id);
            return response()->json([
            'data' =>$emp,
            'status' => 200
        ]);
    }

    // handle update an Tu ajax request
    public function update(Request $request, $id)
    {
        $emp = Pembayaran::Find($id);

			 $empData = [
				'tanggal_pembayaran' => $request->tanggal_pembayaran,
				'total_pembayaran' => $request->total_pembayaran,
				'metode_pembayaran' => $request->metode_pembayaran,
				'status,' => $request->status
			];

        $emp->update($empData);
        return response()->json([
            'data' => $emp,
            'status' => 200
        ]);
    }

    // handle delete an Tu ajax request
    public function delete($id)
    {
        Pembayaran::destroy($id);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Mengghapus'
            ]);
    }

	function getRomawi($bln){
		switch	($bln){
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
