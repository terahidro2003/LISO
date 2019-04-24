<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class groups extends Model
{
	protected $fillable = ['groupName', 'description', 'leader'];

	public function members()
	{
	     return $this->hasMany(dancer::class, 'group');
	}
    //
}
