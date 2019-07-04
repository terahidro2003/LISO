<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthenticationCodes extends Model
{
    protected $fillable = [
    	'code', 'created_by_user', 'purpose'
    ];
}
