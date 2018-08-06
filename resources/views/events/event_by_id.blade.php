@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <div class="row"> 
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
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="comments col-md-12" id="comments">
                            <h3 class="mb-2">Comments</h3>
                            <div class="row pt-2">
                                <div class="col-12">
                                    <form action="{{ url('/create_comment')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="comment">Comment:</label>
                                            <textarea class="form-control" rows="3" name="comment"></textarea>
                                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary float-right">Post Comment</a>
                                    </form>
                                </div>
                            </div>
                            <!-- comment -->
                            <br>
                            
                                <div class="comment mb-2 row">
                                        @foreach($comments as $comment)
                                    <div class="comment-avatar col-md-1 col-sm-2 col-xs-3 text-center pr-1">
                                        <a href=""><img class="mx-auto rounded-circle img-fluid" src="/images/profile_pics/{{ $comment->user->path }}" alt="avatar"></a>
                                    </div>
                                    <div class="comment-content col-md-11 col-sm-10 col-xs-9">
                                    <h6 class="small comment-meta"><a href="#">admin</a>{{ $comment->created_at }}</h6>
                                        <div class="comment-body">
                                            <p>
                                                {{ $comment->comment }}
                                                <br>
                                                <a href="" class="text-right small"><i class="ion-reply"></i> Reply</a>
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            
                            <!-- /comment -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection