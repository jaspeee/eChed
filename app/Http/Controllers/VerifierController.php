<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use App\Form;
use App\Validate;
use App\Count;
use App\Verify;
use App\Employee_profile;
use App\Complete;
use App\Charts\InstitutionChart;
use App\Charts\VerifiedChart;
use App\Charts\SucVerifiedChart;
use App\Charts\StatNonSucChart;
use App\Charts\StatSucChart;
use Illuminate\Support\Str;
Use Carbon\Carbon;
use Hash; 
use App\Jobs\VerifierApprove;
use App\Jobs\VerifierDisapprove;
use App\Jobs\VerifierChangePass;
use App\Charts\StatusChart;
use Illuminate\Support\Facades\URL;
use App\Audit_log;
use RealRashid\SweetAlert\Facades\Alert;


class VerifierController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function getAllMonths()
    {
        $month_array = array();
        $SUC_dates = DB::table('verifies')
        ->join('users','verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('institutions','employee_profiles.institutions_id', '=','institutions.institutions_id')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->where('institution_types.type', 'NON-SUC')
        ->where('statuses.status', 'approve')->orderby('verifies.created_at','asc')->pluck('verifies.created_at');
 
        $SUC_dates = json_decode($SUC_dates);
         
        if( ! empty($SUC_dates) )
        {
            foreach($SUC_dates as $unformatted_date)
            {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_no] = $month_name;
                
            }
           
        }

        return  $month_array;

    }

    public function getMonthlyVerCount($month)
    {
   
        $monthly_ver_count = DB::table('verifies')
        ->join('users','verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('institutions','employee_profiles.institutions_id', '=','institutions.institutions_id')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->where('institution_types.type', 'NON-SUC')
        ->where('statuses.status', 'approve')->whereMonth('verifies.created_at', $month)->count();

        return $monthly_ver_count;

    }


    public function getAllMonthsSuc()
    {
        $month_array = array(); 
        $SUC_dates = DB::table('verifies')
        ->join('users','verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('institutions','employee_profiles.institutions_id', '=','institutions.institutions_id')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->where('institution_types.type', 'SUC')
        ->where('statuses.status', 'approve')->orderby('verifies.created_at','asc')->pluck('verifies.created_at');

        $SUC_dates = json_decode($SUC_dates);
        
        if( ! empty($SUC_dates) )
        {
            foreach($SUC_dates as $unformatted_date)
            {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_no] = $month_name;
                
            }
           
        }

        return  $month_array;

    }

    public function getMonthlyVerCountSuc($month)
    {
   
        $monthly_ver_count = DB::table('verifies')
        ->join('users','verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('institutions','employee_profiles.institutions_id', '=','institutions.institutions_id')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->where('institution_types.type', 'SUC')
        ->where('statuses.status', 'approve')->whereMonth('verifies.created_at', $month)->count();

        return $monthly_ver_count;

    }
 

    public function Page_dashboard()
    {   

         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
        

         //CHART
         $borderColors = [

            "rgba(0, 52, 113, 1.0)",
            "rgba(255, 206, 0, 1.0)",
           
        ];
        $fillColors = [
        
            "rgba(0, 52, 113, 0.7)",
            "rgba(255, 206, 0, 0.7)",
           

        ];
        $borderColors1 = [
            "rgba(16, 121, 16, 1.0)",
            "rgba(220, 0, 5, 1.0)",
           
        ];
        $fillColors1 = [
            "rgba(16, 121, 16, 0.7)",
            "rgba(220, 0, 5, 0.7)",
        ];

        //INSTITUTION
        $SUC = DB::table('institutions')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->where('institution_types.type', 'SUC')->count();

        $NONSUC = DB::table('institutions')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->where('institution_types.type', 'NON-SUC')->count();

        $total = $SUC + $NONSUC; 

       
        $chart = new InstitutionChart;
        $chart->labels(['SUC', 'NON-SUC']);
        $chart->dataset('Institutions', 'horizontalBar', [$SUC,  $NONSUC])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $chart->displayLegend(false);
        
        //VERIFIED

        //NON-SUC
        $monthly_ver_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if( ! empty($month_array))
        {
            foreach($month_array as $month_no => $month_name)
            {
                $monthly_ver_count = $this->getMonthlyVerCount($month_no);
                array_push($monthly_ver_count_array, $monthly_ver_count);
                array_push($month_name_array, $month_name);
            }
        }

        $charts = new VerifiedChart;
        $charts->labels([$month_name_array]);
        $charts->dataset('Non-SUC', 'line', $monthly_ver_count_array)
            ->color($borderColors)
            ->backgroundcolor($fillColors);
      
        $charts->displayLegend(false);

        //STATUS
        $NonSUC_Approve = DB::table('verifies')
        ->join('users','verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('institutions','employee_profiles.institutions_id', '=','institutions.institutions_id')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->where('institution_types.type', 'NON-SUC')
        ->where('statuses.status', 'approve')->count();

        $NonSUC_Disapprove = DB::table('verifies')
        ->join('users','verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('institutions','employee_profiles.institutions_id', '=','institutions.institutions_id')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->where('institution_types.type', 'NON-SUC')
        ->where('statuses.status', 'disapprove')->count();
        
       
        $StatNonSUC_charts = new StatNonSucChart;
        $StatNonSUC_charts->labels(['Approve','Disapprove']);
        $StatNonSUC_charts->dataset('Non-SUC', 'doughnut', [$NonSUC_Approve,$NonSUC_Disapprove])
            ->color($borderColors1)
            ->backgroundcolor($fillColors1);

        $StatNonSUC_charts->displayAxes(false);
        // $StatNonSUC_charts->displayLegend(false);


        //SUC
        $monthly_ver_count_arraySUC = array();
        $month_arrays = $this->getAllMonthsSuc();
        $month_name_arraySUC = array();
        if( ! empty($month_arrays))
        {
            foreach($month_arrays as $month_no => $month_name)
            {
                $monthly_ver_count = $this->getMonthlyVerCountSuc($month_no);
                array_push($monthly_ver_count_arraySUC, $monthly_ver_count);
                array_push($month_name_arraySUC, $month_name);
            }
        }

       
        $SUC_chart = new SucVerifiedChart;
        $SUC_chart->labels([$month_name_arraySUC]);
        $SUC_chart->dataset('SUC', 'line', $monthly_ver_count_arraySUC)
            ->color($borderColors)
            ->backgroundcolor($fillColors);
      
        $SUC_chart->displayLegend(false);

        //STATUS
        $SUC_Approve = DB::table('verifies')
        ->join('users','verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('institutions','employee_profiles.institutions_id', '=','institutions.institutions_id')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->where('institution_types.type', 'SUC')
        ->where('statuses.status', 'approve')->count();

        $SUC_Disapprove = DB::table('verifies')
        ->join('users','verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('institutions','employee_profiles.institutions_id', '=','institutions.institutions_id')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->where('institution_types.type', 'SUC')
        ->where('statuses.status', 'disapprove')->count();

        $StatSUC_charts = new StatSucChart;
        $StatSUC_charts->labels(['Approve','Disapprove']);
        $StatSUC_charts->dataset('Non-SUC', 'doughnut', [$SUC_Approve,$SUC_Disapprove])
            ->color($borderColors)
            ->backgroundcolor($fillColors);

        $StatSUC_charts->displayAxes(false);


        //GET THE LIST OF SUBMISSIONS VERIFIER
        $submissions = DB::table('verifies')
        ->join('users', 'verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('institutions','employee_profiles.institutions_id', '=','institutions.institutions_id')
        ->select('verifies.*','institutions.institution_name')
        ->orderby('verifies_id','desc')->limit(3)->get();
        
         //GET THE DEADLINES
         $deadline = DB::table('deadlines')
         ->join('users', 'deadlines.user_id', '=','users.id')
         ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
         ->select('deadlines.*', 'employee_profiles.first_name', 'employee_profiles.last_Name')
         ->orderby('id','desc')->limit(1)->get();
 
         //GET THE INSTITUTION
        //$school = DB::table('institutions')->where('institutions_id',$institution)->first()->institution_name;
        $date = Carbon::now();
        $dates = $date->toFormattedDateString();   
        


        $institutionID =  DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $HEI =  DB::table('institutions')->where('institutions_id',$institutionID)->first()->institution_name;
        

        //STATUS CHART
        $Approve = DB::table('verifies')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->where('statuses.status', 'approve')->count();

        $Disapprove = DB::table('verifies')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->where('statuses.status', 'disapprove')->count();
        
    
        $stat_chart = new StatusChart;
        $stat_chart->labels(['Approve','Disapprove']);
        $stat_chart->dataset('Status', 'doughnut', [$Approve,$Disapprove])
            ->color($borderColors1)
            ->backgroundcolor($fillColors1);

        $stat_chart->displayAxes(false);


        return view('verifier_pages.dashboard', compact('dates','deadline','submissions',
        'StatSUC_charts','StatNonSUC_charts','SUC_chart','charts',
        'total','chart','fname','lname','HEI','stat_chart'));
    }
    
    public function Page_verification()
    {
         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
         
         //GET THE LIST OF INSTITUTIONS
         $institutions = DB::table('institutions')
         ->join('counts', 'institutions.institutions_id', '=','counts.institutions_id')
         ->join('institution_types', 'institutions.institution_types_id', '=','institution_types.institution_types_id')
         ->select('institutions.*','counts.vcount','counts.fcount','institution_types.type')
         ->where('institution_name','!=','Commission on Higher Education')->get();

        return view('verifier_pages.verification', compact('institutions','fname','lname'));
    }

    public function Page_verify($ins_id) 
    {   
        //GET THE FIRST AND LAST NAME OF THE USER 
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;

        //GET THE SUBMITTED FILES OF A SPECIFIC INSTITUTION
        $files = DB::table('verifies')
        ->join('users', 'verifies.user_id', '=', 'users.id')
        ->join('employee_profiles', 'users.employee_profiles_id', '=', 'employee_profiles.employee_profiles_id')
        ->join('statuses', 'verifies.statuses_id', '=', 'statuses.statuses_id')
        ->select('verifies.*','employee_profiles.first_name','employee_profiles.last_Name','statuses.status')
        ->where('employee_profiles.institutions_id', $ins_id)
        ->whereNotIn('statuses.status', ['Active','Done'])->get(); 

        $institution = DB::table('institutions')->where('institutions_id',$ins_id)->first()->institution_name;

       return view('verifier_pages.verify', compact('files','fname','lname','institution'));
    }
    
    public function Page_password()
    {
         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
         
         $pos = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->position;
         $div = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->division;

         return view('verifier_pages.password', compact('pos','div','fname','lname'));
    } 


    public function Verify_approve(Request $request,$id)
    {   
         //GET THE FILE NAME 
        $filename = DB::table('verifies')->where('verifies_id', $id)->first()->validator_submission;
        
        $stat = DB::table('verifies')->where('verifies_id', $id)->first()->statuses_id;

        //GET THE FORM ID 
        $forms = DB::table('forms')->select('form','forms_id')->get();

        $user = DB::table('verifies')->where('verifies_id', $id)->first()->user_id;
        $employee = DB::table('users')->where('id', $user)->first()->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id', $employee)->first()->institutions_id;  
        $abbrv = DB::table('institutions')->where('institutions_id', $institution)->first()->abbreviation;  
         
        $filenames = Str::replaceLast('_'.$abbrv, '', $filename);

        $date = Carbon::now();
        $date=  $date->year;

        $filenames = Str::replaceLast('_'.$date, '', $filenames);
      
        // $res = Str::containsAll($filenames, ['.xls']) . '';

        $form_id = '0';
        foreach ($forms as $form ) 
        {   

            // if($res == 1)
            // {
            //     $file = Str::replaceLast('.xlsx', '.xls', $form->form);
            //     if($file  == $filenames) 
            //     {   
            //         $form_id = $form->forms_id;
                
            //     }
            // }
            // else
            // {
                if($form->form  == $filenames) 
                {   
                    $form_id = $form->forms_id;
                
                }
            // }

            
        }
 
        if($stat == '5')
        {
            return back()->with('warning', 'You cannot approve this file. Contact the specific validator for resubmission');
        }
        else if($stat == '4')
        {
            return back()->with('warning', 'You already approve this file');
        }
        else
        {   

            $id1 = auth()->id();
            //VerifierApprove::dispatch($id, $id1, $filename, $form_id);
 
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            //STORE DATA TO COMPLETE TABLE
            $comp = new Complete();
            $comp->user_id = auth()->id();
            $comp->verifier_submission = $filename;
            $comp->forms_id = $form_id;
            $comp->institutions_id = $institution;
            $comp->save();

           // COPY FILE TO ANOTHER STORAGE FOLDER 
            if(Storage::move('public/verify/'.$filename, 'public/complete/' .$filename))
            {
                return back()->with('success', 'Approves the file successfully');
            }

               //UPDATE THE VCOUNT IN COUNTS TABLE
               $user = DB::table('verifies')->where('verifies_id', $id)->first()->user_id;
               $employee = DB::table('users')->where('id', $user)->first()->employee_profiles_id;
               $institution = DB::table('employee_profiles')->where('employee_profiles_id', $employee)->first()->institutions_id;  
               $count = DB::table('counts')->where('institutions_id', $institution)->first()->fcount;
               $final_count = $count + 1;
               DB::update('update counts set fcount = ? where institutions_id = ?', [$final_count,$institution]);
            
               
            //UPDATE STATUS IN VALIDATES TABLE
            $status = '4';
            DB::update('update verifies set statuses_id = ? where verifies_id = ?', [$status,$id]);
          
            $audit = new Audit_log();
            $audit->user_id =  auth()->id();
            $audit->user_types_id = '3';
            $audit->event = 'approved';
            $audit->auditable_type = 'App\Verify';
            $audit->auditable_id = $id;
            $audit->old_values = '{status:pending}';
            $audit->new_values = '{status:approve}';
            $audit->url = URL::current();
            $audit->ip_address = \Request::ip();
            $audit->user_agent = $request->header('User-Agent');
            $audit->save();  

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');  
            return back()->with('success', 'Approves the file successfully');

        }
     
      
    }

    public function Verify_disapprove(Request $request,$id)
    {    
        $stat = DB::table('verifies')->where('verifies_id', $id)->first()->statuses_id;

        if($stat == '4')
        {
            return back()->with('warning', 'You cannot disapprove this file. Contact Ched Officer for cancelling the form');
        }
        else if($stat == '5')
        {
            return back()->with('warning', 'You already disapprove this file');
        } 
        else 
        {    
            $comment = $request->textarea;

            //VerifierDisapprove::dispatch($id, $comment);

           
            $comment1 = $comment . ' - Verifier'; 
            DB::table('validates')  
            ->where('encoder_submission',$val_sub)
            ->where('statuses_id','4') 
            ->update(['statuses_id' => '5', 'comment' => $comment1]);

            //UPDATE THE COMMENT IN VERIFIES TABLE
            DB::update('update verifies set comment = ? where verifies_id = ?', [$comment,$id]);
             
            //GET THE FILE NAME
            $filename = DB::table('verifies')->where('verifies_id', $id)->first()->validator_submission;
            
              //UPDATE THE VCOUNT IN COUNTS TABLE
              $user = DB::table('verifies')->where('verifies_id', $id)->first()->user_id;
              $employee = DB::table('users')->where('id', $user)->first()->employee_profiles_id;
              $institution = DB::table('employee_profiles')->where('employee_profiles_id', $employee)->first()->institutions_id;  
              $count = DB::table('counts')->where('institutions_id', $institution)->first()->vcount;
              $final_count = $count - 1;
              DB::update('update counts set fcount = ? where institutions_id = ?', [$final_count,$institution]);
  

            
            if(Storage::delete('public/verify/'.$filename))
            {
                return back()->with('success', 'Disapproves the file successfully');
            } 
            
             //UPDATE STATUS IN VALIDATES TABLE
             $val_sub = DB::table('verifies')->where('verifies_id', $id)->first()->validator_submission;


             //UPDATE STATUS IN VERIFIES TABLE
             $status = '5'; 
             DB::update('update verifies set statuses_id = ? where verifies_id = ?', [$status,$id]);
             
            $audit = new Audit_log();
            $audit->user_id =  auth()->id();
            $audit->user_types_id = '3';
            $audit->event = 'disapproved';
            $audit->auditable_type = 'App\Verify';
            $audit->auditable_id = $id;
            $audit->old_values = '{status:pending}';
            $audit->new_values = '{status:disapprove}';
            $audit->url = URL::current();
            $audit->ip_address = \Request::ip();
            $audit->user_agent = $request->header('User-Agent');
            $audit->save();  

            return back()->with('success', 'Disapproves the file successfully');

        }

        
    }
    
    public function Password_change(Request $request)
    {
        
         $id = auth()->id();
         $current_password = User::find($id)->password;
         
         if(Hash::check($request['old_password'], $current_password))
         {   

            //VerifierChangePass::dispatch($id, $request['password']);

             $user = User::find($id);
             $user->password = Hash::make($request['password']);
             $user->save();  
     
             
         }
         else{
            return back()->with('warning', 'Current password was incorrect');
         }
         return back()->with('success', 'Change password successfully');
    }

    public function Page_references()
    {
        
            //GET THE FORMS
           $id = auth()->id();
           $employee = DB::table('users')->find($id)->employee_profiles_id;
   
           //GET THE FIRST AND LAST NAME OF THE USER 
           $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
           $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
   
   
           //GET THE INSTITUTIONS
           $institutions = DB::table('institutions') ->where('institution_name','!=','Commission on Higher Education')->get();
           $discipline = DB::table('discipline_groups')->get();
   
           return view('verifier_pages.references',compact('discipline','institutions','fname','lname'));
       
    }

    public function audit_download(Request $request, $val)
    {    

        $form = DB::table('verifies')->where('verifies_id',$val)->first()->validator_submission;
        $status = DB::table('verifies')->where('verifies_id',$val)->first()->statuses_id;

        if( $status == 4)
        {
            return Storage::download('public/complete/'.$form);
        }
        else
        {
            return Storage::download('public/verify/'.$form);
        }


    }

}
