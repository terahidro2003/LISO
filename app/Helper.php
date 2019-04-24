<?php

use App\dancer;
use App\Signups;
use App\RFID;

function deleteSignup($signupID)
{
	// 1 - operation success
	//2 - operation failed
	try
	{
		$signupRequest = Signups::where('id', $signupID)->delete();
		return 1;
	}
	catch(Exception $e)
	{
		return 0;
	}
}


function deleteMember($ID)
{
	// 1 - operation success
	//2 - operation failed
	try
	{
		$memberRequest = dancer::where('id', $ID)->delete();
		return 1;
	}
	catch(Exception $e)
	{
		return 0;
	}
}

function calculateBalance($memberPayments, $memberFees)
{
		$balance = 0;
		$paymentSum = 0;
		$feesSum = 0;
		foreach ($memberPayments as $singlePayment) {
			# code...
			$paymentSum+=$singlePayment->price;
		}
		foreach ($memberFees as $Fee) {
			$feesSum+=$Fee->price;
		}
		$balance = $paymentSum - $feesSum;
		return $balance;
}

	/**
     * Track if more than one RFID is assigned to member
     *
     * 1 - ERROR (user has one than one RFID's assigned), 0 - CLEAR (user has one RFID assigned)
     *
     * @return \Illuminate\Http\Response
     */
    function MoreThanOneRFID($ID)
    {
    	$RFID = RFID::where('Owner', $ID)->get();
    	if (count($RFID) > 1){
    		return 1;
    	}else{
    		return 0;
    	}
    }