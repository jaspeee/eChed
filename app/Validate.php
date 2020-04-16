<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Validate extends Model implements AuditableContract
{   
    
    use Auditable;

    protected $fillable = [
        'validates_id',
        'user_id',
        'encoder_submission',
        'statuses_id',
        'comment',
     ]; 

     protected $auditInclude  = [

        'created_at', 'updated_at', 'deleted_at'

    ];

   
}
