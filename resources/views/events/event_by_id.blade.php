@extends('layouts.app')

@section('title', 'Events')

<link rel="stylesheet" href="{{ asset('css/map.css') }}">

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
                        {{-- @if(Auth::check())
                        @if($user_attending != null)
                            @if($user_attending[0]['user_id'] == Auth::user()->id && $user_attending[0]['event_id'] == Request::segment(2))
                                {{Form::open(['method'  => 'DELETE', 'route' => ['attend.destroy', $event->attending->id]])}}
                                <button type="submit" class="btn btn-sm btn-warning">Don't Attend</button>
                            @endif
                        @endif
                        @if(empty($user_attending))
                            {!! Form::open(['method' => 'POST', 'route' => ['attend.store']]) !!}
                            {{ method_field('POST') }}
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <input type="hidden" name="attending" value="1">
                            <button type="submit" class="btn btn-sm btn-primary">Attend</button>
                        @endif
                                @csrf
                                --}}<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal{{ $event->id }}">Map</button>{{--
                                <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#attending">See Attending {{$attend_count}}</button>
                            {!! Form::close() !!}
                        @endif --}}


                        {{-- List of people attending this event --}}
                        @component('components.model_basic')
                            @slot('name')
                                attending
                            @endslot
                            @slot('header')
                                Attending
                            @endslot
                            @slot('body')
                                NAMES
                            @endslot
                        @endcomponent
                        {{-- List of people attending this event END--}}


                        {{-- Map for event --}}
                        @component('components.model')
                            @slot('id')
                                {{ $event->id }}
                            @endslot
                            @slot('header')
                                <a target="_blank" href="https://www.google.com/maps/?q={{$event->location->lat}},{{$event->location->lng}}">View in google maps</a>
                            @endslot
                            @slot('body')
                              <style>
                                  /* Always set the map height explicitly to define the size of the div
                                   * element that contains the map. */
                                  #map {
                                    height: 400px;
                                    width: 100%
                                  }
                                </style>
                                <div id="map"></div>
                                <script>
                                    var lng = '<?php echo $event->location->lng; ?>';
                                    var lat = '<?php echo $event->location->lat; ?>';
                                    var $address = '<?php echo $event->location->address; ?>';
                                    lat = Number(lat);
                                    lng = Number(lng);
                                  function initMap() {
                                    var myLatLng = {lat:lat, lng:lng};
                            
                                    var map = new google.maps.Map(document.getElementById('map'), {
                                      zoom: 10,
                                      center: myLatLng
                                    });
                            
                                    var marker = new google.maps.Marker({
                                      position: myLatLng,
                                      map: map,
                                      title: ""+$address
                                    });
                                  }
                                </script>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB58LtIzgABo3BfoTaI4XL4gMNmx0XfSnA&callback=initMap">
                                </script>

                            @endslot
                            @slot('id')
                                {{ $event->id }}
                            @endslot
                        @endcomponent
                        {{-- Map for event END--}}
                    </div>
                </div>
                <div class="comments col-md-12" id="comments">
                    <h3 class="mb-2">Comments</h3>
                    <div class="row pt-2">
                        <div class="col-12">
                            @if(Auth::check())
                                {!! Form::open(['method' => 'POST', 'files' => true, 'route' => ['comments.store']]) !!}
                                    @csrf
                                    <div class="form-group">
                                        <label for="comment">Comment:</label>
                                        <textarea class="form-control" rows="3" name="comment"></textarea>
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary float-right">Post Comment</a>
                                </form>
                            @endif
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
                                        @if(Auth::check())
                                            @if($comment->user_id == Auth::user()->id)
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['comments.destroy', $comment->id]]) !!}
                                                    <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal{{ $comment->id }}">Edit</a>                    
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                {!! Form::close() !!}
                                            @else
                                                <br>
                                            @endif
                                        @else
                                            <br>
                                        @endif
                                        {{-- Comment update --}}
                                        @component('components.model')
                                            @slot('id')
                                                {{ $comment->id }}
                                            @endslot
                                            @slot('header')
                                                Edit Comment
                                            @endslot
                                            @slot('body')
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
                                        {{-- Comment update END--}}
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