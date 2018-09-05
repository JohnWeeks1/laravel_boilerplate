<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Friend;
use App\User;
use Auth;

class ProfileController extends Controller
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
        $user = User::find(Auth::user()->id);
        return view('profile.profile_page', [
            'user' => $user,
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile_by_user_id($id)
    {
        $user = User::find($id);

        $friend_request = 
            Friend::where('user_requesting_friendship_id', Auth::user()->id)
                    ->where('user_receiveing_friendship_id', $id)
                    ->first();

        return view('profile.profile_page', [
            'user' => $user,
            'friend_request' => $friend_request
        ]);
    }

    public function profile_search()
    {
        $users = User::paginate(20);
        return view('profile.profile_search', [
            'users' => $users,
        ]);
    }

    public function profile_search_selected(Request $request)
    {
        $user_by_id = User::find($request['user_id']);
        
        return view('profile.profile_search', [
            'user_by_id' => $user_by_id
        ]);
    }

    public function send_friend_request($id) 
    {
        $friend = new Friend;

        $friend->user_requesting_friendship_id = Auth::user()->id;
        $friend->user_receiveing_friendship_id = $id;
        $friend->approved_or_not = 0;
        $friend->save();

        return redirect()->back()->with("success","Request sent!");
    }
}
