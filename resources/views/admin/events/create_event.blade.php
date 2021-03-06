@extends('adminlte::page')

@section('title', 'Create Event')

<link rel="stylesheet" href="{{ asset('css/map.css') }}">

@include('admin.includes.scripts')

@section('content_header')
    <div class="container">
        <div class="row">
            <h3>Create Event</h3>
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
        {!! Form::open(['method' => 'POST', 'files' => true, 'route' => ['events.store']]) !!}
            @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name" class="form-control" placeholder="Please the name of you event">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Pleae enter the description for you event" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" id="date" name="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="time">Time <i>(24 hour)</i> </label>
                            <input type="time" id="time" name="time" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="col-md-12">
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
                        {!! Form::submit('Create Event', ['class' => 'btn btn-primary btn']) !!}
                    </div>
                </div>
        {!! Form::close() !!}
    </div>
@stop