<?php

namespace App\Http\Controllers;

use App\Models\Invoice_Tagihan;
use App\Models\Kategori_Tagihan;
use App\Models\Siswa;
use App\Models\Tagihan_Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Tagihan_SiswaController extends Controller
{

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
        return view('tagihan_siswa.index' ,compact('Kategori_tagihan'));
    }

	public function create()
    {
		// $tagihan_siswa = Tagihan_Siswa::all();
		$Kategori_tagihan = Kategori_Tagihan::all();
        return view('tagihan_siswa.create' ,compact('Kategori_tagihan'));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Tagihan_Siswa::with('kategori_tagihan')->get();
        $output = '';
        $p = 1 ;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Kategori Tagihan</th>
                <th>Deskripsi</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->kategori_tagihan->nama_kategori . '</td>
                <td>' . $emp->deskripsi . '</td>
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


		// dd($request->all());
		$siswa = Siswa::all();

		foreach($siswa as $p){
			$pembayaran_last = Invoice_Tagihan::latest('created_at')->first();
			if ($pembayaran_last != null) {
			$nopo = substr($pembayaran_last, 4,5);
			$no_po = intval($nopo);
				do {
				$number = 'INV-'. str_pad(($no_po++ + 1), 5, "0", STR_PAD_LEFT). '-'.$this->getRomawi(date('n')).'-'.date('Y');
			}
			while($pembayaran_last->where('id_invoice', $number)->exists());
		}  else{
			$number = 'INV-00001'. '-'.$this->getRomawi(date('n')).'-'.date('Y');
		}

        $empData = [
            'id_kategori_tagihan' => $request->id_kategori_tagihan,
            'deskripsi' => $request->deskripsi
        ];
			$invoice = [
				'id_tagihan' => $request->id_tagihan,
				'id_invoice' => $number,
				'id_siswa' => $p->id,
				'nominal' => $request->nominal,
				'status' => "unpaid"
			];
			Invoice_Tagihan::create($invoice);
		}


        $emp = Tagihan_Siswa::create($empData);
        return back()->with('success');
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
        // $fileName = '';
        $emp = Tagihan_Siswa::Find($request->id);
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $fileName = time() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/images', $fileName);
        //     if ($emp->image) {
        //         Storage::delete('public/images/' . $emp->image);
        //     }
        // } else {
        //     $fileName = $request->emp_image;
        // }

          $empData = [
            'id_kategori_tagihan' => $request->id_kategori_tagihan,
            'deskripsi' => $request->deskripsi
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
        $emp = Tagihan_Siswa::find($id);
            Tagihan_Siswa::destroy($id);
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
