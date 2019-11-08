<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMappedCells;
//use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class UsersImport implements WithMappedCells, ToArray
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    //use Importable;

    public function mapping(): array
    {
        return [
            'departement' => 'A3',
            'pic' => 'B3',
            'anggaran_tahun' => 'C3',
            'sds' => 'D3',
            'anggaran_bulan' => 'E3',
            'ytd' => 'F3',
            'last_month' => 'G3',
            'saving_ytd' => 'H3',
            'not_use' => 'I3',
        ];
    }

    public function array(array $row)
    {
        return [ 
            'departement' => $row['departement'],
            'pic' => $row['pic'],
            'anggaran_tahun' => $row['anggaran_tahun'],
            'sds' => $row['sds'],
            'anggaran_bulan' => $row['anggaran_bulan'],
            'ytd' => $row['ytd'],
            'last_month' => $row['last_month'],
            'saving_ytd' => $row['saving_ytd'],
            'not_use' => $row['not_use'],
           
        ];
    }
}