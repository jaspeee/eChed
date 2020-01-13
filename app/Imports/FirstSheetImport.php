<?php

namespace App\Imports;

use App\Sample;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Sample([
            'name' => $row['name'],
            'total' => $row['total'],
        ]);
    }
}