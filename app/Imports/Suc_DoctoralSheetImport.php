<?php

namespace App\Imports;

use App\Collation_enrollment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class Suc_DoctoralSheetImport implements ToModel,  WithStartRow, WithCalculatedFormulas
{   

    // public function mapping(): array
    // {
    //     return [
    //         'program_name'  => 'B13',
    //         'major_name' => 'D13',
    //         'male' => 'AH13',
    //         'female' => 'AI13',
    //         'total' => 'AM13',
    //     ];
    // }

    public function startRow(): int
    {
        return 13;
    }


    public function model(array $row)
    {    
        
        return new Collation_enrollment([

            'program_name' => $row[1],
            'major_name' => $row[3],
            'total_male' => $row[33],
            'total_female' => $row[34],
            'total_enrollment' => $row[35],
        ]);

    }

  
}