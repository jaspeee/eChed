<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SucImport;

class ReportsController extends Controller
{
    public function SUCimport() 
    {   
        $file = DB::table('completes')->where('forms_id','2')->get();
        //return $file;

        $storage_file = '';
        foreach($file as $files)
        {
           if (Storage::exists('public/complete/'.$files->verifier_submission)) 
           {
               //$path = Storage::get('public/complete/'.$files->verifier_submission);
               $path = storage_path('app/public/complete/'.$files->verifier_submission);
               Excel::import(new SucImport,  $path);
              
               return 'success';
           }
           else{
              return 'wala';
           }

        }
        
    }
}
