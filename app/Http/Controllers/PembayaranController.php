<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use App\Models\Pembayaran;
use App\Models\Rincian_Pembayaran;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class PembayaranController extends Controller
{
    // set index page view
    public function index()
    {
        return view('pembayaran.index');
    }

	   public function export(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        return Excel::download(new PembayaranExport($awal, $akhir), 'laporan pembayaran tanggal '. $awal . ' sampai tanggal ' . $akhir .   '.xlsx');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Pembayaran::with('siswa')->get();
        $output = '';
        $p = 1 ;
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
