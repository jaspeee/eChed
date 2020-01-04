<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    public function authenticated()
    {
        if(auth()->user()->user_types_id =='1')
        {
            return redirect('/encoder/dashboard');
        }
        elseif(auth()->user()->user_types_id =='2')
        {
            return redirect('/validator/dashboard');
        } 
        elseif(auth()->user()->user_types_id =='3')
        {
            return redirect('/verifier/dashboard');
        } 
        elseif(auth()->user()->user_types_id =='4')
        {
            return redirect('/officer/dashboard');
        } 

        return redirect('/home');
    }

    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['statuses_id' => 1]);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
