<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $primaryKey = 'institutions_id';

    protected $fillable = [
      
        'institutions_id',
        'code',
        'institution_name',
        'abbreviation',
        'institution_types_id',
        'statuses_id',

     ];

}
