<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SucEnrollmentImport;
use App\Imports\SucGraduateImport;
use App\Imports\NonSucEnrollmentImport;
use App\Imports\NonSucGraduateImport;
use App\Imports\NonSuc_Doctoral;
use App\Exports\EnrollmentExport;
use App\InstitutionId;



class ReportsController extends Controller 
{   
    

    public function import() 
    {   
        $file = DB::table('completes')->where('forms_id','2')->get();
       
        foreach($file as $files)
        {
           if (Storage::exists('public/complete/'.$files->verifier_submission)) 
           {    

               
                //STORE DATA 
                $ins = new InstitutionId();
                $ins->institution = $files->institutions_id;
                $ins->save();

               //$path = Storage::get('public/complete/'.$files->verifier_submission);
               $path = storage_path('app/public/complete/'.$files->verifier_submission);
               Excel::import(new SucEnrollmentImport,  $path);
               Excel::import(new SucGraduateImport,  $path);
               
           }
           else{
              return 'wala';
           }

        }


        $NonSucfile = DB::table('completes')->where('forms_id','9')->get();
        //return $file; 

        foreach($NonSucfile as $files)
        {
           if (Storage::exists('public/complete/'.$files->verifier_submission)) 
           {    
            
    
                //STORE DATA 
                $ins = new InstitutionId();
                $ins->institution = $files->institutions_id;
                $ins->save();

               //$path = Storage::get('public/complete/'.$files->verifier_submission);
               $path = storage_path('app/public/complete/'.$files->verifier_submission);
               Excel::import(new NonSucEnrollmentImport,  $path);
               //Excel::import(new NonSucGraduateImport,  $path);
                
               return back(); 
           }
           else{ 
              return 'wala';
           }

        }

        
    }


    public function exports()
    {
        return Excel::download(new EnrollmentExport, 'EnrollmentCollation.xlsx');
    }

  
    
}
