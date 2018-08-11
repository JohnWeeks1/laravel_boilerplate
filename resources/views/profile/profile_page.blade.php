@extends('layouts.app')

@section('title', 'Events')

<link rel="stylesheet" href="{{ asset('css/map.css') }}">

@section('content')

<div class="container">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-3 col-sm-4 text-center">
                <img class="rounded img-fluid" src="images/profile_pics/{{$user->path}}" alt="">
            </div>
            <div class="col-md-9 col-sm-8">
                <br>
                <h3>{{$user->name}}</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam et nesciunt, iste recusandae vero dolores temporibus assumenda est molestiae optio qui quaerat totam sit doloremque deserunt magni at similique quasi.</p>
                <ul>
                    <li> <a href="">Email</a> </li>
                    <li> <a href="">Whatsapp</a> </li>
                </ul>
                <button class="btn btn-info float-right">Edit</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>Events</h4>
            <div class="card-columns">
                @foreach($user->events as $event)
                    @component("components.card")
                        @slot('path')
                            {{asset("images/events/$event->path")}}
                        @endslot
                        @slot('name')
                            {{$event->name}}
                        @endslot
                        @slot('description')
                            <b>Location:</b> {{$event->location->address}}
                        @endslot
                        @slot('link')
                            {{url("event/$event->id")}}
                        @endslot
                    @endcomponent
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection