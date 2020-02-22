<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution_type extends Model
{
    protected $primaryKey = 'institution_types_id';

    protected $fillable = [
      
        'institution_types_id',
        'type',
       
     ];
}
