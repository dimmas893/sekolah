<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Master_Kelas;
use App\Models\Mata_Pelajaran;
use App\Models\Ruangan;
use App\Models\Siswa;
use App\Models\Tingkatan;
use Illuminate\Http\Request;

class AdminNaikKelasController extends Controller
{
    public function Ajaxtk(Request $request)
    {
        // $setting = Setting::first();
        $id = $request->id;
        $emps = Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')->where('kelas_id', $id)->get();
        $p = 1;
        $output = '';
        $kelas = Kelas::with('kelas')->where('id', $id)->first();
        if ($kelas) {
            $output .= '<div class="card">';
            $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $kelas->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $kelas->id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Tambah">
                                                </form>
                                            </div>';
        }
        if ($id && $emps->count() > 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
				<td>

                  <a href="#" id="' . $emp->id . '" jenjang_id="' . $emp->kelasget->kelas->jenjang_pendidikan_id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
				</td>
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($id && $emps->count() === 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
				<td>

                  <a href="#" id="' . $emp->id . '" jenjang_id="' . $emp->kelasget->kelas->jenjang_pendidikan_id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
				</td>
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($emps->count() === 0 && $id === null) {

            $smp = Kelas::with('kelas')->whereIn('tingkatan_id', [14])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
            $p = 1;
            $output = '';
            foreach ($smp as $item) {
                $output .= '<div class="card">';
                $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $item->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $item->id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Tambah">
                                                </form>
                                            </div>';
                $jadwal = \App\Models\Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')
                    ->where('kelas_id', $item->id)
                    ->get();
                $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($jadwal as $emp) {
                    $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
              </tr>';
                }
                $output .= '</tbody></table></div></div>';
            }
            echo $output;
        }
    }
    public function AjaxSd(Request $request)
    {
        // $setting = Setting::first();
        $id = $request->id;
        $emps = Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')->where('kelas_id', $id)->get();
        $p = 1;
        $output = '';
        $kelas = Kelas::with('kelas')->where('id', $id)->first();
        if ($kelas) {
            $output .= '<div class="card">';
            $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $kelas->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $kelas->id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Tambah">
                                                </form>
                                            </div>';
        }
        if ($id && $emps->count() > 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
				<td>

                  <a href="#" id="' . $emp->id . '" jenjang_id="' . $emp->kelasget->kelas->jenjang_pendidikan_id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
				</td>
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($id && $emps->count() === 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
				<td>

                  <a href="#" id="' . $emp->id . '" jenjang_id="' . $emp->kelasget->kelas->jenjang_pendidikan_id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
				</td>
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($emps->count() === 0 && $id === null) {

            $smp = Kelas::with('kelas')->whereIn('tingkatan_id', [1, 2, 3, 4, 5, 6])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
            $p = 1;
            $output = '';
            foreach ($smp as $item) {
                $output .= '<div class="card">';
                $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $item->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $item->id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Tambah">
                                                </form>
                                            </div>';
                $jadwal = \App\Models\Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')
                    ->where('kelas_id', $item->id)
                    ->get();
                $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($jadwal as $emp) {
                    $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
              </tr>';
                }
                $output .= '</tbody></table></div></div>';
            }
            echo $output;
        }
    }
    public function AjaxSmp(Request $request)
    {
        // $setting = Setting::first();
        $id = $request->id;
        $emps = Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')->where('kelas_id', $id)->get();
        $p = 1;
        $output = '';
        $kelas = Kelas::with('kelas')->where('id', $id)->first();
        if ($kelas) {
            $output .= '<div class="card">';
            $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $kelas->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $kelas->id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Tambah">
                                                </form>
                                            </div>';
        }
        if ($id && $emps->count() > 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
				<td>

                  <a href="#" id="' . $emp->id . '" jenjang_id="' . $emp->kelasget->kelas->jenjang_pendidikan_id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
				</td>
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($id && $emps->count() === 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
				<td>

                  <a href="#" id="' . $emp->id . '" jenjang_id="' . $emp->kelasget->kelas->jenjang_pendidikan_id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
				</td>
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($emps->count() === 0 && $id === null) {

            $smp = Kelas::with('kelas')->whereIn('tingkatan_id', [7, 8, 9])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
            $p = 1;
            $output = '';
            foreach ($smp as $item) {
                $output .= '<div class="card">';
                $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $item->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $item->id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Tambah">
                                                </form>
                                            </div>';
                $jadwal = \App\Models\Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')
                    ->where('kelas_id', $item->id)
                    ->get();
                $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($jadwal as $emp) {
                    $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
              </tr>';
                }
                $output .= '</tbody></table></div></div>';
            }
            echo $output;
        }
    }

    public function AjaxSma(Request $request)
    {
        // $setting = Setting::first();
        $id = $request->id;
        $emps = Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')->where('kelas_id', $id)->get();
        $p = 1;
        $output = '';
        $kelas = Kelas::with('kelas')->where('id', $id)->first();
        if ($kelas) {
            $output .= '<div class="card">';
            $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $kelas->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $kelas->id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Tambah">
                                                </form>
                                            </div>';
        }
        if ($id && $emps->count() > 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
				<td>

                  <a href="#" id="' . $emp->id . '" jenjang_id="' . $emp->kelasget->kelas->jenjang_pendidikan_id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
				</td>
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($id && $emps->count() === 0) {
            $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
				<td>

                  <a href="#" id="' . $emp->id . '" jenjang_id="' . $emp->kelasget->kelas->jenjang_pendidikan_id . '" class="text-success mx-1 editIcon" data-toggle="modal" data-target="#editTUModal"><i class="ion-edit h4" data-pack="default" data-tags="on, off"></i></a>
                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="ion-trash-a h4" data-pack="default" data-tags="on, off"></i></a>
				</td>
              </tr>';
            }
            $output .= '</tbody></table></div></div>';
            echo $output;
        }
        if ($emps->count() === 0 && $id === null) {

            $smp = Kelas::with('kelas')->whereIn('tingkatan_id', [10, 11, 12])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
            $p = 1;
            $output = '';
            foreach ($smp as $item) {
                $output .= '<div class="card">';
                $output .= ' <div class="card-header d-flex justify-content-between align-items-center">
                                                Kelas
                                                ' . Master_Kelas::where('id', $item->id_master_kelas)->first()->name . '
                                                <form action="/jadwal-admin" method="get">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                                    <input type="hidden" name="kelas_id" value="' . $item->id . '" />
                                                    <input type="submit" class="btn btn-primary" value="Tambah">
                                                </form>
                                            </div>';
                $jadwal = \App\Models\Jadwal::with('mata_pelajaran', 'ruangan', 'guru', 'hari')
                    ->where('kelas_id', $item->id)
                    ->get();
                $output .= '<div class="card-body"><table class="table table-bordered table-md display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Guru Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($jadwal as $emp) {
                    $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->ruangan->name . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->mata_pelajaran->name . '</td>
                <td>' . $emp->hari->name . '</td>
                <td>' . $emp->jam_masuk . '</td>
                <td>' . $emp->jam_keluar . '</td>
              </tr>';
                }
                $output .= '</tbody></table></div></div>';
            }
            echo $output;
        }
    }
    public function tk()
    {
        $tk = Kelas::with('kelas')->whereIn('tingkatan_id', [14])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
        return view('admin.naikkelas.tk', compact('tk'));
    }
    public function sd()
    {
        $sd = Kelas::with('kelas')->whereIn('tingkatan_id', [1, 2, 3, 4, 5, 6])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
        return view('admin.naikkelas.sd', compact('sd'));
    }
    public function smp()
    {
        $smp = Kelas::with('kelas')->whereIn('tingkatan_id', [7, 8, 9])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
        // dd($smp);
        return view('admin.naikkelas.smp', compact('smp'));
    }
    public function sma()
    {
        $sma = Kelas::with('kelas')->whereIn('tingkatan_id', [10, 11, 12])->select('id', 'id_master_kelas')->groupBy('id', 'id_master_kelas')->get();
        $jadwal = Jadwal::with('mata_pelajaran')->get();
        return view('admin.naikkelas.sma', compact('sma'));
    }

    public function semuakelas()
    {
        $tingkat = Tingkatan::all();
        $sd = Kelas::with('kelas')->whereIn('tingkatan_id', [1, 2, 3, 4, 5, 6])->get();
        $smp = Kelas::with('kelas')->whereIn('tingkatan_id', [7, 8, 9])->get();
        $sma = Kelas::with('kelas')->whereIn('tingkatan_id', [10, 11, 12])->get();
        $tk = Kelas::with('kelas')->whereIn('tingkatan_id', [14])->get();
        return view('admin.naikkelas.index', compact('sd', 'smp', 'sma', 'tk'));
    }

    public function datakelasadmin(Request $request, $id)
    {
        $siswa = Siswa::where('kelas', $id)->get();
        $kelas = Kelas::with('kelas')->where('id', $id)->first();
        // $id = $id;
        // $guru = ;
        // dd($kelas->id_guru);
        return view('admin.naikkelas.datakelas', compact('siswa', 'kelas'));
    }

    public function datakelasadminstore(Request $request)
    {
    }
}
