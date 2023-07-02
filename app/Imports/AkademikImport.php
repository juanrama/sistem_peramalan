<?php

namespace App\Imports;

use App\Models\Akademik;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AkademikImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Akademik([
            'id_mhs' => $row['id_mhs'],
            'angkatan' => $row['angkatan'],
            'id_prodi' => $row['id_prodi'],
            'kabupaten' => $row['kabupaten'],
            'jk' => $row['jk'],
            'sma' => $row['sma'],
            'q_kab' => $row['q_kab'],
            'q_jk' => $row['q_jk'],
            'q_sma' => $row['q_sma'],
            'semester_1' => $row['semester_1'],
            'semester_2' => $row['semester_2'],
            'semester_3' => $row['semester_3'],
            'semester_4' => $row['semester_4'],
            'semester_5' => $row['semester_5'],
        ]);
    }
}
