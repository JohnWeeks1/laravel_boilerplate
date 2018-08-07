<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attend;
use Auth;

class AttendController extends Controller
{

    // protected $fillable = ['attending'];
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
        $attend = new Attend;

        $id = $request['event_id'];

        $attend->user_id = Auth::user()->id;
        $attend->event_id = $id;
        $attend->attending = $request['attending'];

        $attend->save();

        return redirect("event/$id")->with('success', 'You are going to attend this event');
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
        $attend = Attend::find($id);
        $attend->delete();

        return redirect()->back()->with('success', 'You are no longer attending this event'); 
    }
}
