<?php

namespace App\Imports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class JadwalImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return Jadwal::create([
            'kelas_id' => $row['kelas_id'],
            'jenjang_pendidikan_id' => $row['jenjang_pendidikan_id'],
            'ruangan_id' => $row['ruangan_id'],
            'guru_id' => $row['guru_id'],
            'mata_pelajaran_id' => $row['mata_pelajaran_id'],
            'tingkatan_id' => $row['tingkatan_id'],
            'hari_id' => $row['hari_id'],
        ]);
    }
}
