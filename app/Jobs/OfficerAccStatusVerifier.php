<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;

class OfficerAccStatusVerifier implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $id;
    protected $status;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->status == 'Active')
        {   
            $user = User::find($this->id);
            $user ->statuses_id = '2';
            $user ->save();
             
           
        }else{ 
            $user = User::find($this->id);
            $user ->statuses_id = '1';
            $user ->save();
          
        }
    }
}
