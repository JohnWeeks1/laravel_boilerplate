<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use Auth;
use Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $events = User::find($id)->events;
        return view('admin.events.events', [
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create_event');
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
            'name' => 'required|unique:events|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);

        $event = new Event;

        $event->user_id = Auth::user()->id;
        $event->name = $request['name'];
        $event->description = $request['description'];

        if($request->hasFile('image')) {
            
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            
            $path = 'images/events/'.$filename;
            Image::make($image->getRealPath())->save($path);

            $event->path = $filename;
            $event->save();
        }

        return redirect('admin/events')->with('success', 'You just created a new event');
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
        $event = Event::find($id);
        return view('admin.events.edit_event', 
            ['event' => $event]
        );
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
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $event = Event::findOrFail($id);
        $event->name = $request['name'];
        $event->description = $request['description'];

        if ($request->hasFile('image')) {

            if(!empty($user->path)) {
                $file_path = "images/events/$user->path";
                unlink($file_path);
            }

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            
            $path = 'images/events/'.$filename;
            Image::make($image->getRealPath())->save($path);

            $event->path = $filename;
            $event->update();
            
        }
        $event->update();

        return redirect('admin/events')->with('success', 'You just update the event called ' . $request['name'] . '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return redirect('admin/events')->with('success', 'You just deleted an event'); 
    }
}
