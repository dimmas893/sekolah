<?php

namespace App\Http\Controllers;

use App\Imports\GuruImport;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Str;
use File;
use Excel;

class GuruController extends Controller
{
    // set index page view
    public function index()
    {
        return view('guru.index');
    }

    public function edit_profile(Request $request, $id)
    {
        // dd($request->all());
        $emp = Guru::Find($id);
        $lampiranFulltextFile = null;
        if ($request->hasFile('avatar')) {

            if ($emp->avatar) {
                File::delete(public_path('/guru/' . $emp->avatar));
            }
            $file = $request->file('avatar');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/guru';

            $this->lampiranFulltextFile = 'foto-guru-' . $request->name . Str::random(5) . '.' . $file_extension;
            // $this->lampiranFulltextFile = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
            $request->file('avatar')->move($lokasiFile, $this->lampiranFulltextFile);
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        } else {
            $this->lampiranFulltextFile = $emp->avatar;
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        }
        $empData = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'telp' => $request->telp,
            'avatar' => $lampiranFulltextFile,
        ];

        if ($request->password) {
            $useree = [
                'password' => Hash::make($request->password),
            ];
            User::where('id', $emp->id_user)->update($useree);
        }

        $emp->update($empData);
        return back();
    }

    // handle fetch all eamployees ajax request
    public function all()
    {

        // <td><img src="/storage/avatars/' . $emp->avatar . '" width="50" class="img-thumbnail rounded-circle"></td>
        $emps = Guru::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>name</th>
                <th>E-mail</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Gambar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->email . '</td>
                <td>' . $emp->alamat . '</td>
                <td>' . $emp->telp . '</td>
                <td><img src="/guru/' . $emp->avatar . '" width="50" class="img-thumbnail rounded-circle"></td>
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
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/' . 'guru';
            $this->fotoFile = 'foto-guru-' . $request->name . Str::random(5) . '.' . $file_extension;
            $request->file('avatar')->move($lokasiFile, $this->fotoFile);
            $fotoFile = $this->fotoFile;
        }

        $user = [
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'role' => 3,
            'password' => Hash::make($request->password),
        ];
        $usercreate = User::create($user);
        if ($usercreate) {
            $empData = [
                'id_user' => $usercreate->id,
                'name' => $usercreate->name,
                'email' => $usercreate->email,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'avatar' => $fotoFile
            ];
            Guru::create($empData);
            return response()->json([
                'status' => 200,
            ]);
        }
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Guru::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $emp = Guru::Find($request->id);

        // if ($request->hasFile('avatar')) {
        //     $file = $request->file('avatar');
        //     $fileName = time() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/avatars', $fileName);
        //     if ($emp->avatar) {
        //         Storage::delete('public/avatars/' . $emp->avatar);
        //     }
        // } else {
        //     $fileName = $request->id;
        // }

        // $fileName = null;
        $lampiranFulltextFile = null;
        if ($request->hasFile('avatar')) {

            if ($emp->avatar) {
                File::delete(public_path('/guru/' . $emp->avatar));
            }
            $file = $request->file('avatar');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/guru';

            $this->lampiranFulltextFile = 'foto-guru-' . $request->name . Str::random(5) . '.' . $file_extension;
            // $this->lampiranFulltextFile = $request->tahun_terbit.$request->singkatan_jenis.$kodeWilayah.$nomorPeraturan.'.'.$file_extension;
            $request->file('avatar')->move($lokasiFile, $this->lampiranFulltextFile);
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        } else {
            $this->lampiranFulltextFile = $emp->avatar;
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        }

        // $fotoFile = null;
        // 	if($request->hasFile('avatar')){
        // 		$file = $request->file('avatar');
        // 		$file_extension = $file->getClientOriginalExtension();
        // 		$lokasiFile = public_path().'guru';
        // 		$this->fotoFile = 'foto-guru-'.$request->name.Str::random(5).'.'.$file_extension;
        // 		$request->file('avatar')->move($lokasiFile,$this->fotoFile);
        // 		$fotoFile = $this->fotoFile;
        // 	}

        $empData = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'avatar' => $lampiranFulltextFile,
        ];
        $update = [
            'password' => Hash::make($request->password),
        ];
        if ($request->password) {
            $user = User::where('id', $emp->id_user)->update($update);
        }
        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Tu ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Guru::find($id);
        User::destroy($emp->id_user);
        if (File::delete(public_path('/guru/' . $emp->avatar))) {
            Guru::destroy($id);
        } else {
            Guru::destroy($id);
        }
    }

    public function importguru(Request $request)
    {
        $user = Excel::import(new GuruImport, $request->file);
        // dd($user);
        return back();
    }
}
