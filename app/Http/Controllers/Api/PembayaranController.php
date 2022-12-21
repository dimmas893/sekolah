<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice_Tagihan;
use App\Models\Kategori_Tagihan;
use App\Models\Pembayaran;
use App\Models\Rincian_Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PembayaranController extends Controller
{
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
		    $data = Http::post('https://anandadimmas.my.id/api/testing');
    		$response = $data->object();


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


    public function store(Request $request)
    {
		$tes = [];
		// $daftarTag = explode(',', $request->id_tagihan);
		foreach ( $request->id_tagihan as $key => $value) {
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
			// dd($tanggalini);
			 $empData = [
				'id_pembayaran' => $number,
				'tanggal_pembayaran' => $tanggalini,
				'metode_pembayaran' => 'metode_pembayaran',
				'status' => 'unpaid'
			];
			$emp = Pembayaran::create($empData);

			// dd($request->keranjang_tagihan);


			$tampung_total = [];
			$tampung_rincian = [];
			foreach($request->id_tagihan as $key => $value){
				$invoice = Invoice_Tagihan::where('id_invoice', $value)->first();
				$kategori_tagihan = Kategori_Tagihan::where('id', $invoice->id_tagihan)->first();
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
			$kategori_tagihan = Kategori_Tagihan::where('id', $invoice['id_tagihan'])->first();
			// $registeredAt = $p->created_at->isoFormat('D MMMM Y');
			$row['id'] = $p->id_invoice;
			$row['nama'] = $kategori_tagihan->nama_kategori;
			$row['nominal'] = $kategori_tagihan->nominal;
			array_push($data, $row);
			// array_push($biaya_lainnya_cuy, $tampung_semua->biaya_lainnya);
		}
		// $lainlain = array_sum($biaya_lainnya_cuy);

		if ($request->nominal) {
			$rinciancreate = [
					'id_pembayaran' => $emp->id_pembayaran,
					'id_invoice' => $emp->id_pembayaran,
					'tanggal_pembayaran' => $emp->tanggal_pembayaran,
					'nominal_pembayaran' => $request->nominal,
					'metode_pembayaran' => $emp->metode_pembayaran,
				];
				$rincian_fee_pembayaran = Rincian_Pembayaran::create($rinciancreate);
				array_push($tampung_total, $request->nominal);
		}

		$total = array_sum($tampung_total);

		$update = [
			'total_pembayaran' => $total,
			'siswa_id' => $get_siswa_id->id_siswa,
			'status' => 'unpaid',
		];

		// dd($tampung_rincian);
		$pembayaran_update = Pembayaran::where('id_pembayaran', $emp->id_pembayaran)->update($update);

		// dd($total);

			// dd($emp);
			return response()->json([
				'data' => [
					'id' => $emp->id,
					'tanggal' => $emp->tanggal_pembayaran,
					'total_tagihan' => $total
				],
				'item_bayar' => $data,
				'biaya_lain' => [
					'id' => $rincian_fee_pembayaran->id,
					'nama' => 'Fee',
					'nominal' => $rincian_fee_pembayaran->id,
				],
				'status' => 200
			]);





    }

	//   public function store(Request $request)
    // {
	// 		$pembayaran_last = Pembayaran::latest('created_at')->first();
	// 		if ($pembayaran_last != null) {
	// 		$nopo = substr($pembayaran_last, 4,5);
	// 		$no_po = intval($nopo);
	// 			do {
	// 			$number = 'PEM-'. str_pad(($no_po++ + 1), 5, "0", STR_PAD_LEFT). '-'.$this->getRomawi(date('n')).'-'.date('Y');
	// 			}
	// 			while($pembayaran_last->where('id_pembayaran', $number)->exists());
	// 		}  else{
	// 			$number = 'PEM-00001'. '-'.$this->getRomawi(date('n')).'-'.date('Y');
	// 		}

	// 		 $empData = [
	// 			'id_pembayaran' => $number,
	// 			'tanggal_pembayaran' => $request->tanggal_pembayaran,
	// 			'metode_pembayaran' => $request->metode_pembayaran,
	// 			'status' => 'paid'
	// 		];
	// 		$emp = Pembayaran::create($empData);

	// 		// dd($emp);


	// 			$tampung_total = [];
	// 			$tampung_rincian_pembayaran = [];
	// 			foreach($request->keranjang_invoice as $p){
	// 				$invoice = Invoice_Tagihan::where('id_invoice', $p['id_invoice'])->first();
	// 				// dd($invoice);
	// 				$kategori_tagihan = Kategori_Tagihan::where('id', $invoice->id_tagihan)->first();
	// 					$rinciancreate = [
	// 						'id_pembayaran' => $emp->id_pembayaran,
	// 						'id_invoice' => $p['id_invoice'],
	// 						'tanggal_pembayaran' => $request->tanggal_pembayaran,
	// 						'nominal_pembayaran' => $kategori_tagihan->nominal,
	// 						'metode_pembayaran' => $request->metode_pembayaran
	// 					];
	// 					$rincian = Rincian_Pembayaran::create($rinciancreate);
	// 					// dd($rincian);
	// 				// }

	// 				$invoice_update = [
	// 					'status' => 'paid'
	// 				];
	// 				$pentol = Invoice_Tagihan::where('id_invoice', $p['id_invoice'])->update($invoice_update);
	// 				array_push($tampung_total, $rincian->nominal_pembayaran);
	// 				array_push($tampung_rincian_pembayaran, $rincian);

	// 				}

	// 			$total = array_sum($tampung_total);


	// 		$update = [
	// 			'total_pembayaran' => $total,
	// 			'status' => 'paid',
	// 		];

	// 		$pembayaran_update = Pembayaran::where('id_pembayaran', $emp->id_pembayaran)->update($update);


	// 		// dd($tampung_rincian_pembayaran);
	// 		$data = [];
	// 		foreach($tampung_rincian_pembayaran as $p){
	// 			// dd($p);
	// 			$invoice = Invoice_Tagihan::where('id_invoice', $p->id_invoice)->first();
	// 			// dd($invoice);
	// 			$kategori_tagihan = Kategori_Tagihan::where('id', $invoice->id_tagihan)->first();
	// 			// $registeredAt = $p->created_at->isoFormat('D MMMM Y');
	// 			$row['id'] = $p['id_invoice'];
	// 			$row['nama'] = $kategori_tagihan->nama_kategori;
	// 			$row['nominal'] = $kategori_tagihan->nominal;
	// 			array_push($data, $row);
	// 		}

	// 		$biaya = [
	// 			["id" => "001",
	// 			"nama" => "Fee Transaksi",
	// 			"nominal"=> 5000],
	// 							["id" => "001",
	// 			"nama" => "Fee Transaksi",
	// 			"nominal"=> 5000],
	// 		];

	// 		return response()->json([
	// 			'data' => [
	// 				'id' => $emp->id_pembayaran,
	// 				'tanggal' => $emp->tanggal_pembayaran,
	// 				'status' => $emp->status,
	// 				'metode_bayar' => $emp->metode_pembayaran,
	// 				'total_bayar' => $total,
	// 			],
	// 			'item_bayar' => $data,
	// 			"biaya_lain"=>$biaya,

	// 		],200);

    // }


	public function pembayaran_detail_satuan(Request $request)
	{
		// $pembayaran = Pembayaran::where('id_pembayaran', $request->id_pembayaran)->first();
			$pembayaran = Pembayaran::where('siswa_id', $request->siswa_id)->get();
			$data = [];
			foreach($pembayaran as $p){

				$rincian_pembayaran = Rincian_Pembayaran::where('id_pembayaran', $p->id_pembayaran)->first();
				$jumlah_tagihan = Rincian_Pembayaran::where('id_pembayaran', $p->id_pembayaran)->count();
				// dd($rincian_pembayaran);
				$invoice = Invoice_Tagihan::where('id_invoice', $rincian_pembayaran->id_invoice)->first();
				$kategori_tagihan = Kategori_Tagihan::where('id', $invoice->id_tagihan)->first();
				$row['id'] = $p->id_pembayaran;
				$row['nama_tagihan'] = $kategori_tagihan->nama_kategori;
				$row['tanggal'] = $p->tanggal_pembayaran;
				$row['total'] = $p->total_pembayaran;
				$row['jumlah_tagihan'] = $jumlah_tagihan;
				$row['status'] = $p->status;
				array_push($data, $row);
			}

		return response()->json([
            'data' =>$data
        ],200);
	}


	public function pembayaran_detail(Request $request)
	{
		$pembayaran = Pembayaran::where('id_pembayaran', $request->id_pembayaran)->first();
		$rincian_pembayaran = Rincian_Pembayaran::where('id_pembayaran', $pembayaran->id_pembayaran)->get();
		$data = [];
		foreach($rincian_pembayaran as $p){
			$invoice = Invoice_Tagihan::where('id_invoice', $p->id_invoice)->first();
			$kategori_tagihan = Kategori_Tagihan::where('id', $invoice->id_tagihan)->first();
			// $registeredAt = $p->created_at->isoFormat('D MMMM Y');
			$row['id'] = $p->id_invoice;
			$row['nama'] = $kategori_tagihan->nama_kategori;
			$row['nominal'] = $kategori_tagihan->nominal;
			array_push($data, $row);
		}
		// dd($data);

		$biaya = [
				["id" => "001",
				"nama" => "Fee Transaksi",
				"nominal"=> 5000],
				["id" => "002",
				"nama" => "Fee Lainnya",
				"nominal"=> 1000],
			];

		return response()->json([
				'data' => [
					'id' => $pembayaran->id_pembayaran,
					'tanggal' => $pembayaran->tanggal_pembayaran,
					'status' => $pembayaran->status,
					'metode_bayar' => $pembayaran->metode_pembayaran,
					'total_bayar' => $pembayaran->total_pembayaran
				],
				'item_bayar' => $data,
				"biaya_lain"=>$biaya,

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
