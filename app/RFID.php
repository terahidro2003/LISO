<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RFID extends Model
{
	protected $fillable = [
		'RFID', 'Owner'
	];

	public function owner()
	{
		return $this->belongsTo(dancer::class, 'Owner');
	}
}
