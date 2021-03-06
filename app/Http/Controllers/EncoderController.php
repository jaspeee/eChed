<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use App\Form;
use App\Validate;
use App\Audit_log;
use App\Charts\StatusChart;
use Hash;
Use Carbon\Carbon;
use App\Jobs\EncoderUpload;
use App\Jobs\EncoderChangePass;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class EncoderController extends Controller
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


    //     Session::put('fname', $fname);
    //     Session::put('lname', $lname);

    //    $fname = Session::get('fname');
    //    $lname = Session::get('lname');

        //GET THE LIST OF SUBMISSIONS
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $submissions = DB::table('validates')
        ->join('users', 'validates.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->select('validates.*','employee_profiles.first_name','employee_profiles.last_Name','statuses.status')
        ->where('employee_profiles.institutions_id', $institution)->orderby('validates_id','desc')->limit(3)->get();
 

        //GET THE INSTITUTION
        $school = DB::table('institutions')->where('institutions_id',$institution)->first()->institution_name;

 
        //CHART
        $borderColors = [
            "rgba(255, 206, 0, 1.0)",
            "rgba(16, 121, 16, 1.0)",
            "rgba(220, 0, 5, 1.0)",
           
        ];
        $fillColors = [
            "rgba(255, 206, 0, 0.5)",
            "rgba(16, 121, 16, 0.5)",
            "rgba(220, 0, 5, 0.5)",
        ];

        $pending = DB::table('validates')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->join('users', 'validates.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
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
        $chart->labels(['Pending', 'Approved', 'Disapproved']);
        $chart->dataset('Dataset', 'bar', [$pending,  $approve, $disapprove])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $chart->displayLegend(false);

        //GET THE DEADLINES
        $deadline = DB::table('deadlines')
        ->join('users', 'deadlines.user_id', '=','users.id')
        ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->select('deadlines.*','employee_profiles.first_name', 'employee_profiles.last_Name')
        ->orderby('id','desc')->limit(1)->get();

        

        $date = Carbon::now();
        $dates = $date->toFormattedDateString();         

        return view('encoder_pages.dashboard', compact('dates','school',
            'deadline','chart','submissions','fname','lname'));
    }

    public function Page_form()
    { 
        //GET THE FORMS 
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $institution_type = DB::table('institutions')->where('institutions_id',$institution)->first()->institution_types_id;
        $forms = DB::table('forms')->where('institution_types_id', $institution_type)->get();

        //GET THE FIRST AND LAST NAME OF THE USER 
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;


        return view('encoder_pages.forms',compact('forms','institution_type','fname','lname'));

    }

    public function Page_upload()
    {

        //GET THE FIRST AND LAST NAME OF THE USER 
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;


        return view('encoder_pages.upload', compact('fname','lname'));
        
    } 

    public function Page_track()
    {   

        //GET THE SUBMISSIONS FROM THE ENCODERS
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $submissions = DB::table('validates')
        ->join('users', 'validates.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->select('validates.*','employee_profiles.first_name','employee_profiles.last_Name','statuses.status')
        ->where('employee_profiles.institutions_id', $institution)
        ->whereNotIn('statuses.status', ['Active','Done'])
        ->get();

        //GET THE FIRST AND LAST NAME OF THE USER 
        $fname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->first_name;
        $lname = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->last_Name;


        return view('encoder_pages.track', compact('submissions','fname','lname'));
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

         return view('encoder_pages.password', compact('pos','div','fname','lname'));
    }

    public function Upload_file(Request $request)
    {
        
        $id = auth()->id();
        $employee = DB::table('users')->find($id)->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $abbrv = DB::table('institutions')->where('institutions_id', $institution)->first()->abbreviation;


    
        //UPLOAD THE FILE
        if($request->hasFile('file'))
        {
            foreach($request->file as $file)
            {   

                $date = Carbon::now();
                $date=  $date->year;
        
                 $filenameWithExt = $file->getClientOriginalName();
                 $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME).'_'.$abbrv.'_'.$date;
                 $filename1 = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                 $extension = $file->getClientOriginalExtension();
                 $fileNameToStore = $filename.'.'.$extension;
                 
                $forms = DB::table('forms')->get();

                $result="";
                foreach($forms as $f)
                {
                    $data = $f->form;
                    $data1 = Str::before($data,'.');
                  
                    if($data1 == $filename1)
                    {   
                        $result = "yes";
                        break;
                    }
                    else
                    {   
                        $result = "no";
                    }    
                }

                if($result == "no")
                {
                    return back()->with('warning', 'Please check the file name and avoid renaming it');
                }
                elseif($extension != 'xlsx')
                {   
                    return back()->with('warning', 'Not correct file format');
                    
                }
                 elseif (Storage::exists('public/validate/'.$fileNameToStore)) 
                {    
                    return back()->with('warning', 'Files are already submitted to validator');
                }
                 elseif (Storage::exists('public/verify/'.$fileNameToStore)) 
                {    
                    return back()->with('warning', 'Files are already submitted');
                }
                 elseif (Storage::exists('public/complete/'.$fileNameToStore)) 
                {    
                    return back()->with('warning', 'Files are already submitted');
                }
                else
                {   
                    
                    $count = \DB::table('validates')->count();
                    if($count == 0) {
                        $audit_ID = '1';
                    }else {
                        $audit_ID = DB::table('validates')->orderBy('validates_id', 'DESC')->first()->validates_id;
                        $audit_ID= $audit_ID+1;
                    }

                   // EncoderUpload::dispatch($fileNameToStore,$id); 
                     
                    $file->storeAs('public/validate',$fileNameToStore);
                      

                    $audit = new Audit_log();
                    $audit->user_id =   $id;
                    $audit->user_types_id = '1';
                    $audit->event = 'uploaded';
                    $audit->auditable_type = 'App\Validate';
                    $audit->auditable_id = $audit_ID;
                    $audit->old_values = '';
                    $audit->new_values = '{user_id:'.$id.', encoder_submission:'.$fileNameToStore.', statuses_id:3, comment:}';
                    $audit->url = URL::current();
                    $audit->ip_address = \Request::ip();
                    $audit->user_agent = $request->header('User-Agent');
                    $audit->save();  
                    

                    $val = new Validate();
                    $val->user_id = auth()->id();
                    $val->encoder_submission = $fileNameToStore;
                    $val->statuses_id = '3';
                    $val->comment = '';
                    $val->save();  
                }

            } 

          
           //response()->json(['success'=>'You have successfully upload file.']);
         return back()->with('success', 'Files has been successfully submitted to validator');
        }

    }

    public function Password_change(Request $request)
    {
        
        $id = auth()->id();
        $current_password = User::find($id)->password;
        

         if(Hash::check($request['old_password'], $current_password))
         {    

            if($request['password'] == $request['cpass'])
            {
                $user = User::find($id);
                $user->password = Hash::make($request['password']);
                $user->save(); 

                return back()->with('success', 'Change password successfully');
            }
            else
            {
                return back()->with('warning', 'Password mismatch');
            }
             
          

            // $password = Hash::make($request['password']);
            // DB::update('update users set password = ? where id = ?', [$password ,$this->id]);
            
            //EncoderChangePass::dispatch($id,$request['password']);
 
            // $oldpass =  User::find($id)->password;
            // $npass = Hash::make($request['password']);
          
            // $audit = new Audit_log();
            // $audit->user_id = $id;
            // $audit->user_types_id = '1';
            // $audit->event = 'Update';
            // $audit->auditable_type = 'App\User';
            // $audit->auditable_id =  auth()->id();
            // $audit->old_values =  '{password:'.$oldpass.'}';
            // $audit->new_values = '{password:'.$npass.'}';
            // $audit->url = URL::current();
            // $audit->ip_address = \Request::ip();
            // $audit->user_agent = $request->header('User-Agent');
            // $audit->save();  

             
         }  
         else{ 
            return back()->with('warning', 'Current password was incorrect');
         }
        
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

        return view('encoder_pages.references',compact('discipline','institutions','fname','lname'));
    }

    // public function tryyyyy(Request $request)
    // {
    //     // $val = new Validate();
    //     // $val->user_id = 1;
    //     // $val->encoder_submission = 'sample';
    //     // $val->statuses_id = '3';
    //     // $val->comment = '';
    //     // $val->save();   
    //    $sample= \Request::ip();
    //    $sample1= URL::current();
    //    $sample2= $request->header('User-Agent');
    //     return $sample2;
    // }
 
    public function audit(Request $request, $val)
    {   

        return Storage::download('public/forms/'.$val);
        //return 'wala';
    }

}
 