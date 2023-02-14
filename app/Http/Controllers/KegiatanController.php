<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Str;
use File;

class KegiatanController extends Controller
{
    // set index page view
    public function index()
    {
        return view('kegiatan.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Kegiatan::all();
        $output = '';
        $p = 1 ;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Deskripsi Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Jam Kegiatan</th>
                <th>Status Kegiatan</th>
                <th>Foto</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nama_kegiatan . '</td>
                <td>' . $emp->deskripsi . '</td>
                <td>' . $emp->tanggal . '</td>
                <td>' . $emp->jam . '</td>
                <td>' . $emp->status . '</td>
        		<td><img src="/kegiatan/' . $emp->foto . '" width="50" class="img-thumbnail rounded-circle"></td>
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
		if($request->hasFile('foto')){
			$file = $request->file('foto');
			$file_extension = $file->getClientOriginalExtension();
			$lokasiFile = public_path().'/'.'kegiatan';
			$this->fotoFile = 'foto-kegiatan-'.$request->name.Str::random(5).'.'.$file_extension;
			$request->file('foto')->move($lokasiFile,$this->fotoFile);
			$fotoFile = $this->fotoFile;
		}

        $empData = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoFile,
        ];

        Kegiatan::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Kegiatan::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // $fileName = '';
        $emp = Kegiatan::Find($request->id);

		$lampiranFulltextFile = null;
		if($request->hasFile('foto')){

			if ($emp->foto) {
				  File::delete(public_path('/kegiatan/'.$emp->foto));
            }
			$file = $request->file('foto');
			$file_extension = $file->getClientOriginalExtension();
			$lokasiFile = public_path().'/kegiatan';

			$this->lampiranFulltextFile = 'foto-kegiatan-'.$request->name.Str::random(5).'.'.$file_extension;
			// $this->lampiranFulltextFile = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
			$request->file('foto')->move($lokasiFile,$this->lampiranFulltextFile);
			$lampiranFulltextFile = $this->lampiranFulltextFile;
		} else {
			$this->lampiranFulltextFile = $emp->foto;
			$lampiranFulltextFile = $this->lampiranFulltextFile;
		}
        $empData = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'deskripsi' => $request->deskripsi,
            'foto' => $lampiranFulltextFile,
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
        $emp = Kegiatan::find($id);
        if (File::delete(public_path('/kegiatan/'.$emp->foto))) {
            Kegiatan::destroy($id);
        }else{
			 Kegiatan::destroy($id);
		}
    }
}
