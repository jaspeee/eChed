<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Verify;

class ValidatorApprove implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $filename;
    protected $id;
    protected $id1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$filename,$id1)
    {
        $this->filename = $filename;
        $this->id = $id;
        $this->id1 = $id1;
    } 

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $status = '4';
        // DB::update('update validates set statuses_id = ? where validates_id = ?', [$status,$this->id]);
     
        //UPDATE THE VCOUNT IN COUNTS TABLE
        $user = DB::table('validates')->where('validates_id', $this->id)->first()->user_id;
        $employee = DB::table('users')->where('id', $user)->first()->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id', $employee)->first()->institutions_id;  
        $count = DB::table('counts')->where('institutions_id', $institution)->first()->vcount;
        $final_count = $count + 1;
        DB::update('update counts set vcount = ? where institutions_id = ?', [$final_count,$institution]);

         //STORE DATA TO VERIFIES TABLE
        $vfy = new Verify();
        $vfy->user_id =  $this->id1;
        $vfy->validator_submission =  $this->filename;
        $vfy->statuses_id = '3';
        $vfy->comment = '';
        $vfy->save(); 

        Storage::move('public/validate/'. $this->filename, 'public/verify/' . $this->filename);

       

    }
}
