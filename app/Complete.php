<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complete extends Model
{
    protected $fillable = [
      
        'completes_id',
        'user_id',
        'verifier_submission',
        'forms_id',
        'institutions_id',
        'statuses_id', 
        'comment',
     
     ];
}
