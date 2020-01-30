<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnrollmentExport implements FromCollection,  ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'Program Name',
            'Major Name',
            '0M',
            '0F',
            '1M',
            '1F',
            '2M',
            '2F',
            '3M',
            '3F',
            '4M',
            '4F',
            '5M',
            '5F',
            '6M',
            '6F',
            '7M',
            '7F',
            'Total Male',
            'Total Female',
            'Total Enrollment',
            'Institution Type',
        ];
    }

    public function collection()
    {
        return DB::table('collation_enrollments')
        ->join('institution_types', 'institution_types.institution_types_id', '=', 'collation_enrollments.institution_types_id')
        ->select('collation_enrollments.program_name', 'collation_enrollments.major_name',
        'collation_enrollments.total_male','collation_enrollments.total_female','collation_enrollments.total_enrollment',
        'institution_types.type')->get();

    }
}
