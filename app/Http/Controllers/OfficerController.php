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
        ->select('institutions.*','counts.vcount','counts.fcount','institution_types.type')->get();


        return view('officer_pages.finalization', compact('institutions','fname','lname'));
    }
    
    public function Page_reports()
    {
         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
 
        return view('officer_pages.reports', compact('fname','lname'));
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
        ->where('employee_profiles.institutions_id', $ins_id)->get();
  
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
}
