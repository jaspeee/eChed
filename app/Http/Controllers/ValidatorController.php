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
use App\Audit_log; 
use App\Employee_profile;
use App\Charts\StatusChart;
use App\Charts\ValidatorStatusChart;
use App\Charts\AccountStatusChart;
use Hash;
Use Carbon\Carbon;
use App\Jobs\ValidatorApprove;
use App\Jobs\ValidatorDisapprove; 
use App\Jobs\ValidatorAddAcc;
use App\Jobs\ValidatorAccStatus;
use App\Jobs\ValidatorChangePass;
use Illuminate\Support\Facades\URL;

class ValidatorController extends Controller
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

        //GET THE LIST OF SUBMISSIONS VERIFIER
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $submissions = DB::table('verifies')
        ->join('users', 'verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->select('verifies.*','employee_profiles.first_name','employee_profiles.last_Name','statuses.status')
        ->where('employee_profiles.institutions_id', $institution)->orderby('verifies_id','desc')->limit(3)->get();

        //GET THE LIST OF SUBMISSIONS VALIDATOR
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $submissionss = DB::table('validates') 
        ->join('users', 'validates.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->select('validates.*','employee_profiles.first_name','employee_profiles.last_Name','statuses.status')
        ->where('employee_profiles.institutions_id', $institution)->orderby('validates_id','desc')->limit(3)->get();


        $borderColors = [
            "rgba(255, 206, 0, 1.0)",
            "rgba(16, 121, 16, 1.0)",
            "rgba(220, 0, 5, 1.0)",
           
        ];
        $fillColors = [
            "rgba(255, 206, 0, 0.7)",
            "rgba(16, 121, 16, 0.7)",
            "rgba(220, 0, 5, 0.7)",
        ];

        $borderColors1 = [
            "rgba(16, 121, 16, 1.0)",
            "rgba(220, 0, 5, 1.0)",
           
        ];
        $fillColors1 = [
            "rgba(16, 121, 16, 0.7)",
            "rgba(220, 0, 5, 0.7)",
        ];


        //ENCODER 
        $pending = DB::table('validates')
        ->join('users', 'validates.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('statuses.status', 'pending')->count();

        $approve = DB::table('validates')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->join('users', 'validates.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('statuses.status', 'approve')->count();

        $disapprove = DB::table('validates')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->join('users', 'validates.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('statuses.status', 'disapprove')->count();

        $chart = new StatusChart;
        $chart->labels(['Pending', 'Approve', 'Disapprove']);
        $chart->dataset('Dataset', 'bar', [$pending,  $approve, $disapprove])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
           
        $chart->displayLegend(false);
     
 
        //VALIDATOR
        $pending1 = DB::table('verifies')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->join('users', 'verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('statuses.status', 'pending')->count();

        $approve1 = DB::table('verifies') 
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->join('users', 'verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('statuses.status', 'approve')->count();

        $disapprove1 = DB::table('verifies')
        ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
        ->join('users', 'verifies.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('statuses.status', 'disapprove')->count();

        $charts = new ValidatorStatusChart;
        $charts->labels(['Pending', 'Approve', 'Disapprove']);
        $charts->dataset('Dataset', 'bar', [$pending1,  $approve1, $disapprove1])
                ->color($borderColors)
                ->backgroundcolor($fillColors);
        
         $charts->displayLegend(false);

        //ENCODER ACCOUNTS
 
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $active = DB::table('users')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('statuses','users.statuses_id', '=','statuses.statuses_id')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('statuses.status', 'active')->count();

        $inactive = DB::table('users')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('statuses','users.statuses_id', '=','statuses.statuses_id')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('statuses.status', 'inactive')->count();
    
        $chartss = new AccountStatusChart;
        $chartss->labels(['Active', 'Inactive']);
        $chartss->dataset('Dataset', 'doughnut', [$active,  $inactive])
                ->color($borderColors1)
                ->backgroundcolor($fillColors1);
    
        $chartss->displayAxes(false); 
       
         //GET THE DEADLINES
         $deadline = DB::table('deadlines')
         ->join('users', 'deadlines.user_id', '=','users.id')
         ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
         ->select('deadlines.*', 'employee_profiles.first_name', 'employee_profiles.last_Name')->paginate(1);
 
        
          //GET THE INSTITUTION
        $school = DB::table('institutions')->where('institutions_id',$institution)->first()->institution_name;
        $date = Carbon::now();
        $dates = $date->toFormattedDateString();         

        //GET THE REQUEST
        $request = DB::table('concerns')
        ->join('users', 'concerns.user_id', '=','users.id')
        ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->select('concerns.*', 'employee_profiles.first_name', 'employee_profiles.last_Name')
        ->where('employee_profiles.institutions_id', $institution)
        ->where('users.user_types_id', '<>', '2')
        ->orderby('concerns_id','desc')->limit(3)->get();  

        return view('validator_pages.dashboard', compact('school','dates','request',
        'deadline','chartss','charts','chart','submissionss','submissions','fname','lname'));
    }
 
    public function Page_validation()
    {   

        //GET THE SUBMISSONS FROM THE ENCODERS 
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $submissions = DB::table('validates')
        ->join('users', 'validates.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->select('validates.*','employee_profiles.first_name','employee_profiles.last_Name','statuses.status')
        ->where('employee_profiles.institutions_id', $institution)->get();


        //GET THE FIRST AND LAST NAME OF THE USER 
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;

        return view('validator_pages.validation', compact('submissions','fname','lname'));
    }

    public function Page_track()
    {   
        //GET THE FIRST AND LAST NAME OF THE USER 
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;


         //GET THE SUBMISSIONS FROM THE ENCODERS
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
         $submissions = DB::table('verifies')
         ->join('users', 'verifies.user_id', '=','users.id')
         ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
         ->join('statuses','verifies.statuses_id', '=','statuses.statuses_id')
         ->select('verifies.*','employee_profiles.first_name','employee_profiles.last_Name','statuses.status')
         ->where('employee_profiles.institutions_id', $institution)->get();
 
        return view('validator_pages.track', compact('submissions','fname','lname'));
    }
    
    public function Page_records()
    {   
        //GET THE FIRST AND LAST NAME OF THE USER 
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
 
        $forms = DB::table('completes')
        ->where('institutions_id', $institution)
        ->where('statuses_id', '4')->get();

        
        return view('validator_pages.record', compact('fname','lname','forms'));
    }

    public function Page_accounts()
    {   

         //GET THE FIRST AND LAST NAME OF THE USER 
         $id = auth()->id();
         $employee = DB::table('users')->find($id)->employee_profiles_id;
         $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
         $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;
        
         $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
 
         $account = DB::table('users')
         ->join('employee_profiles', 'users.employee_profiles_id', '=', 'employee_profiles.employee_profiles_id')
         ->join('statuses', 'users.statuses_id', '=', 'statuses.statuses_id')
         ->select('users.*','employee_profiles.first_name', 'employee_profiles.last_Name', 
            'employee_profiles.position', 'employee_profiles.division','statuses.status')
         ->where('employee_profiles.institutions_id', $institution)->get();

  
        return view('validator_pages.accounts', compact('account','fname','lname'));
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

         return view('validator_pages.password', compact('pos','div','fname','lname'));
    }

    public function Validation_approve(Request $request,$id)
    {   
 
        //GET THE FILE NAME
        $filename = DB::table('validates')->where('validates_id', $id)->first()->encoder_submission;
        
        $stat = DB::table('validates')->where('validates_id', $id)->first()->statuses_id;
        
        if($stat == '5') 
        {
            return back()->with('danger', 'You cannot approve this file. Contact your encoder for resubmission');
        }
        else if($stat == '4')
        {
            return back()->with('danger', 'You already approve this file');
        }
        else
        {   

            $id1 = auth()->id();
            ValidatorApprove::dispatch($id,$filename,$id1);
  
            //UPDATE STATUS IN VALIDATES TABLE
            $status = '4';
            DB::update('update validates set statuses_id = ? where validates_id = ?', [$status,$id]);
         
            // //UPDATE THE VCOUNT IN COUNTS TABLE
            // $user = DB::table('validates')->where('validates_id', $id)->first()->user_id;
            // $employee = DB::table('users')->where('id', $user)->first()->employee_profiles_id;
            // $institution = DB::table('employee_profiles')->where('employee_profiles_id', $employee)->first()->institutions_id;  
            // $count = DB::table('counts')->where('institutions_id', $institution)->first()->vcount;
            // $final_count = $count + 1;
            // DB::update('update counts set vcount = ? where institutions_id = ?', [$final_count,$institution]);
 
            //  //STORE DATA TO VERIFIES TABLE
            // $vfy = new Verify();
            // $vfy->user_id = auth()->id();
            // $vfy->validator_submission = $filename;
            // $vfy->statuses_id = '3';
            // $vfy->comment = '';
            // $vfy->save(); 

            //MOVE FILE TO ANOTHER STORAGE FOLDER
            // if(Storage::move('public/validate/'.$filename, 'public/verify/' .$filename))
            // {
            //     
            // } 

            $audit = new Audit_log();
            $audit->user_id =  auth()->id();
            $audit->user_types_id = '2';
            $audit->event = 'Update';
            $audit->auditable_type = 'App\Validate';
            $audit->auditable_id = $id;
            $audit->old_values = '{status:pending}';
            $audit->new_values = '{status:approve}';
            $audit->url = URL::current();
            $audit->ip_address = \Request::ip();
            $audit->user_agent = $request->header('User-Agent');
            $audit->save();  

            $count = \DB::table('verifies')->count();
            if($count == 0) {
                $audit_ID = '1';
            }else {
                $audit_ID = DB::table('verifies')->orderBy('verifies_id', 'DESC')->first()->verifies_id;
                $audit_ID= $audit_ID+1;
            }

            $audit = new Audit_log();
            $audit->user_id =  auth()->id();
            $audit->user_types_id = '2';
            $audit->event = 'Upload';
            $audit->auditable_type = 'App\Verify';
            $audit->auditable_id = $audit_ID ;
            $audit->old_values = '';
            $audit->new_values = '{user_id:'.auth()->id().', validator_submission:'.$filename.', statuses_id:3, comment:, }';
            $audit->url = URL::current();
            $audit->ip_address = \Request::ip();
            $audit->user_agent = $request->header('User-Agent');
            $audit->save(); 

            return  back()->with('success', 'Approves the file successfully');
        }
        
       
    }

    public function Validation_disapproves(Request $request, $id)
    {   

        $stat = DB::table('validates')->where('validates_id', $id)->first()->statuses_id;

        if($stat == '4')
        {
            return back()->with('danger', 'You cannot disapprove this file. Contact Ched Verifier for cancelling the form');
        }
        else if($stat == '5')
        {
            return back()->with('danger', 'You already disapprove this file');
        }
        else
        {    
            $comment = $request->textarea;

            ValidatorDisapprove::dispatch($id,$comment);

            //UPDATE STATUS IN VALIDATES TABLE
            $status = '5';
            DB::update('update validates set statuses_id = ? where validates_id = ?', [$status,$id]);
            
            // $sample = $id . ''. $comment; 
            // DB::update('update validates set comment = ? where validates_id = ?', [$comment,$id]);

            // //UPDATE THE COMMENT IN VALIDATES TABLE 
            
            
            // //GET THE FILE NAME 
            // $filename = DB::table('validates')->where('validates_id', $id)->first()->encoder_submission;

            //MOVE FILE TO ANOTHER STORAGE FOLDER

            // if(Storage::delete('public/validate/'.$filename))
            // {
            //     return back()->with('success', 'Disapproves the file successfully');
            // }

            $audit = new Audit_log();
            $audit->user_id =  auth()->id();
            $audit->user_types_id = '2';
            $audit->event = 'Update';
            $audit->auditable_type = 'App\Validate';
            $audit->auditable_id = $id;
            $audit->old_values = '{status:pending}';
            $audit->new_values = '{status:disapprove, comment:'. $comment.'}';
            $audit->url = URL::current();
            $audit->ip_address = \Request::ip();
            $audit->user_agent = $request->header('User-Agent');
            $audit->save();  

            return back()->with('success', 'Disapproves the file successfully');

        } 

        
    }

    public function Validation_accstat(Request $request,$status, $id)
    {   
        //UPDATE STATUS IN USER TABLE
        
        ValidatorAccStatus::dispatch($status,$id);

        if($status == 'Active')
        {   
            // $user = User::find($id);
            // $user ->statuses_id = '2'; 
            // $user ->save(); 

            $audit = new Audit_log();
            $audit->user_id =  auth()->id();
            $audit->user_types_id = '2';
            $audit->event = 'Update';
            $audit->auditable_type = 'App\User';
            $audit->auditable_id = $id;
            $audit->old_values = '{status:active}';
            $audit->new_values = '{status:inactive}';
            $audit->url = URL::current();
            $audit->ip_address = \Request::ip();
            $audit->user_agent = $request->header('User-Agent');
            $audit->save(); 

            
            return back()->with('success', 'Deactivate the account successfully');
        }else{
            // $user = User::find($id);
            // $user ->statuses_id = '1';
            // $user ->save(); 

            $audit = new Audit_log();
            $audit->user_id =  auth()->id();
            $audit->user_types_id = '2';
            $audit->event = 'Update';
            $audit->auditable_type = 'App\User';
            $audit->auditable_id = $id;
            $audit->old_values = '{status:inactive}';
            $audit->new_values = '{status:active}';
            $audit->url = URL::current();
            $audit->ip_address = \Request::ip();
            $audit->user_agent = $request->header('User-Agent');
            $audit->save(); 

            return back()->with('success', 'Activate the account successfully');
        }
 
    }

    public function Accounts_add(Request $request)
    {   

        //GET THE INSTITUTION ID
        $id = auth()->id();
        $fname = request('fname');
        $lname = request('lname');
        $email = request('email');
        $position = request('position');
        $division = request('division');
       
        ValidatorAddAcc::dispatch($id,$fname,$lname,$email,$position,$division);

        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
     
        // //ADD EMPLOYEE 
        // $emp = new Employee_profile();
        // $emp->first_name = request('fname');
        // $emp->last_Name = request('lname'); 
        // $emp->position = request('position');
        // $emp->division = request('division');
        // $emp->institutions_id = $institution;
        // $emp->save();
        
        //ADD USER 
        $users = $request->fname . '' . $request->lname . '123';
        $pass = 'encoder123';

        $emp_id =  DB::table('employee_profiles')->latest()->first()->employee_profiles_id; 
        $hashpass = Hash::make($pass);

        // $user = new User();
        // $user->username = $users;
        // $user->email = $request->email;
        // $user->password = $hashpass;
        // $user->employee_profiles_id = $emp_id;
        // $user->user_types_id = '1';
        // $user->statuses_id = '1';
        // $user->save();       

        $count = \DB::table('users')->count();
        if($count == 0) {
            $audit_ID = '1';
        }else {
            $audit_ID = DB::table('users')->orderBy('id', 'DESC')->first()->id;
            $audit_ID= $audit_ID+1;
        }

        $audit = new Audit_log();
        $audit->user_id =  auth()->id();
        $audit->user_types_id = '2';
        $audit->event = 'Create';
        $audit->auditable_type = 'App\User';
        $audit->auditable_id = $audit_ID;
        $audit->old_values = '';
        $audit->new_values = '{username:'.$users.', email:'.$email.', password:'.$hashpass.', employee_profiles_id:'.$emp_id.', user_types_id:1, statuses_id:1}';
        $audit->url = URL::current();
        $audit->ip_address = \Request::ip();
        $audit->user_agent = $request->header('User-Agent');
        $audit->save();
        
        $count = \DB::table('employee_profiles')->count();
        if($count == 0) {
            $audit_ID1 = '1';
        }else {
            $audit_ID1 = DB::table('employee_profiles')->orderBy('employee_profiles_id', 'DESC')->first()->employee_profiles_id;
            $audit_ID1= $audit_ID1+1;
        }

        $audit = new Audit_log();
        $audit->user_id =  auth()->id();
        $audit->user_types_id = '2';
        $audit->event = 'Create';
        $audit->auditable_type = 'App\Employee_profile';
        $audit->auditable_id = $audit_ID1;
        $audit->old_values = '';
        $audit->new_values = '{first_name:'.$fname.', last_name:'.$lname.', position:'.$position.', division:'.$division.', institutions_id:'.$institution.'}';
        $audit->url = URL::current();
        $audit->ip_address = \Request::ip();
        $audit->user_agent = $request->header('User-Agent');
        $audit->save(); 


        return back()->with('success', 'Added new account successfully');
    }

    public function Password_change(Request $request)
    {
        
        $id = auth()->id();
        $current_password = User::find($id)->password;
         
         if(Hash::check($request['old_password'], $current_password))
         {   
            
            ValidatorChangePass::dispatch($id,$request['password']);

            //  $user = User::find($id);
            //  $user->password = Hash::make($request['password']);
            //  $user->save();  
              
            $audit = new Audit_log();
            $audit->user_id =  auth()->id();
            $audit->user_types_id = '2';
            $audit->event = 'Update';
            $audit->auditable_type = 'App\User';
            $audit->auditable_id = auth()->id();
            $audit->old_values = '{password:'.$current_password.'}';
            $audit->new_values = '{password:'.Hash::make($request['password']).'}';
            $audit->url = URL::current();
            $audit->ip_address = \Request::ip();
            $audit->user_agent = $request->header('User-Agent');
            $audit->save();  
        
             
         }
         else{ 
             return back()->with('danger', 'Current password was incorrect');
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
           $insID = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
           $institutions = DB::table('institutions') ->where('institutions_id', $insID)->get();
           $discipline = DB::table('discipline_groups')->get();
   
           return view('validator_pages.references',compact('discipline','institutions','fname','lname'));
       
    } 

    // public function Accounts_changePass(Request $request, $id)
    // {   

    //     $newpass = Hash::make($request['npass']);
        
    //     DB::update('update users set password = ? where id = ?', [$newpass,$id]);

    //      return back()->with('success', 'Change password successfully');
    // }

    public function audit_download(Request $request, $val)
    {   

        $form = DB::table('validates')->where('validates_id',$val)->first()->encoder_submission;

        $audit = new Audit_log();
        $audit->user_id =  auth()->id();
        $audit->user_types_id = '2';
        $audit->event = 'Download';
        $audit->auditable_type = 'App\Validate';
        $audit->auditable_id = $val;
        $audit->old_values = '';
        $audit->new_values = '{download:'.$form.'}';
        $audit->url = URL::current();
        $audit->ip_address = \Request::ip();
        $audit->user_agent = $request->header('User-Agent');
        $audit->save();  
        
        return Storage::download('public/validate/'.$form);

    }
}
