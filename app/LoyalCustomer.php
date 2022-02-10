<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class LoyalCustomer extends Authenticatable
{
    protected $table         =    'loyal_customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'email2' , 'pass_Col',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

        'password', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->pass_Col;         // colume named "pass"
    }
}
