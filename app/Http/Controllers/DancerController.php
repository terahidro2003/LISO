<?php

namespace App\Http\Controllers;

use App\dancer;
use Illuminate\Support\Facades\Validator;
use App\Signups;
use App\payments;
use App\fees;
use App\groups;
use Illuminate\Http\Request;

class DancerController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = groups::all();
        $members = dancer::all();
        return view('members.index', compact('members', 'groups'));
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
    public function signup2store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'signupID' => 'required',
            'groupID' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['status' => 'FAILED', 'cause' => '1']);
        }
        $signup = Signups::where('id', $request->input('signupID'))->get();
        if(empty($signup)){return response()->json(['status' => 'FAILED', 'cause' => '2']);}
        foreach ($signup as $sign) {
            $templateDancer = dancer::where('lastName', $sign->lastName)->where('firstName', $sign->firstName)->first();
            if(isset($templateDancer)){
                return response(['status' => 'FAILED', 'cause' => '3']);
            }
            if(empty($templateDancer)){
                $dancer = dancer::create([
                'firstName' => $sign->firstName,
                'lastName' => $sign->lastName,
                'primaryPhone' => $sign->primaryPhone,
                'birthDate' => $sign->birthDate,
                'city' => $sign->city,
                'group' => $request->input('groupID'),
                ]);
                $delete = deleteSignup($sign->id);
                return response(['status' => 'OK']);
            }
        }


        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAPI(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'birthDate' => 'required',
            'primaryPhone' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['status' => 'FAILED', 'cause' => '1']);
        }
            $templateDancer = dancer::where('lastName', $request->input('lastName'))->where('firstName', $request->input('firstName'))->first();
            if(isset($templateDancer)){
                return response(['status' => 'FAILED', 'cause' => '3']);
            }
            if(empty($templateDancer)){
                $dancer = dancer::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'primaryPhone' => $request->input('primaryPhone'),
                'birthDate' => $request->input('birthDate'),
                'city' => $request->input('city'),
                'group' => 0,
                ]);
                return response(['status' => 'OK']);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\dancer  $dancer
     * @return \Illuminate\Http\Response
     */
    public function show(dancer $dancer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\dancer  $dancer
     * @return \Illuminate\Http\Response
     */
    public function edit($dancerID)
    {
        $errors = [];
        //Check if user has warnings
        if(MoreThanOneRFID($dancerID) == 1){
            $errors[0] = 1;
        }else{
            $errors[0] = 0;
        }
        $groups = groups::all();
        $dancer = dancer::where('id', $dancerID)->get();
        $payments = payments::where('member', $dancerID)->get();
        $fees = fees::where('owner', $dancerID)->get();
        $balance = calculateBalance($payments, $fees);
        return view('members.edit', compact('dancer', 'groups', 'balance', 'payments', 'errors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\dancer  $dancer
     * @return \Illuminate\Http\Response
     */
    public function update($dancerID, Request $request, dancer $dancer)
    {
        $member = dancer::find($dancerID);
        $member->firstName = $request->input('firstName');
        $member->lastName = $request->input('lastName');
        $member->birthDate = $request->input('birthDate');
        $member->primaryPhone = $request->input('primaryPhone');
        $member->group = $request->input('group');
        $member->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\dancer  $dancer
     * @return \Illuminate\Http\Response
     */
    public function destroy($dancer)
    {
        try{
            dancer::where('id', $dancer)->delete();
        }catch(exception $e){
            return response(['status' => 'FAILED']);
        }
        return response(['status' => 'OK']);
    }
}
