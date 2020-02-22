<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    protected $fillable = [
      
        'verifies_id',
        'user_id',
        'validator_submission',
        'statuses_id',
        'comment',

     ];
}
