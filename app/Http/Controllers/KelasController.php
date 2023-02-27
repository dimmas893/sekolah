<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JenjangPendidikan;
use App\Models\Kelas;
use App\Models\KelasGuru;
use App\Models\Master_Kelas;
use App\Models\Siswa;
use App\Models\Tingkatan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    // set index page view
    public function index()
    {
        $jenjangpenddian = JenjangPendidikan::get();
        $tingkatan = Tingkatan::all();
        return view('kelas.index', compact('jenjangpenddian', 'tingkatan'));
    }

    public function detail($id)
    {
        $jadwal = Jadwal::with('kelasget', 'ruangan', 'mata_pelajaran')->where('kelas_id', $id)->get();
        // dd($jadwal);
        $siswa = Siswa::where('kelas', $id)->get();
        return view('kelas.detail', compact('jadwal', 'siswa'));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Master_Kelas::with('jenjang', 'tingkat')->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Jenjang</th>
                <th>Max</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->jenjang->nama . '</td>
                <td>' . $emp->max . '</td>
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
        // $file = $request->file('image');
        // $fileName = time() . '.' . $file->getClientOriginalExtension();
        // $file->storeAs('public/images', $fileName);

        $empData = [
            'name' => $request->name,
            'tingkatan_id' => $request->tingkatan_id,
            'jenjang_pendidikan_id' => $request->jenjang_pendidikan_id,
            'max' => $request->max
        ];
        Master_Kelas::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Master_Kelas::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        // $fileName = '';
        $emp = Master_Kelas::Find($request->id);
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
            'name' => $request->name,
            'tingkatan_id' => $request->tingkatan_id,
            'jenjang_pendidikan_id' => $request->jenjang_pendidikan_id,
            'max' => $request->max
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
        Master_Kelas::destroy($id);
    }
}
