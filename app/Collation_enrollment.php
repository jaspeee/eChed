<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collation_enrollment extends Model
{
    protected $fillable = [
        'program_name','major_name', 'total_male', 'total_female', 'total_enrollment'
     ];
}

