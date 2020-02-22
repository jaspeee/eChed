<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Concern;
use Hash;


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
    
    public function Accounts_changePass(Request $request, $id)
    {   

        $newpass = Hash::make($request['npass']);
        
        DB::update('update users set password = ? where id = ?', [$newpass,$id]);

         return back()->with('success', 'Change password successfully');
    }

    public function Page_inactive_req(Request $request)
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

 

}
