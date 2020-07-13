<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuditLogsExport implements FromCollection,  ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'User Type',
            'Event',
            'Auditable Type',
            'Old Values',
            'Url',
            'New Values',
            'IP Address',
            'User Agent',
            'Date',
        ];
    }
    
    public function collection()
    {
        $sdate = DB::table('audit_lists')
        ->orderby('audit_lists_id','desc')->limit(1)->first()->date_start;

        $edate = DB::table('audit_lists')
        ->orderby('audit_lists_id','desc')->limit(1)->first()->date_end;

        return DB::table('audit_logs')
        ->select('employee_profiles.first_name','employee_profiles.last_Name',
        'user_types.type','audit_logs.event','audit_logs.auditable_type',
        'audit_logs.old_values','audit_logs.url','audit_logs.new_values',
        'audit_logs.ip_address','audit_logs.user_agent','audit_logs.created_at')
        ->join('users', 'audit_logs.user_id', '=','users.id')
        ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('user_types','user_types.user_types_id', '=', 'audit_logs.user_types_id')
        ->whereBetween('audit_logs.created_at',[$sdate, $edate])
        ->get();
    }
}
