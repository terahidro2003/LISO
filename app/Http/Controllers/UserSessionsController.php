<?php

namespace App\Http\Controllers;

use App\UserSessions;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\AuthenticationCodes;
use DB;

use Illuminate\Http\Request;

class UserSessionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Get users list
     *
     * @return \Illuminate\Http\Response
     */
    public function usersList()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Get users list
     *
     * @return \Illuminate\Http\Response
     */
    public function generateNewUserUrl(Request $req)
    {
        $code = rand(10000, 99999);
        $newCode = new AuthenticationCodes;
        $newCode->code = $code;
        $newCode->purpose = 1;
        $newCode->created_by_user = Auth::user()->id;
        $newCode->save();
        return response()->json(['status' => 'OK', 'code' => $code]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserSessions  $userSessions
     * @return \Illuminate\Http\Response
     */
    public function show(UserSessions $userSessions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserSessions  $userSessions
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSessions $userSessions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserSessions  $userSessions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSessions $userSessions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserSessions  $userSessions
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSessions $userSessions)
    {
        //
    }
}
