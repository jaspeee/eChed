<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Employee_profile;
use App\User;
use Hash;

class OfficerAddAccValidator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $id;
    protected $fname;
    protected $lname;
    protected $email;
    protected $position;
    protected $division;
    protected $institution1;

    /**
     * Create a new job instance.
     *
     * @return void 
     */
    public function __construct($id,$fname,$lname,$email,$position,$division,$institution1)
    {
        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->position = $position;
        $this->division = $division;
        $this->institution1 = $institution1;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //GET THE INSTITUTION ID
        $employee = DB::table('users')->find($this->id)->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id',$employee)->first()->institutions_id;
     
        //ADD EMPLOYEE
        $emp = new Employee_profile();
        $emp->first_name = $this->fname;
        $emp->last_Name = $this->lname;
        $emp->position = $this->position;
        $emp->division = $this->division;
        $emp->institutions_id = $this->institution1;
        $emp->save();
        
        //ADD USER
        $users = $this->fname . '' . $this->lname . '123';
        $pass = 'validator123';

        $emp_id =  DB::table('employee_profiles')->latest()->first()->employee_profiles_id; 
        $hashpass = Hash::make($pass);

        $user = new User();
        $user->username = $users;
        $user->email = $this->email;
        $user->password = $hashpass;
        $user->employee_profiles_id = $emp_id;
        $user->user_types_id = '2';
        $user->statuses_id = '1';
        $user->save();     
    }
}
