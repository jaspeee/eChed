<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Validate;
use App\Audit_log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EncoderUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fileNameToStore;
    protected $id;
   
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fileNameToStore, $id)
    {
        $this->fileNameToStore = $fileNameToStore;
        $this->id = $id;
    
    } 

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $val = new Validate(); 
        $val->user_id =  $this->id;
        $val->encoder_submission = $this->fileNameToStore;
        $val->statuses_id = '3';
        $val->comment = '';
        $val->save();  

        // $audit_ID = DB::table('validates')->orderBy('validates_id', 'DESC')->first()->validates_id;
        // $audit_ID= $audit_ID+1;

        // $audit = new Audit_log();
        // $audit->user_id =   $this->id;
        // $audit->user_types_id = '1';
        // $audit->event = 'Upload';
        // $audit->auditable_type = 'App\Validate';
        // $audit->auditable_id = $audit_ID;
        // $audit->old_values = '';
        // $audit->new_values = '{user_id:"",encoder_submission:"",statuses_id:"",comment:""}';
        // $audit->url = URL::current();
        // $audit->ip_address = \Request::ip();
        // $audit->user_agent = $request->header('User-Agent');
        // $audit->save();  
        

    }
}
