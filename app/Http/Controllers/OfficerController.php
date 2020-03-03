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
use App\Deadline;
use App\Institution;
use App\Charts\TotalEGChar;
use App\Charts\TotalMFChar;
use App\Charts\TotalGradMFChart;
use App\Charts\TotalNonSucEGChart;
use App\Charts\TotalNonSucMFChart;
use App\Charts\TotalNonSucGradMFChart;
use Illuminate\Support\Str;
use Hash;
use App\Charts\DG;
use App\Charts\CollegeE;
use App\Charts\Courses;
use App\Charts\CollegeG;
use App\Charts\Programs;
use App\Charts\Gender;
use App\Charts\Male;
use App\Charts\Female;
use App\Jobs\OfficerAddAccVerifier;
use App\Jobs\OfficerAccStatusVerifier;
use App\Jobs\OfficerAddAccValidator;
use App\Jobs\OfficerAccStatusValidator;
use App\Jobs\OfficerAddAccOfficer;
Use Carbon\Carbon;
use App\Charts\InstitutionChart;
use App\Charts\StatusChart;
use App\Jobs\OfficerApprove;
use App\Jobs\OfficerDisapprove;


class OfficerController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');

    }
     
    public function Page_dashboard()
    {   
         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
        
        //GET THE DEADLINE
        $deadline = DB::table('deadlines')
        ->join('users', 'deadlines.user_id', '=','users.id')
        ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->select('deadlines.*', 'employee_profiles.first_name', 'employee_profiles.last_Name')->paginate(1);

        $date = Carbon::now();
        $dates = $date->toFormattedDateString();  
        $institutionID =  DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $HEI =  DB::table('institutions')->where('institutions_id',$institutionID)->first()->institution_name;
        
        //GET THE VERIFIER SUBMISSIONS
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $submissions = DB::table('completes')
        ->join('users', 'completes.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->select('completes.*','employee_profiles.first_name','employee_profiles.last_Name')
        ->orderby('completes_id','desc')->limit(3)->get();


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

        //INSTITUTION CHART
        $SUC = DB::table('institutions')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->where('institution_types.type', 'SUC')->count();

        $NONSUC = DB::table('institutions')
        ->join('institution_types','institutions.institution_types_id', '=','institution_types.institution_types_id')
        ->where('institution_types.type', 'NON-SUC')->count();

        $total = $SUC + $NONSUC; 

        $ins_chart = new InstitutionChart;
        $ins_chart->labels(['SUC', 'NON-SUC']);
        $ins_chart->dataset('Institutions', 'horizontalBar', [$SUC,  $NONSUC])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $ins_chart->displayLegend(false);

        //STATUS CHART
         $Approve = DB::table('completes')
         ->join('statuses','completes.statuses_id', '=','statuses.statuses_id')
         ->where('statuses.status', 'approve')->count();
 
         $Disapprove = DB::table('completes')
         ->join('statuses','completes.statuses_id', '=','statuses.statuses_id')
         ->where('statuses.status', 'disapprove')->count();
  
         $stat_chart = new StatusChart;
         $stat_chart->labels(['Approve','Disapprove']);
         $stat_chart->dataset('Status', 'doughnut', [$Approve,$Disapprove])
             ->color($borderColors1)
             ->backgroundcolor($fillColors1);
 
         $stat_chart->displayAxes(false);
        
         
          //GET THE REQUEST 
          $request = DB::table('concerns')
          ->join('users', 'concerns.user_id', '=','users.id')
          ->join('user_types', 'users.user_types_id', '=','user_types.user_types_id')
          ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
          ->select('concerns.*', 'employee_profiles.first_name', 'employee_profiles.last_Name','user_types.type')
          ->where('users.user_types_id', '<>', '1')
          ->orderby('concerns_id','desc')->limit(3)->get();
 
        return view('officer_pages.dashboard', compact('deadline','fname',
        'lname','dates','HEI','request',
        'submissions','ins_chart','total','stat_chart'));

    } 

    public function Page_finalization()
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


        return view('officer_pages.finalization', compact('institutions','fname','lname'));
    }
    
    public function Page_reports()
    {
         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
        

         //GET THE COMPLETED FILES
         $files = DB::table('completes')
        ->join('institutions', 'completes.institutions_id', '=', 'institutions.institutions_id')
        ->select('completes.*','institutions.institution_name')
        ->where('completes.statuses_id','4')
        ->get();
        

        return view('officer_pages.reports', compact('fname','lname','files'));
    }
    
    public function Page_deadline()
    {
         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
 
        return view('officer_pages.deadline', compact('fname','lname'));
    }

    public function Page_final($ins_id)
    {
         //GET THE FIRST AND LAST NAME OF THE USER  
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;

         //GET THE SUBMITTED FILES OF A SPECIFIC INSTITUTION
         $files = DB::table('completes')
        ->join('users', 'completes.user_id', '=', 'users.id') 
        ->join('employee_profiles', 'users.employee_profiles_id', '=', 'employee_profiles.employee_profiles_id')
        ->join('statuses', 'completes.statuses_id', '=', 'statuses.statuses_id')
        ->select('completes.*','employee_profiles.first_name','employee_profiles.last_Name','statuses.status')
        ->where('completes.institutions_id', $ins_id)->get();
         
        $institution = DB::table('institutions')->where('institutions_id',$ins_id)->first()->institution_name;

        //return $files;
         return view('officer_pages.final', compact('files','fname','lname','institution'));

    } 

    public function Page_account()
    {
        //GET THE FIRST AND LAST NAME OF THE USER 
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;

       return view('officer_pages.accounts', compact('fname','lname'));
    }

    public function Page_account_verifier()
    {
        //GET THE FIRST AND LAST NAME OF THE USER 
        $id = auth()->id(); 
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;

        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $type = '3'; 
        $account = DB::table('users')
        ->join('employee_profiles', 'users.employee_profiles_id', '=', 'employee_profiles.employee_profiles_id')
        ->join('statuses', 'users.statuses_id', '=', 'statuses.statuses_id')
        ->select('users.*','employee_profiles.first_name', 'employee_profiles.last_Name', 
           'employee_profiles.position', 'employee_profiles.division','statuses.status')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('users.user_types_id', $type)->get();
  

       return view('officer_pages.verifier_acc', compact('account','fname','lname'));
    }

    public function Page_account_validator()
    {
        //GET THE FIRST AND LAST NAME OF THE USER 
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;

        $type = '2';
        $account = DB::table('users')
        ->join('employee_profiles', 'users.employee_profiles_id', '=', 'employee_profiles.employee_profiles_id')
        ->join('institutions', 'institutions.institutions_id', '=', 'employee_profiles.institutions_id')
        ->join('statuses', 'users.statuses_id', '=', 'statuses.statuses_id')
        ->select('users.*','employee_profiles.first_name', 'employee_profiles.last_Name', 
           'employee_profiles.position', 'employee_profiles.division','institutions.institution_name','statuses.status')
        ->where('users.user_types_id', $type)->get();

        $institution = DB::table('institutions')->get();
        return view('officer_pages.validator_acc', compact('account','institution','fname','lname'));
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

         return view('officer_pages.password', compact('pos','div','fname','lname'));
    }


    public function Account_verifier_status($status, $id)
    {   

        OfficerAccStatusVerifier::dispatch($id,$status);
 
        if($status == 'Active')
        {   
            // $user = User::find($id);
            // $user ->statuses_id = '2';
            // $user ->save(); 
             
            return back()->with('success', 'Deactivate the account successfully');
        }else{ 

            // $user = User::find($id);
            // $user ->statuses_id = '1';
            // $user ->save(); 

            return back()->with('success', 'Activate the account successfully');
        }
 
    }

    public function Account_verifier_add(Request $request)
    {  

        $id = auth()->id();
        $fname = request('fname');
        $lname = request('lname');
        $email = request('email');
        $position = request('position');
        $division = request('division');

        OfficerAddAccVerifier::dispatch($id,$fname,$lname,$email,$position,$division);

        // //GET THE INSTITUTION ID
        // $employee = DB::table('users')->find($id)->employee_profiles_id;
        // $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
     
        // //ADD EMPLOYEE
        // $emp = new Employee_profile();
        // $emp->first_name = request('fname');
        // $emp->last_Name = request('lname');
        // $emp->position = request('position');
        // $emp->division = request('division');
        // $emp->institutions_id = $institution;
        // $emp->save();
        
        // //ADD USER
        // $users = $request->fname . '' . $request->lname . '123'; 
        // $pass = 'verifier123';

        // $emp_id =  DB::table('employee_profiles')->latest()->first()->employee_profiles_id; 
        // $hashpass = Hash::make($pass);

        // $user = new User();
        // $user->username = $users;
        // $user->email = $request->email;
        // $user->password = $hashpass;
        // $user->employee_profiles_id = $emp_id;
        // $user->user_types_id = '3';
        // $user->statuses_id = '1';
        // $user->save();        


        return  back()->with('success', 'Added a new account successfully');
 
    }

    public function Account_validator_add(Request $request)
    {    

        $id = auth()->id();
        $fname = request('fname');
        $lname = request('lname');
        $email = request('email');
        $position = request('position');
        $division = request('division');
        $institution1 = $request->institution;

        OfficerAddAccValidator::dispatch($id,$fname,$lname,$email,$position,$division,$institution1);

        // //GET THE INSTITUTION ID
        // $employee = DB::table('users')->find($id)->employee_profiles_id;
        // $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
     
        // //ADD EMPLOYEE
        // $emp = new Employee_profile();
        // $emp->first_name = request('fname');
        // $emp->last_Name = request('lname');
        // $emp->position = request('position');
        // $emp->division = request('division');
        // $emp->institutions_id = $request->institution;
        // $emp->save();
        
        // //ADD USER
        // $users = $request->fname . '' . $request->lname . '123';
        // $pass = 'validator12345678';

        // $emp_id =  DB::table('employee_profiles')->latest()->first()->employee_profiles_id; 
        // $hashpass = Hash::make($pass);

        // $user = new User();
        // $user->username = $users;
        // $user->email = $request->email;
        // $user->password = $hashpass;
        // $user->employee_profiles_id = $emp_id;
        // $user->user_types_id = '2';
        // $user->statuses_id = '1';
        // $user->save();      
        

        return  back()->with('success', 'Added a new account successfully');
    }

    public function Password_change(Request $request)
    {
        
        $id = auth()->id();
         $current_password = User::find($id)->password;
         
         if(Hash::check($request['old_password'], $current_password))
         {   
            
             $user = User::find($id);
             $user->password = Hash::make($request['password']);
             $user->save(); 
             
            
         }
         else{
             return back();
         }
         return back();
    }
    
    public function Deadline_add(Request $request)
    {   

        $id = auth()->id();

        $user = new Deadline();
        $user->user_id = $id;
        $user->message = $request->note;
        $user->deadline_date = $request->date;
        $user->save();     
        
        return back()->with('success', 'Set the deadline successfully');
    }

    public function Page_collation() 
    {
         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
        
        //GET THE DEADLINE
        $SUC = DB::table('collations')->where('institution_types_id','1')->get();
        $NONSUC= DB::table('collations')->where('institution_types_id','2')->get();
      
        return view('officer_pages.collation', compact('SUC','NONSUC','fname','lname'));
    }

    public function Page_analytics()
    {
         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
        
         
      
         //CHART
         $borderColors = [
         
            "rgba(177, 48, 40)"
        ];
        $fillColors = [
            
            "rgba(250, 161, 155)"
        ];

    
        $LinedgColor1 = [
            "rgba(255, 206, 0, 1.0)",
            "rgba(255, 206, 0, 1.0)",
            "rgba(255, 206, 0, 1.0)",
            "rgba(255, 206, 0, 1.0)",
            "rgba(255, 206, 0, 1.0)",
            
        ];
        $FilldgColor1 = [
            "rgba(255, 206, 0, 0.8)",
            "rgba(255, 206, 0, 0.7)",
            "rgba(255, 206, 0, 0.5)",
            "rgba(255, 206, 0, 0.4)",
            "rgba(255, 206, 0, 0.3)",
            
        ];

        //TOP 5 DISCIPLINE GROUP
        $DG1 = DB::table('collations')
        ->join('discipline_groups', 'discipline_groups.discipline_groups_id', '=','collations.discipline_groups_id')
        ->select(DB::raw("SUM(TE+TG) as Total"))
        ->groupBy('discipline_groups.major_discipline')
         //->where('institution_types_id','2')
        ->orderby('Total','desc')->first()->Total;

        $DG2 = DB::table('collations')
        ->join('discipline_groups', 'discipline_groups.discipline_groups_id', '=','collations.discipline_groups_id')
        ->select(DB::raw("SUM(TE+TG) as Total"))
        ->groupBy('discipline_groups.major_discipline')
        ->orderby('Total','desc')->skip(1)->first()->Total;
        
        $DG3 = DB::table('collations')
        ->join('discipline_groups', 'discipline_groups.discipline_groups_id', '=','collations.discipline_groups_id')
        ->select(DB::raw("SUM(TE+TG) as Total"))
        ->groupBy('discipline_groups.major_discipline')
        ->orderby('Total','desc')->skip(2)->first()->Total;

        $DG4 = DB::table('collations') 
        ->join('discipline_groups', 'discipline_groups.discipline_groups_id', '=','collations.discipline_groups_id')
        ->select(DB::raw("SUM(TE+TG) as Total"))
        ->groupBy('discipline_groups.major_discipline')
        ->orderby('Total','desc')->skip(3)->first()->Total;

        $DG5 = DB::table('collations')
        ->join('discipline_groups', 'discipline_groups.discipline_groups_id', '=','collations.discipline_groups_id')
        ->select(DB::raw("SUM(TE+TG) as Total"))
        ->groupBy('discipline_groups.major_discipline')
        ->orderby('Total','desc')->skip(4)->first()->Total;

        $DG = DB::table('collations')
        ->join('discipline_groups', 'discipline_groups.discipline_groups_id', '=','collations.discipline_groups_id')
        ->select(DB::raw("SUM(TE+TG) as Total"),'discipline_groups.major_discipline')
        ->groupBy('discipline_groups.major_discipline')
        ->orderby('Total','desc')
        ->limit(5)->get();
      

        $Discipline = new DG;
        $Discipline->labels(['Top 1', 
        'Top 2',
        'Top 3',
        'Top 4',
        'Top 5',
        ]);

        $Discipline->dataset('NON SUC', 'horizontalBar', 
            [$DG1,
            $DG2,  
            $DG3, 
            $DG4, 
            $DG5,
            ])
            ->color($LinedgColor1)
            ->backgroundcolor($FilldgColor1);

        $Discipline->displayLegend(false);

            //return  $SUC_DG;



         //TOP 10 COLLEGE ENROLLMENTS
         $College_E1 = DB::table('collations')
         ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->first()->Total;

         $College_E2 = DB::table('collations')
         ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->skip(1)->first()->Total;

         $College_E3 = DB::table('collations')
         ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->skip(2)->first()->Total;

         $College_E4 = DB::table('collations')
         ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->skip(3)->first()->Total;

         $College_E5 = DB::table('collations')
         ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->skip(4)->first()->Total;

         $College_E6 = DB::table('collations')
         ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->skip(5)->first()->Total;

         $College_E7 = DB::table('collations')
         ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->skip(6)->first()->Total;

         $College_E8 = DB::table('collations')
         ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->skip(7)->first()->Total;

         $College_E9 = DB::table('collations')
         ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->skip(8)->first()->Total;

        //  $College_E10 = DB::table('collations')
        //  ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
        //  ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
        //  ->groupBy('institutions.institution_name')
        //  ->orderby('Total','desc')->skip(9)->first()->Total;
        
       
        $College_E = DB::table('collations')
        ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TE) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->limit(10)->get();

         $LineCollegeColor1 = [
            "rgba(220, 0, 5, 1.0)",
            "rgba(220, 0, 5, 1.0)",
            "rgba(220, 0, 5, 1.0)",
            "rgba(220, 0, 5, 1.0)",
            "rgba(220, 0, 5, 1.0)",
            "rgba(220, 0, 5, 1.0)",
            "rgba(220, 0, 5, 1.0)",
            "rgba(220, 0, 5, 1.0)",
            "rgba(220, 0, 5, 1.0)",
            "rgba(220, 0, 5, 1.0)",
        ];
        $FillCollegeColor1 = [
            "rgba(220, 0, 5, 0.8)",
            "rgba(220, 0, 5, 0.8)",
            "rgba(220, 0, 5, 0.7)",
            "rgba(220, 0, 5, 0.7)",
            "rgba(220, 0, 5, 0.6)",
            "rgba(220, 0, 5, 0.6)",
            "rgba(220, 0, 5, 0.5)",
            "rgba(220, 0, 5, 0.5)",
            "rgba(220, 0, 5, 0.4)",
            "rgba(220, 0, 5, 0.4)",
            
        ];

         $ce = new CollegeE;
         $ce->labels(['Top 1',
            'Top 2',
            'Top 3',
            'Top 4',
            'Top 5',
            'Top 6', 
            'Top 7',
            'Top 8',
            'Top 9',
            'Top 10',
        ]);
 
         $ce->dataset('NON SUC', 'bar', 
             [$College_E1,
                $College_E2,
                $College_E3,
                $College_E4,
                $College_E5,
                $College_E6,
                $College_E7,
                $College_E8,
                $College_E9,
                // $College_E10,
             ])
 
             ->color($LineCollegeColor1)
             ->backgroundcolor($FillCollegeColor1);
 
         $ce->displayLegend(false);

        
         $LineCourseColor1 = [
            "rgba(0, 52, 113, 1.0)",
            "rgba(0, 52, 113, 1.0)",
            "rgba(0, 52, 113, 1.0)",
            "rgba(0, 52, 113, 1.0)",
            "rgba(0, 52, 113, 1.0)",
           
        ];
        $FillCourseColor1 = [
            "rgba(0, 52, 113, 0.8)",
            "rgba(0, 52, 113, 0.7)",
            "rgba(0, 52, 113, 0.6)",
            "rgba(0, 52, 113, 0.5)",
            "rgba(0, 52, 113, 0.4)",
            
        ];

        //TOP 5 COURSES ENROLLEES


        $Courses_E = DB::table('collations')
        ->select(DB::raw("SUM(TE) as Total"),'program_name')
         ->groupBy('program_name')
         ->orderby('Total','desc')->limit(5)->get();
        

         $Courses_E1 = DB::table('collations')
         ->select(DB::raw("SUM(TE) as Total"))
         ->groupBy('program_name')
         ->orderby('Total','desc')->first()->Total;
         
         $Courses_E2 = DB::table('collations')
         ->select(DB::raw("SUM(TE) as Total"))
         ->groupBy('program_name')
         ->orderby('Total','desc')->skip(1)->first()->Total;

         $Courses_E3 = DB::table('collations')
         ->select(DB::raw("SUM(TE) as Total"))
         ->groupBy('program_name')
         ->orderby('Total','desc')->skip(2)->first()->Total;

         $Courses_E4 = DB::table('collations')
         ->select(DB::raw("SUM(TE) as Total"))
         ->groupBy('program_name')
         ->orderby('Total','desc')->skip(3)->first()->Total;

         $Courses_E5 = DB::table('collations')
         ->select(DB::raw("SUM(TE) as Total"))
         ->groupBy('program_name')
         ->orderby('Total','desc')->skip(4)->first()->Total;


         $courses = new Courses;
         $courses->labels(['Top 1', 
         'Top 2',
         'Top 3',
         'Top 4',
         'Top 5',
           
       
        ]);
 
         $courses->dataset('NON SUC', 'bar', 
             [$Courses_E1,
              $Courses_E2,
              $Courses_E3,
              $Courses_E4,
              $Courses_E5,

             ])
 
             ->color($LineCourseColor1)
             ->backgroundcolor($FillCourseColor1);
 
         $courses->displayLegend(false);


         $LinegradColor1 = [
            "rgba(0, 52, 113, 1.0)",
            "rgba(0, 52, 113, 1.0)",
            "rgba(0, 52, 113, 1.0)",
            "rgba(0, 52, 113, 1.0)",
            "rgba(0, 52, 113, 1.0)",
           
        ];
        $FillgradColor1 = [
            "rgba(0, 52, 113, 0.8)",
            "rgba(0, 52, 113, 0.7)",
            "rgba(0, 52, 113, 0.6)",
            "rgba(0, 52, 113, 0.5)",
            "rgba(0, 52, 113, 0.4)",
            
        ];


        //TOP 5 HIGHEST NUMBER OF GRADUATES

        $College_G = DB::table('collations')
        ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
         ->select(DB::raw("SUM(collations.TG) as Total"),'institutions.institution_name')
         ->groupBy('institutions.institution_name')
         ->orderby('Total','desc')->limit(5)->get();

         $College_G1 = DB::table('collations')
         ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
          ->select(DB::raw("SUM(collations.TG) as Total"),'institutions.institution_name')
          ->groupBy('institutions.institution_name')
          ->orderby('Total','desc')->first()->Total;

          $College_G2 = DB::table('collations')
          ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
          ->select(DB::raw("SUM(collations.TG) as Total"),'institutions.institution_name')
          ->groupBy('institutions.institution_name')
          ->orderby('Total','desc')->skip(1)->first()->Total;

          $College_G3 = DB::table('collations')
          ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
          ->select(DB::raw("SUM(collations.TG) as Total"),'institutions.institution_name')
          ->groupBy('institutions.institution_name')
          ->orderby('Total','desc')->skip(2)->first()->Total;
 
          $College_G4 = DB::table('collations')
          ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
          ->select(DB::raw("SUM(collations.TG) as Total"),'institutions.institution_name')
          ->groupBy('institutions.institution_name')
          ->orderby('Total','desc')->skip(3)->first()->Total;

          $College_G5 = DB::table('collations')
          ->join('institutions', 'institutions.institutions_id', '=','collations.institutions_id')
          ->select(DB::raw("SUM(collations.TG) as Total"),'institutions.institution_name')
          ->groupBy('institutions.institution_name')
          ->orderby('Total','desc')->skip(4)->first()->Total;

        
         $college = new CollegeG;
         $college->labels(['Top 1', 
         'Top 2',
         'Top 3',
         'Top 4',
         'Top 5',
           
       
        ]); 
 
         $college->dataset('NON SUC', 'bar', 
             [
                $College_G1,
                $College_G2,
                $College_G3,
                $College_G4,
                $College_G5, 

             ])
 
             ->color($LinegradColor1)
             ->backgroundcolor($FillgradColor1);
 
         $college->displayLegend(false);
         

         $LineprogColor1 = [
            "rgba(255, 206, 0, 1.0)",
            "rgba(255, 206, 0, 1.0)",
            "rgba(255, 206, 0, 1.0)",
            "rgba(255, 206, 0, 1.0)",
            "rgba(255, 206, 0, 1.0)",
            
        ];
        $FillprogColor1 = [
            "rgba(255, 206, 0, 0.8)",
            "rgba(255, 206, 0, 0.7)",
            "rgba(255, 206, 0, 0.5)",
            "rgba(255, 206, 0, 0.4)",
            "rgba(255, 206, 0, 0.3)",
            
        ];

        
          //TOP 5 POPULAR PROGRAMS

          $Programs = DB::table('collations')
          ->select(DB::raw("SUM(TE+TG) as Total"),'program_name')
          ->groupBy('program_name')
          ->orderby('Total','desc')->limit(5)->get();

          $Programs1 = DB::table('collations')
          ->select(DB::raw("SUM(TE+TG) as Total"),'program_name')
          ->groupBy('program_name')
          ->orderby('Total','desc')->first()->Total;

          $Programs2 = DB::table('collations')
          ->select(DB::raw("SUM(TE+TG) as Total"),'program_name')
          ->groupBy('program_name')
          ->orderby('Total','desc')->skip(1)->first()->Total;

          $Programs3 = DB::table('collations')
          ->select(DB::raw("SUM(TE+TG) as Total"),'program_name')
          ->groupBy('program_name')
          ->orderby('Total','desc')->skip(2)->first()->Total;

          $Programs4 = DB::table('collations')
          ->select(DB::raw("SUM(TE+TG) as Total"),'program_name')
          ->groupBy('program_name')
          ->orderby('Total','desc')->skip(3)->first()->Total;

          $Programs5 = DB::table('collations')
          ->select(DB::raw("SUM(TE+TG) as Total"),'program_name')
          ->groupBy('program_name')
          ->orderby('Total','desc')->skip(4)->first()->Total;


          $program = new Programs;
          $program->labels(['Top 1', 
          'Top 2',
          'Top 3',
          'Top 4',
          'Top 5',
            
        
         ]);
  
          $program->dataset('NON SUC', 'horizontalBar', 
              [
                 $Programs1,
                 $Programs2,
                 $Programs3,
                 $Programs4,
                 $Programs5,
               
              ])
                
            //   ->fill(false)
              ->color($LineprogColor1)
              ->backgroundcolor($FillprogColor1);
  
          $program->displayLegend(false);
          

          $TotalEnrollment = DB::table('collations')
          ->select(DB::raw("SUM(TE) as Total"))
          ->first()->Total; 

          $TotalGraduates = DB::table('collations')
          ->select(DB::raw("SUM(TG) as Total"))
          ->first()->Total;

          $TotalMale = DB::table('collations')
          ->select(DB::raw("SUM(TME+TMG) as Total"))
          ->first()->Total;

          $TotalFemale = DB::table('collations')
          ->select(DB::raw("SUM(TFE+TFG) as Total"))
          ->first()->Total;

        $LinemfColor1 = [  
            "rgba(0, 52, 113, 0.8)",  
            "rgba(255, 20, 134, 0.9)",
        ];

        $FillmfColor1 = [
            "rgba(0, 52, 113, 0.7)",
            "rgba(255, 20, 134, 0.7)",
        ];

          $gender = new Gender;
          $gender->labels(['Male', 'Female',]);
          $gender->dataset('Total', 'doughnut', [ $TotalMale,$TotalFemale])
                 ->color($LinemfColor1)
                 ->backgroundcolor($FillmfColor1);
          $gender->displayLegend(false);

        
          $SUCMale = DB::table('collations')
          ->select(DB::raw("SUM(TME+TMG) as Total"))
          ->where('institution_types_id','1')
          ->first()->Total;

          $NONSUCMale = DB::table('collations')
          ->select(DB::raw("SUM(TME+TMG) as Total"))
          ->where('institution_types_id','2')
          ->first()->Total;

          $LinemColor1 = [
            "rgba(0, 52, 113, 0.8)",  
            "rgba(0, 52, 113, 0.8)",   
         ];
      
        $FillmColor1 = [
            "rgba(0, 52, 113, 0.7)",  
            "rgba(0, 52, 113, 0.7)",  
        ];

          $male = new Male;
          $male->labels(['SUC', 'NON-SUC',]);
          $male->dataset('Total', 'bar', [ $SUCMale,$NONSUCMale])
                 ->color($LinemColor1)
                 ->backgroundcolor($FillmColor1);
          $male->displayLegend(false);

          
        $LinefColor1 = [
            "rgba(255, 20, 134, 0.9)",
            "rgba(255, 20, 134, 0.9)",
        ];

        $FillfColor1 = [
            "rgba(255, 20, 134, 0.7)",
            "rgba(255, 20, 134, 0.7)",
        ];

          $SUCFemale = DB::table('collations')
          ->select(DB::raw("SUM(TFE+TFG) as Total"))
          ->where('institution_types_id','1')
          ->first()->Total;

          $NONSUCFemale = DB::table('collations')
          ->select(DB::raw("SUM(TFE+TFG) as Total"))
          ->where('institution_types_id','2')
          ->first()->Total;
 
          $female = new Female;
          $female->labels(['SUC', 'NON-SUC',]);
          $female->dataset('Total', 'bar', [ $SUCFemale,$NONSUCFemale])
                 ->color($LinefColor1)
                 ->backgroundcolor($FillfColor1);
          $female->displayLegend(false);

          $TotalStudents = DB::table('collations')
          ->select(DB::raw("SUM(TE+TG) as Total"))
          ->first()->Total; 

          $SUCPercentage = DB::table('collations')
          ->select(DB::raw("SUM(TE+TG) as Total"))
          ->first()->Total;

          $SUC_Population =  DB::table('collations')
          ->select(DB::raw("SUM(TE+TG) as Total"))
          ->where('institution_types_id', '1')
          ->first()->Total;  

          $SUC_TE = DB::table('collations')
          ->select(DB::raw("SUM(TE) as Total"))
          ->where('institution_types_id', '1')
          ->first()->Total; 

          $SUC_TG = DB::table('collations')
          ->select(DB::raw("SUM(TG) as Total"))
          ->where('institution_types_id', '1')
          ->first()->Total; 


          $NONSUC_Population =  DB::table('collations')
          ->select(DB::raw("SUM(TE+TG) as Total"))
          ->where('institution_types_id', '2')
          ->first()->Total;  

          $NONSUC_TE = DB::table('collations')
          ->select(DB::raw("SUM(TE) as Total"))
          ->where('institution_types_id', '2')
          ->first()->Total; 

          $NONSUC_TG = DB::table('collations')
          ->select(DB::raw("SUM(TG) as Total"))
          ->where('institution_types_id', '2')
          ->first()->Total; 



         return view('officer_pages.analytics', compact(
             'TotalStudents',
        'Discipline','DG','ce','College_E', 'courses', 'Courses_E','college', 'College_G',
        'Programs', 'program', 'male', 'female',
        'fname','lname','TotalEnrollment','TotalGraduates', 'gender',
        'SUC_Population','SUC_TE', 'SUC_TG', 'NONSUC_Population', 'NONSUC_TE', 'NONSUC_TG'
        ));
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
   
           return view('officer_pages.references',compact('discipline','institutions','fname','lname'));
       
    }

    public function Page_account_officer()
    {
        //GET THE FIRST AND LAST NAME OF THE USER 
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;

        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $type = '4';
        $account = DB::table('users')
        ->join('employee_profiles', 'users.employee_profiles_id', '=', 'employee_profiles.employee_profiles_id')
        ->join('statuses', 'users.statuses_id', '=', 'statuses.statuses_id')
        ->select('users.*','employee_profiles.first_name', 'employee_profiles.last_Name', 
           'employee_profiles.position', 'employee_profiles.division','statuses.status')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('users.user_types_id', $type)->get();


       return view('officer_pages.officer_acc', compact('account','fname','lname'));
    }

    public function Account_officer_add(Request $request)
    {   


        $id = auth()->id();
        $fname = request('fname');
        $lname = request('lname');
        $email = request('email');
        $position = request('position');
        $division = request('division');

        OfficerAddAccOfficer::dispatch($id,$fname,$lname,$email,$position,$division);
       
        // //GET THE INSTITUTION ID
        // $employee = DB::table('users')->find($id)->employee_profiles_id;
        // $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
     
        // //ADD OFFICER
        // $emp = new Employee_profile();
        // $emp->first_name = request('fname');
        // $emp->last_Name = request('lname');
        // $emp->position = request('position');
        // $emp->division = request('division');
        // $emp->institutions_id = $institution;
        // $emp->save();
        
        // //ADD USER
        // $users = $request->fname . '' . $request->lname . '123';
        // $pass = 'officer12345678';

        // $emp_id =  DB::table('employee_profiles')->latest()->first()->employee_profiles_id; 
        // $hashpass = Hash::make($pass);
 
        // $user = new User();
        // $user->username = $users;
        // $user->email = $request->email;
        // $user->password = $hashpass;
        // $user->employee_profiles_id = $emp_id;
        // $user->user_types_id = '4';
        // $user->statuses_id = '1';
        // $user->save();       


        return  back()->with('success', 'Added a new account successfully');
 
    }

    public function officer_approve($id)
    {   
         
        $stat = DB::table('completes')->where('completes_id', $id)->first()->statuses_id;


        if($stat == '5')
        {
            return back()->with('danger', 'You cannot approve this file. Contact the specific validator for resubmission');
        }
        else if($stat == '4')
        {
            return back()->with('danger', 'You already approve this file');
        }
        else
        {   
             //UPDATE STATUS IN VALIDATES TABLE
            $status = '4';
            DB::update('update completes set statuses_id = ? where completes_id = ?', [$status,$id]);

            return back()->with('success', 'Approves the file successfully'); 
 
        }
     
      
    } 

    public function officer_disapprove(Request $request,$id)
    {    
        $stat = DB::table('completes')->where('completes_id', $id)->first()->statuses_id;

        if($stat == '4')
        { 
            return back()->with('danger', 'You cannot disapprove this file. Contact Ched Officer for cancelling the form');
        }
        else if($stat == '5')
        {
            return back()->with('danger', 'You already disapprove this file');
        } 
        else
        {    

           
            $comment = $request->textarea;

            OfficerDisapprove::dispatch($id,$comment); 
 
             //UPDATE STATUS IN COMPLETES TABLE
            $status = '5'; 
            DB::update('update completes set statuses_id = ? where completes_id = ?', [$status,$id]);
            
            //UPDATE THE COMMENT IN COMPLETES TABLE
            DB::update('update completes set comment = ? where completes_id = ?', [$comment,$id]);
            
            // //GET THE FILE NAME
            // $filename = DB::table('completes')->where('completes_id', $id)->first()->verifier_submission;
            
            //   //UPDATE THE VCOUNT IN COUNTS TABLE
            //   $institution = DB::table('completes')->where('completes_id', $id)->first()->institutions_id;
            //   $fcount = DB::table('counts')->where('institutions_id', $institution)->first()->fcount;
            //   $final_fcount = $fcount - 1;
            //   $vcount = DB::table('counts')->where('institutions_id', $institution)->first()->vcount;
            //   $final_vcount = $vcount - 1; 
 
            //   DB::table('counts')  
            //   ->where('institutions_id',$institution)
            //   ->update(['vcount' => $final_vcount, 'fcount' => $final_fcount]);

            //   $comment1 = $comment . ' - Officer'; 
            //   DB::table('verifies')  
            //   ->where('validator_submission',$filename)
            //   ->where('statuses_id','4')
            //   ->update(['statuses_id' => '5', 'comment' => $comment1]);

            //   DB::table('validates')  
            //   ->where('encoder_submission',$filename)
            //   ->where('statuses_id','4')
            //   ->update(['statuses_id' => '5', 'comment' => $comment1]);

            // Storage::delete('public/complete/'.$filename);
            

            return back()->with('success', 'Disapproves the file successfully');

        }

        
    }

    public function Institution_add(Request $request)
    {
        
       
        //ADD INSTITUTION
        $ins = new Institution();
        $ins->code = request('code');
        $ins->institution_name = request('institution');
        $ins->abbreviation = request('abbrv');
        $ins->institution_types_id = request('type');
        $ins->statuses_id = '1'; 
        $ins->save();
         
        return back()->with('success', 'Added a new Institution successfully');

    }

    public function Account_edit(Request $request, $id)
    {
        
          DB::table('users')   
          ->where('id',$id)
          ->update(['username' => $request->users]);

        $emp_id = DB::table('users')->where('id', $id)->first()->employee_profiles_id;

        DB::table('employee_profiles')   
        ->where('employee_profiles_id',$emp_id)
        ->update(['first_name' => $request->fname, 
        'last_Name' => $request->lname,
        'position' => $request->position,
        'division' => $request->division]);

 
        return back()->with('success', 'Edit the account successfully');
         

    }

    public function Account_request(Request $request, $id, $type)
    {   

        if($type === "Officer")
        {   
            DB::table('concerns')   
            ->where('concerns_id',$id)
            ->delete();

            return redirect('/officer/accounts/officer');
        }
        else if($type === "Validator")
        {   
            DB::table('concerns')   
            ->where('concerns_id',$id)
            ->delete();
            return redirect('/officer/accounts/validator');
        }
        else if($type === "6")
        {   
            DB::table('concerns')   
            ->where('concerns_id',$id)
            ->delete();
            return redirect('/validator/accounts');
        }
        else
        {   
            DB::table('concerns')   
            ->where('concerns_id',$id)
            ->delete();
            return redirect('/officer/accounts/verifier');
        }
       
    }



}
