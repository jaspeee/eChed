<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Complete;

class VerifierApprove implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $id1;
    protected $id;
    protected $filename;
    protected $form_id;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $id1, $filename, $form_id)
    {
        $this->id = $id;
        $this->id1 = $id1;
        $this->filename = $filename;
        $this->form_id = $form_id;
    }

    /** 
     * Execute the job.
     *
     * @return void 
     */
    public function handle()
    {
        // //UPDATE STATUS IN VALIDATES TABLE
        // $status = '4';
        // DB::update('update verifies set statuses_id = ? where verifies_id = ?', [$status,$this->id]);
    
        //UPDATE THE VCOUNT IN COUNTS TABLE
        $user = DB::table('verifies')->where('verifies_id', $this->id)->first()->user_id;
        $employee = DB::table('users')->where('id', $user)->first()->employee_profiles_id;
        $institution = DB::table('employee_profiles')->where('employee_profiles_id', $employee)->first()->institutions_id;  
        $count = DB::table('counts')->where('institutions_id', $institution)->first()->fcount;
        $final_count = $count + 1;
        DB::update('update counts set fcount = ? where institutions_id = ?', [$final_count,$institution]);
        
        
        //STORE DATA TO VERIFIES TABLE
        $comp = new Complete();
        $comp->user_id = $this->id1;
        $comp->verifier_submission =  $this->filename;
        $comp->forms_id =  $this->form_id; 
        $comp->institutions_id = $institution;
        $comp->statuses_id = '3'; 
        $comp->comment = ''; 
        $comp->save();

        Storage::move('public/verify/'.$this->filename, 'public/complete/' .$this->filename);

    }
}
