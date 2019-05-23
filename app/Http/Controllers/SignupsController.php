<?php

namespace App\Http\Controllers;

use App\Signups;
use App\dancer;
use App\groups;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SignupsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->except('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $signups = Signups::all();
        $groups = groups::all();
        return view('signups.index', compact('signups', 'groups'));
    }

    /**
     * Display a listing of the resource in JSON formating
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAPI()
    {
        $signups = Signups::all();
        return response()->json($signups);
    }

    /**
     * Filtering signup resources by current selected city
     *
     * @return \Illuminate\Http\Response
     */
    public function showCurrentCity($cityID)
    {
        switch ($cityID) {
            case 2:
                $signups = Signups::where('city', 'Vilnius')->get();
                break;

            case 1:
                $signups = Signups::where('city', 'Klaipeda')->get();
                break;
        }

        return response()->json($signups);
    }

    /**
     * Show the form for creating a new dancer's signup request.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('public.signup');
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
            'firstName' => 'required|max:40',
            'lastName' => 'required|max:40',
            'birthDate' => 'required|date',
            'city' => 'required|max:9',
            'primaryPhone' => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->route('SignupFormPublic')->withErrors('operation', '0');
        }
        $signup = Signups::create($request->all());
        return redirect()->route('SignupFormPublic')->withErrors('operation', '1');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Signups  $signups
     * @return \Illuminate\Http\Response
     */
    public function show(Signups $signups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Signups  $signups
     * @return \Illuminate\Http\Response
     */
    public function edit(Signups $signups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Signups  $signups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signups $signups)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Signups  $signups
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = deleteSignup($request->input('id'));
        //
    }



}
