<?php

namespace App\Imports;

use App\Collation_graduate;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class Suc_BaccalaureateGradSheetImport implements ToModel,  WithStartRow, WithCalculatedFormulas
{   

    public function startRow(): int
    {
        return 13;
    }


    public function model(array $row)
    {    
    
        return new Collation_graduate([
        
            'program_name' => $row[1], 
            'major_name' => $row[3],
            'total_male' => $row[39],
            'total_female' => $row[40],
            'total_graduate' => $row[41],
            'institution_types_id' => '1',
        ]);



    }

    

  
}