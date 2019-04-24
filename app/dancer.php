<?php

namespace App;
use \App\groups;
use Illuminate\Database\Eloquent\Model;

class dancer extends Model
{
	protected $fillable = [
		'firstName',
		'lastName',
		'primaryPhone',
		'birthDate',
		'city',
		'group',
	];
	public function currentGroup()
	{
		return $this->belongsTo(groups::class, 'group');
	}
	public function rfid()
	{
		return $this->belongsTo(RFID::class, 'id', 'Owner');
	}
    //
}
