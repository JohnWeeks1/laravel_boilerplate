@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <div class="container">
        <div class="row"> 
                <div class="card-columns">
            @foreach($events as $event)
                @component("components.card")
                    @slot('path')
                        {{asset("images/events/$event->path")}}
                    @endslot
                    @slot('name')
                        {{$event->name}}
                    @endslot
                    @slot('description')
                      <b>Location:</b> {{$event->location->address}} <br>
                      <b>Date:</b> {{date('M j, Y h:ia', strtotime($event->date_time))}}</b>
                    @endslot
                    @slot('link')
                        {{url("event/$event->id")}}
                    @endslot
                @endcomponent
            @endforeach
                </div>
        </div>
        <div class="center_paginate">
            {{ $events->links() }}
        </div>
    </div>
@endsection
