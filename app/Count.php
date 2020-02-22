<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
    protected $fillable = [
      
        'counts_id',
        'institutions_id',
        'vcount',
        'fcount',
     
     ];
}
