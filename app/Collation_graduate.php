<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collation_graduate extends Model
{
    protected $fillable = [
        'program_name','major_name', 'total_male', 'total_female', 'total_graduate', 'institution_types_id'
     ];
}
