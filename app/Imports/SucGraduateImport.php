<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class SucGraduateImport implements WithMultipleSheets
{   

    public function sheets(): array
    {
        return [
            0 => new Suc_DoctoralGradSheetImport(),
            1 => new Suc_MasteralGradSheetImport(),
            2 => new Suc_PostBaccalaureateGradSheetImport(),
            3 => new Suc_BaccalaureateGradSheetImport(),
            4 => new Suc_PreBaccalaureateGradSheetImport(),
            5 => new Suc_VocTechGradSheetImport(),
            6 => new Suc_BasicGradSheetImport(),

        ];
    }
}
