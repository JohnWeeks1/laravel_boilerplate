@extends('adminlte::page')

@section('title', 'Events')

@include('admin.includes.scripts')

@section('content_header')
    <div class="container">
        <div class="row">
            <h3>My friends</h3>
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
                    <th>Image</th>
                    <th>Name</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($friends as $friend)    
                    <tr>
                        <td>
                            <img src="{{ asset("images/profile_pics/".$friend->users[0]->path) }}" alt="" width="50">
                        </td>
                        <td>{{$friend->users[0]->name}}</td>
                        <td>
                            @if($friend->approved_or_not == 0)
                                <span class="bg-info">Friendship Pending</span>
                            @elseif($friend->approved_or_not == 1)
                                <a class="btn btn-primary btn-sm" href="{{url('profile/'.$friend->users[0]->id)}}">Profile</a>               
                                <a class="btn btn-danger btn-sm" href="unfriend/{{$friend->user_receiveing_friendship_id}}">Unfriend</a> 
                            @endif
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop