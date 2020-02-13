<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\User;
use Hash;


class EncoderChangePass implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $request;



    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$request)
    {
        
        $this->id = $id;
        $this->request = $request;
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   

        
        // $user = User::find($this->id);
        // $user->password = Hash::make($this->request);
        // $user->save(); 

        $password = Hash::make($this->request);
        DB::update('update users set password = ? where id = ?', [$password ,$this->id]);
        
          
    }
}
