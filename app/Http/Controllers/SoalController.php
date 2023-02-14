<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Ujian;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    // set index page view
    public function index()
    {
        return view('soal.index');
    }

    // handle fetch all eamployees ajax request
    public function all($id)
    {

        // <td><img src="/storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Soal::where('ujian_id', $id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Soal</th>
                <th>Jawaban A</th>
                <th>Jawaban B</th>
                <th>Jawaban C</th>
                <th>Jawaban E</th>
                <th>Kunci Jawaban</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->soal . '</td>
                <td>' . $emp->jawaban_a . '</td>
                <td>' . $emp->jawaban_b . '</td>
                <td>' . $emp->jawaban_c . '</td>
                <td>' . $emp->jawaban_d . '</td>
                <td>' . $emp->kunci_jawaban . '</td>
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
        // $soal = ;
        // $id = $request->ujian_id;
        foreach ($request['soal'] as $index => $value) {
            if ($value != null) {
                if (Soal::where('ujian_id', $request['ujian_id'][$index])->where('soal', $request['soal'][$index])->where('jawaban_a', $request['jawaban_a'][$index])->where('jawaban_b', $request['jawaban_b'][$index])->where('jawaban_c', $request['jawaban_c'][$index])->where('jawaban_d', $request['jawaban_d'][$index])->where('kunci_jawaban', $request['kunci_jawaban'][$index])->first() === null) {
                    $empData = [
                        'ujian_id' => $request['ujian_id'][$index],
                        'soal' => $request['soal'][$index],
                        'jawaban_a' => $request['jawaban_a'][$index],
                        'jawaban_b' => $request['jawaban_b'][$index],
                        'jawaban_c' => $request['jawaban_c'][$index],
                        'jawaban_d' => $request['jawaban_d'][$index],
                        'kunci_jawaban' => $request['kunci_jawaban'][$index],
                    ];
                    Soal::create($empData);
                }
            } else {
                // return 'dsds';
                $id = $request->ujian_id;
                $ujian = Ujian::where('id', $id)->first();
                $soal = Soal::with('ujian')->where('ujian_id', $ujian->id)->get();
                $jadwal_id = $ujian->jadwal_id;
                return view('soal.create', compact('soal', 'id', 'jadwal_id'));
            }
        }
        $ujian = Ujian::where('id', $request->ujian_id)->first();
        $id = $ujian->id;
        $soal = Soal::with('ujian')->where('ujian_id', $ujian->id)->get();
        $jadwal_id = $ujian->jadwal_id;
        return view('soal.create', compact('soal', 'id', 'jadwal_id'));
    }

    public function storemulti(Request $request)
    {
        // dd($request->all());
        // $soal = ;
        // $id = $request->ujian_id;
        foreach ($request['soal'] as $index => $value) {
            if ($value != null) {
                if (Soal::where('ujian_id', $request['ujian_id'][$index])->where('soal', $request['soal'][$index])->where('jawaban_a', $request['jawaban_a'][$index])->where('jawaban_b', $request['jawaban_b'][$index])->where('jawaban_c', $request['jawaban_c'][$index])->where('jawaban_d', $request['jawaban_d'][$index])->where('kunci_jawaban', $request['kunci_jawaban'][$index])->first() === null) {
                    $empData = [
                        'ujian_id' => $request['ujian_id'][$index],
                        'soal' => $request['soal'][$index],
                        'jawaban_a' => $request['jawaban_a'][$index],
                        'jawaban_b' => $request['jawaban_b'][$index],
                        'jawaban_c' => $request['jawaban_c'][$index],
                        'jawaban_d' => $request['jawaban_d'][$index],
                        'kunci_jawaban' => $request['kunci_jawaban'][$index],
                    ];
                    Soal::create($empData);
                }
            }
        }
        $ujian = Ujian::where('id', $request->ujian_id)->first();
        $id = $ujian->id;
        $soal = Soal::with('ujian')->where('ujian_id', $ujian->id)->get();
        $jadwal_id = $ujian->jadwal_id;
        return view(
            'soal.create',
            compact('soal', 'id', 'jadwal_id')
        );
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Soal::find($id);
        return response()->json($emp);
    }

    public function update(Request $request)
    {
        $emp = Soal::Find($request->id);
        $empData = [
            'soal' => $request->soal,
            'jawaban_a' => $request->jawaban_a,
            'jawaban_b' => $request->jawaban_b,
            'jawaban_c' => $request->jawaban_c,
            'jawaban_d' => $request->jawaban_d,
            'kunci_jawaban' => $request->kunci_jawaban,
        ];
        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        Soal::destroy($id);
    }
}
