<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VerifierDisapprove implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $comment;
    protected $id;

    /**
     * Create a new job instance. 
     *
     * @return void
     */
    public function __construct($id, $comment)
    {
        $this->comment = $comment;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void 
     */
    public function handle()
    {
         //UPDATE THE COMMENT IN VALIDATES TABLE
         DB::update('update verifies set comment = ? where verifies_id = ?', [$this->comment,$this->id]);
            
        //GET THE FILE NAME
        $filename = DB::table('verifies')->where('verifies_id', $this->id)->first()->validator_submission;
            
        //UPDATE THE VCOUNT IN COUNTS TABLE
        $user = DB::table('verifies')->where('verifies_id', $this->id)->first()->user_id;
        $employee = DB::table('users')->where('id', $user)->first()->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id', $employee)->first()->institutions_id;  
        $count = DB::table('counts')->where('institutions_id', $institution)->first()->vcount;
        $final_count = $count - 1;
        DB::update('update counts set vcount = ? where institutions_id = ?', [$final_count,$institution]);
  
        Storage::delete('public/verify/'.$filename);
 

    }
}
