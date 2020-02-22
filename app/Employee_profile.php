<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_profile extends Model
{
    protected $primaryKey = 'employee_profiles_id';

    protected $fillable = [
      
        'employee_profiles_id',
        'first_name',
        'last_Name',
        'position',
        'division',
        'institutions_id',

     ];

}
