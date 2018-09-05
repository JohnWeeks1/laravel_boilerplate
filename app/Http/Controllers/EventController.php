<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Comment;
use App\Event;
use App\User;
use Auth;
use DB;
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
            'date' => 'required',
            'time' => 'required',
            'image' => 'required',
            'address' => 'required',
        ]);

        $event = new Event;

        $event->user_id = Auth::user()->id;
        $event->name = $request['name'];
        $event->description = $request['description'];
        $event->date_time = $request['date'] . " " . $request['time'] . ":00";

        if($request->hasFile('image')) {
            
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            
            $path = 'images/events/'.$filename;
            Image::make($image->getRealPath())->save($path);

            $event->path = $filename;
            $event->save();
            $event_id = DB::getPdo()->lastInsertId();
        }

        $location = new Location;

        $address = $request['address'];
        $data = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&key=AIzaSyB58LtIzgABo3BfoTaI4XL4gMNmx0XfSnA");
        $location->event_id = $event_id;
        $location->address = $address;
        $location->lng = json_decode($data)->results[0]->geometry->location->lng;
        $location->lat = json_decode($data)->results[0]->geometry->location->lat;

        $location->save();
        
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
            'date' => 'required',
            'time' => 'required'
        ]);

        $event = Event::findOrFail($id);
        $event->name = $request['name'];
        $event->description = $request['description'];
        $event->date_time = $request['date'] . " " . $request['time'];

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

        if(!empty($request['address'])) {
            $location = Location::where('event_id', $id);

            $address = $request['address'];
            $data = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&key=AIzaSyB58LtIzgABo3BfoTaI4XL4gMNmx0XfSnA");

            $location->update([ 
                'address' => $address,
                'lng' => json_decode($data)->results[0]->geometry->location->lng,
                'lat' => json_decode($data)->results[0]->geometry->location->lat
            ]);
        }

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

    public function events()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(15);
        return view('events.events', [
            'events' => $events
        ]); 
    }

    public function event_by_id($id)
    {
        $event = Event::find($id);
        $comments = Comment::where('event_id', $id)->get();

        if(Auth::check()) {
        $is_attending = 
        DB::table("event_user")
            ->where("user_id", Auth::user()->id)
            ->where("event_id", $id)
            ->first();
        } else {
            $is_attending = "";
        }

        return view('events.event_by_id', [
            'event' => $event,
            'comments' => $comments,
            'is_attending' => $is_attending
        ]);
    }

    public function attend_event(Request $request) 
    {
        $event = Event::find($request['event_id']);
        //This will add to the event_user pivot table
        $event->users()->attach(Auth::user()->id);
        return redirect()->back()->with('success','You are attending this event');
    }

    public function unattend_event($id) 
    {
        $event = Event::find($id);
        //This will remove from the event_user pivot table
        $event->users()->detach(Auth::user()->id);
        return redirect()->back()->with('success','You are no longer attending this event');
    }
       
}
