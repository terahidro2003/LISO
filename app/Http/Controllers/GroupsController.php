<?php

namespace App\Http\Controllers;

use App\groups;
use App\dancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupsController extends Controller
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
        $groups = groups::withCount('members')->get();
        return view('groups.index', compact('groups'));
    }

    /**
     * Display a listing of the resource in JSON formatting.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAPI()
    {
        $groups = groups::withCount('members')->get();
        return response()->json($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => 'required|max:50',
        ]);
        if ($validator->fails()){
            return response()->json(['status' => 'FAILED']);
        }
        $group = groups::create([
            'groupName' => $request->input('name'),
            'description' => $request->input('description'),
            'leader' => $request->input('leader'),
        ]);
        return response(['status' => 'OK']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function show(groups $groups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function edit($groupID)
    {
        $groups = groups::where('id', $groupID)->get();
        return view('groups.edit', compact('groups'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $groupID)
    {
        $groups = groups::find($groupID);
        $groups->groupName = $request->input('groupName');
        $groups->leader = $request->input('leader');
        $groups->description = $request->input('description');
        $groups->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function destroy(groups $groups)
    {
        //
    }
    /**
     * Show members of given group
     *
     * @param  \App\Signups  $signups
     * @return \Illuminate\Http\Response
     */
    public function members($id)
    {
        $members = dancer::where('group', $id)->get();
        $groupName = groups::where('id', $id)->select('groupName')->first();
        return view('groups.members', compact('members', 'groupName'));
    }
}
