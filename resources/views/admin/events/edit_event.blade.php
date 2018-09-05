@extends('adminlte::page')

@section('title', 'Create Event')

<link rel="stylesheet" href="{{ asset('css/map.css') }}">

@include('admin.includes.scripts')

@section('content_header')
    <div class="container">
        <div class="row">
            <h3>Edit Event</h3>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid py-3 jumbotron">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            {!! Form::open(['method' => 'POST', 'files' => true, 'action' => ['EventController@update', $event->id]]) !!}
                @csrf
                {{ method_field('PATCH') }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name" class="form-control" placeholder="Please the name of you event" value="{{$event->name}}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Pleae enter the description for you event" rows="4">{{$event->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            
                            <input type="date" id="date" name="date" class="form-control" value="{{substr($event->date_time,0,10)}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="time">Time <i>(24 hour)</i> </label>
                            <input type="time" id="time" name="time" class="form-control" value="{{substr($event->date_time,11,15)}}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Current Image</label>
                            <br>
                            <img class="img-responsive" src="{{ asset("images/events/$event->path") }}" alt="" style="width:400px;">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="image">New Image</label>
                            <input type="file" name="image">
                            <span>If you would like to update your image, please pick a new one.</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            Current Location: {{ $event->location->address }}
                        </div>
                        <div class="form-group">
                            <input id="pac-input" class="controls" type="text" placeholder="Enter a location" name="address">
                            <div id="map"></div>
                            <div id="infowindow-content">
                                <span id="place-name"  class="title"></span><br>
                                Place ID <span id="place-id"></span><br>
                                <span id="place-address"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        {!! Form::submit('Update Event', ['class' => 'btn btn-primary btn']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
    </div>
@stop