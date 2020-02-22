<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
      
        'programs_id',
        'discipline_groups_id',
        'program_levels_id',
        'program_name',
      

     ];
}
