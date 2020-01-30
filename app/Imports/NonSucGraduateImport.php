<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class NonSucGraduateImport implements WithMultipleSheets
{   

    public function sheets(): array
    {
        return [
            1 => new NonSuc_DoctoralGradSheetImport(),
            2 => new NonSuc_MasteralGradSheetImport(),
            3 => new NonSuc_PostBaccalaureateGradSheetImport(),
            4 => new NonSuc_BaccalaureateGradSheetImport(),
            5 => new NonSuc_PreBaccalaureateGradSheetImport(),
            6 => new NonSuc_VocTechGradSheetImport(),
            7 => new NonSuc_BasicGradSheetImport(),

        ];
    }
}
