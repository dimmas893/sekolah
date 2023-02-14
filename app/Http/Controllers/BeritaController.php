<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

use Str;
use File;

class BeritaController extends Controller
{
    // set index page view
    public function index()
    {
        return view('berita.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Berita::all();
        $output = '';
        $p = 1 ;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul Berita</th>
                <th>Isi Berita</th>
                <th>Tanggal Berita</th>
                <th>Jam Berita</th>
                <th>Status</th>
                <th>Gambar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->judul . '</td>
                <td>' . $emp->isi . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . $emp->jam . '</td>
                <td>' . $emp->status . '</td>
                <td><img src="/berita/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
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

		$fotoFile = null;
		if($request->hasFile('image')){
			$file = $request->file('image');
			$file_extension = $file->getClientOriginalExtension();
			$lokasiFile = public_path().'/'.'berita';
			$this->fotoFile = 'foto-berita-'.$request->name.Str::random(5).'.'.$file_extension;
			$request->file('image')->move($lokasiFile,$this->fotoFile);
			$fotoFile = $this->fotoFile;
		}

        $empData = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'status' => $request->status,
            'image' => $fotoFile
        ];
        Berita::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Berita::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
		$fileName = '';
        $emp = Berita::Find($request->id);
		$lampiranFulltextFile = null;
		if($request->hasFile('image')){

			if ($emp->image) {
				  File::delete(public_path('/berita/'.$emp->image));
            }
			$file = $request->file('image');
			$file_extension = $file->getClientOriginalExtension();
			$lokasiFile = public_path().'/berita';

			$this->lampiranFulltextFile = 'foto-berita-'.$request->name.Str::random(5).'.'.$file_extension;
			// $this->lampiranFulltextFile = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
			$request->file('image')->move($lokasiFile,$this->lampiranFulltextFile);
			$lampiranFulltextFile = $this->lampiranFulltextFile;
		} else {
			$this->lampiranFulltextFile = $emp->image;
			$lampiranFulltextFile = $this->lampiranFulltextFile;
		}



        $empData = [
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'status' => $request->status,
            'isi' => $request->isi,
            'image' => $lampiranFulltextFile
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
        $emp = Berita::find($id);
        if (File::delete(public_path('/berita/'.$emp->image))) {
            Berita::destroy($id);
        }else{
			 Berita::destroy($id);
		}
    }
}
