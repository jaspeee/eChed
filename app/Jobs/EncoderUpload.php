<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Validate;
use Illuminate\Support\Facades\Storage;

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
    public function handle()
    {
        $val = new Validate();
        $val->user_id =  $this->id;
        $val->encoder_submission = $this->fileNameToStore;
        $val->statuses_id = '3';
        $val->comment = '';
        $val->save();  

    }
}
