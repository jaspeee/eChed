<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validate extends Model
{
    protected $fillable = [
        'validates_id',
        'user_id',
        'encoder_submission',
        'statuses_id',
        'comment',
     ]; 
 
}
