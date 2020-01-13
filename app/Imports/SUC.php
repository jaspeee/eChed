<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SUC implements WithMultipleSheets 
{
    public function sheets(): array
    {
        return [
            new FirstSheetImport(),
            new SecondSheetImport(),
            new ThirdSheetImport()
        ];
    }
}
