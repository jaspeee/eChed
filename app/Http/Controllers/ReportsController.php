<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Suc_CollationImport;
use App\Imports\NonSuc_CollationImport;
use App\Exports\EnrollmentExport;
use App\InstitutionId;
Use Carbon\Carbon;


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
               Excel::import(new Suc_CollationImport,  $path);
               
               
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
               Excel::import(new NonSuc_CollationImport,  $path);
                
              
           } 
           else{ 
              return 'wala';
           } 

        }

        // $data = DB::table('collations')->get();
        // $prog = DB::table('programs')->get();

        // $prog_name='';
        // $discpline_id='';
        // $idd = '';
        // foreach($data as $d)
        // {   
        //     $prog_name = $d->program_name;
        //     $idd = $d->collations_id;
            
        //     foreach($prog as $p)
        //     {
        //         if( $prog_name == $p->program_name)
        //         {
        //             $discpline_id = $p->discipline_groups_id;
        //         }
        //         else
        //         {
        //             $discpline_id = '1';
        //         }
        //     }

        //     DB::update('update collations set discipline_groups_id = ? where collations_id = ?', [$discpline_id,$idd]);

        // }

        return back();

    }


    public function exports()
    {   
        $date = Carbon::now();
        $dates = $date->toDateString();             

        $name = 'Collation_'. $dates.'.xlsx';
        return Excel::download(new EnrollmentExport, $name);
    }

  
    
}
