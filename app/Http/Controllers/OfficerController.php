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
use App\Charts\TotalEGChar;
use App\Charts\TotalMFChar;
use App\Charts\TotalGradMFChart;
use App\Charts\TotalNonSucEGChart;
use App\Charts\TotalNonSucMFChart;
use App\Charts\TotalNonSucGradMFChart;
use Illuminate\Support\Str;
use Hash;


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


        return view('officer_pages.dashboard', compact('deadline','fname','lname'));

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
        ->select('completes.*','institutions.institution_name')->get();
        

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
        ->select('completes.*','employee_profiles.first_name','employee_profiles.last_Name')
        ->where('completes.institutions_id', $ins_id)->get();
        
        //return $files;
         return view('officer_pages.final', compact('files','fname','lname'));

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
        if($status == 'Active')
        {   
            $user = User::find($id);
            $user ->statuses_id = '2';
            $user ->save();
            
            return back();
        }else{
            $user = User::find($id);
            $user ->statuses_id = '1';
            $user ->save();
            return back();
        }
 
    }

    public function Account_verifier_add(Request $request)
    {
        //GET THE INSTITUTION ID
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
     
        //ADD EMPLOYEE
        $emp = new Employee_profile();
        $emp->first_name = request('fname');
        $emp->last_Name = request('lname');
        $emp->position = request('position');
        $emp->division = request('division');
        $emp->institutions_id = $institution;
        $emp->save();
        
        //ADD USER
        $users = $request->fname . '' . $request->lname . '123';
        $pass = 'verifier12345678';

        $emp_id =  DB::table('employee_profiles')->latest()->first()->employee_profiles_id; 
        $hashpass = Hash::make($pass);

        $user = new User();
        $user->username = $users;
        $user->email = $request->email;
        $user->password = $hashpass;
        $user->employee_profiles_id = $emp_id;
        $user->user_types_id = '3';
        $user->statuses_id = '1';
        $user->save();       


        return back();
 
    }

    public function Account_validator_add(Request $request)
    {
        //GET THE INSTITUTION ID
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
     
        //ADD EMPLOYEE
        $emp = new Employee_profile();
        $emp->first_name = request('fname');
        $emp->last_Name = request('lname');
        $emp->position = request('position');
        $emp->division = request('division');
        $emp->institutions_id = $request->institution;
        $emp->save();
        
        //ADD USER
        $users = $request->fname . '' . $request->lname . '123';
        $pass = 'validator12345678';

        $emp_id =  DB::table('employee_profiles')->latest()->first()->employee_profiles_id; 
        $hashpass = Hash::make($pass);

        $user = new User();
        $user->username = $users;
        $user->email = $request->email;
        $user->password = $hashpass;
        $user->employee_profiles_id = $emp_id;
        $user->user_types_id = '2';
        $user->statuses_id = '1';
        $user->save();     
        

        return back();
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
        
        return back();
    }

    public function Page_collation()
    {
         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
        
        //GET THE DEADLINE
        $SUCenrollments = DB::table('collation_enrollments')->where('institution_types_id','1')->get();
        $SUCgraduates = DB::table('collation_graduates')->where('institution_types_id','1')->get();
        
        $NONSUCenrollments = DB::table('collation_enrollments')->where('institution_types_id','2')->get();
        $NONSUCgraduates = DB::table('collation_graduates')->where('institution_types_id','2')->get();
    
        return view('officer_pages.collation', compact('NONSUCenrollments','NONSUCgraduates','SUCenrollments','SUCgraduates','fname','lname'));
    }

    public function Page_analytics()
    {
         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
        
         //SUC
         $totalEnrollment = DB::table('collation_enrollments')->where('institution_types_id','1')->SUM('total_enrollment');
         $AVGEnrollment = DB::table('collation_enrollments')->where('institution_types_id','1')->AVG('total_enrollment');

         $totalEnrollmentMale = DB::table('collation_enrollments')->where('institution_types_id','1')->SUM('total_male');
         $AVGEnrollmentMale = DB::table('collation_enrollments')->where('institution_types_id','1')->AVG('total_male');
        
         $totalEnrollmentFemale = DB::table('collation_enrollments')->where('institution_types_id','1')->SUM('total_female');
         $AVGEnrollmentFemale = DB::table('collation_enrollments')->where('institution_types_id','1')->AVG('total_female');
         
   
         $totalGraduate = DB::table('collation_graduates')->where('institution_types_id','1')->SUM('total_graduate');
         $AVGGraduate = DB::table('collation_graduates')->where('institution_types_id','1')->AVG('total_graduate');
         
         $totalGraduateMale = DB::table('collation_graduates')->where('institution_types_id','1')->SUM('total_male');
         $AVGGraduateMale = DB::table('collation_graduates')->where('institution_types_id','1')->AVG('total_male');
         
         $totalGraduateFemale = DB::table('collation_graduates')->where('institution_types_id','1')->SUM('total_female');
         $AVGGraduateFemale = DB::table('collation_graduates')->where('institution_types_id','1')->AVG('total_female');
        

        if($totalEnrollmentMale == null && $totalEnrollmentFemale == null)
        {
            $percentageMaleEnroll = null;
            $percentageFemaleEnroll = null;
        }
        else
        {
            //MALE
            $percentageMaleEnroll = $totalEnrollmentMale / $totalEnrollment;
            $percentageMaleEnroll =  $percentageMaleEnroll * 100;
            $percentageMaleEnroll =  Str::limit($percentageMaleEnroll, 5);

            //FEMALE
            $percentageFemaleEnroll = $totalEnrollmentFemale / $totalEnrollment;
            $percentageFemaleEnroll =  $percentageFemaleEnroll * 100;
            $percentageFemaleEnroll =  Str::limit($percentageFemaleEnroll, 5);
        }
        


        if($totalGraduateMale == null &&  $totalGraduateFemale == null)
        {
            $percentageMaleGrad = null;
            $percentageFemaleGrad = null;
        }
        else
        {
            //MALE
            $percentageMaleGrad = $totalGraduateMale / $totalGraduate;
            $percentageMaleGrad =  $percentageMaleGrad * 100;
            $percentageMaleGrad = Str::limit($percentageMaleGrad, 5);

            //FEMALE
            $percentageFemaleGrad = $totalGraduateFemale / $totalGraduate;
            $percentageFemaleGrad =  $percentageFemaleGrad * 100;
            $percentageFemaleGrad = Str::limit($percentageFemaleGrad, 5);
        }

       
         //CHART
         $borderColors = [
            "rgba(255, 205, 86, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 99, 132, 1.0)"
        ];
        $fillColors = [
            "rgba(255, 205, 86, 0.2)",
            "rgba(22,160,133, 0.2)",
            "rgba(255, 99, 132, 0.2)"
        ];


        $chart = new TotalEGChar;
        $chart->labels(['Total Enrollment', 'Total Graduates']);
        $chart->dataset('SUC', 'pie', [$totalEnrollment,  $totalGraduate])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        //$chart->displayLegend(false);

        $TotalMF = new TotalMFChar;
        $TotalMF->labels(['Total Male', 'Total Female']);
        $TotalMF->dataset('SUC', 'bar', [$totalEnrollmentMale,  $totalEnrollmentFemale])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $TotalMF->displayLegend(false);
        
        $TotalGradMF = new TotalGradMFChart;
        $TotalGradMF->labels(['Total Male', 'Total Female']);
        $TotalGradMF->dataset('SUC', 'bar', [$totalGraduateMale,  $totalGraduateFemale])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $TotalGradMF->displayLegend(false);



        //NON SUC
        //ENROLLMENT
        $NONSUCtotalEnrollment = DB::table('collation_enrollments')->where('institution_types_id','2')->SUM('total_enrollment');
        $NONSUCAVGEnrollment = DB::table('collation_enrollments')->where('institution_types_id','2')->AVG('total_enrollment');

        $NONSUCtotalEnrollmentMale = DB::table('collation_enrollments')->where('institution_types_id','2')->SUM('total_male');
        $NONSUCAVGEnrollmentMale = DB::table('collation_enrollments')->where('institution_types_id','2')->AVG('total_male');

        $NONSUCtotalEnrollmentFemale = DB::table('collation_enrollments')->where('institution_types_id','2')->SUM('total_female');
        $NONSUCAVGEnrollmentFemale = DB::table('collation_enrollments')->where('institution_types_id','2')->AVG('total_female');

        //GRADUATES
        $NONSUCtotalGraduate = DB::table('collation_graduates')->where('institution_types_id','2')->SUM('total_graduate');
        $NONSUCAVGGraduate = DB::table('collation_graduates')->where('institution_types_id','2')->AVG('total_graduate');
        
        $NONSUCtotalGraduateMale = DB::table('collation_graduates')->where('institution_types_id','2')->SUM('total_male');
        $NONSUCAVGGraduateMale = DB::table('collation_graduates')->where('institution_types_id','2')->AVG('total_male');
        
        $NONSUCtotalGraduateFemale = DB::table('collation_graduates')->where('institution_types_id','2')->SUM('total_female');
        $NONSUCAVGGraduateFemale = DB::table('collation_graduates')->where('institution_types_id','2')->AVG('total_female');

        
        if($NONSUCtotalEnrollmentMale == null && $NONSUCtotalEnrollmentFemale == null)
        {
            $percentageNonSucMaleEnroll = null;
            $percentageNonSucFemaleEnroll = null;
        }
        else{
            //MALE
            $percentageNonSucMaleEnroll = $NONSUCtotalEnrollmentMale / $NONSUCtotalEnrollment;
            $percentageNonSucMaleEnroll =  $percentageNonSucMaleEnroll * 100;
            $percentageNonSucMaleEnroll = Str::limit($percentageNonSucMaleEnroll, 5);

            //FEMALE
            $percentageNonSucFemaleEnroll = $NONSUCtotalEnrollmentFemale / $NONSUCtotalEnrollment;
            $percentageNonSucFemaleEnroll =  $percentageNonSucFemaleEnroll * 100;
            $percentageNonSucFemaleEnroll = Str::limit($percentageNonSucFemaleEnroll, 5);

        }

        if($NONSUCtotalGraduateMale == null &&  $NONSUCtotalGraduateFemale == null)
        {
            
            $percentageNonSucMaleGrad = null;
            $percentageNonSucFemaleGrad = null;

        }
        else
        {
            //MALE
            $percentageNonSucMaleGrad = $NONSUCtotalGraduateMale / $NONSUCtotalGraduate;
            $percentageNonSucMaleGrad =  $percentageNonSucMaleGrad * 100;
            $percentageNonSucMaleGrad = Str::limit($percentageNonSucMaleGrad, 5);

            //FEMALE
            $percentageNonSucFemaleGrad = $NONSUCtotalGraduateFemale / $NONSUCtotalGraduate;
            $percentageNonSucFemaleGrad =  $percentageNonSucFemaleGrad * 100;
            $percentageNonSucFemaleGrad = Str::limit($percentageNonSucFemaleGrad, 5);
        }

       

        $TotalNonSucEG = new TotalNonSucEGChart;
        $TotalNonSucEG->labels(['Enrollment', 'Graduates']);
        $TotalNonSucEG->dataset('SUC', 'pie', [$NONSUCtotalEnrollment,  $NONSUCtotalGraduate])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $TotalNonSucEG->displayLegend(false);


        $TotalNonSucMF = new TotalNonSucMFChart;
        $TotalNonSucMF->labels(['Total Male', 'Total Female']);
        $TotalNonSucMF->dataset('SUC', 'bar', [$NONSUCtotalEnrollmentMale,  $NONSUCtotalEnrollmentFemale])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $TotalNonSucMF->displayLegend(false);


        $TotalNonSucGradMF = new TotalNonSucGradMFChart;
        $TotalNonSucGradMF->labels(['Total Male', 'Total Female']);
        $TotalNonSucGradMF->dataset('SUC', 'bar', [$NONSUCtotalGraduateMale,  $NONSUCtotalGraduateFemale])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $TotalNonSucGradMF->displayLegend(false);
        

         return view('officer_pages.analytics', compact('totalGraduateFemale','totalGraduateMale','percentageFemaleGrad',
         'percentageMaleGrad','AVGGraduateFemale','AVGGraduateMale','TotalGradMF',
         'totalEnrollmentFemale','totalEnrollmentMale','percentageMaleEnroll',
         'percentageFemaleEnroll','AVGEnrollmentFemale','AVGEnrollmentMale',
         'TotalMF','chart','fname','lname',
        'TotalNonSucEG','TotalNonSucMF','TotalNonSucGradMF',
        'NONSUCAVGEnrollmentMale', 'NONSUCAVGEnrollmentFemale','percentageNonSucMaleEnroll', 'percentageNonSucFemaleEnroll'
        , 'NONSUCtotalEnrollmentMale', 'NONSUCtotalEnrollmentFemale',
        'NONSUCAVGGraduateMale', 'NONSUCAVGGraduateFemale', 'percentageNonSucMaleGrad', 'percentageNonSucFemaleGrad'
        ,'NONSUCtotalGraduateMale', 'NONSUCtotalGraduateFemale'

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


}
