<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ExportsController extends Controller
{
    public function exports()
    {
        return Excel::download(new EnrollmentExport, 'EnrollmentCollation.xlsx');
    }
}
