<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    //protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'user_name', 'user_type','email','first_name', 'last_name', 'contact_number', 'billing_address', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function review()
    {
        return $this->hasMany('App\Review', 'user_id');  
    }
}
