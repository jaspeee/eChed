<?php

namespace App\Imports;

use App\Collation_graduate;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class NonSuc_BasicGradSheetImport implements ToModel,  WithStartRow, WithCalculatedFormulas
{   

    public function startRow(): int
    {
        return 10;
    }


    public function model(array $row)
    {    
        return new Collation_graduate([

            'program_name' => $row[0], 
            'major_name' => $row[2],
            'total_male' => $row[36],
            'total_female' => $row[37],
            'total_graduate' => $row[38],
            'institution_types_id' => '2',
        ]);

    }

    

  
}