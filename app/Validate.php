<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Validate extends Model implements Auditable
{   
    
    use \OwenIt\Auditing\Auditable; 

    protected $fillable = [
        'validates_id',
        'user_id',
        'encoder_submission',
        'statuses_id',
        'comment',
     ]; 

    

   
}
