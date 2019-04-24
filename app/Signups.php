<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signups extends Model
{
	protected $fillable = [
		'firstName',
		'lastName',
		'primaryPhone',
		'birthDate',
		'city',
	];


    //
}
