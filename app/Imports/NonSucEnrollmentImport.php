<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class NonSucEnrollmentImport implements WithMultipleSheets
{   

    
    public function sheets(): array
    {
        return [
            1 => new NonSuc_Doctoral(),
            2 => new NonSuc_MasteralSheetImport(),
            3 => new NonSuc_PostBaccalaureateSheetImport(),
            4 => new NonSuc_BaccalaureateSheetImport(),
            5 => new NonSuc_PreBaccalaureateSheetImport(),
            6 => new NonSuc_VocTechSheetImport(),
            7 => new NonSuc_BasicSheetImport(),

        ];
    }
}
