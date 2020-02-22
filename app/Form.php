<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
      
        'forms_id',
        'form',
        'description',
        'institution_types_id',

     ];
}
