<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Form;
use App\Validate;
use App\Charts\StatusChart;
use Hash;

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

        //GET THE LIST OF SUBMISSIONS
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
        $submissions = DB::table('validates')
        ->join('users', 'validates.user_id', '=','users.id')
        ->join('employee_profiles','users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->select('validates.*','employee_profiles.first_name','employee_profiles.last_Name','statuses.status')
        ->where('employee_profiles.institutions_id', $institution)->orderby('validates_id','desc')->limit(3)->get();
 
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

        $pending = DB::table('validates')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->where('statuses.status', 'pending')->count();

        $approve = DB::table('validates')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->where('statuses.status', 'approve')->count();

        $disapprove = DB::table('validates')
        ->join('statuses','validates.statuses_id', '=','statuses.statuses_id')
        ->where('statuses.status', 'disapprove')->count();


        $chart = new StatusChart;
        $chart->labels(['Pending', 'Approve', 'Disapprove']);
        $chart->dataset('Dataset', 'bar', [$pending,  $approve, $disapprove])
            ->color($borderColors)
            ->backgroundcolor($fillColors);
        
        $chart->displayLegend(false);

        //GET THE DEADLINES
        $deadline = DB::table('deadlines')
        ->join('users', 'deadlines.user_id', '=','users.id')
        ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->select('deadlines.*', 'employee_profiles.first_name', 'employee_profiles.last_Name')->paginate(1);


        return view('encoder_pages.dashboard', compact('deadline','chart','submissions','fname','lname'));
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
        ->where('employee_profiles.institutions_id', $institution)->get();

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


        $this->validate($request, [

            'file' => 'required',
            'file.*' => 'mimes:xlsx'

        ]);
    
        //UPLOAD THE FILE
        if($request->hasFile('file'))
        {
            foreach($request->file as $file)
            {   
                 $filenameWithExt = $file->getClientOriginalName();
                 $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME).'_'.$abbrv;
                 $extension = $file->getClientOriginalExtension();
                 $fileNameToStore = $filename.'.'.$extension;
                
                 $file->storeAs('public/validate',$fileNameToStore);

                $val = new Validate();
                $val->user_id = auth()->id();
                $val->encoder_submission = $fileNameToStore;
                $val->statuses_id = '3';
                $val->comment = '';
                $val->save();

            }

            return back()->with('success', 'Your files has been successfully added');
        }

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

        return view('encoder_pages.references',compact('discipline','institutions','fname','lname'));
    }

}
