<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use OwenIt\Auditing\Auditable;
// use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
// use OwenIt\Auditing\Contracts\UserResolver;
use Auth;

//implements AuditableContract, UserResolver
class User extends Authenticatable 
{   
    //use Auditable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array 
     */
    protected $fillable = [
       'username','email','password', 'employee_profiles_id', 'user_types_id', 'statuses_id'
    ]; 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //   public static function resolveId()
    // {
    //     return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    // }
}
