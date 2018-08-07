<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentController extends Controller
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
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = new Comment;
        
        $comment->user_id = Auth::user()->id;
        $comment->event_id = $request['event_id'];
        $comment->comment = $request['comment'];
        $comment->save();

        $id = $request['event_id'];

        return redirect("event/$id")->with('success', 'You just created a new comment');
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
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = Comment::find($id);
        $comment->update([
            $comment->comment = $request['comment']
        ]);

        $event_id = $request['event_id'];

        return redirect("event/$event_id")->with('success', 'You just edited a comment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Comment::find($id);
        $event->delete();

        return redirect()->back()->with('success', 'You just deleted a comment'); 
    }
}
