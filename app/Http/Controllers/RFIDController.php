<?php

namespace App\Http\Controllers;

use App\RFID;
use App\Entrie;
use App\dancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RFIDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rfids = RFID::all();
        return view('rfid.index', compact('rfids'));
    }

     /**
     * Scan RFID device via WEB enveroment
     *
     * @return \Illuminate\Http\Response
     */
    public function scan(Request $Req)
    {
        $checker = Validator::make($Req->all(), [
        	'RFID' => 'required',
        ]);
        if($checker->fails()){
        	return response()->json(['status' => 'FAILED', 'cause' => 1]);
        }
        $owner = RFID::where('RFID', $Req->input('RFID'))->first();

        if(empty($owner))
        {
        	return response()->json(['status' => 'FAILED', 'cause' => 3]);
        }
        $ownerData = dancer::where('id', $owner->id)->first();

        $todaysEntrie = Entrie::where('Owner', $owner->Owner)->where('created_at', 'LIKE', '%'.date('Y-m').'%')->first();


        if(!empty($todaysEntrie)){
        	return response()->json(['status' => 'FAILED', 'cause' => 2]);
        }
        $entrie = new Entrie;
        $entrie->RFID = $Req->input('RFID');
        $entrie->Owner = $owner->Owner;
        $entrie->save();
        return response()->json(['status' => 'OK', 'firstName' => $ownerData->firstName, 'lastName' => $ownerData->lastName]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'RFID' => 'required',
            'Owner' => 'required',
        ]);
        if ($validator->fails())
        {
            return response(['status' => 'FAILED', 'cause' => 1]);
        }
        $RFID = RFID::create($request->all());
        return response(['status' => 'OK']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RFID  $rFID
     * @return \Illuminate\Http\Response
     */
    public function show(RFID $rFID)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RFID  $rFID
     * @return \Illuminate\Http\Response
     */
    public function edit(RFID $rFID)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RFID  $rFID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RFID $rFID)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RFID  $rFID
     * @return \Illuminate\Http\Response
     */
    public function destroy(RFID $rFID)
    {
        //
    }
}
