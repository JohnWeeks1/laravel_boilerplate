@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <div class="container">
        <div class="row jumbotron"> 
            <div class="col-md-6 text-center">
                <img class="img-fluid" src="{{url("images/events/$event->path")}}">
            </div>
            <div class="col-md-6">
                <div class="col-md-12 text-center">
                    <h1>{{$event->name}}</h1>
                    <p>{{$event->description}}</p>
                </div>
                <div class="col-md-12">
                        <span class="float-left"><b>Creator:</b> {{$event->user->name}}</span>
                        <br>
                        <span class="float-left"> <b>Location:</b> {{$event->location->address}}</span>
                        <br><br>
                        <button class="btn btn-primary btn-sm">Button</button>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal{{ $event->id }}">Map</button> 
                        @component('components.model')
                            @slot('id')
                                {{ $event->id }}
                            @endslot
                            @slot('header')
                                Map
                            @endslot
                            @slot('body')
                                Map Body
                            @endslot
                            @slot('id')
                                {{ $event->id }}
                            @endslot
                        @endcomponent
                    </div>
            </div>
        </div>
    </div>
@endsection