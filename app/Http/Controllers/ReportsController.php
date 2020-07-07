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
use App\Collation; 
Use Carbon\Carbon;
use App\Collation_list; 
use App\Audit_log; 
use RealRashid\SweetAlert\Facades\Alert;


class ReportsController extends Controller 
{   
     
    
    public function addcollation(Request $request)
    {   
           //ADD COLLATION 
           $col = new Collation_list();
           $col->collate_name = request('cname');
           $col->date_start = request('sdate');
           $col->date_end = request('edate');
           $col->save();
            

           //IMPORT EXCEL
           $sdate =  request('sdate');
           $edate = request('edate');

         

          $collationID = DB::table('collation_lists')->orderBy('collation_lists_id', 'DESC')->first()->collation_lists_id;
     

           //SUC IMPORT
           $file = DB::table('archives')
           ->whereBetween('created_at',[$sdate, $edate])
           ->where('forms_id','2')
           ->get();


           foreach($file as $files)
           {
              if (Storage::exists('public/archives/'.$files->file)) 
              {    
   
                   //STORE DATA 
                   $ins = new InstitutionId();
                   $ins->institution = $files->institutions_id;
                   $ins->collation =  $collationID;
                   $ins->save(); 
   
                
                  $path = storage_path('app/public/archives/'.$files->file);
                  Excel::import(new Suc_CollationImport,  $path);
                  
                  
              }
              else{
                
              }
   
           }

           //NON SUC IMPORT

           $NonSucfile = DB::table('archives')
           ->whereBetween('created_at',[$sdate, $edate])
           ->where('forms_id','9')->get();
        
           foreach($NonSucfile as $files)
           {
              if (Storage::exists('public/archives/'.$files->file)) 
              {    
               
                   //STORE DATA 
                   $ins = new InstitutionId();
                   $ins->institution = $files->institutions_id;
                   $ins->collation =  $collationID;
                   $ins->save();
    
               
                  $path = storage_path('app/public/archives/'.$files->file);
                  Excel::import(new NonSuc_CollationImport,  $path);
                   
                 
              } 
              else{ 
                
              } 
   
           }

        
           $data = DB::table('collations')->get();
           $prog = DB::table('programs')->get();
   
           $prog_name='';
           $discpline_id='';
           $idd = '';
   
           foreach($data as $d)
           {   
               $prog_name = $d->program_name;
               $idd = $d->collations_id;
               
               //return  $prog_name . ''. $idd;
            
               foreach($prog as $p)
               { 
                   if( $prog_name == $p->program_name)
                   {
                       $discpline_id = $p->discipline_groups_id;

                        break;
                       //return $discpline_id;
                   }
                   else
                   {
                        $discpline_id = '22';
                      
                   }
                  
               }
               
               DB::statement('SET FOREIGN_KEY_CHECKS=0;');
               DB::update('update collations set discipline_groups_id = ? where collations_id = ?', [$discpline_id,$idd]);
            //    $discpline_id='22';
              
           }
           DB::statement('SET FOREIGN_KEY_CHECKS=1;');  
        return back()->with('success', 'Added new collation successfully');

    
    }

    public function import() 
    {   

        $file = DB::table('archives')
        ->whereBetween('created_at',[])
        ->where('forms_id','2')
        ->get();

        // $file = DB::table('archives')
        // ->whereBetween('statuses_id','4')
        // ->where('forms_id','2')
        // ->where('created_at','4')
        // ->get();
       
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

    
        $NonSucfile = DB::table('completes')->where('forms_id','9')
        ->where('statuses_id','4')->get();
        //return $file; 


      

        foreach($NonSucfile as $files)
        {
           if (Storage::exists('public/complete/'.$files->verifier_submission)) 
           {    
            
     
                //STORE DATA 
                $ins = new InstitutionId();
                $ins->institution = $files->institutions_id;
                $ins->collation =  $collationID;
                $ins->save();
 
               //$path = Storage::get('public/complete/'.$files->verifier_submission);
               $path = storage_path('app/public/complete/'.$files->verifier_submission);
               Excel::import(new NonSuc_CollationImport,  $path);
                
              
           } 
           else{ 
              return 'wala';
           } 

        }

        $data = DB::table('collations')->get();
        $prog = DB::table('programs')->get();

        $prog_name='';
        $discpline_id='';
        $idd = '';

        foreach($data as $d)
        {   
            $prog_name = $d->program_name;
            $idd = $d->collations_id;
            
            //return  $prog_name . ''. $idd;
         
            foreach($prog as $p)
            { 
                if( $prog_name == $p->program_name)
                {
                    $discpline_id = $p->discipline_groups_id;

                    //return $discpline_id;
                }
               
            }
            
            DB::update('update collations set discipline_groups_id = ? where collations_id = ?', [$discpline_id,$idd]);
            $discpline_id='22';
           
        }

        $audit = new Audit_log();
        $audit->user_id =  auth()->id();
        $audit->user_types_id = '4'; 
        $audit->event = 'Import';
        $audit->auditable_type = 'App\Collation';
        $audit->auditable_id = '';
        $audit->old_values = '';
        $audit->new_values = 'Collate SUC Files';
        $audit->url = URL::current();
        $audit->ip_address = \Request::ip();
        $audit->user_agent = $request->header('User-Agent');
        $audit->save();  

        $audit = new Audit_log();
        $audit->user_id =  auth()->id();
        $audit->user_types_id = '4'; 
        $audit->event = 'Import';
        $audit->auditable_type = 'App\Collation';
        $audit->auditable_id = '';
        $audit->old_values = '';
        $audit->new_values = 'Collate NonSUC Files';
        $audit->url = URL::current();
        $audit->ip_address = \Request::ip();
        $audit->user_agent = $request->header('User-Agent');
        $audit->save();  

        return  back()->with('success', 'Collated the files successfully');

    }

    

    public function exports(Request $request, $id)
    {   
        
         //STORE DATA 
         $ins = new InstitutionId();
         $ins->institution = '0';
         $ins->collation =  $id;
         $ins->save(); 

        $date = Carbon::now();
        $dates = $date->toDateString();             

        $name = 'Collation_'. $dates.'.xlsx';

        // $audit = new Audit_log();
        // $audit->user_id =  auth()->id();
        // $audit->user_types_id = '4'; 
        // $audit->event = 'Import';
        // $audit->auditable_type = 'App\Collation';
        // $audit->auditable_id = '';
        // $audit->old_values = '';
        // $audit->new_values = 'Export File';
        // $audit->url = URL::current();
        // $audit->ip_address = \Request::ip();
        // $audit->user_agent = $request->header('User-Agent');
        // $audit->save();  
        

        return Excel::download(new EnrollmentExport, $name);
    }

  
    
}
