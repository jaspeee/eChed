<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    protected $fillable = [
      
        'id',
        'user_id',
        'message',
        'deadline_date',
     
     ];
}
