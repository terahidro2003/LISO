<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paymentStatistics extends Model
{
	protected $fillable = ['range', 'balance', 'fees', 'payments', 'deptors', 'month', 'year'];
    //
}
