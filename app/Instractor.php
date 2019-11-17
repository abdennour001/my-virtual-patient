<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Instractor extends Authenticatable
{
    protected $table = 'instractor';
    protected $primaryKey = 'instractorID';



    protected $fillable = [
        'instractorID', 'instractor_email','instractor_mName', 'password','instractor_fName',
        'instractor_lName', 'instractorName','instractor_university','instractor_status',
        'instractor_agree_disagree',
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
