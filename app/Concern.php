<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concern extends Model
{
    protected $fillable = [
      
        'concerns_id',
        'user_id',
        'statuses_id',
        
     ];
}
