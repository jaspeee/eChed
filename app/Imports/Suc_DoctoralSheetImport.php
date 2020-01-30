<?php

namespace App\Imports;

use App\Collation_enrollment;
use App\Collation_graduate;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Http\Controllers\ReportsController;
class Suc_DoctoralSheetImport implements ToModel,  WithStartRow, WithCalculatedFormulas
{   
    public $institutionsID=''; 

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
    
    public function ins()
    {
       return $this->institutionsID;
    }


    public function model(array $row)
    {    
        
        // $data =  $row[1];
        // $program = array();
        // $value = '';
        // $count = 0;
        // foreach( $data as $d) 
        // {
        //     $value = DB::select('select programs_id from programs where program_name = ?', [$d]);
        //     $program[$count] =  $value;
        //     $count = +1;
        // }
        
        $id = $this->ins();
    
        return new Collation_enrollment([
            
            //'institutions_id' => $id, 
            //'program_name' => $id, 
            'program_name' => $row[1], 
            'major_name' => $row[3],
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
            'institution_types_id' => '1',
        ]);



    }

    

  
}