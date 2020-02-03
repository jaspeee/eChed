<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class Suc_CollationImport implements WithMultipleSheets
{   

    
    public function sheets(): array
    {
        return [
            1 => new Suc_DoctoralSheetImport(),
            2 => new Suc_MasteralSheetImport(),
            3 => new Suc_PostBaccalaureateSheetImport(),
            4 => new Suc_BaccalaureateSheetImport(),
            5 => new Suc_PreBaccalaureateSheetImport(),
            6 => new Suc_VocTechSheetImport(),
            7 => new Suc_BasicSheetImport(),

        ];
    }
}
