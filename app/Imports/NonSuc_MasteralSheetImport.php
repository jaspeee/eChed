<?php

namespace App\Imports;

use App\Collation;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class NonSuc_MasteralSheetImport implements ToModel,  WithStartRow, WithCalculatedFormulas,
WithBatchInserts, WithChunkReading, ShouldQueue


{   

    public function startRow(): int
    {
        return 10;
    }


    public function getInstitutionID()
    {
        return DB::table('institution_ids')
        ->orderby('institution_ids_id','desc')->limit(1)->first()->institution;
    }

    public function getCollationID()
    {
        return DB::table('institution_ids')
        ->orderby('institution_ids_id','desc')->limit(1)->first()->collation;
    }

    public function model(array $row)
    {    
        if($row[0] == null)
        {
            return null;
        }
        else
        { 
            return new Collation([
                'institutions_id' => $this->getInstitutionID(), 
                'program_name' => $row[0], 
                'major_name' => $row[2],
                'discipline_groups_id' => '1',
                'tuition' => $row[15],
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
                'TME' => $row[33],
                'TFE' => $row[34],
                'TE' => $row[35],
                'TMG' => $row[36],
                'TFG' => $row[37],
                'TG' => $row[38],
                'institution_types_id' => '2',
                'collation_lists_id' => $this->getCollationID(), 
            ]);
        }
    }

    public function batchSize(): int
    {
        return 5;
    }

    public function chunkSize(): int
    {
        return 5;
    }
    
  
}