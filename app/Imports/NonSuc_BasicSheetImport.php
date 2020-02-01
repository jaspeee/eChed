<?php

namespace App\Imports;

use App\Collation_enrollment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class NonSuc_BasicSheetImport implements ToModel,  WithStartRow, WithCalculatedFormulas
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
            return new Collation_enrollment([
                'institutions_id' => $this->getID(), 
                'program_name' => $row[0], 
                'major_name' => $row[2],
                '0M' => $row[17],
                '0F' => $row[18],
                '1M' => $row[19],
                '1F' => $row[20],
                '2M' => $row[21],
                '2F' => $row[22],
                '3M' => $row[23],
                '3F' => $row[24],
                '4M' => $row[25], 
                '4F' => $row[26],
                '5M' => $row[27],
                '5F' => $row[28],
                '6M' => $row[29],
                '6F' => $row[30],
                '7M' => $row[31],
                '7F' => $row[32],
                'total_male' => $row[33],
                'total_female' => $row[34],
                'total_enrollment' => $row[35],
                'institution_types_id' => '2',
            ]);
        }

    }

    

  
}