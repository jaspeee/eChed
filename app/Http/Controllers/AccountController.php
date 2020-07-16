<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Concern;
use App\Audit_log;
use Hash;
use Illuminate\Support\Facades\URL; 
use RealRashid\SweetAlert\Facades\Alert;



class AccountController extends Controller
{
    public function Page_acc()
    {
       
        return view('redirect');
    }

    public function Page_forgot()
    {
       
        return view('forgotpass');
    }

    public function Page_forgot_req(Request $request)
    {   

        $user1 = DB::table('users')
        ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->where('employee_profiles.first_name',$request->fname)
        ->where('employee_profiles.last_Name',$request->lname)
        ->where('users.username',$request->username)->get();

        if(!$user1->isEmpty())
        {
            $user = DB::table('users')
            ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
            ->where('employee_profiles.first_name',$request->fname)
            ->where('employee_profiles.last_Name',$request->lname)
            ->where('users.username',$request->username)->first()->id;
    
        
    
            $con = new Concern();
            $con->user_id = $user;
            $con->statuses_id = '6';
            $con->save();   
    
            $type = 'Reset Password';
    
            return view('process', compact('type'));

           
        }
        else
        {
            return back()->with('warning', 'No credentials found'); 
        }
       
    }
    
    public function Accounts_changePass(Request $request, $id)
    {   

        if($request['npass'] == $request['cpass'])
        {
            $newpass = Hash::make($request['npass']);
        
            DB::update('update users set password = ? where id = ?', [$newpass,$id]);


            $usertype = DB::table('users')->where('id',auth()->id())->first()->user_types_id;
            $oldpass = DB::table('users')->where('id',$id)->first()->password;

            $audit = new Audit_log();
            $audit->user_id =  auth()->id();
            $audit->user_types_id = $usertype;
            $audit->event = 'reset password';
            $audit->auditable_type = 'App\User';
            $audit->auditable_id = $id;
            $audit->old_values = '{password:'.$oldpass.'}';
            $audit->new_values = '{password:'.$newpass.'}';
            $audit->url = URL::current();
            $audit->ip_address = \Request::ip();
            $audit->user_agent = $request->header('User-Agent');
            $audit->save();  
            
            return back()->with('success', 'Change password successfully'); 
        } 
        else
        {
            return back()->with('warning', 'Mismatch password'); 
        }
        
        
 
        
    }

    public function Page_inactive_req(Request $request)
    {   
        $user1 = DB::table('users')
        ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
        ->where('employee_profiles.first_name',$request->fname)
        ->where('employee_profiles.last_Name',$request->lname)
        ->where('users.username',$request->username)->get();

        if(!$user1->isEmpty())
        {
            $user = DB::table('users')
            ->join('employee_profiles', 'users.employee_profiles_id', '=','employee_profiles.employee_profiles_id')
            ->where('employee_profiles.first_name',$request->fname)
            ->where('employee_profiles.last_Name',$request->lname)
            ->where('users.username',$request->username)->first()->id;
    
            $con = new Concern();
            $con->user_id = $user;
            $con->statuses_id = '7';
            $con->save();   

            $type = 'Reactivate Account';
            return view('process', compact('type')); 
        }
        else
        {
            return back()->with('warning', 'No credentials found'); 
        }
        
    }

 

}
