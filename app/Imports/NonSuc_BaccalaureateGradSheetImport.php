<?php

namespace App\Imports;

use App\Collation_graduate;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class NonSuc_BaccalaureateGradSheetImport implements ToModel,  WithStartRow, WithCalculatedFormulas
{   

    public function startRow(): int
    {
        return 10;
    }


    public function getID()
    {
        return DB::table('institution_ids')
        ->orderby('institution_ids_id','desc')->limit(1)->first()->institution;
    }

    public function model(array $row)
    {    
        if($row[0] == null)
        {
            return null;
        }
        else
        {
            return new Collation_graduate([
                'institutions_id' => $this->getID(), 
                'program_name' => $row[0], 
                'major_name' => $row[2],
                'total_male' => $row[36],
                'total_female' => $row[37],
                'total_graduate' => $row[38],
                'institution_types_id' => '2',
            ]);
        }

    }

    

  
}