@extends('adminlte::page')

@section('title', 'Events')

@include('admin.includes.scripts')

@section('content_header')
    <div class="container">
        <div class="row">
            <h3>Events</h3>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid py-3 jumbotron">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        <div class="row">
            <div class="col-md-8">
                <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm">Create Event</a>
            </div>
        </div>
        <br>
        {{-- {!! Form::open(['method' => 'POST', 'route' => ['events.edit', $event->id]]) !!} --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search&hellip;">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success" style="margin-top: 0px;">Search</button>
                        </span>
                    </div>
                </div>
            </div>
        {{-- {!! Form::close() !!} --}}

        <br>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)    
                    <tr>
                        <td>{{$event->name}}</td>
                        <td>{{$event->location->address}}</td>
                        <td>{{substr("$event->description",0,70)}}...</td>
                        <td>
                            <img src="{{ asset("images/events/$event->path") }}" alt="" style="height:50px;">
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['events.destroy', $event->id]]) !!}
                                <a href="{{ url('admin/events/' . $event->id . '/edit') }}" class="btn btn-warning" style="margin-top:10px;">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>                    
                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit','class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop