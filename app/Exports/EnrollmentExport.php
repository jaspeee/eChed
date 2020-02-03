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
            'Institutional Name',
            'Program Name',
            'Discipline',
            'Major Name',
            'Tuition',
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
            'TME',
            'TFE',
            'TE',
            'TMG',
            'TFG',
            'TG',
            'Institution Type',
        ];
    }

    public function collection()
    {
        return DB::table('collations')
        ->join('institutions','institutions.institutions_id', '=', 'collations.institutions_id')
        ->join('institution_types', 'institution_types.institution_types_id', '=', 'collations.institution_types_id')
        ->join('discipline_groups', 'discipline_groups.discipline_groups_id', '=', 'collations.discipline_groups_id')
        ->select('institutions.institution_name',
            'collations.program_name', 
            'discipline_groups.major_discipline', 
            'collations.major_name',
            'collations.tuition',
            'collations.0M',
            'collations.0F',
            'collations.1M',
            'collations.1F',
            'collations.2M',
            'collations.2F',
            'collations.3M',
            'collations.3F',
            'collations.4M',
            'collations.4F',
            'collations.5M',
            'collations.5F',
            'collations.6M',
            'collations.6F',
            'collations.7M',
            'collations.7F',
            'collations.TME',
            'collations.TFE',
            'collations.TE',
            'collations.TMG',
            'collations.TFG',
            'collations.TG',
            'institution_types.type')->get();

    }
}
