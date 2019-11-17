<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    protected $primaryKey = 'adminID';
    protected $table = 'admin';


    protected $fillable = [
        'adminID', 'admin_email','admin_fName', 'password','admin_mName', 'admin_lName', 'adminName',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
