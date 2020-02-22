<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OfficerDisapprove implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $comment;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$comment)
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
       
           
            //GET THE FILE NAME
            $filename = DB::table('completes')->where('completes_id',  $this->id)->first()->verifier_submission;
            
              //UPDATE THE VCOUNT IN COUNTS TABLE
              $institution = DB::table('completes')->where('completes_id',  $this->id)->first()->institutions_id;
              $fcount = DB::table('counts')->where('institutions_id', $institution)->first()->fcount;
              $final_fcount = $fcount - 1;
              $vcount = DB::table('counts')->where('institutions_id', $institution)->first()->vcount;
              $final_vcount = $vcount - 1;
 
              DB::table('counts')  
              ->where('institutions_id',$institution)
              ->update(['vcount' => $final_vcount, 'fcount' => $final_fcount]);

              $comment1 =  $this->comment . ' - Officer'; 
              DB::table('verifies')  
              ->where('validator_submission',$filename)
              ->where('statuses_id','4')
              ->update(['statuses_id' => '5', 'comment' => $comment1]);

              DB::table('validates')  
              ->where('encoder_submission',$filename)
              ->where('statuses_id','4')
              ->update(['statuses_id' => '5', 'comment' => $comment1]);

            Storage::delete('public/complete/'.$filename);
            

    }
}
