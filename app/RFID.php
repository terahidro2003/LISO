<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RFID extends Model
{
	protected $fillable = [
		'RFID', 'Owner'
	];

	public function dancer()
	{
		return $this->belongsTo(dancer::class, "Owner", "id");
	}
}
