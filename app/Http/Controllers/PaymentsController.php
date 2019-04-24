<?php

namespace App\Http\Controllers;

use App\payments;
use App\dancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = payments::all();
        return view('payments.index', compact('payments'));
        //
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
            'price' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['status' => 'FAILED', 'cause' => '1']);
        }
            $payment = payments::create([
                'member' => $request->input('id'),
                'price' => $request->input('price'),
            ]);

            return response(['status' => 'OK']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function show(payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit(payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function destroy(payments $payments)
    {
        //
    }

    /**
     * Attach and adapt the discount for current member.
     *
     * @param  \App\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function changePaymentSettings($dancerID, Request $request)
    {
        $currentDancer = dancer::where('id', $dancerID)->first();
        $newFee = $request->input('fee');
        $VIP = $request->input('VIP');
        $currentDancer->fee = $newFee;
        $currentDancer->VIP = $VIP;
        $currentDancer->save();
        return back();
    }


}
