<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function import() 
    {   
        
        // Excel::import(new UsersImport, 'users.xlsx');
        
        // return redirect('/')->with('success', 'All good!');
    }
}
