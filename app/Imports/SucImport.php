<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SucImport implements WithMultipleSheets 
{
    public function sheets(): array
    {
        return [
            new Suc_DoctoralSheetImport(),

        ];
    }
}
