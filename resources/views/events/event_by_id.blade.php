@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <div class="container">
        <div class="jumbotron">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
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


                        {!! Form::open(['method' => 'POST', 'route' => ['attend.store']]) !!}
                            @csrf
                            {{ method_field('POST') }}
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <input type="hidden" name="attending" value="1">
                            @if(empty($event->attend->attending))
                                <button type="submit" class="btn btn-sm btn-primary">Attend</button>
                            @endif
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal{{ $event->id }}">Map</button>
                        {!! Form::close() !!}


                        {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['attend.destroy', $event->attending->id]]) !!}
                            @if(!empty($event->attend->attending))
                                <button type="submit" class="btn btn-sm btn-primary">Don't Attend</button>
                            @endif
                        {!! Form::close() !!} --}}


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
                <div class="comments col-md-12" id="comments">
                    <h3 class="mb-2">Comments</h3>
                    <div class="row pt-2">
                        <div class="col-12">
                                {!! Form::open(['method' => 'POST', 'files' => true, 'route' => ['comments.store']]) !!}
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
                            <div class="comment-avatar col-md-1 col-sm-3 col-3 text-center pr-1">
                                <a href=""><img class="mx-auto rounded-circle img-fluid" src="/images/profile_pics/{{ $comment->user->path }}" alt="avatar" style="width:70px;"></a>
                            </div>
                            <div class="comment-content col-md-11 col-sm-9 col-9">
                            <h6 class="small comment-meta"><a href="#">{{ $comment->user->name }}</a> {{ $comment->created_at }}</h6>
                                <div class="comment-body">
                                    <p>
                                        {{ $comment->comment }}
                                        <br>
                                        @if($comment->user_id == Auth::user()->id)
                                            
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['comments.destroy', $comment->id]]) !!}
                                                <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal{{ $comment->id }}">Edit</a>                    
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            {!! Form::close() !!}
                                        @else
                                            <br>
                                        @endif
                                        @component('components.model')
                                            @slot('id')
                                                {{ $comment->id }}
                                            @endslot
                                            @slot('header')
                                                Edit Comment
                                            @endslot
                                            @slot('body')
                                            {{$comment->id}}
                                            {!! Form::open(['method' => 'POST', 'action' => ['CommentController@update', $comment->id]]) !!}
                                                    @csrf
                                                    {{ method_field('PATCH') }}
                                                    <div class="form-group">
                                                        <label for="comment">Comment:</label>
                                                        <textarea class="form-control" rows="3" name="comment">{{ $comment->comment }}</textarea>
                                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-primary float-right">Update Comment</a>
                                                {!! Form::close() !!}
                                            @endslot
                                            @slot('id')
                                                {{ $comment->id }}
                                            @endslot
                                        @endcomponent
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
@endsection