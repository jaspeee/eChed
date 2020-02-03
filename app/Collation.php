<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collation extends Model
{
    protected $fillable = [
      
        'institutions_id',
        'program_name',
        'major_name',
        'discipline_groups_id',
        'tuition',
        '0M',
        '0F',
        '1M',
        '1F',
        '2M',
        '2F',
        '3M',
        '3F',
        '4M',
        '4F',
        '5M',
        '5F',
        '6M',
        '6F',
        '7M',
        '7F',
        'TME',
        'TFE',
        'TE',
        'TMG',
        'TFG',
        'TG',
        'institution_types_id',

     ];
}
