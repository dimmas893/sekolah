<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Buku_Kategori;
use Illuminate\Http\Request;
use Str;
use File;
use Illuminate\Support\Facades\Auth;

class PerpustakaanController extends Controller
{
    // set index page view
    public function index()
    {
        $kategori_buku = Buku_Kategori::all();
        return view('perpustakaan.index', compact('kategori_buku'));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Buku::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Sampul Buku</th>
                <th>Sinopsis</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->judul . '</td>
                <td>' . $emp->sinopsis . '</td>
                <td><img src="/sampul/' . $emp->sampul . '" width="50" class="img-thumbnail rounded-circle"></td>
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
        if ($request->hasFile('sampul')) {
            $file = $request->file('sampul');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/sampul';

            $this->sampul = 'sampul-' . $request->name . Str::random(5) . '.' . $file_extension;
            // $this->sampul = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
            $request->file('sampul')->move($lokasiFile, $this->sampul);
            $sampul = $this->sampul;
        } else {
            $sampul = null;
        }

        $empData = [
            'judul' => $request->judul_buku,
            'sampul' => $sampul,
            'sinopsis' => $request->sinopsis,
            'bahasa' => $request->bahasa,
            'jumlah_halaman' => $request->jumlah_halaman,
            'isbn_no' => $request->isbn_no,
            'penerbit' => $request->penerbit,
            'penulis' => $request->penulis,
            'rak' => $request->rak,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
            'dibuat_oleh' => Auth::user()->id,
            'diubah_oleh' =>  Auth::user()->id,
        ];
        Buku::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Buku::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Buku::Find($request->id);

        if ($request->hasFile('sampul')) {
            if ($emp->sampul) {
                File::delete(public_path('/sampul/' . $emp->sampul));
            }
            $file = $request->file('sampul');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/sampul';

            $this->sampul = 'sampul-' . $request->name . Str::random(5) . '.' . $file_extension;
            // $this->sampul = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
            $request->file('sampul')->move($lokasiFile, $this->sampul);
            $sampul = $this->sampul;
        } else {
            $this->sampul = $emp->sampul;
            $sampul = $this->sampul;
        }

        $empData = [
            'judul' => $request->judul_buku,
            'sampul' => $sampul,
            'sinopsis' => $request->sinopsis,
            'bahasa' => $request->bahasa,
            'jumlah_halaman' => $request->jumlah_halaman,
            'isbn_no' => $request->isbn_no,
            'penerbit' => $request->penerbit,
            'penulis' => $request->penulis,
            'rak' => $request->rak,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
            'dibuat_oleh' => Auth::user()->id,
            'diubah_oleh' =>  Auth::user()->id,
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
        $emp = Buku::find($id);
        if (File::delete(public_path('/sampul/' . $emp->sampul))) {
            Buku::destroy($id);
        } else {
            Buku::destroy($id);
        }
    }
}
