<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ValidatorDisapprove implements ShouldQueue
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
         //UPDATE COMMENT IN VALIDATES TABLE 
         DB::update('update validates set comment = ? where validates_id = ?', [ $this->comment,  $this->id]);

        //  //UPDATE THE STATUS IN VALIDATES TABLE
        //  $status = '5';
        //  DB::update('update validates set statuses_id = ? where validates_id = ?', [$status,$this->id]);
         
         //GET THE FILE NAME 
         $filename = DB::table('validates')->where('validates_id', $this->id)->first()->encoder_submission;

         Storage::delete('public/validate/'.$filename);

    }
}
